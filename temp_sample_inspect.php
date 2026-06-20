<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Sample;

$samples = Sample::with(['user','species','result'])->take(10)->get();
if ($samples->isEmpty()) {
    echo "No samples found\n";
    exit(0);
}
foreach ($samples as $s) {
    echo "ID: {$s->id}\n";
    echo "  User: " . ($s->user->email ?? 'none') . "\n";
    echo "  Species: " . ($s->species->name ?? 'none') . "\n";
    echo "  Status: {$s->status}\n";
    echo "  Paid: " . ($s->is_paid ? 'yes' : 'no') . "\n";
    echo "  Result: " . ($s->result ? $s->result->sex_result : 'none') . "\n";
    echo "  Comment: " . ($s->result->comment ?? 'none') . "\n";
    echo "  PDF route: /client/sample/{$s->id}/pdf\n";
    echo "  Show URL: /client/sample/{$s->id}\n";
    echo "\n";
}
