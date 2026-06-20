<x-app-layout>
    <x-slot name="header">
        <h2 class="font-outfit font-black text-3xl text-slate-900 leading-tight">
            {{ __('Scanner un Prélèvement') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('error'))
                <div class="mb-6 bg-red-50 backdrop-blur-sm border border-red-200 text-red-800 px-4 py-4 rounded-xl shadow-sm flex items-center gap-3">
                    <svg class="w-6 h-6 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white shadow-xl shadow-slate-200/50 sm:rounded-3xl p-8 border border-slate-100 text-center">
                <div class="w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                </div>
                
                <h3 class="text-2xl font-bold font-outfit text-slate-800 mb-2">Pistolet Optique / Scanner Web</h3>
                <p class="text-slate-500 mb-8">Scannez le QR Code de l'échantillon ou entrez son identifiant unique manuellement pour retrouver instantanément la fiche patient.</p>

                <form action="{{ route('lab.scan') }}" method="GET" class="max-w-md mx-auto relative group flex gap-2">
                    <input type="text" name="qr_code" required placeholder="Ex: 550e8400-e29b-41d4-a716-446655440000" class="block w-full border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-2.5 rounded-xl transition shadow-lg shadow-indigo-600/30">
                        Chercher
                    </button>
                </form>

                <div class="mt-12 bg-slate-50 p-6 rounded-2xl border border-dashed border-slate-200 text-sm text-slate-400">
                    * En production, cette page active l'API Camera (WebRTC) pour lire directement les codes via la webcam du poste du biologiste.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
