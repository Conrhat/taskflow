<header
    class="fixed top-0 right-0 left-[250px] h-[70px] z-40
           bg-[#0b1230]/95 backdrop-blur-md border-b border-white/5
           transition-all duration-300 ease-in-out">

    <div class="h-full px-6 flex items-center justify-between">

        {{-- IZQUIERDA --}}
        <div class="flex items-center gap-4">

            {{-- MENU TOGGLE --}}
            <button id="sidebarToggle"
                class="w-10 h-10 flex items-center justify-center rounded-lg
                       text-blue-200/60 hover:bg-white/5 hover:text-white
                       transition-colors duration-200">
                <span class="material-symbols-outlined text-[22px]">menu</span>
            </button>

            {{-- BUSCADOR --}}
            <div class="relative hidden sm:block">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-blue-300/40 text-[19px]">search</span>
                <input type="text" placeholder="Buscar..."
                    class="w-[280px] h-10 rounded-lg bg-white/5 border border-white/10 pl-10 pr-4 text-sm
                           text-white placeholder:text-blue-300/40 outline-none
                           transition-all duration-200
                           focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
            </div>

        </div>

        {{-- DERECHA --}}
        <div class="flex items-center gap-3">

            {{-- NOTIFICACIONES --}}
            <button
                class="relative w-10 h-10 rounded-full border border-white/10
                       flex items-center justify-center text-blue-200/60
                       hover:bg-white/5 hover:text-white transition-colors duration-200">
                <span class="material-symbols-outlined text-[20px]">notifications</span>
                <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-blue-400 border-2 border-[#0b1230]"></span>
            </button>

            <div class="h-6 w-px bg-white/10"></div>

            {{-- USUARIO --}}
            <div class="relative">
                <button id="navUserButton" type="button"
                    class="flex items-center gap-3 pl-1 pr-2 py-1 rounded-xl
                           hover:bg-white/5 transition-colors duration-200">

                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-blue-700
                                flex items-center justify-center text-sm font-bold text-white flex-shrink-0">
                        {{ strtoupper(substr(Auth::user()->user_name ?? 'U', 0, 2)) }}
                    </div>

                    <div class="hidden lg:block text-left">
                        <p class="text-sm font-semibold text-white leading-tight">{{ Auth::user()->user_name }}</p>
                        <p class="text-xs text-blue-300/50 leading-tight">Usuario</p>
                    </div>

                    <span class="material-symbols-outlined text-[18px] text-blue-200/60 transition-transform duration-200" id="navUserChevron">
                        expand_more
                    </span>
                </button>

                {{-- DROPDOWN --}}
                <div id="navUserDropdown"
                    class="hidden absolute top-full right-0 mt-2 w-56 rounded-xl overflow-hidden z-50
                           bg-[#101a45] border border-white/10 shadow-2xl shadow-black/40
                           origin-top-right transition-all duration-150">

                    <div class="px-4 py-3 border-b border-white/5">
                        <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->user_name }}</p>
                        <p class="text-xs text-blue-300/50">Sesión activa</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-red-300
                                   hover:bg-red-500/10 hover:text-red-200 transition-colors duration-150">
                            <span class="material-symbols-outlined text-[18px]">logout</span>
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</header>

<script>
    (function () {
        const button = document.getElementById('navUserButton');
        const dropdown = document.getElementById('navUserDropdown');
        const chevron = document.getElementById('navUserChevron');

        button?.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdown.classList.toggle('hidden');
            chevron.classList.toggle('rotate-180');
        });

        document.addEventListener('click', function (e) {
            if (!dropdown.contains(e.target) && !button.contains(e.target)) {
                dropdown.classList.add('hidden');
                chevron.classList.remove('rotate-180');
            }
        });
    })();
</script>
