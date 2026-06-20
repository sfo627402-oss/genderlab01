<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Species;
use App\Models\Sample;
use App\Models\Result;

class ExampleSeeder extends Seeder
{
    public function run()
    {
        $client = User::where('email', 'client@client.com')->first();
        $biologist = User::where('email', 'biologist@admin.com')->first();
        $species = Species::where('name', 'Ara ararauna')->first();
        
        if ($client && $biologist && $species) {
            $sample = Sample::create([
                'user_id' => $client->id,
                'species_id' => $species->id,
                'sample_type' => 'feather',
                'quantity' => 4,
                'status' => 'Completed',
                'qr_code' => 'DEMO-ARA-999',
                'notes' => "Demande d'analyse en urgence. Plumes de grande taille.",
                'is_paid' => false
            ]);
            
            Result::create([
                'sample_id' => $sample->id,
                'biologist_id' => $biologist->id,
                'sex_result' => 'Female',
                'confidence_score' => 99,
                'quality_check' => 'Good',
                'comment' => "Profil ADN rubis parfaitement lisible. Sexage M/F conclu sans équivoque.",
                'status' => 'validated'
            ]);
        }
    }
}
