@props(['collections'])

<header class="navbar bg-base-100 container mx-auto">
  <div class="flex-1">
    <a class="btn btn-ghost text-xl">Aura</a>
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
                <li><a href="#" class="text-sm">{{ $collection->name }}</a></li>
                @endforeach
            </ul>
      </li>
      <li><a href="{{ route('products.index') }}">Products</a></li>

    <div class="dropdown dropdown-end">
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          <img
            alt="Tailwind CSS Navbar component"
            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
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
        <li><a class="text-sm">Logout</a></li>
      </ul>
    </div>
  </ul>
  </div>
</header>
