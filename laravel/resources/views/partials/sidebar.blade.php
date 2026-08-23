<aside id="sidebar"
    class="fixed top-0 bottom-0 left-0 w-[250px] z-50 flex flex-col
           bg-gradient-to-b from-[#0b1230] via-[#0e1a45] to-[#0a1230]
           border-r border-white/5 shadow-2xl shadow-black/30
           transition-transform duration-300 ease-in-out">

    {{-- LOGO --}}
    <div class="flex items-center gap-3 px-5 h-[70px] flex-shrink-0 border-b border-white/5">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 min-w-0">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700
                        flex items-center justify-center shadow-lg shadow-blue-900/40
                        flex-shrink-0">
                <span class="material-symbols-outlined text-white text-[20px]">bolt</span>
            </div>
            <div class="flex items-baseline gap-1.5 min-w-0">
                <span class="text-[17px] font-bold tracking-tight text-white">TaskFlow</span>
                <span class="text-[11px] font-medium text-blue-300/50">v1</span>
            </div>
        </a>
    </div>

    {{-- MENU --}}
    <nav class="flex-1 overflow-y-auto py-5 px-3">
        <p class="px-3 mb-3 text-[11px] font-semibold uppercase tracking-wider text-blue-300/40">
            Menú
        </p>

        @php
            $links = [
                ['route' => 'dashboard',        'active' => request()->routeIs('dashboard'),        'label' => 'Dashboard',   'icon' => 'grid_view'],
                ['route' => 'categorias.index', 'active' => request()->routeIs('categorias.*'),     'label' => 'Categorías',  'icon' => 'sell'],
                ['route' => 'tareas.index',     'active' => request()->routeIs('tareas.*'),         'label' => 'Tareas',      'icon' => 'checklist'],
            ];
        @endphp

        @foreach ($links as $link)
            <a href="{{ route($link['route']) }}"
                class="group relative flex items-center gap-3 w-full px-3 py-2.5 mb-1 rounded-lg text-sm font-medium
                    transition-all duration-200 ease-in-out
                    {{ $link['active']
                            ? 'bg-blue-500/15 text-white'
                            : 'text-blue-200/60 hover:bg-white/5 hover:text-white hover:translate-x-1' }}">

                @if ($link['active'])
                    <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] rounded-full bg-blue-400"></span>
                @endif

                <span class="material-symbols-outlined text-[20px] {{ $link['active'] ? 'text-blue-400' : '' }}">
                    {{ $link['icon'] }}
                </span>
                <span>{{ $link['label'] }}</span>
            </a>
        @endforeach
    </nav>

    {{-- USUARIO --}}
    <div class="flex-shrink-0 px-4 py-4 border-t border-white/5">
        <div class="flex items-center gap-3 rounded-xl bg-white/5 px-3 py-3">
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-blue-700
                        flex items-center justify-center text-xs font-bold text-white flex-shrink-0">
                {{ strtoupper(substr(Auth::user()->user_name ?? 'U', 0, 2)) }}
            </div>
            <div class="min-w-0">
                <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->user_name }}</p>
                <p class="text-xs text-blue-300/50 truncate">Usuario</p>
            </div>
        </div>
    </div>

</aside>

<script>
    document.getElementById('sidebarToggle')?.addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
    });
</script>
