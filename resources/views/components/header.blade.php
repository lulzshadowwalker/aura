@props(['collections'])

<header class="navbar bg-base-100 container mx-auto">
  <div class="flex-1">
    <a href="{{ route('home.index') }}" class="btn btn-ghost">
    <img src="{{ asset('assets/images/logo.png') }}" alt="Northwind Logo" class="h-10">
    <span class="text-xl font-semibold">Northwind</span>
</a>
  </div>

  <div class="flex-none">
    <ul class="menu menu-horizontal space-x-1 items-center">
      <li><a href="{{ route('home.index') }}">Home</a></li>
      <li class="dropdown dropdown-end">
        <button>
          Collections
        </button>

        <ul class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
          @foreach ($collections as $key => $collection)
          <li><a href="/#{{ $collection->slug }}" class="text-sm">{{ $collection->name }}</a></li>
          @endforeach
        </ul>
      </li>
      <li><a href="{{ route('products.index') }}">Products</a></li>

      @if (auth()->check())
      <div class="dropdown dropdown-end">
        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <img
              alt="Tailwind CSS Navbar component"
              src="{{ auth()->user()->avatar }}" />
          </div>
        </div>

        <ul
          tabindex="0"
          class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
          <li>
            <a class="justify-between text-sm">
              Profile
              <span class="badge">New</span>
            </a>
          </li>
          <li><a class="text-sm">Settings</a></li>
          <li>
            <form method="post" action="{{ route('auth.logout') }}" class="w-full">
              @csrf
              <button type="submit" class="text-sm w-full">Logout</button>
            </form>
          </li>
        </ul>
      </div>
      @else
      <x-auth-button />
      @endif
    </ul>
  </div>
</header>
