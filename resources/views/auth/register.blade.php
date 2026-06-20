<x-guest-layout>
    <div class="mb-8">
        <h2 class="font-outfit font-black text-2xl text-white mb-2">Inscription</h2>
        <p class="text-white/50 text-sm">Créez votre accès personnel au laboratoire.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-white/70 text-xs font-bold uppercase tracking-widest mb-2 ml-1">Nom complet</label>
            <input id="name" 
                   class="block w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white placeholder-white/20 focus:outline-none focus:border-bio-400 focus:ring-1 focus:ring-bio-400 transition" 
                   type="text" 
                   name="name" 
                   placeholder="Aymen Dev"
                   :value="old('name')" 
                   required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-white/70 text-xs font-bold uppercase tracking-widest mb-2 ml-1">Email</label>
            <input id="email" 
                   class="block w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white placeholder-white/20 focus:outline-none focus:border-bio-400 focus:ring-1 focus:ring-bio-400 transition" 
                   type="email" 
                   name="email" 
                   placeholder="votre@email.com"
                   :value="old('email')" 
                   required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-white/70 text-xs font-bold uppercase tracking-widest mb-2 ml-1">Mot de passe</label>
            <input id="password" 
                   class="block w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white placeholder-white/20 focus:outline-none focus:border-bio-400 focus:ring-1 focus:ring-bio-400 transition"
                   type="password"
                   name="password"
                   placeholder="••••••••"
                   required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-white/70 text-xs font-bold uppercase tracking-widest mb-2 ml-1">Confirmation</label>
            <input id="password_confirmation" 
                   class="block w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white placeholder-white/20 focus:outline-none focus:border-bio-400 focus:ring-1 focus:ring-bio-400 transition"
                   type="password"
                   name="password_confirmation" 
                   placeholder="••••••••"
                   required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-bio-500 hover:bg-bio-400 text-white font-black py-4 rounded-2xl transition shadow-xl shadow-bio-500/20 hover:shadow-bio-500/40 hover:-translate-y-0.5 transform">
                S'inscrire
            </button>
        </div>
        
        <div class="text-center pt-6 border-t border-white/5">
            <p class="text-white/40 text-sm">
                Déjà inscrit ? 
                <a href="{{ route('login') }}" class="text-bio-400 hover:text-bio-300 font-bold transition">Se connecter</a>
            </p>
        </div>
    </form>
</x-guest-layout>
