<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Sample;
use App\Models\Species;
use App\Models\Result;
use Illuminate\Support\Str;

$client = User::where('email', 'client@client.com')->first();
$biologist = User::where('email', 'biologist@admin.com')->first();
$species = Species::first();

if (!$client || !$biologist || !$species) {
    echo "Missing seeded test data.\n";
    exit(1);
}

$sample = Sample::create([
    'user_id' => $client->id,
    'species_id' => $species->id,
    'sample_type' => 'blood',
    'quantity' => 2,
    'notes' => 'Test sample submission',
    'qr_code' => Str::uuid()->toString(),
    'status' => 'Pending',
    'is_paid' => false,
]);

echo "Created sample id={$sample->id}, status={$sample->status}, paid=" . ($sample->is_paid ? 'yes' : 'no') . "\n";

$result = Result::create([
    'sample_id' => $sample->id,
    'biologist_id' => $biologist->id,
    'sex_result' => 'Female',
    'confidence_score' => 92,
    'quality_check' => 'Good',
    'comment' => 'Analysis completed successfully.',
    'status' => 'validated',
]);

$sample->update(['status' => 'Completed']);

$sampleFresh = Sample::with(['result'])->find($sample->id);

echo "After biologiste: sample id={$sampleFresh->id}, status={$sampleFresh->status}, hasResult=" . ($sampleFresh->result ? 'yes' : 'no') . "\n";

echo "Client view before payment: ";
if ($sampleFresh->status === 'Completed' && $sampleFresh->result) {
    echo "result present, but payment required\n";
} else {
    echo "result not available yet\n";
}

$sampleFresh->update(['is_paid' => true]);
$samplePaid = Sample::with(['result'])->find($sample->id);

echo "After payment: sample paid=" . ($samplePaid->is_paid ? 'yes' : 'no') . ", hasResult=" . ($samplePaid->result ? 'yes' : 'no') . "\n";

if ($samplePaid->status === 'Completed' && $samplePaid->result && $samplePaid->is_paid) {
    echo "Client can see biologist result: Sex={$samplePaid->result->sex_result}, Confidence={$samplePaid->result->confidence_score}, Quality={$samplePaid->result->quality_check}\n";
}
