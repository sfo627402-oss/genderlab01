<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GenDer Lab — Sexage Moléculaire & Détection Pathogènes</title>
    <meta name="description" content="Plateforme de sexage moléculaire ADN pour oiseaux et espèces monomorphes. Analyse PCR, IA électrophorèse, rapport certifié en 24-72h. Précision 99.9%.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html { scroll-behavior: smooth; }
        .hero-bg {
            background:
                radial-gradient(circle at top right, rgba(34, 211, 238, 0.22), transparent 25%),
                radial-gradient(circle at bottom left, rgba(77, 212, 255, 0.14), transparent 22%),
                linear-gradient(135deg, #020617 0%, #0f172a 35%, #0c4a6e 100%);
            position: relative;
            min-height: calc(100vh - 4.5rem);
        }
        .hero-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(5, 17, 41, 0.35);
            pointer-events: none;
        }
        .hero-content {
            position: relative;
            z-index: 10;
        }
        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.1);
            border-color: rgba(34, 197, 94, 0.24);
        }
        .gradient-text {
            background: linear-gradient(135deg, #4de12f 0%, #0084ff 45%, #22d3ee 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .dna-container {
            position: absolute;
            width: 100px;
            height: 500px;
            opacity: 0.1;
            right: 10%;
            top: 10%;
            display: flex;
            flex-direction: column;
            gap: 15px;
            pointer-events: none;
            z-index: 5;
        }
        .dna-step {
            width: 60px;
            height: 4px;
            background: #4de12f;
            border-radius: 9999px;
            position: relative;
            animation: dna-rotate 4s infinite linear;
        }
        .dna-step::before,
        .dna-step::after {
            content: '';
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 9999px;
            background: #22d3ee;
            top: -3px;
        }
        .dna-step::after {
            right: -5px;
            background: #0084ff;
        }
        @keyframes dna-rotate {
            0% { transform: scaleX(1) rotate(0deg); opacity: 1; }
            50% { transform: scaleX(-1) rotate(180deg); opacity: 0.3; }
            100% { transform: scaleX(1) rotate(360deg); opacity: 1; }
        }
    </style>
</head>
<body class="font-inter bg-slate-950 text-slate-300 antialiased">
    <nav class="fixed top-0 w-full z-50 bg-transparent backdrop-blur-md border-b border-white/5 transition-all duration-300">
        <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-600 opacity-80"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex items-center justify-between py-1 relative">
            <a href="/" class="inline-flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="GenDer Lab Logo" class="h-16 md:h-20 w-auto transition duration-300 transform scale-125 ml-4">
            </a>
            <div class="hidden md:flex items-center gap-8">
                <a href="#services" class="text-slate-300 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-cyan-400 hover:to-blue-400 text-sm font-bold transition uppercase tracking-widest">Services</a>
                <a href="#how" class="text-slate-300 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-cyan-400 hover:to-blue-400 text-sm font-bold transition uppercase tracking-widest">Processus</a>
                <a href="#species" class="text-slate-300 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-cyan-400 hover:to-blue-400 text-sm font-bold transition uppercase tracking-widest">Espèces</a>
                <a href="#contact" class="text-slate-300 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-r hover:from-cyan-400 hover:to-blue-400 text-sm font-bold transition uppercase tracking-widest">Contactez-nous</a>
            </div>
            <div class="flex items-center gap-6">
                <a href="{{ route('login') }}" class="text-slate-200 hover:text-cyan-400 font-black text-sm uppercase tracking-widest transition">Connexion</a>
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-xs uppercase tracking-widest px-6 py-3.5 rounded-xl transition shadow-[0_0_20px_rgba(37,99,235,0.3)] transform hover:-translate-y-0.5 border border-cyan-500/30">S'inscrire</a>
            </div>
        </div>
    </nav>
    <section class="hero-bg min-h-screen flex items-center relative overflow-hidden pt-24 pb-24">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(34,211,238,0.18),_transparent_35%),radial-gradient(circle_at_bottom_left,_rgba(77,212,255,0.12),_transparent_30%)]"></div>
        <div class="dna-container hidden lg:flex">
            @for($i = 0; $i < 12; $i++)
                <div class="dna-step" style="animation-delay: {{ $i * 0.18 }}s"></div>
            @endfor
        </div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full relative z-10 hero-content">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 glass px-4 py-2 rounded-full text-xs font-black text-bio-300 mb-8 tracking-widest uppercase border border-bio-200">
                        <div class="w-2 h-2 bg-bio-400 rounded-full animate-pulse"></div>
                        Laboratoire certifié ISO — 99,9% de précision
                    </div>
                    <div class="max-w-3xl">
                        <h1 class="font-outfit font-black text-4xl lg:text-5xl xl:text-6xl text-white leading-tight tracking-tight mb-2">
                            GenDer Lab
                        </h1>
                        <h2 class="font-outfit font-black gradient-text text-3xl lg:text-5xl xl:text-6xl leading-tight tracking-tight mb-6">
                            Sexage Moléculaire & Détection Pathogènes
                        </h2>
                    </div>
                    <p class="text-slate-200 text-base lg:text-lg leading-relaxed mb-10 max-w-2xl font-medium">
                        La référence en diagnostic génétique aviaire. Détermination moléculaire du sexe chez les espèces monomorphes avec une précision élevée grâce aux technologies PCR de référence.
                    </p>
                    <div class="flex flex-wrap gap-4 mb-12">
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-bio-500 hover:bg-bio-400 text-white font-bold py-4 px-8 rounded-2xl transition shadow-xl shadow-bio-500/30">Commencer mon analyse</a>
                        <a href="#how" class="inline-flex items-center gap-2 glass text-white font-semibold py-4 px-8 rounded-2xl transition hover:bg-white/15">Voir le processus</a>
                    </div>
                    <div class="grid grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-black text-white">1200+</div>
                            <div class="text-white/60 text-xs mt-2 uppercase tracking-widest">Espèces analysées</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-black text-white">99.9%</div>
                            <div class="text-white/60 text-xs mt-2 uppercase tracking-widest">Précision</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-black text-white">24h</div>
                            <div class="text-white/60 text-xs mt-2 uppercase tracking-widest">Rapport express</div>
                        </div>
                    </div>
                </div>
                <div class="relative" x-data="{ 
                    active: 0, 
                    images: [
                        '{{ asset('images/hero/photo_2026-06-20_12-45-18.jpg') }}',
                        '{{ asset('images/hero/photo_2026-06-20_12-45-33.jpg') }}',
                        '{{ asset('images/hero/photo_2026-06-20_12-45-40.jpg') }}',
                        '{{ asset('images/hero/photo_2026-06-20_12-46-01.jpg') }}'
                    ],
                    next() { this.active = (this.active + 1) % this.images.length },
                    init() { setInterval(() => this.next(), 5000) }
                }">
                    <div class="relative rounded-[2.5rem] overflow-hidden shadow-[0_45px_120px_-50px_rgba(0,0,0,0.7)] border border-white/10 bg-slate-950/80 backdrop-blur-xl h-[560px]">
                        <template x-for="(img, index) in images" :key="index">
                            <div x-show="active === index" 
                                 x-transition:enter="transition duration-1000 ease-in-out"
                                 x-transition:enter-start="opacity-0 scale-110"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition duration-1000 ease-in-out"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-105"
                                 class="absolute inset-0">
                                <img :src="img" alt="GenDer Lab Hero" class="w-full h-full object-cover object-top">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                            </div>
                        </template>

                        <div class="absolute left-6 bottom-6 p-5 rounded-3xl bg-slate-900/80 border border-white/10 shadow-xl z-20 backdrop-blur-md">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-12 h-12 rounded-3xl bg-bio-400/15 flex items-center justify-center text-bio-400 text-xl font-black">♀</div>
                                <div>
                                    <div class="text-white font-bold">Rapport sous 72h</div>
                                    <div class="text-slate-300 text-xs uppercase tracking-widest">Prélèvement simplifié</div>
                                </div>
                            </div>
                            <div class="text-white/70 text-sm leading-relaxed">Prélevez plumes, sang ou coquille, et recevez un certificat imprimable dans votre espace sécurisé.</div>
                        </div>

                        <!-- Dots indicator -->
                        <div class="absolute right-6 bottom-6 flex gap-2 z-20">
                            <template x-for="(img, index) in images" :key="index">
                                <button @click="active = index" 
                                        :class="active === index ? 'bg-bio-400 w-8' : 'bg-white/20 w-2 hover:bg-white/40'"
                                        class="h-2 rounded-full transition-all duration-300"></button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-8 bg-slate-950 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6 text-sm text-slate-300">
            <div class="flex items-center gap-3"><div class="w-3 h-3 bg-bio-400 rounded-full"></div>Analyse ADN ISO & validation vétérinaire.</div>
            <div class="flex items-center gap-3"><div class="w-3 h-3 bg-bio-400 rounded-full"></div>Détection pathogènes avancée.</div>
            <div class="flex items-center gap-3"><div class="w-3 h-3 bg-bio-400 rounded-full"></div>Données sécurisées et rapports certifiés.</div>
        </div>
    </section>
    <section id="services" class="py-24 bg-slate-950">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <span class="inline-flex items-center gap-2 bg-bio-500/10 text-bio-400 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em] mb-4 border border-bio-500/20">Nos services</span>
                <h2 class="font-outfit font-black text-4xl lg:text-5xl text-white tracking-tight">La Génétique Aviaire de Nouvelle Génération</h2>
                <p class="text-slate-400 text-lg mt-6 max-w-2xl mx-auto font-medium leading-relaxed">Du sexage moléculaire à la détection de pathogènes, GenDer Lab centralise les analyses génétiques aviaires avec rapidité, précision et standards de qualité.</p>
                
                <div class="mt-12 pt-10 border-t border-white/5 flex flex-col items-center">
                    <h3 class="text-bio-500 text-xs font-bold uppercase tracking-[0.15em] mb-8">Pourquoi choisir GenDer Lab ?</h3>
                    <div class="flex flex-wrap justify-center gap-10 md:gap-20">
                        <div class="text-center">
                            <div class="text-4xl font-black text-white">95%</div>
                            <div class="text-slate-400 text-xs mt-2 uppercase tracking-widest">Précision analytique</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-black text-white">24–72h</div>
                            <div class="text-slate-400 text-xs mt-2 uppercase tracking-widest">Délais moyens</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-black text-white">100% local</div>
                            <div class="text-slate-400 text-xs mt-2 uppercase tracking-widest">Analyses en Algérie</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-slate-900/50 backdrop-blur rounded-[2rem] overflow-hidden shadow-[0_30px_80px_-35px_rgba(0,0,0,0.5)] border border-white/5 card-hover group hover:border-bio-500/30">
                    <div class="h-56 overflow-hidden relative">
                        <img src="{{ asset('images/service_sexage.png') }}" alt="Sexage ADN" class="w-full h-full object-cover object-top group-hover:scale-105 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-6 left-6 text-white font-black text-xl uppercase tracking-tight">Sexage Moléculaire</span>
                    </div>
                    <div class="p-8">
                        <p class="text-slate-400 text-sm leading-relaxed mb-5">Détermination moléculaire fiable du sexe chez les espèces monomorphes et juvéniles. Une méthode rapide, non invasive et scientifiquement validée.</p>
                        <div class="inline-flex items-center gap-2 text-bio-600 font-bold text-xs uppercase tracking-widest"><span class="w-2 h-2 bg-bio-400 rounded-full"></span>Résultats en 24-72h</div>
                    </div>
                </div>
                <div class="bg-slate-900/50 backdrop-blur rounded-[2rem] overflow-hidden shadow-[0_30px_80px_-35px_rgba(0,0,0,0.5)] border border-white/5 card-hover group hover:border-bio-500/30">
                    <div class="h-56 overflow-hidden relative">
                        <img src="{{ asset('images/service_pathogenes.png') }}" alt="Détection Pathogènes" class="w-full h-full object-cover object-top group-hover:scale-105 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-6 left-6 text-white font-black text-xl uppercase tracking-tight">Bilan Sanitaire</span>
                    </div>
                    <div class="p-8">
                        <p class="text-slate-400 text-sm leading-relaxed mb-5">Analyse moléculaire rapide pour identifier les agents infectieux affectant la santé aviaire et prévenir les risques sanitaires.</p>
                        <div class="inline-flex items-center gap-2 text-bio-600 font-bold text-xs uppercase tracking-widest"><span class="w-2 h-2 bg-bio-400 rounded-full"></span>Contrôle sanitaire complet</div>
                    </div>
                </div>
                <div class="bg-slate-900/50 backdrop-blur rounded-[2rem] overflow-hidden shadow-[0_30px_80px_-35px_rgba(0,0,0,0.5)] border border-white/5 card-hover group hover:border-bio-500/30">
                    <div class="h-56 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1552084117-56a987666449?q=80&w=800&auto=format&fit=crop" alt="Génotypage" class="w-full h-full object-cover object-top group-hover:scale-105 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-6 left-6 text-white font-black text-xl uppercase tracking-tight">Tests de Parenté</span>
                    </div>
                    <div class="p-8">
                        <p class="text-slate-400 text-sm leading-relaxed mb-5">Confirmez les liens de parenté et sécurisez vos programmes de reproduction grâce à une analyse génétique fiable et précise des lignées aviaires.</p>
                        <div class="inline-flex items-center gap-2 text-bio-600 font-bold text-xs uppercase tracking-widest"><span class="w-2 h-2 bg-bio-400 rounded-full"></span>Rapport clair et exploitable</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="how" class="py-24 bg-slate-900">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-bio-400 font-bold text-xs uppercase tracking-widest mb-3 inline-block">Processus simplifié</span>
                <h2 class="font-outfit font-black text-4xl lg:text-5xl text-white">Votre analyse en 4 étapes</h2>
                <p class="text-slate-400 text-lg mt-4 max-w-2xl mx-auto font-medium leading-relaxed">De l'inscription au rapport certifié, chaque étape est pensée pour être simple, rapide et sûre.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div class="flex gap-6">
                        <div class="flex-shrink-0 w-16 h-16 rounded-3xl bg-bio-500/10 text-bio-400 flex items-center justify-center text-2xl font-black">1</div>
                        <div>
                            <h3 class="text-white font-black text-xl mb-2">Inscription & Bio-ID</h3>
                            <p class="text-slate-400 text-sm leading-relaxed">Enregistrez vos oiseaux, générez un QR unique et suivez chaque prélèvement dans votre espace.</p>
                        </div>
                    </div>
                    <div class="flex gap-6">
                        <div class="flex-shrink-0 w-16 h-16 rounded-3xl bg-bio-500/10 text-bio-400 flex items-center justify-center text-2xl font-black">2</div>
                        <div>
                            <h3 class="text-white font-black text-xl mb-2">Prélèvement de l'échantillon</h3>
                            <p class="text-slate-400 text-sm leading-relaxed">Prélevez plumes, sang ou coquille — pas besoin de transport stressant pour vos oiseaux.</p>
                        </div>
                    </div>
                    <div class="flex gap-6">
                        <div class="flex-shrink-0 w-16 h-16 rounded-3xl bg-bio-500/10 text-bio-400 flex items-center justify-center text-2xl font-black">3</div>
                        <div>
                            <h3 class="text-white font-black text-xl mb-2">Analyse Moléculaire par PCR</h3>
                            <p class="text-slate-400 text-sm leading-relaxed">L’ADN est extrait puis amplifié par PCR afin d’identifier les marqueurs génétiques liés au sexe aviaire.</p>
                        </div>
                    </div>
                    <div class="flex gap-6">
                        <div class="flex-shrink-0 w-16 h-16 rounded-3xl bg-bio-500/10 text-bio-400 flex items-center justify-center text-2xl font-black">4</div>
                        <div>
                            <h3 class="text-white font-black text-xl mb-2">Certificat imprimable</h3>
                            <p class="text-slate-400 text-sm leading-relaxed">Téléchargez votre rapport sécurisé ou recevez un document physique validé.</p>
                        </div>
                    </div>
                </div>
                <div class="relative w-full max-w-sm xl:max-w-md mx-auto" x-data="{ 
                    active: 0, 
                    images: [
                        '{{ asset('images/etape/photo_2026-06-20_19-49-16.jpg') }}',
                        '{{ asset('images/etape/photo_2026-06-20_19-49-26.jpg') }}',
                        '{{ asset('images/etape/photo_2026-06-20_19-49-32.jpg') }}',
                        '{{ asset('images/etape/photo_2026-06-20_19-49-40.jpg') }}',
                        '{{ asset('images/etape/photo_2026-06-20_19-49-47.jpg') }}',
                        '{{ asset('images/etape/photo_2026-06-20_19-49-55.jpg') }}',
                        '{{ asset('images/etape/photo_2026-06-20_19-50-01.jpg') }}',
                        '{{ asset('images/etape/photo_2026-06-20_19-50-11.jpg') }}',
                        '{{ asset('images/etape/photo_2026-06-20_19-50-18.jpg') }}'
                    ],
                    next() { this.active = (this.active + 1) % this.images.length },
                    init() { setInterval(() => this.next(), 4000) }
                }">
                    <div class="relative rounded-[2rem] overflow-hidden shadow-[0_30px_80px_-40px_rgba(15,23,42,0.4)] border border-slate-200 aspect-[4/5] lg:aspect-square bg-slate-900">
                        <template x-for="(img, index) in images" :key="index">
                            <div x-show="active === index" 
                                 x-transition:enter="transition duration-1000 ease-in-out"
                                 x-transition:enter-start="opacity-0 scale-105"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition duration-1000 ease-in-out"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-105"
                                 class="absolute inset-0">
                                <img :src="img" alt="Processus GenDer Lab" class="w-full h-full object-cover object-top">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>
                            </div>
                        </template>

                        <!-- Dots indicator -->
                        <div class="absolute right-6 bottom-6 flex gap-2 z-20 flex-wrap justify-end max-w-[80%]">
                            <template x-for="(img, index) in images" :key="index">
                                <button @click="active = index" 
                                        :class="active === index ? 'bg-bio-500 w-8' : 'bg-white/40 w-2 hover:bg-white/70'"
                                        class="h-2 rounded-full transition-all duration-300"></button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="species" class="py-24 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-flex items-center gap-2 bg-white/5 text-bio-300 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em] mb-4 border border-bio-400/20">Base génétique</span>
                <h2 class="font-outfit font-black text-4xl lg:text-5xl tracking-tight">Espèces supportées</h2>
                <p class="text-slate-400 text-lg mt-4 max-w-2xl mx-auto font-medium leading-relaxed">Couverture génétique sur +1200 espèces de Psittacidés, Galliformes et plus.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $families = [
                        ['code' => 'PS-01', 'name' => 'Psittacidés', 'desc' => 'Aras, Gris du Gabon, Cacatoès, Amazones', 'count' => '350+ espèces'],
                        ['code' => 'AG-02', 'name' => 'Agapornidés', 'desc' => 'Lovebirds, Personatus, Fischeri', 'count' => '9 espèces'],
                        ['code' => 'CL-03', 'name' => 'Columbidés', 'desc' => 'Pigeons et tourterelles', 'count' => '310+ espèces'],
                        ['code' => 'ES-04', 'name' => 'Estrildidés', 'desc' => 'Mandarins, Goulds, Moineaux', 'count' => '144+ espèces'],
                        ['code' => 'FA-05', 'name' => 'Falconidés', 'desc' => 'Faucons, buses et éperviers', 'count' => '62+ espèces'],
                        ['code' => 'GL-06', 'name' => 'Galliformes', 'desc' => 'Faisans, cailles, paons', 'count' => '295+ espèces'],
                    ];
                @endphp
                @foreach($families as $family)
                    <div class="group bg-slate-950/80 border border-white/10 rounded-[2rem] p-8 shadow-[0_20px_60px_-30px_rgba(0,0,0,0.5)] hover:border-bio-400/40 transition">
                        <div class="flex items-center justify-between mb-5">
                            <div>
                                <span class="text-[10px] uppercase tracking-[0.3em] text-bio-300 font-black">{{ $family['code'] }}</span>
                                <h3 class="text-white font-black text-2xl mt-3 uppercase tracking-tight">{{ $family['name'] }}</h3>
                            </div>
                            <span class="text-bio-400 font-bold text-xs uppercase tracking-[0.25em]">{{ $family['count'] }}</span>
                        </div>
                        <p class="text-slate-400 text-sm leading-relaxed">{{ $family['desc'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-20 text-center">
                <a href="{{ route('register') }}" class="inline-flex items-center gap-3 bg-bio-500 hover:bg-bio-400 text-slate-950 font-black uppercase tracking-[0.3em] text-sm py-4 px-12 rounded-3xl shadow-xl shadow-bio-500/30 transition hover:-translate-y-1">Soumettre une espèce non référencée</a>
            </div>
        </div>
    </section>
    <section class="py-20 bg-gradient-to-r from-bio-950 via-slate-900 to-indigo-950 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_top_left,_rgba(34,211,238,0.35),_transparent_30%)]"></div>
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <h2 class="font-outfit font-black text-4xl lg:text-5xl mb-6 tracking-tight">Rejoignez notre communauté</h2>
            <p class="text-slate-300 text-lg mb-10 leading-relaxed">Besoin d’une analyse génétique aviaire ?</p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="inline-flex items-center gap-3 bg-bio-500 hover:bg-bio-400 text-slate-950 font-bold text-sm uppercase py-4 px-10 rounded-3xl shadow-xl shadow-bio-500/30 transition hover:-translate-y-1">Demander une analyse</a>
                <a href="#how" class="inline-flex items-center gap-3 bg-white/10 hover:bg-white/20 text-white font-bold text-sm uppercase py-4 px-10 rounded-3xl border border-white/20 backdrop-blur-md transition hover:-translate-y-1">Découvrir nos méthodes</a>
            </div>
        </div>
    </section>
    <footer id="contact" class="bg-slate-950 text-slate-300 py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="md:col-span-2">
                    <img src="{{ asset('images/logo.png') }}" alt="GenDer Lab Logo" class="h-40 mb-6 w-auto">
                    <p class="text-slate-400 text-sm leading-relaxed max-w-md">Plateforme de sexage ADN et de détection de pathogènes pour volailles et oiseaux de compagnie. Rapports certifiés, données sécurisées.</p>
                </div>
                <div>
                    <h4 class="font-black text-white mb-4 text-sm uppercase tracking-widest">Services</h4>
                    <ul class="space-y-3 text-slate-400 text-sm">
                        <li><a href="#services" class="hover:text-white transition">Sexage ADN</a></li>
                        <li><a href="#services" class="hover:text-white transition">Pathogènes</a></li>
                        <li><a href="#species" class="hover:text-white transition">Espèces couvertes</a></li>
                        <li><a href="#how" class="hover:text-white transition">Processus</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-black text-white mb-4 text-sm uppercase tracking-widest">Contact</h4>
                    <ul class="space-y-4 text-slate-400 text-sm">
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-bio-400 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            Algérie
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-bio-400 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <a href="tel:0669084702" class="hover:text-white transition font-medium">0669 08 47 02</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-bio-400 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <a href="mailto:info.genderlab.dz@gmail.com" class="hover:text-white transition font-medium">info.genderlab.dz@gmail.com</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-pink-500 shrink-0">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm3.98-10.822a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </div>
                            <a href="https://instagram.com/genderlab_dz" target="_blank" class="hover:text-pink-400 transition font-medium">@genderlab_dz</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-slate-500">
                <p>© {{ date('Y') }} GenDer Lab — Tous droits réservés.</p>
                <div class="flex flex-wrap gap-6">
                    <a href="#" class="hover:text-white transition">Mentions légales</a>
                    <a href="#" class="hover:text-white transition">Politique de confidentialité</a>
                    <a href="#" class="hover:text-white transition">CGU</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
