@extends('layouts.base')

@section('body')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(24px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<main class="min-h-screen flex flex-col items-center justify-center relative overflow-hidden
             bg-gradient-to-br from-[#0b1230] via-[#0e1a45] to-[#0a1230]">

    {{-- Blobs decorativos --}}
    <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-blue-600/30 blur-3xl animate-pulse"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-blue-400/20 blur-3xl animate-pulse [animation-delay:700ms]"></div>

    <div class="py-4 px-4 md:px-8 relative z-10">
        <div class="grid items-center gap-6 max-w-6xl w-full lg:grid-cols-2">

            {{-- Tarjeta cristal --}}
            <div class="rounded-2xl p-6 max-w-md mx-auto md:p-8 lg:mx-0
                        bg-white/10 backdrop-blur-xl border border-white/20 shadow-2xl shadow-black/30
                        [animation:fadeInUp_0.7s_ease-out_both]">

                <div class="mb-8 [animation:fadeInUp_0.7s_ease-out_0.1s_both]">
                    <h1 class="text-white text-3xl font-bold mb-4">Crear cuenta</h1>
                    <p class="text-blue-100/70 text-base leading-relaxed">
                        Regístrate para acceder a tu panel y empezar a gestionar tus tareas.
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

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
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

                    <div class="[animation:fadeInUp_0.7s_ease-out_0.4s_both]">
                        <label for="password_confirmation" class="mb-2 text-white font-medium text-sm inline-block">Confirmar contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required
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
                               [animation:fadeInUp_0.7s_ease-out_0.5s_both]">
                        Registrarse
                    </button>

                    <div class="text-blue-100/70 text-sm text-center [animation:fadeInUp_0.7s_ease-out_0.6s_both]">
                        ¿Ya tienes una cuenta?
                        <a href="{{ route('login') }}"
                            class="text-blue-300 hover:text-white hover:underline ml-1 font-medium transition-colors duration-200
                                   focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-400 rounded">
                            Inicia sesión
                        </a>
                    </div>
                </form>
            </div>

            <div class="aspect-[71/50] max-lg:w-4/5 mx-auto [animation:fadeInUp_0.7s_ease-out_0.3s_both]">
                <img src="https://readymadeui.com/images/integration-illus.webp" class="w-full object-cover drop-shadow-2xl"
                    alt="Registro" />
            </div>
        </div>
    </div>
</main>
@endsection
