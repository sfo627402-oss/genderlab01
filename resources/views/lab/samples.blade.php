<x-app-layout>
    <x-slot name="header">
        <h2 class="font-outfit font-black text-3xl text-white leading-tight">
            {{ __('Laboratoire : Échantillons Entrants') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- BioStats Dashboard -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-6 mb-12">
                @foreach([
                    ['label' => 'Analyses Globales', 'val' => $stats['total'], 'color' => 'slate', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2'],
                    ['label' => 'Enregistrés', 'val' => $stats['pending'], 'color' => 'slate', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['label' => 'Réceptionnés', 'val' => $stats['received'], 'color' => 'blue', 'icon' => 'M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4'],
                    ['label' => 'Processing', 'val' => $stats['processing'], 'color' => 'amber', 'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
                    ['label' => 'Certifiés', 'val' => $stats['completed'], 'color' => 'emerald', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z']
                ] as $s)
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col justify-between group hover:shadow-xl transition-all duration-500">
                    <div class="flex justify-between items-start mb-4">
                        <div class="bg-{{$s['color']}}-50 p-2 rounded-xl text-{{$s['color']}}-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}"></path></svg>
                        </div>
                    </div>
                    <div>
                        <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1 italic">{{ $s['label'] }}</div>
                        <div class="text-3xl font-black text-slate-900 font-outfit">{{ $s['val'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mb-10 flex flex-col lg:flex-row justify-between items-end gap-6">
                <div class="bg-white p-1.5 rounded-2xl border border-slate-200 shadow-sm flex gap-1">
                    @foreach(['' => 'Tous', 'Pending' => 'En Attente', 'Received' => 'Reçus', 'Processing' => 'Traitement'] as $key => $val)
                        <a href="{{ route('lab.samples', $key ? ['status' => $key] : []) }}" 
                           class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all {{ (request('status') == $key || (!request('status') && !$key)) ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }}">
                            {{ $val }}
                        </a>
                    @endforeach
                </div>

                <div class="relative w-full lg:w-96">
                    <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" id="labSearch" placeholder="Scan QR # ou Recherche Species..." 
                           class="w-full pl-14 pr-8 py-5 bg-white border-0 rounded-[2.5rem] text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 shadow-xl shadow-indigo-900/5 transition">
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-2xl shadow-indigo-900/5 sm:rounded-[2.5rem] border border-slate-100">
                @if(isset($samples) && $samples->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-slate-50/50">
                                    <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Bio-ID QR</th>
                                    <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Spécification Espèce</th>
                                    <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Statut Actuel</th>
                                    <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Temporalité</th>
                                    <th class="px-8 py-6 text-right text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Console</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @foreach($samples as $sample)
                                    <tr class="hover:bg-slate-50/50 transition-all group">
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <div class="text-xs font-mono font-black text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-lg inline-block tracking-widest border border-indigo-100">#{{ substr($sample->qr_code, 0, 8) }}</div>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <div class="text-sm font-black text-slate-900 italic font-outfit uppercase tracking-tight">{{ $sample->species->name }}</div>
                                            <div class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-widest">{{ ucfirst($sample->sample_type) }} • x{{ $sample->quantity }} unités</div>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            @php
                                                $color = 'slate';
                                                if($sample->status == 'Received') $color = 'blue';
                                                if($sample->status == 'Processing') $color = 'amber';
                                                if($sample->status == 'Completed') $color = 'emerald';
                                            @endphp
                                            <span class="px-4 py-1.5 inline-flex text-[10px] font-black rounded-lg bg-{{ $color }}-50 text-{{ $color }}-700 border border-{{ $color }}-200 uppercase tracking-widest">
                                                {{ $sample->status }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                            {{ $sample->created_at->diffForHumans() }}
                                        </td>
                                        <td class="px-8 py-6 whitespace-nowrap text-right">
                                            <a href="{{ route('lab.sample.show', $sample->id) }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-indigo-600 text-white text-[10px] font-black uppercase tracking-widest py-3 px-6 rounded-xl shadow-lg transition transform group-hover:-translate-x-1">
                                                Ouvrir Console
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-20 text-center">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        </div>
                        <h4 class="text-xl font-black text-slate-900 font-outfit italic">Vide Analytique</h4>
                        <p class="text-slate-400 text-sm mt-2">Aucun échantillon identifié dans cette catégorie.</p>
                    </div>
                @endif
            </div>
            
        </div>
    </div>

    <script>
        document.getElementById('labSearch').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    </script>
</x-app-layout>
