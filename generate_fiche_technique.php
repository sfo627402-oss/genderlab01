<?php
// Simple PDF generator for the technical sheet
function pdfEscape($text) {
    return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $text);
}

$lines = [
    'FICHE TECHNIQUE - BioScan AI',
    '',
    '1. Présentation',
    '- Nom du projet : bioscan-ai-main',
    '- Thème : plateforme de sexage ADN et détection pathogènes',
    '- Objectif : soumission client, saisie biologiste, consultation rapport avec paiement livraison',
    '',
    '2. Stack technique',
    '- Backend : PHP 8 + Laravel 12',
    '- Frontend : Blade + Tailwind CSS + Vite',
    '- Base de données : SQLite, Eloquent ORM',
    '- Authentification : Laravel Breeze',
    '',
    '3. Architecture',
    '- Pattern : MVC',
    '- Routes : routes/web.php',
    '- Contrôleurs : ClientController, BiologistController, DashboardController',
    '- Modèles : Sample, Result, Species, User',
    '- Vues : client/sample_show, welcome, layouts/app',
    '',
    '4. Base de données',
    '- Tables : users, species, samples, results',
    '- Migrations : create_species, create_results, create_samples',
    '- Seeders : DatabaseSeeder, ExampleSeeder',
    '',
    '5. Workflow fonctionnel',
    'Client : soumission / suivi / rapport / paiement livraison',
    'Biologiste : scan QR / statut / saisie analyse / validation',
    'Paiement : route POST /client/sample/{id}/pay et flag is_paid',
    '',
    '6. Routes clés',
    '- GET /client/submit',
    '- POST /client/submit',
    '- GET /client/sample/{id}',
    '- POST /client/sample/{id}/pay',
    '- GET /client/sample/{id}/pdf',
    '- GET /lab/samples',
    '- POST /lab/sample/{id}/analyze',
    '',
    '7. Fichiers importants',
    '- routes/web.php',
    '- app/Http/Controllers/ClientController.php',
    '- app/Http/Controllers/BiologistController.php',
    '- app/Models/Sample.php',
    '- app/Models/Result.php',
    '- resources/views/client/sample_show.blade.php',
    '',
    '8. Installation et exécution',
    '1. copier .env.example en .env',
    '2. composer install',
    '3. npm install',
    '4. npm run build',
    '5. php artisan key:generate',
    '6. php artisan migrate --seed',
    '7. php artisan serve --host=127.0.0.1 --port=8000',
    '',
    '9. Points à noter',
    '- Paiement non connecté à un service réel',
    '- Affichage paiement livraison dans la vue client',
    '- Comptes de test : client@client.com / biologist@admin.com / password',
    '',
    '10. Utilisation prévue',
    '- Démonstration client -> labo -> client',
    '- Génération de rapport PDF',
    '- Interface multi-rôles client / biologiste / admin',
];

$contents = "BT\n/F1 18 Tf 50 800 Td (" . pdfEscape(array_shift($lines)) . ") Tj\n/F1 12 Tf\n";
$y = 780;
foreach ($lines as $line) {
    if ($line === '') {
        $y -= 14;
        $contents .= "0 -14 Td () Tj\n";
    } else {
        $contents .= "0 -14 Td (" . pdfEscape($line) . ") Tj\n";
    }
}
$contents .= "ET";

$pdf = "%PDF-1.4\n";
$pdf .= "1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj\n";
$pdf .= "2 0 obj<</Type/Pages/Count 1/Kids[3 0 R]>>endobj\n";
$pdf .= "3 0 obj<</Type/Page/Parent 2 0 R/MediaBox[0 0 595 842]/Resources<</Font<</F1 4 0 R>>>>/Contents 5 0 R>>endobj\n";
$pdf .= "4 0 obj<</Type/Font/Subtype/Type1/BaseFont/Times-Roman>>endobj\n";
$pdf .= "5 0 obj<</Length " . strlen($contents) . ">>stream\n";
$pdf .= $contents . "\nendstream\nendobj\n";

$xref = "xref\n0 6\n0000000000 65535 f \n";
$positions = [];
$offset = strlen($pdf);
$pdfSoFar = "%PDF-1.4\n1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj\n2 0 obj<</Type/Pages/Count 1/Kids[3 0 R]>>endobj\n3 0 obj<</Type/Page/Parent 2 0 R/MediaBox[0 0 595 842]/Resources<</Font<</F1 4 0 R>>>>/Contents 5 0 R>>endobj\n4 0 obj<</Type/Font/Subtype/Type1/BaseFont/Times-Roman>>endobj\n";
$pos1 = strlen("%PDF-1.4\n");
$pos2 = $pos1 + strlen("1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj\n");
$pos3 = $pos2 + strlen("2 0 obj<</Type/Pages/Count 1/Kids[3 0 R]>>endobj\n");
$pos4 = $pos3 + strlen("3 0 obj<</Type/Page/Parent 2 0 R/MediaBox[0 0 595 842]/Resources<</Font<</F1 4 0 R>>>>/Contents 5 0 R>>endobj\n");
$pos5 = $pos4 + strlen("4 0 obj<</Type/Font/Subtype/Type1/BaseFont/Times-Roman>>endobj\n");
$pos6 = $pos5;

$xref .= sprintf("%010d 00000 n \n%010d 00000 n \n%010d 00000 n \n%010d 00000 n \n%010d 00000 n \n", $pos1, $pos2, $pos3, $pos4, $pos5);

$startxref = strlen($pdf) + strlen($contents) + strlen("5 0 obj<</Length " . strlen($contents) . ">>stream\n") + 1; // approximate

$pdf .= $xref;
$pdf .= "trailer<</Size 6/Root 1 0 R>>\nstartxref\n" . $startxref . "\n%%EOF";

file_put_contents('bioscan-ai-technical-sheet.pdf', $pdf);
echo "PDF generated: bioscan-ai-technical-sheet.pdf\n";
