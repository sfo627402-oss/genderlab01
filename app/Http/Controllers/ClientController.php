<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sample;
use App\Models\Species;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function submitForm()
    {
        $species = Species::all();
        return view('client.submit', compact('species'));
    }

    public function storeSample(Request $request)
    {
        $request->validate([
            'species_id' => 'required',
            'sample_type' => 'required|in:feather,blood,eggshell',
            'quantity' => 'required|integer|min:1',
            'delivery_method' => 'required|in:courier,dropoff',
            'pre_scan_image' => 'sometimes|file|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('pre_scan_image')) {
            $file = $request->file('pre_scan_image');
            if ($file && $file->isValid() && $file->getSize() > 0) {
                $extension = strtolower($file->getClientOriginalExtension());
                if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                    return back()->withErrors(['pre_scan_image' => 'Le fichier doit être une image JPG, JPEG, PNG ou GIF.'])->withInput();
                }
                $filename = uniqid('pre_scan_', true) . '.' . $extension;
                $storagePath = storage_path('app/public/pre_scans');
                if (!file_exists($storagePath)) {
                    mkdir($storagePath, 0755, true);
                }
                $file->move($storagePath, $filename);
                $imagePath = 'pre_scans/' . $filename;
            }
        }

        $speciesId = $request->species_id;
        if ($speciesId === 'autre') {
            $otherSp = Species::firstOrCreate(
                ['name' => 'Autre / Inconnue'],
                ['family' => 'Non spécifié', 'description' => 'Saisie libre / Espèce inconnue']
            );
            $speciesId = $otherSp->id;
        }

        $sample = Sample::create([
            'user_id' => Auth::id(),
            'species_id' => $speciesId,
            'sample_type' => $request->sample_type,
            'quantity' => $request->quantity,
            'notes' => $request->notes,
            'qr_code' => Str::uuid()->toString(),
            'status' => 'Pending',
            'payment_required' => false,
            'pre_scan_image_path' => $imagePath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Sample submitted successfully. Please print the QR code and attach it to your sample.');
    }

    public function showSample($id)
    {
        $sample = Sample::where('user_id', Auth::id())
            ->with(['species', 'result'])
            ->findOrFail($id);

        if ($sample->status === 'Completed' && $sample->result) {
            $sample->load('result.biologist');
        }

        return view('client.sample_show', compact('sample'));
    }

    public function instructionsPage()
    {
        return view('client.instructions');
    }

    public function printReport($id)
    {
        $sample = Sample::where('user_id', Auth::id())->with(['species', 'result', 'user', 'result.biologist'])->findOrFail($id);
        
        if ($sample->status !== 'Completed') {
            abort(403, 'Report not available until the analysis is completed.');
        }

        if (!$sample->client_access_granted) {
            abort(403, 'Report not available until the administrator grants access.');
        }

        return view('client.pdf', compact('sample'));
    }
}
