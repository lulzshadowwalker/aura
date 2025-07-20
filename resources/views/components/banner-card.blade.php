@props(['image'])

<a {{ $attributes->merge(['class' => 'block group overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-500']) }}>
  <img 
    src="{{ $image }}" 
    alt="Promotional Banner" 
    class="w-full h-full object-cover aspect-[12/5] transition-transform duration-500 ease-in-out group-hover:scale-105"
  />
</a>
