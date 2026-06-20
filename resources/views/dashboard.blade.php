<x-app-layout>
    <x-slot name="header">
        <h2 class="font-outfit font-black text-3xl text-white leading-tight">
            {{ __('Plateforme Client GenDer Lab') }}
        </h2>
        <p class="text-white/60 text-sm mt-1">Gerez vos analyses genetiques et consultez vos certificats officiels.</p>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50/80 backdrop-blur-sm border border-green-200 text-green-800 px-6 py-4 rounded-2xl shadow-sm flex items-center gap-3 animate-fade-in-up">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-black text-sm uppercase tracking-tight">{{ session('success') }}</span>
                </div>
            @endif

            <div class="flex flex-col md:flex-row justify-between items-end gap-6">
                <div class="w-full md:w-auto">
                    <h3 class="text-2xl font-outfit font-black text-slate-900 tracking-tight">Analyses en cours</h3>
                    <p class="text-sm text-slate-500 font-medium">Suivi temps reel de votre patrimoine genetique.</p>
                </div>
                
                <div class="flex items-center gap-4 w-full md:w-auto">
                    <div class="relative w-full md:w-80 group">
                        <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400 group-focus-within:text-indigo-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" id="sampleSearch" placeholder="Bio-ID ou Espece..." class="block w-full pl-12 pr-4 py-4 bg-white border-0 rounded-2xl text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 transition shadow-xl shadow-indigo-900/5">
                    </div>

                    <a href="{{ route('client.submit') }}" class="whitespace-nowrap inline-flex items-center justify-center px-8 py-4 font-black text-[10px] uppercase tracking-[0.2em] text-white transition-all duration-300 bg-slate-900 rounded-2xl hover:bg-indigo-600 focus:outline-none shadow-xl hover:shadow-indigo-500/30 transform hover:-translate-y-1">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Soumettre
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
                <div class="lg:col-span-4 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden group">
                    <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-indigo-500/5 rounded-full blur-3xl group-hover:bg-indigo-500/10 transition"></div>
                    
                    <div class="flex items-center gap-8 relative z-10 w-full md:w-auto">
                        <div class="relative w-24 h-24 flex-shrink-0">
                            <svg class="w-full h-full transform -rotate-90">
                                <circle cx="48" cy="48" r="42" stroke="currentColor" stroke-width="8" fill="transparent" class="text-slate-100" />
                                <circle cx="48" cy="48" r="42" stroke="currentColor" stroke-width="8" fill="transparent" stroke-dasharray="264" stroke-dashoffset="{{ 264 - (264 * $profile_progress / 100) }}" class="text-indigo-600 transition-all duration-1000 ease-out" />
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center text-lg font-black text-slate-900 font-outfit">
                                {{ $profile_progress }}<span class="text-[10px] ml-0.5">%</span>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-black text-slate-900 text-xl font-outfit uppercase italic tracking-tight italic">Profil <span class="text-indigo-600">Eleveur</span></h4>
                            <p class="text-xs text-slate-500 font-medium mt-1">Ajoutez votre affixe pour des rapports officiels certifies.</p>
                        </div>
                    </div>

                    @if($profile_progress < 100)
                        <div class="relative z-10 w-full md:w-auto">
                            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-8 py-3.5 bg-indigo-600 hover:bg-slate-900 text-white font-black text-[10px] uppercase tracking-widest rounded-xl transition transition-transform hover:-translate-y-1 shadow-lg shadow-indigo-600/20">
                                Completer l'Espace
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    @else
                        <div class="relative z-10 flex items-center gap-3 text-emerald-600 bg-emerald-50 px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] border border-emerald-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Ecosysteme Certifie
                        </div>
                    @endif
                </div>

                <div class="lg:col-span-3">
                    <div class="hidden md:block bg-white overflow-hidden shadow-2xl shadow-indigo-900/5 sm:rounded-[2.5rem] border border-slate-100">
                        @if(isset($samples) && $samples->count() > 0)
                            <table class="min-w-full">
                                <thead>
                                    <tr class="bg-slate-50/50">
                                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Bio-ID / Cycle</th>
                                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Specification</th>
                                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Support</th>
                                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Statut</th>
                                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Verdict ADN</th>
                                        <th class="px-8 py-6 text-right text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Console</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 bg-white">
                                    @foreach($samples as $sample)
                                        <tr class="hover:bg-slate-50/50 transition-all group">
                                            <td class="px-8 py-6 whitespace-nowrap">
                                                <div class="text-xs font-black text-indigo-600 font-mono bg-indigo-50 px-3 py-1.5 rounded-lg inline-flex tracking-widest border border-indigo-100">#{{ $sample->id }}</div>
                                                <div class="text-[10px] font-bold text-slate-400 mt-2 uppercase tracking-wider">{{ $sample->created_at->format('d M, Y') }}</div>
                                            </td>
                                            <td class="px-8 py-6 whitespace-nowrap">
                                                <div class="text-sm font-black text-slate-900 font-outfit uppercase tracking-tight italic">{{ $sample->species->name }}</div>
                                                <div class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-widest">{{ $sample->species->family }}</div>
                                            </td>
                                            <td class="px-8 py-6 whitespace-nowrap">
                                                @if($sample->sample_type == 'feather')
                                                    <span class="px-3 py-1 inline-flex text-[9px] font-black uppercase tracking-widest rounded-lg bg-sky-50 text-sky-700 border border-sky-100">Plume</span>
                                                @else
                                                    <span class="px-3 py-1 inline-flex text-[9px] font-black uppercase tracking-widest rounded-lg bg-rose-50 text-rose-700 border border-rose-100">Sang</span>
                                                @endif
                                            </td>
                                            <td class="px-8 py-6 whitespace-nowrap">
                                                @php
                                                    $color = 'slate';
                                                    $label = 'Waiting';
                                                    if($sample->status == 'Received') { $color = 'blue'; $label = 'Received'; }
                                                    if($sample->status == 'Processing') { $color = 'amber'; $label = 'PCR Lab'; }
                                                    if($sample->status == 'Completed') { $color = 'emerald'; $label = 'Certified'; }
                                                @endphp
                                                <span class="px-4 py-1.5 inline-flex items-center gap-2 text-[10px] font-black rounded-xl bg-{{ $color }}-50 text-{{ $color }}-700 border border-{{ $color }}-200 uppercase tracking-widest">
                                                    <div class="w-1.5 h-1.5 rounded-full bg-{{ $color }}-500 animate-pulse"></div>
                                                    {{ $label }}
                                                </span>
                                            </td>
                                            <td class="px-8 py-6 whitespace-nowrap text-sm text-slate-900 font-black font-outfit tracking-tighter italic">
                                                @if($sample->status === 'Completed' && $sample->result && $sample->client_access_granted)
                                                    <span class="text-indigo-600">{{ $sample->result->sex_result }}</span>
                                                @else
                                                    <span class="text-slate-300 font-normal tracking-widest">...</span>
                                                @endif
                                            </td>
                                            <td class="px-8 py-6 whitespace-nowrap text-right">
                                                <a href="{{ route('client.sample.show', $sample->id) }}" class="inline-flex items-center justify-center p-3 text-slate-400 hover:text-indigo-600 bg-slate-50 hover:bg-indigo-50 rounded-xl transition group-hover:bg-indigo-600 group-hover:text-white">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                    <div class="md:hidden space-y-6">
                        @foreach($samples as $sample)
                            <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-indigo-900/5 border border-slate-100">
                                <div class="flex justify-between items-start mb-6">
                                    <div>
                                        <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2 flex items-center gap-2">
                                            <div class="w-1 h-1 bg-indigo-500 rounded-full"></div>
                                            #{{ $sample->id }} • {{ $sample->created_at->format('d/m/Y') }}
                                        </div>
                                        <h4 class="font-black text-slate-900 text-xl font-outfit uppercase italic tracking-tight italic">{{ $sample->species->name }}</h4>
                                    </div>
                                    @php
                                        $color = 'slate';
                                        if($sample->status == 'Received') $color = 'blue';
                                        if($sample->status == 'Processing') $color = 'amber';
                                        if($sample->status == 'Completed') $color = 'emerald';
                                    @endphp
                                    <span class="px-4 py-1.5 text-[9px] font-black uppercase tracking-widest rounded-xl bg-{{ $color }}-100 text-{{ $color }}-700 border border-{{ $color }}-200">
                                        {{ $sample->status }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center bg-slate-50 p-6 rounded-2xl border border-slate-100">
                                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">VERDICT ADN</div>
                                    <div class="font-black text-indigo-600 font-outfit text-lg tracking-tight italic uppercase">
                                        @if($sample->status === 'Completed' && $sample->result && $sample->client_access_granted)
                                            {{ $sample->result->sex_result }}
                                        @else
                                            IN PROGRESS
                                        @endif
                                    </div>
                                </div>
                                <a href="{{ route('client.sample.show', $sample->id) }}" class="mt-6 block w-full bg-slate-900 text-white text-center py-5 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-slate-900/20 transform active:scale-95 transition">
                                    Explorer l'Analyse
                                </a>
                            </div>
                        @endforeach
                    </div>

                    @if($samples->isEmpty())
                        <div class="bg-white p-20 rounded-[3rem] text-center border border-slate-100 border-dashed border-2">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </div>
                            <h4 class="text-xl font-black text-slate-900 font-outfit italic">Bio-Portfolio Vide</h4>
                            <p class="text-slate-400 text-sm mt-2 font-medium">Commencez votre premiere analyse genetique des maintenant.</p>
                        </div>
                    @endif
                </div>

                <div class="space-y-8">
                    <div class="bg-indigo-950 rounded-[2.5rem] shadow-2xl p-10 text-white relative overflow-hidden group">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-bio-400/20 rounded-full blur-2xl group-hover:bg-bio-400/30 transition duration-500"></div>
                        <div class="relative z-10">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="bg-bio-500 p-2 rounded-xl text-white shadow-lg shadow-bio-500/20">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <h3 class="font-black font-outfit text-2xl tracking-tight uppercase italic italic">BioScan <span class="text-bio-400">PRO</span></h3>
                            </div>
                            <p class="text-xs text-indigo-100/70 mb-10 leading-relaxed font-medium uppercase tracking-widest">
                                DNA INTELLIGENCE FOR ELITE BREEDERS
                            </p>
                            <ul class="space-y-6 mb-12">
                                @foreach(['Health Screening Tool', 'AI Mating Suggester', 'Priority PCR Lane'] as $feature)
                                <li class="flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-indigo-200">
                                    <div class="w-5 h-5 rounded-full bg-bio-400/20 flex items-center justify-center text-bio-400 shrink-0">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                    </div>
                                    {{ $feature }}
                                </li>
                                @endforeach
                            </ul>
                            <button class="w-full bg-bio-500 hover:bg-white hover:text-indigo-950 text-white font-black py-5 rounded-[1.5rem] transition shadow-2xl shadow-bio-500/40 uppercase tracking-[0.2em] text-[10px]">
                                Upgrade Ecosystem
                            </button>
                        </div>
                    </div>

                    <a href="{{ route('client.instructions') }}" class="block bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl transition group">
                        <div class="flex items-center gap-6">
                            <div class="bg-indigo-50 p-4 rounded-2xl text-indigo-600 group-hover:bg-slate-900 group-hover:text-white transition shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-black text-slate-900 font-outfit uppercase tracking-tight">Protocoles Bio</h4>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Guide de prelevement</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
        </div>
    </div>

    <!-- AI Overlay -->
    <a href="{{ route('client.instructions') }}" class="fixed bottom-10 right-10 w-20 h-20 bg-slate-900 rounded-full flex items-center justify-center text-white shadow-[0_0_50px_rgba(79,70,229,0.3)] hover:scale-110 transition z-50 group border border-white/10">
        <svg class="w-10 h-10 group-hover:text-bio-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
        <div class="absolute -top-1 -right-1 w-5 h-5 bg-green-500 border-4 border-slate-900 rounded-full"></div>
    </a>

    <script>
        document.getElementById('sampleSearch').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const desktopRows = document.querySelectorAll('tbody tr');
            desktopRows.forEach(row => { row.style.display = row.innerText.toLowerCase().includes(searchTerm) ? '' : 'none'; });
            const mobileCards = document.querySelectorAll('.md\\:hidden > div');
            mobileCards.forEach(card => { card.style.display = card.innerText.toLowerCase().includes(searchTerm) ? '' : 'none'; });
        });
    </script>
</x-app-layout>
