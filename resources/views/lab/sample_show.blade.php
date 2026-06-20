<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-outfit font-black text-3xl text-white leading-tight">
                Console Labo : Échantillon <span class="bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 px-3 py-1 rounded-lg">#{{ $sample->id }}</span>
            </h2>
            <a href="{{ route('lab.samples') }}" class="text-sm font-semibold text-slate-400 hover:text-white transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Retour
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50/80 backdrop-blur-sm border border-green-200 text-green-800 px-6 py-4 rounded-2xl shadow-sm flex items-center gap-3 animate-fade-in-up">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-black text-sm uppercase tracking-tight">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Data & Telemetry Column -->
                <div class="space-y-8">
                    <div class="bg-white shadow-xl shadow-indigo-900/5 sm:rounded-[2.5rem] p-8 border border-slate-100 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/5 rounded-full blur-3xl rotate-45 group-hover:bg-indigo-500/10 transition duration-700"></div>
                        
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-8 flex items-center gap-2">
                            <div class="w-1 h-1 bg-indigo-500 rounded-full"></div>
                            Paramètres Bio-Moléculaires
                        </h3>
                        
                        <div class="space-y-6">
                            <div>
                                <p class="text-[9px] text-slate-400 font-black uppercase tracking-widest mb-1.5">Taxonomie</p>
                                <p class="text-lg font-black text-slate-900 font-outfit uppercase tracking-tight italic">{{ $sample->species->name }}</p>
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $sample->species->family }}</p>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                    <p class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-1">Amorce (Primer)</p>
                                    <p class="text-xs font-mono font-black text-indigo-600 truncate">{{ $sample->species->primer_set ?? 'STD-X1' }}</p>
                                </div>
                                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                    <p class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-1">Qualité Prélève.</p>
                                    <p class="text-[10px] font-black text-slate-700 uppercase">{{ $sample->sample_type }} x{{ $sample->quantity }}</p>
                                </div>
                            </div>

                            <div>
                                <p class="text-[9px] text-slate-400 font-black uppercase tracking-widest mb-2">Propriétaire (Éleveur)</p>
                                <div class="flex items-center gap-3 bg-slate-50 p-3 rounded-2xl border border-slate-100">
                                    <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center font-black text-[10px] text-indigo-600">
                                        {{ substr($sample->user->name, 0, 1) }}
                                    </div>
                                    <p class="text-xs font-black text-slate-900 uppercase tracking-tight">{{ $sample->user->name }}</p>
                                </div>
                            </div>

                            @if($sample->notes)
                            <div class="bg-amber-50/50 p-5 rounded-3xl border border-amber-100 mt-4">
                                <p class="text-[9px] text-amber-600 font-black uppercase tracking-widest mb-2 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Note de Terrain
                                </p>
                                <p class="text-xs font-bold text-amber-900 italic leading-relaxed">"{{ $sample->notes }}"</p>
                            </div>
                            @endif

                            @if($sample->pre_scan_image_path)
                            <div class="mt-6 border border-slate-200 rounded-[2rem] overflow-hidden bg-white shadow-xl shadow-indigo-900/5 group">
                                <div class="bg-slate-900 px-5 py-3 border-b border-white/5 flex justify-between items-center">
                                    <p class="text-[9px] font-black text-white/40 uppercase tracking-[0.2em]">VISUAL_TELEMETRY_01</p>
                                    <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></div>
                                </div>
                                <div class="p-4 bg-slate-100">
                                    <a href="{{ asset('storage/' . $sample->pre_scan_image_path) }}" target="_blank" class="block relative overflow-hidden rounded-2xl">
                                        <img src="{{ asset('storage/' . $sample->pre_scan_image_path) }}" alt="Photo Client" class="w-full h-auto transform group-hover:scale-105 transition duration-700 grayscale hover:grayscale-0">
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>

                        <form action="{{ route('lab.sample.status', $sample->id) }}" method="POST" class="mt-10 pt-8 border-t border-slate-100 space-y-4">
                            @csrf
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Flux Logistique (Statut)</label>
                            <div class="flex gap-3">
                                <select name="status" class="block w-full border-0 bg-slate-50 focus:ring-4 focus:ring-indigo-500/10 rounded-2xl text-[10px] font-black uppercase tracking-widest h-14">
                                    <option value="Pending" {{ $sample->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Received" {{ $sample->status == 'Received' ? 'selected' : '' }}>Received</option>
                                    <option value="Processing" {{ $sample->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="Completed" {{ $sample->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                <button type="submit" class="bg-slate-900 hover:bg-indigo-600 text-white font-black text-[10px] uppercase tracking-widest px-6 rounded-2xl shadow-xl transition active:scale-95">Update</button>
                            </div>
                        </form>
                    </div>

                    <!-- AI Compute Pulse -->
                    <div class="bg-indigo-950 shadow-2xl shadow-indigo-950/40 rounded-[2.5rem] p-10 text-white relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-transparent"></div>
                        <div class="relative z-10 flex flex-col items-center text-center">
                            <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mb-6 border border-white/10 group-hover:scale-110 transition duration-500">
                                <svg class="h-10 w-10 text-indigo-400 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                </svg>
                            </div>
                            <h3 class="font-black font-outfit text-xl mb-3 tracking-tight uppercase italic italic">BioScan <span class="text-indigo-400">Compute</span></h3>
                            <p class="text-[10px] text-indigo-200/50 font-medium uppercase tracking-[0.2em] leading-relaxed">
                                Upload d'électrophorèse <br/>Prêt pour parsing IA
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Analysis Terminal Column -->
                <div class="lg:col-span-2">
                    <div class="bg-white shadow-2xl shadow-indigo-900/5 sm:rounded-[3rem] p-10 border border-slate-100 relative group">
                        <div class="flex items-center justify-between mb-10 pb-6 border-b border-slate-50">
                            <div>
                                <h3 class="text-2xl font-black font-outfit text-slate-900 uppercase italic tracking-tight italic">Console <span class="text-indigo-600">Analytique</span></h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Séquençage & Certification de l'échantillon</p>
                            </div>
                            <div class="bg-indigo-50 text-indigo-600 px-5 py-2.5 rounded-2xl font-mono text-xs font-black tracking-widest border border-indigo-100">
                                REF-{{ $sample->id }}-{{ date('Y') }}
                            </div>
                        </div>
                        
                        <form action="{{ route('lab.sample.analyze', $sample->id) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                            @csrf

                            <div class="space-y-4">
                                <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Paiement désactivé</label>
                                <p class="text-[10px] text-slate-500 uppercase tracking-[0.2em] mt-2">Le prélèvement est traité sans facturation à la livraison.</p>
                            </div>

                            <!-- Dropzone Style Upload -->
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Résultat Visuel (Gel Electrophorèse)</label>
                                <label for="gel_image" class="relative group/zone block cursor-pointer">
                                    <input id="gel_image" name="gel_image" type="file" class="sr-only" accept="image/*">
                                    <div class="absolute inset-0 bg-indigo-600/5 rounded-[2rem] border-2 border-indigo-200 border-dashed group-hover/zone:border-indigo-400 group-hover/zone:bg-indigo-600/10 transition-all duration-300"></div>
                                    <div class="relative px-8 py-12 flex flex-col items-center justify-center text-center">
                                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-lg mb-6 group-hover/zone:scale-110 transition duration-500">
                                            <svg class="h-8 w-8 text-indigo-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                                <path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <div class="space-y-2">
                                            <span class="text-sm font-black text-slate-900 uppercase tracking-tight">Déposer le Cliché</span>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">JPG, JPEG, PNG, GIF, TIFF max 5MB</p>
                                        </div>
                                    </div>
                                </label>
                                @if(optional($sample->result)->gel_image_path)
                                    <p class="text-[10px] font-black text-emerald-600 mt-4 flex items-center gap-2 uppercase tracking-widest">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Archive visuelle détectée
                                    </p>
                                @endif
                                @error('gel_image') <span class="text-red-500 text-[10px] font-bold mt-2 block uppercase tracking-widest">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-4">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Verdict Biologique</label>
                                    <select name="sex_result" required class="block w-full border-0 bg-slate-50 focus:ring-4 focus:ring-indigo-500/10 rounded-2xl text-[10px] font-black uppercase tracking-widest h-16">
                                        <option value="">Conclusion...</option>
                                        <option value="Male" {{ optional($sample->result)->sex_result == 'Male' ? 'selected' : '' }}>MALE (+/Y)</option>
                                        <option value="Female" {{ optional($sample->result)->sex_result == 'Female' ? 'selected' : '' }}>FEMALE (+/+)</option>
                                        <option value="Inconclusive" {{ optional($sample->result)->sex_result == 'Inconclusive' ? 'selected' : '' }}>NON CONCLUANT</option>
                                    </select>
                                </div>

                                <div class="space-y-4">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Indice de Confiance (%)</label>
                                    <input type="number" name="confidence_score" min="0" max="100" value="{{ optional($sample->result)->confidence_score ?? 100 }}" required class="block w-full border-0 bg-slate-50 focus:ring-4 focus:ring-indigo-500/10 rounded-2xl text-[10px] font-black uppercase tracking-widest h-16 px-6">
                                </div>

                                <div class="md:col-span-2 space-y-4">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Contrôle Qualité Biochimique</label>
                                    <div class="flex gap-10 bg-slate-50 p-6 rounded-3xl border border-slate-100">
                                        <label class="flex items-center gap-3 cursor-pointer group/radio">
                                            <input type="radio" name="quality_check" value="Good" {{ optional($sample->result)->quality_check == 'Good' || !optional($sample->result)->quality_check ? 'checked' : '' }} class="w-5 h-5 text-emerald-600 focus:ring-emerald-500/10 border-slate-300">
                                            <span class="text-[10px] font-black text-slate-700 uppercase tracking-widest group-hover/radio:text-emerald-600 transition">OPTIMALE (GOOD)</span>
                                        </label>
                                        <label class="flex items-center gap-3 cursor-pointer group/radio">
                                            <input type="radio" name="quality_check" value="Bad" {{ optional($sample->result)->quality_check == 'Bad' ? 'checked' : '' }} class="w-5 h-5 text-rose-600 focus:ring-rose-500/10 border-slate-300">
                                            <span class="text-[10px] font-black text-slate-700 uppercase tracking-widest group-hover/radio:text-rose-600 transition">DÉGRADÉE (BAD)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Observations Expert (Publiques)</label>
                                <textarea name="comment" rows="5" class="block w-full border-0 bg-slate-50 focus:ring-4 focus:ring-indigo-500/10 rounded-[2rem] text-sm font-medium p-8 shadow-inner" placeholder="Analyse certifiée conforme aux protocoles BioScan AI...">{{ optional($sample->result)->comment }}</textarea>
                            </div>

                            <div class="flex items-center justify-between pt-10 border-t border-slate-50">
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest max-w-xs">
                                    En validant, vous générez un certificat <br/>numérique opposable et infalsifiable.
                                </p>
                                <button type="submit" class="bg-indigo-600 hover:bg-slate-900 text-white font-black text-[10px] uppercase tracking-[0.2em] px-12 py-6 rounded-2xl shadow-2xl shadow-indigo-600/30 transform hover:-translate-y-1 transition active:scale-95">
                                    Signer l'Analyse
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
