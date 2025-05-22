<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
    <style>
        /* Hapus scrollbar tetapi tetap bisa scroll jika diperlukan */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        /* Active menu item styling */
        .menu-item-active {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 3px solid white;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50">

    <flux:sidebar sticky stashable class="w-64 min-w-[16rem] border-e border-blue-200 bg-gradient-to-b from-blue-300 to-blue-400 text-white shadow-lg overflow-y-auto no-scrollbar">
    <flux:sidebar.toggle class="lg:hidden text-white hover:text-blue-100" icon="x-mark" />

    <!-- Logo Area dengan backdrop blur, logo di tengah dan backdrop dipanjangkan -->
    <div class="bg-blue-600/30 backdrop-blur-sm mb-3 pt-3 pb-2 border-b border-blue-400/30 w-full flex justify-center">
        <a href="{{ route('dashboard') }}" class="flex items-center" wire:navigate>
            <x-app-logo />
        </a>
    </div>

    <!-- User Profile Card -->
    <div class="mx-2 mb-3 p-2 bg-white/10 backdrop-blur-sm rounded-lg border border-white/20">
        <div class="flex items-center px-1">
            <div class="relative">
                <div class="h-9 w-9 rounded-full bg-blue-700 text-white font-semibold flex items-center justify-center text-sm shadow-inner border-2 border-white/30">
                    {{ auth()->user()->initials() }}
                </div>
                <div class="absolute -bottom-1 -right-1 h-3.5 w-3.5 bg-green-500 rounded-full border-2 border-blue-600"></div>
            </div>
            <div class="ml-2 flex-1">
                <div class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</div>
                <div class="text-xs text-blue-100 truncate">Administrator</div>
            </div>
            <flux:dropdown position="bottom" align="end">
                <button class="p-1 rounded-full hover:bg-white/10 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </button>
                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="px-3 py-2 border-b border-gray-200">
                            <div class="flex items-center space-x-3">
                                <span class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full bg-blue-600 text-white font-semibold justify-center items-center">
                                    {{ auth()->user()->initials() }}
                                </span>
                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </div>
    </div>

    <!-- Dashboard -->
    <div class="px-2">
        <flux:navlist variant="outline" class="mb-3 text-sm">
            <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" 
                class="font-semibold text-white hover:bg-white/10 rounded-md px-3 py-2 transition-all duration-200 {{ request()->routeIs('dashboard') ? 'menu-item-active pl-2' : '' }}" wire:navigate>
                {{ __('Dashboard') }}
            </flux:navlist.item>
        </flux:navlist>
    </div>

    <!-- Data Personal -->
    <div class="px-2">
        <h3 class="px-3 py-1 mb-1 text-xs uppercase tracking-wider font-bold text-blue-100 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            {{ __('Data Personal') }}
        </h3>
        <flux:navlist variant="outline" class="mb-3 text-sm">
            <flux:navlist.group class="grid gap-0.5">
                <flux:navlist.item icon="user" :href="route('siswa')" :current="request()->routeIs('siswa')" 
                    class="font-semibold text-white hover:bg-white/10 rounded-md px-3 py-1.5 transition-all duration-200 {{ request()->routeIs('siswa') ? 'menu-item-active pl-2' : '' }}" wire:navigate>
                    {{ __('Siswa') }}
                </flux:navlist.item>
                <flux:navlist.item icon="academic-cap" :href="route('guru')" :current="request()->routeIs('guru')" 
                    class="font-semibold text-white hover:bg-white/10 rounded-md px-3 py-1.5 transition-all duration-200 {{ request()->routeIs('guru') ? 'menu-item-active pl-2' : '' }}" wire:navigate>
                    {{ __('Guru') }}
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>
    </div>

    <!-- Data PKL -->
    <div class="px-2">
        <h3 class="px-3 py-1 mb-1 text-xs uppercase tracking-wider font-bold text-blue-100 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            {{ __('Data PKL') }}
        </h3>
        <flux:navlist variant="outline" class="mb-3 text-sm">
            <flux:navlist.group class="grid gap-0.5">
                <flux:navlist.item icon="building-office-2" :href="route('industri')" :current="request()->routeIs('industri')" 
                    class="font-semibold text-white hover:bg-white/10 rounded-md px-3 py-1.5 transition-all duration-200 {{ request()->routeIs('industri') ? 'menu-item-active pl-2' : '' }}" wire:navigate>
                    {{ __('Industri') }}
                </flux:navlist.item>
                <flux:navlist.item icon="briefcase" :href="route('pkl')" :current="request()->routeIs('pkl')" 
                    class="font-semibold text-white hover:bg-white/10 rounded-md px-3 py-1.5 transition-all duration-200 {{ request()->routeIs('pkl') ? 'menu-item-active pl-2' : '' }}" wire:navigate>
                    {{ __('Status PKL') }}
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>
    </div>

    <!-- Status Info Box -->
    <div class="mx-2 mb-3 p-2 bg-white/10 backdrop-blur-sm rounded-lg border border-white/20">
        <div class="flex items-center mb-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-blue-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <span class="font-bold text-xs text-blue-100">Statistik Sistem</span>
        </div>
        <div class="grid grid-cols-2 gap-2 text-xs font-medium text-blue-50">
            <div>
                <div class="flex justify-between mb-0.5">
                    <span>PKL Aktif</span>
                    <span>10%</span>
                </div>
                <div class="w-full bg-blue-800/50 rounded-full h-1.5">
                    <div class="bg-blue-100 h-1.5 rounded-full" style="width: 10%"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between mb-0.5">
                    <span>Siswa</span>
                    <span>91%</span>
                </div>
                <div class="w-full bg-blue-800/50 rounded-full h-1.5">
                    <div class="bg-green-300 h-1.5 rounded-full" style="width: 92%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigasi kembali -->
    <div class="px-2">
        <flux:navlist variant="outline" class="text-sm mb-3">
            <flux:navlist.item icon="arrow-left" :href="route('home')" 
                class="font-semibold text-white hover:bg-white/10 rounded-md px-3 py-1.5 transition-all duration-200" wire:navigate>
                {{ __('Kembali') }}
            </flux:navlist.item>
        </flux:navlist>
    </div>

    <!-- Footer Info -->
    <div class="mt-auto px-3 py-2 text-xs text-center text-blue-200/70 border-t border-blue-400/30">
        <div class="font-medium">PKL Management System</div>
        <div class="text-[10px] mt-0.5">© 2025 All Rights Reserved</div>
    </div>
    </flux:sidebar>

    <!-- Mobile Sidebar -->
    <flux:header class="lg:hidden bg-blue-500 text-white shadow-md">
        <flux:sidebar.toggle class="lg:hidden text-white hover:text-blue-100" icon="bars-2" inset="left" />
        <span class="font-bold text-lg">PKL SYSTEM</span>
        <flux:spacer />
        <flux:dropdown position="top" align="end">
            <div class="relative">
                <div class="h-8 w-8 rounded-full bg-blue-600 text-white font-semibold flex items-center justify-center border-2 border-white/40">
                    {{ auth()->user()->initials() }}
                </div>
                <div class="absolute -bottom-0.5 -right-0.5 h-3 w-3 bg-green-500 rounded-full border-2 border-blue-500"></div>
            </div>
            <flux:menu>
                <flux:menu.radio.group>
                    <div class="flex items-center gap-2 px-3 py-2">
                        <span class="relative flex h-8 w-8 overflow-hidden rounded-lg bg-blue-600 text-white items-center justify-center">
                            {{ auth()->user()->initials() }}
                        </span>
                        <div class="grid text-sm">
                            <span class="font-semibold">{{ auth()->user()->name }}</span>
                            <span class="text-xs">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </flux:menu.radio.group>
                <flux:menu.separator />
                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>
                <flux:menu.separator />
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>
</html>
