<x-app-layout>
    <x-slot name="header">
        <h2 class="font-outfit font-black text-3xl text-white leading-tight">
            {{ __('Soumission d\'Échantillon') }}
        </h2>
        <p class="text-slate-400 text-sm mt-1">Assistant intelligent de préparation du prélèvement biologique.</p>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Multi-step Form Container using Alpine.js -->
        <div x-data="{ step: 1, deliveryType: 'courier' }" class="bg-white overflow-hidden shadow-2xl shadow-indigo-900/10 sm:rounded-[2.5rem] border border-slate-100 p-8 lg:p-12 relative">
            
            <!-- Progress Bar -->
            <div class="mb-12 relative px-4">
                <div class="overflow-hidden bg-slate-100 h-1.5 rounded-full w-full">
                    <div class="h-full bg-indigo-600 transition-all duration-700 cubic-bezier(0.4, 0, 0.2, 1)" 
                            :style="'width: ' + ((step / 3) * 100) + '%'"></div>
                </div>
                <div class="flex justify-between mt-5 px-1 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] relative z-10 w-full">
                    <span :class="{'text-indigo-600': step >= 1}" class="transition duration-500">I. Profilage ADN</span>
                    <span :class="{'text-indigo-600': step >= 2}" class="transition duration-500">II. Qualification IA</span>
                    <span :class="{'text-indigo-600': step >= 3}" class="transition duration-500">III. Logistique</span>
                </div>
            </div>

            <form action="{{ route('client.store') }}" method="POST" id="submissionForm" enctype="multipart/form-data">
                @csrf

                @if($errors->any())
                    <div class="mb-6 rounded-3xl border border-red-200 bg-red-50 p-5 text-red-700">
                        <p class="font-black uppercase tracking-widest text-xs mb-3">Erreur de validation</p>
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <!-- STEP 1: ESPÈCE & TYPE -->
                <div x-show="step === 1" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div class="mb-10 text-center">
                        <h3 class="text-3xl font-black font-outfit text-slate-900 tracking-tight">Cible Génétique</h3>
                        <p class="text-slate-500 text-sm mt-3 max-w-md mx-auto">Identifiez officiellement l'individu. Ces données seront gravées sur le certificat final.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-10">
                        <div class="group">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 transition">Espèce de l'oiseau</label>
                            <div class="relative">
                                <select name="species_id" required class="block w-full border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 shadow-sm transition appearance-none cursor-pointer">
                                    <option value="" disabled selected>Choisir une espèce...</option>
                                    @foreach($species as $sp)
                                        <option value="{{ $sp->id }}">{{ $sp->name }} ({{ $sp->family }})</option>
                                    @endforeach
                                    <option value="autre">Autre espèce (Inconnue / Non listée)</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 transition">Support Biologique</label>
                            <div class="relative">
                                <select name="sample_type" required class="block w-full border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 shadow-sm transition appearance-none cursor-pointer">
                                    <option value="feather">Plume (Extraction Bulbe)</option>
                                    <option value="blood">Sang (Papier FTA / Buvard)</option>
                                    <option value="eggshell">Coquille (Membrane interne)</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 transition">Quantité d'unités</label>
                            <input type="number" name="quantity" min="1" value="3" required class="block w-full border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 shadow-sm transition">
                        </div>

                        <div class="group">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 transition">Note d'identification</label>
                            <input type="text" name="notes" placeholder="Ex: Mâle supposé, Bague #2024..." class="block w-full border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 shadow-sm transition">
                        </div>
                    </div>

                    <div class="flex justify-center mt-12 bg-slate-50 -mx-12 -mb-12 p-10 rounded-b-[2.5rem]">
                        <button type="button" @click="step = 2" class="bg-indigo-600 hover:bg-slate-900 text-white font-black text-sm uppercase tracking-widest py-5 px-12 rounded-2xl shadow-xl shadow-indigo-600/20 hover:shadow-indigo-600/40 transition-all flex items-center gap-3 transform hover:-translate-y-1">
                            Lancer l'Analyse IA
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- STEP 2: IA SCAN -->
                <div x-show="step === 2" style="display: none;" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="mb-10 text-center">
                        <h3 class="text-3xl font-black font-outfit text-slate-900 tracking-tight">Vérification Bio-Visuo</h3>
                        <p class="text-slate-500 text-sm mt-3 max-w-md mx-auto">Validez la conformité du prélèvement pour garantir l'extraction d'ADN.</p>
                    </div>

                    <div class="bg-slate-900 rounded-[2rem] p-10 text-center border border-indigo-500/30 relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/50 to-transparent"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-400 mx-auto mb-6 border border-indigo-500/20">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                            </div>
                            <h4 class="text-white font-bold text-xl mb-3">Télécharger un cliché macro</h4>
                            <p class="text-indigo-200/60 text-sm max-w-xs mx-auto mb-8">Le système GenDer Lab analysera automatiquement votre cliché pour valider la qualité du prélèvement avant l'extraction ADN.</p>
                            
                            <label for="pre_scan_image" class="cursor-pointer inline-flex items-center gap-3 bg-white hover:bg-indigo-50 text-indigo-900 font-black text-xs uppercase tracking-widest py-4 px-10 rounded-xl transition shadow-xl">
                                <span id="file_name">Choisir un fichier</span>
                                <input type="file" id="pre_scan_image" name="pre_scan_image" class="hidden" accept="image/*" @change="document.getElementById('file_name').textContent = $event.target.files[0]?.name || 'Choisir un fichier'">
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-12 bg-slate-50 -mx-12 -mb-12 p-10 rounded-b-[2.5rem]">
                        <button type="button" @click="step = 1" class="text-slate-400 hover:text-slate-800 font-black text-xs uppercase tracking-widest transition">Retour</button>
                        <button type="button" @click="step = 3" class="bg-indigo-600 hover:bg-slate-900 text-white font-black text-sm uppercase tracking-widest py-5 px-12 rounded-2xl shadow-xl transition-all transform hover:-translate-y-1">Étape Logistique</button>
                    </div>
                </div>

                <!-- STEP 3: LOGISTIQUE -->
                <div x-show="step === 3" style="display: none;" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div class="mb-10 text-center">
                        <h3 class="text-3xl font-black font-outfit text-slate-900 tracking-tight">Expédition BioScan</h3>
                        <p class="text-slate-500 text-sm mt-3 max-w-sm mx-auto">Comment la matière organique arrivera-t-elle au laboratoire ?</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        <label class="relative flex cursor-pointer rounded-3xl border-2 p-8 transition-all" :class="{'border-indigo-600 bg-indigo-50/10 shadow-lg': deliveryType === 'courier', 'border-slate-100 bg-slate-50': deliveryType !== 'courier' }">
                            <input type="radio" name="delivery_method" value="courier" class="sr-only" @click="deliveryType = 'courier'" checked>
                            <div class="w-full">
                                <div class="text-indigo-600 mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                </div>
                                <h4 class="text-xl font-black text-slate-900 mb-2">Envoi Postal</h4>
                                <p class="text-xs text-slate-500 font-medium leading-relaxed">Glissez votre kit dans une enveloppe sécurisée avec le QR Code BioScan.</p>
                            </div>
                        </label>

                        <label class="relative flex cursor-pointer rounded-3xl border-2 p-8 transition-all" :class="{'border-indigo-600 bg-indigo-50/10 shadow-lg': deliveryType === 'dropoff', 'border-slate-100 bg-slate-50': deliveryType !== 'dropoff' }">
                            <input type="radio" name="delivery_method" value="dropoff" class="sr-only" @click="deliveryType = 'dropoff'">
                            <div class="w-full">
                                <div class="text-emerald-500 mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <h4 class="text-xl font-black text-slate-900 mb-2">Dépôt Labo</h4>
                                <p class="text-xs text-slate-500 font-medium leading-relaxed">Gagnez du temps sur l'extraction en déposant directement vos échantillons.</p>
                            </div>
                        </label>
                    </div>

                    @error('delivery_method')
                        <p class="text-red-500 text-sm font-bold uppercase tracking-widest mb-4">{{ $message }}</p>
                    @enderror

                    <div class="flex justify-between items-center mt-12 bg-slate-50 -mx-12 -mb-12 p-10 rounded-b-[2.5rem]">
                        <button type="button" @click="step = 2" class="text-slate-400 hover:text-slate-800 font-black text-xs uppercase tracking-widest transition">Retour</button>
                        <button type="submit" class="bg-indigo-600 hover:bg-slate-900 text-white font-black text-sm uppercase tracking-widest py-5 px-12 rounded-2xl shadow-xl transition-all transform hover:-translate-y-1">Valider & Générer QR</button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Support Sections -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
            <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm">
                <h4 class="font-black text-slate-900 uppercase tracking-widest text-[10px] mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span>
                    Support IA Assistant
                </h4>
                <div class="flex gap-4 p-4 bg-slate-50 rounded-2xl mb-4">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    </div>
                    <p class="text-sm text-slate-600 font-medium leading-relaxed">L'IA validera la lisibilité de votre échantillon pour garantir une extraction ADN réussie.</p>
                </div>
                <input type="text" placeholder="Doutes sur le prélèvement ? Demandez à l'IA..." class="w-full bg-slate-50 border-0 rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-indigo-500/20 transition">
            </div>

            <!-- Pricing Card -->
            <div class="bg-gradient-to-br from-indigo-600 to-indigo-900 rounded-[2rem] p-8 text-white relative overflow-hidden shadow-xl shadow-indigo-900/20 group hover:shadow-indigo-900/40 transition-all duration-300 transform hover:-translate-y-1 border border-indigo-500/30">
                <div class="absolute right-0 top-0 w-48 h-48 bg-white/10 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150"></div>
                <h4 class="font-black uppercase tracking-widest text-[10px] mb-6 flex items-center gap-2 text-indigo-200 relative z-10">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Tarifs Estimés
                </h4>
                
                <div class="space-y-4 relative z-10 mt-6">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10 group-hover:bg-white/15 transition-colors">
                        <div class="text-xs text-indigo-200 font-bold uppercase tracking-widest mb-1 shadow-sm">Sexage ADN</div>
                        <div class="font-black text-2xl text-white">1000 — 2000 <span class="text-sm font-bold text-indigo-300">DA</span></div>
                    </div>
                    
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10 group-hover:bg-white/15 transition-colors">
                        <div class="text-xs text-indigo-200 font-bold uppercase tracking-widest mb-1 shadow-sm">Pathogènes (PCR)</div>
                        <div class="font-black text-2xl text-white">5000 — 6000 <span class="text-sm font-bold text-indigo-300">DA</span></div>
                    </div>
                </div>
                
                <p class="mt-5 text-[10px] uppercase tracking-wider font-bold text-indigo-200/80 leading-relaxed relative z-10">* Le prix exact dépend de l'espèce cible analysée.</p>
            </div>

            <div class="bg-slate-900 rounded-[2rem] p-8 text-white relative overflow-hidden group">
                <div class="absolute right-0 top-0 w-32 h-32 bg-indigo-500/10 rounded-full blur-3xl"></div>
                <h4 class="font-black uppercase tracking-widest text-[10px] mb-6 flex items-center gap-2 text-indigo-400">
                    BioScan Academy
                </h4>
                <div class="relative rounded-2xl overflow-hidden aspect-video bg-indigo-950 flex items-center justify-center group-hover:scale-[1.02] transition duration-500">
                    <img src="https://loremflickr.com/600/400/bird?v=2" class="absolute inset-0 w-full h-full object-cover opacity-40">
                    <div class="w-16 h-16 bg-white/10 backdrop-blur-xl rounded-full flex items-center justify-center border border-white/20 transition group-hover:bg-white/20">
                        <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </div>
                <p class="mt-4 text-xs font-bold text-indigo-300">Tuto: Extraction bulbaire sans stress (Ara sp.)</p>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
