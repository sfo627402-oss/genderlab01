<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Sample;
use App\Models\Species;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.index');
        } elseif ($user->role === 'biologist') {
            return redirect()->route('lab.samples');
        }

        $samples = Sample::where('user_id', $user->id)
            ->with(['species', 'result'])
            ->latest()
            ->get();
        
        $species = Species::all();
        
        // Calculate profile completeness
        $profile_progress = 0;
        if($user->phone) $profile_progress += 33;
        if($user->address) $profile_progress += 33;
        if($user->breeder_id) $profile_progress += 34;

        return view('dashboard', compact('samples', 'species', 'profile_progress'));
    }

    public function verifyQr($qr_code)
    {
        $sample = Sample::where('qr_code', $qr_code)
            ->with(['species', 'result', 'user'])
            ->firstOrFail();

        return view('verify', compact('sample'));
    }
}
