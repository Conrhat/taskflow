@extends('layouts.base')

@section('body')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(24px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<main class="min-h-screen flex bg-[#0b1230]">

    {{-- Panel izquierdo: login --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center relative overflow-hidden
                bg-gradient-to-br from-[#0b1230] via-[#0e1a45] to-[#0a1230] px-4 py-10">

        <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-blue-600/30 blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-blue-400/20 blur-3xl animate-pulse [animation-delay:700ms]"></div>

        <div class="w-full max-w-md relative z-10 [animation:fadeInUp_0.7s_ease-out_both]">

            <div class="mb-8 [animation:fadeInUp_0.7s_ease-out_0.1s_both]">
                <h1 class="text-white text-3xl font-bold mb-4">Iniciar sesión</h1>
                <p class="text-blue-100/70 text-base leading-relaxed">
                    Inicia sesión para acceder a tu panel y gestionar tus tareas.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-500/15 border border-red-400/30 text-red-200 px-4 py-3 rounded-lg text-sm
                            [animation:fadeInUp_0.7s_ease-out_0.15s_both]">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="[animation:fadeInUp_0.7s_ease-out_0.2s_both]">
                    <label for="user_name" class="mb-2 text-white font-medium text-sm inline-block">Nombre de usuario</label>
                    <input type="text" id="user_name" name="user_name" placeholder="juanperez" value="{{ old('user_name') }}" required autofocus
                        class="px-3 py-2.5 text-sm text-white placeholder:text-blue-100/40 rounded-md bg-white/10 w-full
                               outline-1 -outline-offset-1 outline-white/20
                               focus:outline-2 focus:-outline-offset-2 focus:outline-blue-400
                               transition-all duration-200" />
                </div>

                <div class="[animation:fadeInUp_0.7s_ease-out_0.3s_both]">
                    <label for="password" class="mb-2 text-white font-medium text-sm inline-block">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required
                        class="px-3 py-2.5 text-sm text-white placeholder:text-blue-100/40 rounded-md bg-white/10 w-full
                               outline-1 -outline-offset-1 outline-white/20
                               focus:outline-2 focus:-outline-offset-2 focus:outline-blue-400
                               transition-all duration-200" />
                </div>

                <button type="submit"
                    class="w-full py-2 px-3.5 text-sm rounded-md font-semibold cursor-pointer tracking-wide text-white
                           bg-blue-600 hover:bg-blue-500 hover:scale-[1.02] active:scale-[0.98]
                           transition-all duration-200
                           focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-400
                           [animation:fadeInUp_0.7s_ease-out_0.4s_both]">
                    Iniciar sesión
                </button>

                <div class="text-blue-100/70 text-sm text-center [animation:fadeInUp_0.7s_ease-out_0.5s_both]">
                    ¿No tienes una cuenta?
                    <a href="{{ route('register') }}"
                        class="text-blue-300 hover:text-white hover:underline ml-1 font-medium transition-colors duration-200
                               focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-400 rounded">
                        Regístrate
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Panel derecho: paisaje --}}
    <div class="hidden lg:block lg:w-1/2 relative overflow-hidden [animation:fadeInUp_0.9s_ease-out_0.2s_both]">
        <img src="{{ asset('storage/image/puesta-sol-misurina_181624-34793.avif') }}"
             alt="Puesta de sol en Misurina"
             class="absolute inset-0 w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/0 to-black/10"></div>

        <div class="absolute bottom-10 left-10 right-10 text-white/90 [animation:fadeInUp_0.9s_ease-out_0.5s_both]">
            <p class="text-lg font-semibold drop-shadow">TaskFlow</p>
            <p class="text-sm text-white/70 drop-shadow">Organiza tu trabajo con la calma de un buen paisaje.</p>
        </div>
    </div>
</main>
@endsection
