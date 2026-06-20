<x-app-layout>
    <x-slot name="header">
        <h2 class="font-outfit font-black text-3xl text-white leading-tight">
            {{ __('Panneau d\'Administration Avancé') }}
        </h2>
        <p class="text-white/60 text-sm mt-1">Supervision globale, métriques de la plateforme et gestion des utilisateurs.</p>
    </x-slot>    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <!-- Strategic Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Revenue Command -->
                <div class="bg-slate-900 overflow-hidden shadow-2xl shadow-indigo-900/20 sm:rounded-[2.5rem] p-8 text-white relative group border border-white/5">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-indigo-500/10 rounded-full blur-3xl group-hover:bg-indigo-500/20 transition duration-700"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="p-3 bg-white/5 rounded-2xl border border-white/5">
                                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-emerald-400 font-black text-[10px] bg-emerald-400/10 border border-emerald-400/20 px-3 py-1 rounded-full uppercase tracking-widest">+{{ $stats['growth'] }}%</span>
                        </div>
                        <p class="mb-1 text-[10px] font-black text-white/40 uppercase tracking-[0.2em]">Flux Financier Brut</p>
                        <p class="text-4xl font-black font-outfit tracking-tight">{{ number_format($stats['revenue'], 2) }} DZD</p>
                    </div>
                </div>

                @foreach([
                    ['label' => 'Base Utilisateurs', 'val' => $stats['users'], 'color' => 'blue', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                    ['label' => 'Analyses ADN', 'val' => $stats['samples'], 'color' => 'indigo', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                    ['label' => 'Taxonomie Bio', 'val' => $stats['species'], 'color' => 'bio', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z']
                ] as $item)
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 sm:rounded-[2.5rem] border border-slate-100 p-8 flex flex-col justify-end relative group">
                    <div class="absolute right-6 top-6">
                        <div class="bg-{{$item['color']}}-50 p-3 rounded-2xl text-{{$item['color']}}-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path></svg>
                        </div>
                    </div>
                    <div>
                        <p class="mb-1 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ $item['label'] }}</p>
                        <p class="text-4xl font-black font-outfit text-slate-900 tracking-tight">{{ $item['val'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Distribution Matrix -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach([
                    ['label' => 'En attente', 'count' => $status_dist['pending'], 'color' => 'slate'],
                    ['label' => 'Réceptionnés', 'count' => $status_dist['received'], 'color' => 'blue'],
                    ['label' => 'PCR / Séquence', 'count' => $status_dist['processing'], 'color' => 'amber'],
                    ['label' => 'Certifiés', 'count' => $status_dist['completed'], 'color' => 'emerald']
                ] as $item)
                <div class="bg-white rounded-3xl border border-slate-100 p-6 flex flex-col gap-2 shadow-sm hover:shadow-lg transition cursor-help">
                    <div class="flex justify-between items-center">
                        <p class="text-[9px] font-black uppercase tracking-[0.15em] text-slate-400">{{ $item['label'] }}</p>
                        <div class="w-1.5 h-1.5 rounded-full bg-{{ $item['color'] }}-400 animate-pulse"></div>
                    </div>
                    <p class="text-2xl font-black text-slate-900 font-outfit">{{ $item['count'] }} <span class="text-xs font-bold text-slate-300 ml-1">unités</span></p>
                </div>
                @endforeach
            </div>

            <!-- Detailed Activity Monitoring -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 pb-12">
                <!-- Recent Users Monitor -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-[3rem] border border-slate-100 relative">
                    <div class="p-10 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                        <div class="flex items-center gap-4">
                            <div class="bg-blue-600 p-3 rounded-2xl text-white shadow-lg shadow-blue-600/20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <h3 class="font-black font-outfit text-xl text-slate-900 uppercase italic tracking-tight">Ecosystem <span class="text-blue-600">Dynamics</span></h3>
                        </div>
                    </div>
                    <div class="p-4">
                        <ul class="space-y-2">
                            @foreach($recent_users as $u)
                            <li class="p-6 rounded-[2rem] flex justify-between items-center hover:bg-slate-50 transition group">
                                <div class="flex items-center gap-5">
                                    <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center font-black text-slate-900 text-xl border-4 border-white shadow-sm transition group-hover:scale-105">
                                        {{ substr($u->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-slate-900 uppercase tracking-tight">{{ $u->name }}</p>
                                        <p class="text-[11px] font-bold text-slate-400 lowercase">{{ $u->email }}</p>
                                    </div>
                                </div>
                                <div>
                                    @php
                                        $rCol = 'slate';
                                        if($u->role == 'admin') $rCol = 'indigo';
                                        if($u->role == 'biologist') $rCol = 'bio';
                                    @endphp
                                    <span class="px-5 py-2 inline-flex text-[10px] font-black rounded-xl bg-{{$rCol}}-50 text-{{$rCol}}-600 uppercase tracking-widest border border-{{$rCol}}-100">
                                        {{ $u->role }}
                                    </span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Laboratory Telemetry -->
                <div class="bg-indigo-950 overflow-hidden shadow-2xl shadow-indigo-900/40 sm:rounded-[3rem] border border-white/5 relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/30 to-transparent"></div>
                    <div class="p-10 border-b border-white/5 flex justify-between items-center relative z-10">
                        <div class="flex items-center gap-4">
                            <div class="bg-indigo-500 p-3 rounded-2xl text-white shadow-lg shadow-indigo-500/30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </div>
                            <h3 class="font-black font-outfit text-xl text-white uppercase italic tracking-tight">DNA <span class="text-indigo-400">Throughput</span></h3>
                        </div>
                    </div>
                    <div class="p-4 relative z-10">
                        <ul class="space-y-2">
                            @foreach($recent_samples as $s)
                            <li class="p-6 rounded-[2rem] flex justify-between items-center hover:bg-white/5 transition group">
                                <div class="flex items-center gap-5">
                                    <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center font-mono font-black text-indigo-100 text-[10px] tracking-tighter">
                                        #{{ substr($s->qr_code, 0, 4) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-white uppercase tracking-tight">{{ $s->user->name }}</p>
                                        <p class="text-[11px] font-bold text-indigo-300 italic">{{ $s->species->name }}</p>
                                    </div>
                                </div>
                                <div>
                                    @php
                                        $color = 'slate';
                                        if($s->status == 'Received') $color = 'blue';
                                        if($s->status == 'Processing') $color = 'amber';
                                        if($s->status == 'Completed') $color = 'emerald';
                                    @endphp
                                    <span class="px-5 py-2 inline-flex text-[10px] font-black rounded-xl bg-{{ $color }}-500/10 text-{{ $color }}-300 border border-{{ $color }}-500/20 uppercase tracking-widest">
                                        {{ $s->status }}
                                    </span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Client Access Control -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[3rem] border border-slate-100">
                <div class="p-10 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                    <div class="flex items-center gap-4">
                        <div class="bg-emerald-600 p-3 rounded-2xl text-white shadow-lg shadow-emerald-600/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 01-6 0 3 3 0 016 0zm-8 8a8 8 0 0116 0H7z"></path></svg>
                        </div>
                        <h3 class="font-black font-outfit text-xl text-slate-900 uppercase italic tracking-tight">Gestion de l’accès client</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-black uppercase tracking-wider text-slate-400">Échantillon</th>
                                    <th class="px-6 py-3 text-left text-xs font-black uppercase tracking-wider text-slate-400">Client</th>
                                    <th class="px-6 py-3 text-left text-xs font-black uppercase tracking-wider text-slate-400">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-black uppercase tracking-wider text-slate-400">Accès</th>
                                    <th class="px-6 py-3 text-right text-xs font-black uppercase tracking-wider text-slate-400">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @foreach($recent_samples as $s)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-black text-slate-900">#{{ $s->id }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-500">{{ $s->user->name }}</td>
                                    <td class="px-6 py-4 text-sm uppercase tracking-widest font-black text-slate-900">{{ $s->status }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex items-center px-3 py-2 rounded-full text-[10px] font-black uppercase tracking-widest {{ $s->client_access_granted ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-orange-50 text-orange-800 border border-orange-200' }}">
                                            {{ $s->client_access_granted ? 'Accès activé' : 'Accès désactivé' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="inline-flex items-center gap-2 justify-end">
                                            <form action="{{ route('admin.sample.access', $s->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-[10px] font-black uppercase tracking-widest text-white {{ $s->client_access_granted ? 'bg-slate-900 hover:bg-indigo-600' : 'bg-emerald-900 hover:bg-emerald-600' }} transition">
                                                    {{ $s->client_access_granted ? 'Révoquer' : 'Autoriser' }}
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.sample.destroy', $s->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer cet échantillon ? Cette action est irréversible.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-[10px] font-black uppercase tracking-widest text-white bg-rose-600 hover:bg-rose-500 transition">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</x-app-layout>
