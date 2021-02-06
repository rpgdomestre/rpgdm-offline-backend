<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('dashboard.index') }}">
                        <x-jet-application-mark class="block w-auto h-9" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard.index') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="/dashboard/weeklies" :active="request()->routeIs('weeklies')">
                        {{ __('Weeklies') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="/dashboard/pages" :active="request()->routeIs('pages')">
                        {{ __('Pages') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="/dashboard/collections" :active="request()->routeIs('collections')">
                        {{ __('Collections') }}
                    </x-jet-nav-link>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard.index') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="/dashboard/weeklies" :active="request()->routeIs('weeklies')">
                {{ __('Weeklies') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="/dashboard/pages" :active="request()->routeIs('pages')">
                {{ __('Pages') }}
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="/dashboard/collections" :active="request()->routeIs('collections')">
                {{ __('Collections') }}
            </x-jet-responsive-nav-link>
        </div>
    </div>
</nav>
