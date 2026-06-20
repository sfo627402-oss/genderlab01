<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-outfit font-black text-3xl text-white leading-tight">
                    Échantillon <span class="bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 px-3 py-1 rounded-lg">#{{ $sample->id }}</span>
                </h2>
                <p class="text-slate-400 text-sm mt-1">Détails et rapport d'analyse moléculaire.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-slate-400 hover:text-white transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Retour
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50/80 backdrop-blur-sm border border-green-200 text-green-800 px-6 py-4 rounded-2xl shadow-sm flex items-center gap-3 animate-fade-in-up">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-black text-sm uppercase tracking-tight">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Data Column -->
                <div class="lg:col-span-2 space-y-10">
                    <!-- Journey Timeline -->
                    <div class="bg-white shadow-xl shadow-indigo-900/5 sm:rounded-[3rem] p-10 border border-slate-100 relative overflow-hidden">
                        <h3 class="text-2xl font-black font-outfit text-slate-900 mb-10 flex items-center gap-4 uppercase italic tracking-tight italic">
                            Traceur de <span class="text-indigo-600">Séquençage</span>
                        </h3>

                        <div class="relative">
                            <div class="absolute top-7 left-10 right-10 h-0.5 bg-slate-100 hidden md:block"></div>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 relative z-10 text-center">
                                @php
                                    $steps = [
                                        ['id' => 'Pending', 'label' => 'Register', 'icon' => 'M12 4v16m8-8H4'],
                                        ['id' => 'Received', 'label' => 'Reception', 'icon' => 'M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4'],
                                        ['id' => 'Processing', 'label' => 'PCR Logic', 'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
                                        ['id' => 'Completed', 'label' => 'Certified', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z']
                                    ];
                                    $currentIndex = 0;
                                    foreach($steps as $idx => $s) { if($s['id'] == $sample->status) $currentIndex = $idx; }
                                @endphp

                                @foreach($steps as $idx => $step)
                                    @php
                                        $isPast = $idx <= $currentIndex;
                                        $isCurrent = $idx == $currentIndex;
                                    @endphp
                                    <div class="flex flex-col items-center group">
                                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-all duration-700 {{ $isPast ? ($isCurrent ? 'bg-indigo-600 text-white shadow-2xl shadow-indigo-600/40 scale-110 ring-8 ring-indigo-50 border border-white/20' : 'bg-indigo-100 text-indigo-600 border border-indigo-200') : 'bg-slate-50 text-slate-300 border border-slate-100' }}">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"></path></svg>
                                        </div>
                                        <p class="mt-4 text-[9px] font-black uppercase tracking-[0.2em] {{ $isPast ? 'text-slate-900' : 'text-slate-400' }}">{{ $step['label'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Global Info Box -->
                    <div class="bg-white shadow-xl shadow-indigo-900/5 sm:rounded-[3rem] p-10 border border-slate-100 relative overflow-hidden group">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-8 flex items-center gap-2">
                            <div class="w-1 h-1 bg-slate-900 rounded-full"></div>
                            Spécification Technique
                        </h3>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 relative z-10">
                            <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100 hover:bg-white transition group/item">
                                <p class="text-[8px] text-slate-400 font-black uppercase tracking-[0.2em] mb-2">Taxonomie</p>
                                <p class="text-sm font-black text-slate-900 leading-tight uppercase tracking-tight italic">{{ $sample->species->name }}</p>
                            </div>
                            <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100 hover:bg-white transition group/item">
                                <p class="text-[8px] text-slate-400 font-black uppercase tracking-[0.2em] mb-2">Support</p>
                                <p class="text-sm font-black text-slate-900 leading-tight uppercase tracking-tight italic capitalize">{{ $sample->sample_type }} <span class="text-[10px] text-slate-400 opacity-50 ml-0.5">x{{ $sample->quantity }}</span></p>
                            </div>
                            <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100 hover:bg-white transition group/item">
                                <p class="text-[8px] text-slate-400 font-black uppercase tracking-[0.2em] mb-2">Timeline</p>
                                <p class="text-sm font-black text-slate-900 leading-tight uppercase tracking-tight italic">{{ $sample->created_at->format('d M, Y') }}</p>
                            </div>
                            <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100 hover:bg-white transition group/item">
                                <p class="text-[8px] text-slate-400 font-black uppercase tracking-[0.2em] mb-2">Bio-Status</p>
                                @php
                                    $color = 'slate';
                                    if($sample->status == 'Received') $color = 'blue';
                                    if($sample->status == 'Processing') $color = 'amber';
                                    if($sample->status == 'Completed') $color = 'emerald';
                                @endphp
                                <span class="px-3 py-1 bg-{{$color}}-500 text-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-lg shadow-{{$color}}-500/20">
                                    {{ $sample->status }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Result Section -->
                    <div class="bg-white shadow-2xl shadow-indigo-900/5 sm:rounded-[3rem] border border-slate-100 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-indigo-500/5 rounded-full blur-[100px] group-hover:bg-indigo-500/10 transition duration-1000"></div>

                        <div class="p-10 relative z-10">
                            <div class="flex items-center justify-between mb-12">
                                <div class="flex items-center gap-4">
                                    <div class="bg-slate-900 p-3 rounded-2xl text-white shadow-xl shadow-slate-900/20">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                    </div>
                                    <h3 class="text-2xl font-black font-outfit text-slate-900 uppercase italic tracking-tight italic">Verdict <span class="text-indigo-600">ADN</span> Certifié</h3>
                                </div>
                                <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border border-slate-100 px-4 py-2 rounded-xl">Diagnostic Terminal</div>
                            </div>

                            @if($sample->status === 'Completed' && $sample->result)
                                @if($sample->client_access_granted)
                                    <div class="bg-emerald-100 rounded-[2rem] p-8 border border-emerald-200 text-emerald-900 mb-8">
                                        <div class="text-sm font-black uppercase tracking-[0.2em] mb-3">Analyse gratuite</div>
                                        <p class="text-sm leading-relaxed">
                                            Ce prélèvement est offert. Le rapport est disponible immédiatement.
                                        </p>
                                    </div>

                                    <div class="text-center py-10">
                                            <div class="relative inline-block mb-10">
                                                @if($sample->result->sex_result == 'Male')
                                                <div class="w-40 h-40 bg-indigo-600 rounded-full flex items-center justify-center text-white text-6xl shadow-2xl shadow-indigo-600/40 relative z-10 font-black">♂</div>
                                                <div class="absolute -inset-4 bg-indigo-600/20 rounded-full animate-ping opacity-20"></div>
                                            @elseif($sample->result->sex_result == 'Female')
                                                <div class="w-40 h-40 bg-pink-500 rounded-full flex items-center justify-center text-white text-6xl shadow-2xl shadow-pink-500/40 relative z-10 font-black">♀</div>
                                                <div class="absolute -inset-4 bg-pink-500/20 rounded-full animate-ping opacity-20"></div>
                                            @else
                                                <div class="w-40 h-40 bg-slate-900 rounded-full flex items-center justify-center text-white text-6xl relative z-10">?</div>
                                            @endif
                                        </div>
                                        
                                        <h2 class="text-5xl font-black font-outfit uppercase italic tracking-tighter italic {{ $sample->result->sex_result == 'Male' ? 'text-indigo-600' : ($sample->result->sex_result == 'Female' ? 'text-pink-600' : 'text-slate-900') }}">
                                            {{ $sample->result->sex_result == 'Male' ? 'Alpha Male' : ($sample->result->sex_result == 'Female' ? 'Alpha Female' : 'Inconclusive') }}
                                        </h2>
                                        
                                        <div class="mt-12 grid grid-cols-2 gap-6 max-w-lg mx-auto">
                                            <div class="bg-slate-50 border border-slate-100 p-6 rounded-[2rem]">
                                                <span class="block text-[8px] uppercase tracking-[0.2em] text-slate-400 font-black mb-2">Confiance IA</span>
                                                <span class="font-black text-slate-900 text-2xl font-outfit">{{ $sample->result->confidence_score }}<span class="text-xs ml-0.5 opacity-50">%</span></span>
                                            </div>
                                            <div class="bg-slate-50 border border-slate-100 p-6 rounded-[2rem]">
                                                <span class="block text-[8px] uppercase tracking-[0.2em] text-slate-400 font-black mb-2">Qualité Bio</span>
                                                <span class="font-black text-slate-900 text-2xl font-outfit">{{ $sample->result->quality_check == 'Good' ? 'PREMIUM' : 'LOW' }}</span>
                                            </div>
                                        </div>

                                        @if($sample->result->comment)
                                            <div class="mt-12 text-left bg-slate-50 p-8 rounded-[2.5rem] border border-slate-100 relative group/note">
                                                <div class="absolute top-0 right-10 bg-white border border-slate-100 px-4 py-1.5 rounded-b-xl text-[8px] font-black uppercase tracking-[0.2em] text-slate-400">Expert Note</div>
                                                <p class="italic text-slate-600 leading-relaxed font-serif text-lg">"{{ $sample->result->comment }}"</p>
                                            </div>
                                        @endif

                                        <div class="mt-16 flex flex-col md:flex-row gap-6 justify-center">
                                            <a href="{{ route('client.sample.pdf', $sample->id) }}" target="_blank" class="bg-slate-900 hover:bg-indigo-600 text-white font-black text-[10px] uppercase tracking-[0.2em] px-12 py-6 rounded-2xl shadow-2xl shadow-slate-900/20 transition-all transform hover:-translate-y-1">
                                                Télécharger le Certificat
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="py-24 text-center relative z-10 flex flex-col items-center">
                                        <div class="w-32 h-32 bg-slate-50 rounded-full flex items-center justify-center mb-10 relative">
                                            <div class="absolute inset-0 border-4 border-slate-400 rounded-full border-t-transparent animate-spin"></div>
                                            <svg class="h-10 w-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                            </svg>
                                        </div>
                                        <h4 class="text-2xl font-black font-outfit uppercase tracking-tight italic">Accès restreint</h4>
                                        <p class="mt-4 text-sm text-slate-400 max-w-sm font-medium leading-relaxed">
                                            Le rapport existe mais l’accès n’est pas encore autorisé par l’administrateur. Aucun détail d’analyse n’est affiché pour le moment.
                                        </p>
                                    </div>
                                @endif
                            @else
                                @if($sample->client_access_granted)
                                    <div class="py-24 text-center relative z-10 flex flex-col items-center">
                                        <div class="w-32 h-32 bg-slate-50 rounded-full flex items-center justify-center mb-10 relative">
                                            <div class="absolute inset-0 border-4 border-emerald-500 rounded-full border-t-transparent animate-spin"></div>
                                            <svg class="h-10 w-10 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                            </svg>
                                        </div>
                                        <h4 class="text-2xl font-black font-outfit uppercase tracking-tight italic">Accès autorisé</h4>
                                        <p class="mt-4 text-sm text-slate-400 max-w-sm font-medium leading-relaxed">
                                            Votre administrateur a déjà autorisé l’accès. L’analyse est toujours en cours, les résultats seront disponibles dès qu’elle sera terminée.
                                        </p>
                                    </div>
                                @else
                                    <div class="py-24 text-center relative z-10 flex flex-col items-center">
                                        <div class="w-32 h-32 bg-slate-50 rounded-full flex items-center justify-center mb-10 relative">
                                            <div class="absolute inset-0 border-4 border-indigo-500 rounded-full border-t-transparent animate-spin"></div>
                                            <svg class="h-10 w-10 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                            </svg>
                                        </div>
                                        <h4 class="text-2xl font-black font-outfit uppercase tracking-tight italic">Analyse en cours</h4>
                                        <p class="mt-4 text-sm text-slate-400 max-w-sm font-medium leading-relaxed">
                                            Votre nouveau test est en cours de traitement. Merci de revenir bientôt pour consulter les résultats.
                                        </p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Logistics Column -->
                <div class="space-y-10">
                    <div class="bg-white shadow-xl shadow-indigo-900/5 sm:rounded-[3rem] p-10 border border-slate-100 text-center relative overflow-hidden group">
                        <div class="absolute top-0 inset-x-0 h-2 bg-gradient-to-r from-bio-400 to-indigo-600"></div>
                        <h3 class="font-black text-slate-900 font-outfit uppercase italic tracking-tight italic text-xl mt-4 mb-2">QR <span class="text-indigo-600">BioTag</span></h3>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-10 px-6">Identifiant unique du prélèvement</p>
                        
                        <style>
                            @media print {
                                body * { visibility: hidden; }
                                #qr-print-section, #qr-print-section * { visibility: visible; }
                                #qr-print-section {
                                    position: fixed;
                                    left: 50%;
                                    top: 15%;
                                    transform: translateX(-50%);
                                    text-align: center;
                                }
                                #qr-print-section img { display: block; margin: 0 auto; width: 180px; height: 180px; }
                                #qr-print-section .qr-text { 
                                    margin-top: 20px; 
                                    font-family: monospace; 
                                    font-size: 1.5rem; 
                                    font-weight: bold; 
                                    color: #000 !important; 
                                    border: none !important;
                                    background: transparent !important;
                                    box-shadow: none !important;
                                }
                            }
                        </style>

                        <div id="qr-print-section" class="p-8 inline-block mb-10 rounded-[2.5rem] bg-slate-50 border-2 border-dashed border-slate-200 shadow-inner group-hover:border-indigo-300 transition duration-500">
                            <p class="hidden print:block font-bold text-center text-xl mb-4">GenDer Lab - Tag #{{ $sample->id }}</p>
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ route('verify.qr', $sample->qr_code) }}" alt="QR Code" class="mx-auto block rounded-2xl mix-blend-multiply" />
                            <div class="qr-text mt-6 bg-white py-2 px-4 rounded-xl text-xs font-mono font-black text-indigo-600 tracking-[0.2em] border border-slate-100 shadow-sm">{{ substr($sample->qr_code, 0, 8) }}</div>
                        </div>

                        <button onclick="window.print()" class="print:hidden w-full bg-slate-900 hover:bg-indigo-600 text-white font-black text-[10px] uppercase tracking-[0.2em] py-6 rounded-2xl shadow-xl transition active:scale-95">
                            Imprimer le Tag
                        </button>
                    </div>

                    <div class="bg-indigo-950 shadow-2xl shadow-indigo-950/40 rounded-[3rem] p-10 text-white relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-br from-bio-500/20 to-transparent"></div>
                        <div class="relative z-10">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="bg-bio-500 p-2 rounded-xl text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <h3 class="font-black font-outfit text-2xl tracking-tight uppercase italic italic">BioScan <span class="text-bio-400">PRO</span></h3>
                            </div>
                            <p class="text-[10px] text-indigo-200/50 mb-8 uppercase tracking-[0.2em] font-black">Elite Breeder Ecosystem</p>
                            <button class="w-full bg-white/10 hover:bg-white hover:text-indigo-950 text-white font-black text-[10px] uppercase tracking-[0.2em] py-5 rounded-2xl transition-all border border-white/10 backdrop-blur-sm">
                                Explore PRO Benefits
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
