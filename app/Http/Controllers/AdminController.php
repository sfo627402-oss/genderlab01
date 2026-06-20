<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sample;
use App\Models\Species;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'samples' => Sample::count(),
            'species' => Species::count(),
            'revenue' => Sample::where('is_paid', true)->count() * 15, // 15€ per sample
            'growth' => 24, // Simulated growth %
        ];
        
        $status_dist = [
            'pending' => Sample::where('status', 'Pending')->count(),
            'received' => Sample::where('status', 'Received')->count(),
            'processing' => Sample::where('status', 'Processing')->count(),
            'completed' => Sample::where('status', 'Completed')->count(),
        ];
        
        $recent_users = User::latest()->take(5)->get();
        $recent_samples = Sample::with(['species', 'user'])->latest()->take(5)->get();

        return view('admin.index', compact('stats', 'recent_users', 'recent_samples', 'status_dist'));
    }

    public function toggleClientAccess(Request $request, $id)
    {
        $sample = Sample::findOrFail($id);
        $sample->update(['client_access_granted' => !$sample->client_access_granted]);

        return back()->with('success', 'L’accès client a été mis à jour pour cet échantillon.');
    }

    public function destroySample(Request $request, $id)
    {
        $sample = Sample::findOrFail($id);
        $sample->delete();

        return back()->with('success', 'Échantillon supprimé avec succès.');
    }
}
