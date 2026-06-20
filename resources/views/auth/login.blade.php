<x-guest-layout>
    <div class="mb-8">
        <h2 class="font-outfit font-black text-2xl text-white mb-2">Bienvenue</h2>
        <p class="text-white/50 text-sm">Connectez-vous à votre portail génétique.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-white/70 text-xs font-bold uppercase tracking-widest mb-2 ml-1">Email</label>
            <input id="email" 
                   class="block w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white placeholder-white/20 focus:outline-none focus:border-bio-400 focus:ring-1 focus:ring-bio-400 transition" 
                   type="email" 
                   name="email" 
                   placeholder="votre@email.com"
                   :value="old('email')" 
                   required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-2 ml-1">
                <label for="password" class="block text-white/70 text-xs font-bold uppercase tracking-widest">Mot de passe</label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-bio-400 hover:text-bio-300 transition font-bold" href="{{ route('password.request') }}">
                        Oublié ?
                    </a>
                @endif
            </div>
            <input id="password" 
                   class="block w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white placeholder-white/20 focus:outline-none focus:border-bio-400 focus:ring-1 focus:ring-bio-400 transition"
                   type="password"
                   name="password"
                   placeholder="••••••••"
                   required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center ml-1">
            <input id="remember_me" type="checkbox" class="rounded-lg bg-white/5 border-white/10 text-bio-500 shadow-sm focus:ring-bio-500 focus:ring-offset-0" name="remember">
            <label for="remember_me" class="ms-3 text-sm text-white/40">Se souvenir de moi</label>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-bio-500 hover:bg-bio-400 text-white font-black py-4 rounded-2xl transition shadow-xl shadow-bio-500/20 hover:shadow-bio-500/40 hover:-translate-y-0.5 transform">
                Se connecter
            </button>
        </div>
        
        <div class="text-center pt-6">
            <p class="text-white/40 text-sm">
                Pas encore de compte ? 
                <a href="{{ route('register') }}" class="text-bio-400 hover:text-bio-300 font-bold transition">Créer un compte</a>
            </p>
        </div>
    </form>
</x-guest-layout>
