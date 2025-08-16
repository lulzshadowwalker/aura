<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" data-theme="cookie"
      class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) && $title ? $title . ' | ' . config('app.name') : config('app.name') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col">
<x-marquee :text="__('app.marquee')"/>
<x-header :collections="$collections"/>
<main class="flex-1">
    {{ $slot }}
</main>
<x-flash-messages/>
<x-footer :collections="$collections"/>
<x-cart-fab/>

<!-- FontAwesomeIcons -->
<script src="https://kit.fontawesome.com/a51f251d24.js" crossorigin="anonymous"></script>

<!-- NOTE: Use fontawesome going forward as we will deprecate lucide icons at some point -->
<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script> lucide.createIcons(); </script>
@stack('scripts')
</body>

</html>
