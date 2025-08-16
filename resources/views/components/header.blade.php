@props(['collections'])

<header class="navbar bg-base-100 container mx-auto">
    <div class="flex-1">
        <a href="{{ route('home.index', ['language' => app()->getLocale()]) }}" class="btn btn-ghost">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Northwind Logo" class="h-10">
            <span class="text-xl font-semibold">{{ __('app.northwind') }}</span>
        </a>
    </div>

    <div class="flex-none">
        <ul class="menu menu-horizontal space-x-1 items-center">
            <li><a href="{{ route('home.index', ['language' => app()->getLocale()]) }}">{{ __('app.home') }}</a></li>
            <li class="dropdown dropdown-end">
                <button>
                    {{ __('app.collections') }}
                </button>

                <ul class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                    @foreach ($collections as $key => $collection)
                        <li><a href="/#{{ $collection->slug }}" class="text-sm">{{ $collection->name }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="{{ route('products.index', ['language' => app()->getLocale()]) }}">{{ __('app.products') }}</a></li>

            <!-- Language Switcher -->
            @php
                $segments = request()->segments();
                if (count($segments) === 0) { $segments = [app()->getLocale()]; }
                $segments[0] = 'en'; $enPath = implode('/', $segments);
                $segments[0] = 'ar'; $arPath = implode('/', $segments);
            @endphp
            <li class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-sm">{{ strtoupper(app()->getLocale()) }}</div>
                <ul tabindex="0" class="menu dropdown-content bg-base-100 rounded-box z-1 mt-3 w-28 p-2 shadow">
                    <li><a href="{{ url('/' . $enPath) }}">EN</a></li>
                    <li><a href="{{ url('/' . $arPath) }}">AR</a></li>
                </ul>
            </li>

            @if (auth()->check())
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full">
                            <img
                                alt="Tailwind CSS Navbar component"
                                src="{{ auth()->user()->avatar }}"/>
                        </div>
                    </div>

                    <ul
                        tabindex="0"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                        <li>
                            <a class="justify-between text-sm">
                                {{ __('app.profile') }}
                                <span class="badge">{{ __('app.new') }}</span>
                            </a>
                        </li>
                        <li><a class="text-sm">{{ __('app.settings') }}</a></li>
                        <li>
                            <form method="post" action="{{ route('auth.logout', ['language' => app()->getLocale()]) }}"
                                  class="w-full">
                                @csrf
                                <button type="submit" class="text-sm w-full">{{ __('app.logout') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <x-auth-button/>
            @endif
        </ul>
    </div>
</header>
