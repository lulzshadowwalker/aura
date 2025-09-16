<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" data-theme="cookie"
    class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @unless (app()->environment('local'))
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-BTWQ5QP28W"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'G-BTWQ5QP28W');
        </script>
    @endunless

    <title>{{ isset($title) && $title ? $title . ' | ' . config('app.name') : config('app.name') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.3.2/css/flag-icons.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col">
    <x-marquee :text="__('app.marquee')" />

    <x-header :collections="$collections" />

    <main class="flex-1"> {{ $slot }} </main>
    <x-flash-messages />

    <x-footer :collections="$collections" />

    <x-cart-fab />

    <!-- FontAwesomeIcons -->
    <script src="https://kit.fontawesome.com/a51f251d24.js" crossorigin="anonymous"></script>

    <!-- NOTE: Use fontawesome going forward as we will deprecate lucide icons at some point -->
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>

</html>
