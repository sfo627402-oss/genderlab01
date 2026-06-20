<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            <div class="mb-10 text-center md:text-left">
                <h2 class="text-3xl font-black font-outfit text-slate-900 uppercase italic tracking-tight italic">Identité <span class="text-indigo-600">Utilisateur</span></h2>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mt-2">Gestion des paramètres de compte sécurisé</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <!-- Profile Sidebar Info -->
                <div class="space-y-6">
                    <div class="bg-indigo-950 rounded-[2.5rem] p-10 text-white relative overflow-hidden group shadow-2xl shadow-indigo-950/20">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/20 to-transparent"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mb-6 border border-white/20">
                                <svg class="w-8 h-8 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <h3 class="font-black font-outfit text-xl uppercase italic tracking-tight italic">{{ Auth::user()->name }}</h3>
                            <p class="text-[9px] font-black text-indigo-300/60 uppercase tracking-[0.2em] mt-1">{{ Auth::user()->email }}</p>
                            
                            <div class="mt-8 pt-6 border-t border-white/10">
                                <div class="flex items-center justify-between text-[9px] font-black uppercase tracking-widest text-indigo-200/40">
                                    <span>Accès Rôle</span>
                                    <span class="bg-indigo-500 text-white px-3 py-1 rounded-lg">{{ Auth::user()->role ?? 'Client' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-xl shadow-indigo-900/5">
                        <h4 class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Protection des Données</h4>
                        <p class="text-xs text-slate-500 leading-relaxed font-medium">
                            Vos données génétiques et personnelles sont cryptées selon les standards AES-256. BioScan AI garantit la confidentialité totale de vos prélèvements.
                        </p>
                    </div>
                </div>

                <!-- Settings Forms -->
                <div class="lg:col-span-2 space-y-10">
                    
                    <div class="bg-white shadow-2xl shadow-indigo-900/5 sm:rounded-[2.5rem] border border-slate-100 overflow-hidden">
                        <div class="px-10 py-8 bg-slate-50 border-b border-slate-100">
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em]">01. Informations du Profil</h3>
                        </div>
                        <div class="p-10">
                            <div class="max-w-xl">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-2xl shadow-indigo-900/5 sm:rounded-[2.5rem] border border-slate-100 overflow-hidden">
                        <div class="px-10 py-8 bg-slate-50 border-b border-slate-100">
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em]">02. Sécurité d'Accès</h3>
                        </div>
                        <div class="p-10">
                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>

                    <div class="bg-rose-50/50 shadow-2xl shadow-rose-900/5 sm:rounded-[2.5rem] border border-rose-100 overflow-hidden">
                        <div class="px-10 py-8 bg-rose-50/80 border-b border-rose-100">
                            <h3 class="text-xs font-black text-rose-900 uppercase tracking-[0.2em]">Zone Critique</h3>
                        </div>
                        <div class="p-10">
                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
