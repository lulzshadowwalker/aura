@props([
    'speed' => 0.5,
    'text' => 'Default marquee text'
])

<marquee behavior="scroll" direction="left" scrollamount="5" class="py-2 font-medium bg-primary text-primary-content">
    @for ($i = 0; $i < 16; $i++)
        <span class="me-4 inline-flex items-center gap-4">
            <span class="text-nowrap">{{ $text }}</span>
            <img src="{{ asset('assets/images/logo.png') }}" alt="Northwind Logo" class="h-8">
        </span>
    @endfor
</marquee>
