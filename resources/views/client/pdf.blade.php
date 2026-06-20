<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport d'Analyse - {{ $sample->qr_code }}</title>
    <!-- Tailwind CSS for styling -->
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .no-print { display: none !important; }
        }
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background: #e5e7eb; padding: 20px;}
        .a4-page {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            padding: 40px 50px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="text-gray-800">
    <div class="text-center mb-6 no-print">
        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow">
            Imprimer en PDF
        </button>
        <a href="{{ route('client.sample.show', $sample->id) }}" class="ml-4 text-blue-600 hover:underline">Retour au Dashboard</a>
    </div>

    <div class="a4-page relative">
        <!-- Header -->
        <div class="flex justify-between items-start border-b-2 border-indigo-600 pb-6 mb-6">
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 50px; margin-bottom: 10px;">
                <h1 class="text-3xl font-black text-indigo-800 tracking-tight">Certificat de laboratoire</h1>
                <p class="text-xs text-gray-500 uppercase font-bold tracking-widest mt-1">GenDer Lab — Laboratoire de Biotechnologie</p>
                <p class="text-sm text-gray-500 mt-2">Algérie</p>
                <p class="text-sm text-gray-500">info.genderlab.dz@gmail.com | 06 69 08 47 02</p>
            </div>
            <div class="text-right">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ $sample->qr_code }}" alt="QR Code" class="inline-block" />
                <p class="text-xs text-gray-400 mt-1">Réf: {{ substr($sample->qr_code, 0, 8) }}</p>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-center uppercase tracking-wider mb-8 text-gray-800 bg-gray-100 py-3 rounded-md">
            Certificat de Sexage ADN
        </h2>

        <!-- Data Grids -->
        <div class="grid grid-cols-2 gap-8 mb-8">
            <div>
                <h3 class="text-sm font-bold text-indigo-700 uppercase border-b border-indigo-200 pb-1 mb-3">Informations Client</h3>
                <p class="text-lg font-semibold">{{ $sample->user->name }}</p>
                <p class="text-sm text-gray-600">{{ $sample->user->email }}</p>
                <p class="text-sm text-gray-600 mt-2"><strong>Date de prélèvement:</strong> {{ $sample->created_at->format('d/m/Y') }}</p>
                <p class="text-sm text-gray-600"><strong>Date du rapport:</strong> {{ $sample->result->updated_at->format('d/m/Y') }}</p>
            </div>

            <div>
                <h3 class="text-sm font-bold text-indigo-700 uppercase border-b border-indigo-200 pb-1 mb-3">Détails de l'Échantillon</h3>
                <p class="text-lg font-semibold italic">{{ $sample->species->name }}</p>
                <p class="text-sm text-gray-600">Famille: {{ $sample->species->family }}</p>
                <p class="text-sm text-gray-600 mt-2"><strong>Type d'échantillon:</strong> {{ ucfirst($sample->sample_type) }}</p>
                <p class="text-sm text-gray-600"><strong>Qualité reçue:</strong> {{ $sample->result->quality_check == 'Good' ? 'Excellente' : 'Médiocre' }}</p>
            </div>
        </div>

        <!-- Result Box -->
        <div class="border-4 border-indigo-100 p-8 text-center rounded-xl my-10 bg-indigo-50">
            <h3 class="text-sm font-bold text-gray-500 uppercase mb-4">Résultat de l'Analyse</h3>
            
            @if($sample->result->sex_result == 'Male')
                <div class="text-5xl font-black text-blue-600 mb-2 font-sans tracking-wide">MÂLE ♂</div>
            @elseif($sample->result->sex_result == 'Female')
                <div class="text-5xl font-black text-pink-600 mb-2 font-sans tracking-wide">FEMELLE ♀</div>
            @else
                <div class="text-3xl font-black text-gray-600 mb-2">NON CONCLUANT</div>
            @endif

            <div class="inline-block mt-4 bg-white px-4 py-1 rounded-full text-sm font-bold shadow-sm {{ $sample->result->confidence_score > 95 ? 'text-green-600' : 'text-orange-500' }}">
                Fiabilité IA / Validation: {{ $sample->result->confidence_score }}%
            </div>
        </div>

        <!-- Comments & Signatures -->
        <div class="mb-10">
            <h3 class="text-sm font-bold text-indigo-700 uppercase border-b border-indigo-200 pb-1 mb-3">Commentaires du Biologiste</h3>
            <p class="text-sm text-gray-700 italic bg-gray-50 p-4 rounded-md min-h-[60px] border border-gray-100">
                {{ $sample->result->comment ?: 'Analyse standard. Aucune anomalie détectée lors de l\'amplification PCR.' }}
            </p>
        </div>

        <div class="flex justify-between items-end mt-16 pt-8 border-t border-gray-200">
            <div class="text-xs text-gray-400 max-w-[250px]">
                Ce document est généré électroniquement et validé par notre laboratoire. Toute falsification est interdite.
            </div>
            <div class="text-center">
                <p class="text-sm text-gray-600 mb-2">Validé par : <strong>{{ $sample->result->biologist->name ?? 'Dr. Expert' }}</strong></p>
                <div class="font-signature text-3xl text-blue-900 border-2 border-indigo-100 px-8 py-2 rounded -rotate-3 opacity-80 inline-block bg-indigo-50/50">
                    Validé par le laboratoire
                </div>
            </div>
        </div>
    </div>
</body>
</html>
