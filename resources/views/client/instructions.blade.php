<x-app-layout>
    <x-slot name="header">
        <h2 class="font-outfit font-black text-3xl text-white leading-tight uppercase tracking-tight">
            Guide du Prélèvement <span class="text-bio-400">&</span> Assistance
        </h2>
        <p class="text-white/60 text-sm mt-1 uppercase tracking-widest font-bold">Tout ce qu'il faut savoir pour envoyer vos échantillons au GenDer Lab.</p>
    </x-slot>

    <div class="py-12 bg-[#0A0F1C] min-h-screen text-slate-300 relative overflow-hidden">
        <!-- Abstract Background Effects -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#4f46e50a_1px,transparent_1px),linear-gradient(to_bottom,#4f46e50a_1px,transparent_1px)] bg-[size:3rem_3rem] pointer-events-none"></div>
        <div class="absolute top-0 right-1/4 w-[800px] h-[800px] bg-bio-500/5 rounded-full blur-[150px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-indigo-500/5 rounded-full blur-[150px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                
                <!-- Main Content Left -->
                <div class="xl:col-span-2 space-y-8">
                    
                    <!-- Intro Card -->
                    <div class="bg-slate-900/60 p-8 sm:p-10 rounded-[2.5rem] shadow-2xl border border-slate-800 overflow-hidden relative backdrop-blur-xl group">
                        <div class="absolute -top-32 -right-32 w-96 h-96 bg-bio-500/10 rounded-full blur-[100px] group-hover:bg-bio-500/20 transition duration-700"></div>
                        <div class="relative z-10 flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                            <div class="max-w-2xl">
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-bio-500/10 border border-bio-500/20 text-bio-400 text-[10px] font-black uppercase tracking-[0.35em] mb-6">
                                    <div class="w-1.5 h-1.5 rounded-full bg-bio-400 animate-pulse"></div>
                                    Guide du Prélèvement
                                </span>
                                <h3 class="text-3xl sm:text-4xl font-black font-outfit text-white mb-6 uppercase italic tracking-tight leading-none">Préparez et envoyez vos échantillons <br/><span class="text-transparent bg-clip-text bg-gradient-to-r from-bio-400 to-indigo-400">en toute confiance</span></h3>
                                <p class="text-slate-400 text-sm leading-relaxed font-medium">Suivez les meilleures pratiques de prélèvement (Plume, Sang ou Coquille), emballez vos échantillons correctement et profitez d'une analyse moléculaire rapide (24h-72h) entièrement réalisée en Algérie.</p>
                            </div>
                            
                            <!-- Étape Rapide -->
                            <div class="rounded-[2rem] border border-slate-700/50 bg-slate-800/50 p-6 shadow-inner max-w-sm flex-shrink-0">
                                <div class="flex items-center gap-3 mb-5">
                                    <svg class="w-5 h-5 text-bio-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    <p class="text-[10px] uppercase tracking-[0.3em] text-white font-black">Étape rapide</p>
                                </div>
                                <ul class="space-y-4">
                                    @foreach(['Choix d\'échantillon', 'Emballage sécurisé', 'Étiquette QR', 'Envoi suivi'] as $step)
                                    <li class="flex items-center gap-3 text-slate-300 text-xs font-bold uppercase tracking-widest">
                                        <div class="w-6 h-6 rounded-lg bg-slate-700 flex items-center justify-center text-bio-400 border border-slate-600 shadow-sm">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        {{ $step }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Protocol & Protection -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- Protocol List -->
                        <div class="bg-slate-900/60 p-8 rounded-[2.5rem] shadow-2xl border border-slate-800 backdrop-blur-xl">
                            <h3 class="text-2xl font-black font-outfit text-white mb-8 uppercase italic tracking-tight">Protocole certifié</h3>
                            <div class="space-y-8 relative before:absolute before:inset-y-0 before:left-[1.375rem] before:w-px before:bg-slate-800">
                                <div class="relative flex gap-6">
                                    <div class="w-11 h-11 shrink-0 rounded-2xl bg-slate-800 border-2 border-slate-700 text-white flex items-center justify-center font-black relative z-10 shadow-lg">1</div>
                                    <div class="pt-2">
                                        <h4 class="text-sm font-black text-white uppercase tracking-widest mb-2">Préparez l'échantillon</h4>
                                        <p class="text-slate-400 text-xs leading-relaxed font-medium">Plumes (3-5 propres et arrachées), Goutte de Sang ou Coquille (membrane interne). Évitez le matériel au sol.</p>
                                    </div>
                                </div>
                                <div class="relative flex gap-6">
                                    <div class="w-11 h-11 shrink-0 rounded-2xl bg-slate-800 border-2 border-slate-700 text-white flex items-center justify-center font-black relative z-10 shadow-lg">2</div>
                                    <div class="pt-2">
                                        <h4 class="text-sm font-black text-white uppercase tracking-widest mb-2">Séchez et protégez</h4>
                                        <p class="text-slate-400 text-xs leading-relaxed font-medium">Mettez l'échantillon dans un sachet zip propre et sec. Ajoutez un calage pour éviter les chocs.</p>
                                    </div>
                                </div>
                                <div class="relative flex gap-6">
                                    <div class="w-11 h-11 shrink-0 rounded-2xl bg-bio-500/20 border-2 border-bio-500/50 text-bio-400 flex items-center justify-center font-black relative z-10 shadow-[0_0_15px_rgba(79,70,229,0.3)]">3</div>
                                    <div class="pt-2">
                                        <h4 class="text-sm font-black text-white uppercase tracking-widest mb-2">Identifiez le prélèvement</h4>
                                        <p class="text-slate-400 text-xs leading-relaxed font-medium">Collez le QR code fourni sur le sachet. Vérifiez qu'il reste lisible et intact.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Protection Image Card -->
                        <div class="relative rounded-[2.5rem] overflow-hidden border border-slate-800 shadow-2xl group min-h-[360px]">
                            <img src="https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=800&q=80" alt="Protection Échantillon" class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition duration-700 opacity-60">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-transparent"></div>
                            
                            <div class="absolute inset-0 p-8 flex flex-col justify-end">
                                <span class="inline-flex w-fit px-3 py-1 bg-white/10 backdrop-blur-md rounded-lg text-white text-[9px] font-black uppercase tracking-widest border border-white/20 mb-4">
                                    Sécurité
                                </span>
                                <h4 class="text-2xl font-black font-outfit text-white uppercase italic tracking-tight mb-2">Protégez votre échantillon</h4>
                                <p class="text-xs text-slate-300 font-medium">Utilisez des sacs propres et un colis rigide pour éviter toute contamination ou détérioration durant le transport.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Expédition & réception -->
                    <div class="bg-slate-900/60 p-8 sm:p-10 rounded-[2.5rem] shadow-2xl border border-slate-800 backdrop-blur-xl group relative overflow-hidden">
                        <div class="absolute inset-0 bg-[linear-gradient(to_right,#4f46e50d_1px,transparent_1px),linear-gradient(to_bottom,#4f46e50d_1px,transparent_1px)] bg-[size:2rem_2rem] opacity-20"></div>
                        <div class="relative z-10">
                            <h3 class="text-2xl font-black font-outfit text-white mb-6 uppercase italic tracking-tight">Expédition & Réception</h3>
                            
                            <div class="text-slate-400 text-sm leading-relaxed font-medium space-y-4 mb-10 max-w-3xl">
                                <p>Envoyez votre colis via un transporteur ou déposez-le directement dans notre centre en Algérie. Les analyses (Sexage, Pathogènes ou Génotypage) sont lancées dès réception.</p>
                                <p>Assurez-vous de bien identifier chaque support biologique sur les sachets zip. Les délais moyens de nos diagnostics certifiés sont de <strong class="text-white font-bold">24h à 72h avec une précision de 95%</strong>.</p>
                            </div>

                            <div class="grid gap-6 sm:grid-cols-2">
                                <!-- A faire -->
                                <div class="rounded-3xl bg-emerald-500/5 p-6 border border-emerald-500/20">
                                    <div class="flex items-center gap-3 mb-5">
                                        <div class="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center text-emerald-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <p class="text-xs font-black text-white uppercase tracking-widest">À faire</p>
                                    </div>
                                    <ul class="space-y-3">
                                        @foreach(['Conserver au sec', 'Suivre la fiche de prélèvement', 'Vérifier le QR code'] as $do)
                                        <li class="flex items-start gap-3 text-emerald-200/70 text-xs font-bold uppercase tracking-wide">
                                            <span class="mt-1 w-1.5 h-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                                            {{ $do }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                
                                <!-- A eviter -->
                                <div class="rounded-3xl bg-rose-500/5 p-6 border border-rose-500/20">
                                    <div class="flex items-center gap-3 mb-5">
                                        <div class="w-8 h-8 rounded-full bg-rose-500/20 flex items-center justify-center text-rose-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </div>
                                        <p class="text-xs font-black text-white uppercase tracking-widest">À éviter</p>
                                    </div>
                                    <ul class="space-y-3">
                                        @foreach(['Chaleur excessive', 'Sachet humide', 'QR code plié'] as $dont)
                                        <li class="flex items-start gap-3 text-rose-200/70 text-xs font-bold uppercase tracking-wide">
                                            <span class="mt-1 w-1.5 h-1.5 rounded-full bg-rose-400 shrink-0"></span>
                                            {{ $dont }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AI Setup & Support Right Sidebar -->
                <div class="space-y-8" x-data="{
                        draft: '',
                        messages: [
                            { id: 1, role: 'assistant', text: 'Bienvenue sur le support GenDer Lab. Une question sur vos prélèvements (Plume, Sang, Coquille) ?' },
                            { id: 2, role: 'user', text: 'Puis-je utiliser une plume tombée pour le sexage ?' },
                            { id: 3, role: 'assistant', text: 'Non, il faut arracher 3 à 5 plumes au niveau du bréchet ou du dos pour que le bulbe (l\'ADN) soit exploitable et ainsi garantir nos 99.9% de précision.' }
                        ],
                        send() {
                            if (!this.draft.trim()) return;
                            this.messages.push({ id: Date.now(), role: 'user', text: this.draft });
                            const question = this.draft;
                            this.draft = '';
                            const answer = this.createAnswer(question);
                            setTimeout(() => {
                                this.messages.push({ id: Date.now() + 1, role: 'assistant', text: answer });
                                this.$nextTick(() => {
                                    this.$refs.messages.scrollTop = this.$refs.messages.scrollHeight;
                                });
                            }, 550);
                        },
                        createAnswer(question) {
                            const q = question.toLowerCase();
                            
                            if (q.includes('bonjour') || q.includes('salut') || q.includes('hello')) return 'Bonjour ! Comment puis-je vous guider dans vos prélèvements génétiques aujourd\'hui ?';
                            if (q.includes('merci')) return 'Avec plaisir ! N\'hésitez pas si vous avez d\'autres questions pour garantir des analyses parfaites.';
                            if (q.includes('prix') || q.includes('tarif') || q.includes('combien')) return 'Nos tarifs sont très compétitifs. Pour le sexage ou les dépistages de pathogènes, veuillez consulter les offres détaillées dans votre tableau de bord.';
                            if (q.includes('sang') || q.includes('ongle')) return 'Pour le prélèvement sanguin : coupez légèrement l\'extrémité d\'un ongle et déposez 1 à 2 gouttes sur du papier buvard propre. Laissez sécher à l\'air libre.';
                            if (q.includes('coquille') || q.includes('oeuf')) return 'Pour une coquille : assurez-vous de bien prélever la membrane interne (la fine pellicule) car c\'est elle qui contient l\'ADN, et laissez-la sécher avant l\'envoi.';
                            if (q.includes('plume')) return 'Pour les plumes : arrachez 3 à 5 plumes moyennes (ventre, bréchet ou dos). Les plumes muées ou tombées au fond de la cage ne contiennent pas assez d\'ADN au niveau du bulbe.';
                            if (q.includes('délai') || q.includes('temps') || q.includes('jour')) return 'Notre processus 100% local en Algérie permet de délivrer vos résultats en 24h à 72h maximum dès réception de votre enveloppe.';
                            if (q.includes('pathogène') || q.includes('maladie') || q.includes('virus')) return 'Nous dépistons les principaux pathogènes (PBFD, Chlamydia, Polyomavirus, etc.). Mettez chaque oiseau dans un sachet zip séparé pour éviter les contaminations croisées.';
                            if (q.includes('espèce') || q.includes('oiseau') || q.includes('type') || q.includes('perroquet')) return 'Nous traitons quasiment toutes les espèces : perroquets, canaris, chardonnerets, rapaces et pigeons. L\'ADN est universel !';
                            if (q.includes('adresse') || q.includes('envoyer') || q.includes('poste') || q.includes('yalidine')) return 'Déposez votre échantillon à l\'adresse de notre laboratoire traitant (indiquée sur l\'étiquette générée lors de la soumission de la commande) via votre transporteur favori.';
                            if (q.includes('erreur') || q.includes('raté') || q.includes('échec') || q.includes('mauvais')) return 'En cas d\'échantillon inexploitable, notre équipe d\'extraction vous contactera immédiatement via la plateforme pour vous accompagner dans un nouveau prélèvement.';
                            if (q.includes('précis') || q.includes('fiable') || q.includes('sûr')) return 'Nos équipements PCR garantissent une précision de 99.9% avec délivrance d\'un certificat d\'analyse anti-falsifiable (QR code).';
                            
                            return 'Je vous remercie pour votre question. Pour plus de détails, veillez toujours à ce que vos échantillons soient secs, propres et identifiés avec leur QR code GenDer Lab.';
                        }
                    }">
                    
                    <!-- Assistant IA Card -->
                    <div class="bg-indigo-950/80 rounded-[2.5rem] shadow-2xl border border-indigo-500/20 p-6 text-white overflow-hidden relative group backdrop-blur-2xl">
                        <div class="absolute -top-10 -right-10 w-48 h-48 bg-bio-500/20 rounded-full blur-[60px] group-hover:bg-bio-400/30 transition duration-700"></div>
                        <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-purple-500/20 rounded-full blur-[60px] group-hover:bg-purple-400/30 transition duration-700"></div>
                        
                        <div class="relative z-10 flex flex-col h-[520px]">
                            <!-- Header -->
                            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-white/5">
                                <div class="w-12 h-12 bg-gradient-to-br from-bio-400 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-bio-500/20 relative">
                                    <div class="absolute inset-0 rounded-2xl bg-white/20 animate-pulse"></div>
                                    <svg class="w-6 h-6 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-black font-outfit text-lg uppercase italic tracking-tight hidden lg:block">Assistant Labo</h3>
                                    <h3 class="font-black font-outfit text-lg uppercase italic tracking-tight lg:hidden">Assistant de laboratoire</h3>
                                    <div class="flex items-center gap-2 mt-1">
                                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></div>
                                        <p class="text-[9px] text-bio-400 font-bold uppercase tracking-widest">En ligne • IA Biologiste</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Messages -->
                            <div x-ref="messages" x-init="$watch('messages', () => { $nextTick(() => { $refs.messages.scrollTop = $refs.messages.scrollHeight; }); })" class="flex-1 overflow-y-auto space-y-5 mb-6 pr-2 custom-scrollbar">
                                <template x-for="message in messages" :key="message.id">
                                    <div class="flex w-full" :class="message.role === 'user' ? 'justify-end' : 'justify-start'">
                                        <div :class="message.role === 'user' ? 
                                            'bg-gradient-to-br from-bio-600 to-indigo-600 p-4 rounded-2xl rounded-tr-sm text-sm text-white border border-white/10 shadow-lg shadow-bio-900/50 max-w-[85%]' : 
                                            'bg-slate-900/80 backdrop-blur-md p-4 rounded-2xl rounded-tl-sm text-sm text-slate-300 border border-slate-700 max-w-[85%]'" 
                                            class="font-medium leading-relaxed shadow-sm break-words" x-text="message.text"></div>
                                    </div>
                                </template>
                            </div>
                            
                            <!-- Input -->
                            <div class="mt-auto relative z-20">
                                <div class="relative flex items-center">
                                    <input x-model="draft" @keydown.enter.prevent="send()" type="text" placeholder="Posez votre question..." class="w-full bg-slate-900/80 border border-slate-700/80 rounded-2xl py-4 pl-5 pr-14 text-sm text-white focus:outline-none focus:border-bio-500 focus:ring-1 focus:ring-bio-500 transition placeholder:text-slate-500 font-medium backdrop-blur-md shadow-inner">
                                    <button @click="send()" type="button" class="absolute right-2 w-10 h-10 bg-white hover:bg-slate-200 rounded-xl flex items-center justify-center text-slate-900 transition-all duration-300 transform active:scale-95 shadow-md">
                                        <svg class="w-4 h-4 ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Support GenDer Lab Card -->
                    <div class="bg-slate-900/60 rounded-[2.5rem] border border-slate-800 shadow-2xl p-8 backdrop-blur-xl group relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/10 rounded-bl-full group-hover:bg-indigo-500/20 transition-all duration-500"></div>
                        <div class="relative z-10">
                            <h4 class="text-xl font-black font-outfit text-white mb-5 uppercase italic tracking-tight">Support GenDer Lab</h4>
                            <p class="text-slate-400 text-xs leading-relaxed mb-8 font-medium">Un doute sur l'extraction d'une plume, d'une goutte de sang ou d'une coquille ? Notre équipe de biologistes locaux est à votre écoute pour une aide sur-mesure avant votre envoi.</p>
                            
                            <div class="space-y-4">
                                @foreach([
                                    'Support par chat disponible 7j/7.',
                                    'Réponse en moins de 2 heures pour les prélèvements urgents.',
                                    'Accès direct à vos instructions depuis votre dashboard.'
                                ] as $supportFeature)
                                <div class="flex gap-4 items-start bg-slate-800/30 p-3 rounded-2xl border border-slate-800">
                                    <span class="mt-1 w-2 h-2 rounded-full bg-bio-500 shrink-0 shadow-[0_0_10px_rgba(79,70,229,0.5)]"></span>
                                    <p class="text-[11px] text-slate-300 font-bold uppercase tracking-widest leading-relaxed">{{ $supportFeature }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.5);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(79, 70, 229, 0.3);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(79, 70, 229, 0.6);
        }
    </style>
</x-app-layout>
