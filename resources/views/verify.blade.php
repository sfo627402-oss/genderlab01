<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Vérification BioScan AI #{{ $sample->id }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css'])
    </head>
    <body class="font-inter antialiased hero-bg min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
        <!-- Background DNA Decoration -->
        <div class="absolute inset-0 opacity-10 pointer-events-none overflow-hidden">
            <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-indigo-500 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-bio-500 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-lg w-full relative z-10">
            <!-- Header Logo -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center gap-4">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-2xl shadow-indigo-500/20 transform -rotate-6">
                        <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                </div>
                <h1 class="mt-6 font-outfit font-black text-3xl text-white uppercase italic tracking-tighter italic">BioScan <span class="text-indigo-400">Validator</span></h1>
                <p class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em] mt-2">Authentification Moléculaire Certifiée</p>
            </div>

            <!-- Content Card -->
            <div class="glass rounded-[3rem] p-10 shadow-2xl relative overflow-hidden group">
                <!-- Glitch Effect Line -->
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-indigo-500 to-transparent opacity-50"></div>
                
                <!-- Status Badge -->
                <div class="flex justify-between items-start mb-12">
                    <div>
                        <p class="text-white/30 text-[9px] font-black uppercase tracking-[0.2em] mb-2">ID_SPECIMEN</p>
                        <h2 class="text-white font-outfit font-black text-3xl tracking-tight">#{{ $sample->id }}</h2>
                    </div>
                    @php
                        $statusColors = [
                            'Pending' => 'bg-amber-500/20 text-amber-400 border-amber-500/30',
                            'Received' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                            'Processing' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                            'Completed' => 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30',
                        ];
                        $statusLabel = [
                            'Pending' => 'EN ATTENTE',
                            'Received' => 'RÉCEPTIONNÉ',
                            'Processing' => 'SÉQUENÇAGE',
                            'Completed' => 'CERTIFIÉ',
                        ];
                    @endphp
                    <div class="px-5 py-2 rounded-xl border {{ $statusColors[$sample->status] ?? 'bg-white/10 text-white border-white/20' }} text-[10px] font-black uppercase tracking-[0.2em]">
                        {{ $statusLabel[$sample->status] ?? $sample->status }}
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-2 gap-6 mb-12">
                    <div class="bg-white/5 border border-white/5 p-5 rounded-3xl group-hover:bg-white/10 transition duration-500">
                        <p class="text-[8px] text-white/30 font-black uppercase tracking-[0.2em] mb-2">TAXONOMIE</p>
                        <p class="text-white font-black text-sm uppercase tracking-tight italic">{{ $sample->species->name }}</p>
                    </div>
                    <div class="bg-white/5 border border-white/5 p-5 rounded-3xl group-hover:bg-white/10 transition duration-500">
                        <p class="text-[8px] text-white/30 font-black uppercase tracking-[0.2em] mb-2">ORIGINE</p>
                        <p class="text-white font-black text-sm uppercase tracking-tight italic">{{ explode(' ', $sample->user->name)[0] }}</p>
                    </div>
                    <div class="bg-white/5 border border-white/5 p-5 rounded-3xl group-hover:bg-white/10 transition duration-500">
                        <p class="text-[8px] text-white/30 font-black uppercase tracking-[0.2em] mb-2">BIOMARQUEUR</p>
                        <p class="text-white font-black text-sm uppercase tracking-tight italic capitalize">{{ $sample->sample_type }}</p>
                    </div>
                    <div class="bg-white/5 border border-white/5 p-5 rounded-3xl group-hover:bg-white/10 transition duration-500">
                        <p class="text-[8px] text-white/30 font-black uppercase tracking-[0.2em] mb-2">DATATION</p>
                        <p class="text-white font-black text-sm uppercase tracking-tight italic">{{ $sample->created_at->format('d M, Y') }}</p>
                    </div>
                </div>

                <!-- Result Area -->
                <div class="pt-10 border-t border-white/10">
                    @if($sample->status === 'Completed' && $sample->result)
                        @if($sample->client_access_granted)
                            <div class="text-center py-10 bg-emerald-500/10 rounded-[2.5rem] border border-emerald-500/20 relative overflow-hidden group/result">
                                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-transparent"></div>
                                <p class="text-emerald-900/40 text-[9px] font-black uppercase tracking-[0.3em] mb-8 relative z-10">RAPPORT DISPONIBLE</p>

                                <div class="relative z-10 mb-8">
                                    @if($sample->result->sex_result == 'Male')
                                        <div class="inline-flex w-24 h-24 bg-indigo-600 rounded-full items-center justify-center text-white text-5xl shadow-[0_0_50px_rgba(79,70,229,0.4)] font-black">♂</div>
                                        <h3 class="mt-6 text-slate-900 font-outfit font-black text-5xl tracking-tighter uppercase italic">MÂLE</h3>
                                    @elseif($sample->result->sex_result == 'Female')
                                        <div class="inline-flex w-24 h-24 bg-pink-500 rounded-full items-center justify-center text-white text-5xl shadow-[0_0_50px_rgba(236,72,153,0.4)] font-black">♀</div>
                                        <h3 class="mt-6 text-slate-900 font-outfit font-black text-5xl tracking-tighter uppercase italic">FEMELLE</h3>
                                    @else
                                        <div class="inline-flex w-24 h-24 bg-slate-700 rounded-full items-center justify-center text-white text-5xl font-black">?</div>
                                        <h3 class="mt-6 text-slate-900 font-outfit font-black text-4xl tracking-tighter uppercase italic">NON CONCLUANT</h3>
                                    @endif
                                </div>

                                <div class="relative z-10 grid grid-cols-2 gap-4 px-10">
                                    <div class="text-center">
                                        <span class="block text-[8px] font-black text-slate-500 uppercase tracking-[0.2em] mb-1">Confiance</span>
                                        <span class="text-emerald-700 font-black text-lg">{{ $sample->result->confidence_score }}%</span>
                                    </div>
                                    <div class="text-center">
                                        <span class="block text-[8px] font-black text-slate-500 uppercase tracking-[0.2em] mb-1">Qualité</span>
                                        <span class="text-indigo-700 font-black text-lg uppercase tracking-tighter">{{ $sample->result->quality_check == 'Good' ? 'PREMIUM' : 'LOW' }}</span>
                                    </div>
                                </div>

                                @if($sample->result->comment)
                                    <div class="mt-10 mx-auto max-w-2xl bg-white/90 text-slate-900 p-6 rounded-[2rem] border border-emerald-100">
                                        <p class="text-sm italic">"{{ $sample->result->comment }}"</p>
                                    </div>
                                @endif

                                <div class="mt-12">
                                    <a href="{{ route('client.sample.pdf', $sample->id) }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-slate-900 text-white text-xs font-black uppercase tracking-[0.2em] hover:bg-slate-800 transition">
                                        Télécharger le rapport PDF
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-16">
                                <div class="relative w-20 h-20 mx-auto mb-8">
                                    <div class="absolute inset-0 border-4 border-white/5 rounded-full"></div>
                                    <div class="absolute inset-0 border-4 border-amber-500 rounded-full border-t-transparent animate-spin"></div>
                                    <svg class="absolute inset-0 m-auto h-8 w-8 text-amber-400/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-black text-white font-outfit uppercase italic tracking-tight italic">Rapport bloqué</h4>
                                <p class="mt-3 text-[10px] text-white/30 uppercase tracking-[0.2em] font-bold">Le rapport est prêt, mais l’accès client n’est pas encore autorisé.</p>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-16">
                            <div class="relative w-20 h-20 mx-auto mb-8">
                                <div class="absolute inset-0 border-4 border-white/5 rounded-full"></div>
                                <div class="absolute inset-0 border-4 border-indigo-500 rounded-full border-t-transparent animate-spin"></div>
                                <svg class="absolute inset-0 m-auto h-8 w-8 text-indigo-400/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                            </div>
                            <h4 class="text-xl font-black text-white font-outfit uppercase italic tracking-tight italic">Analyse en cours</h4>
                            <p class="mt-3 text-[10px] text-white/30 uppercase tracking-[0.2em] font-bold">Le prélèvement est toujours en cours de traitement en laboratoire.</p>
                        </div>
                    @endif
                </div>
                
                <!-- Security Note -->
                <div class="mt-12 flex items-center justify-center gap-3 text-[9px] text-white/20 uppercase tracking-[0.2em] font-black">
                    <div class="w-2 h-px bg-white/20"></div>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3 h-3 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Official Validation Node
                    </span>
                    <div class="w-2 h-px bg-white/20"></div>
                </div>
            </div>

            <p class="text-center mt-12 text-white/20 text-[9px] font-black uppercase tracking-[0.4em]">
                BIOSCAN AI • SECURITY LAYER
            </p>
        </div>
    </body>
</html>
