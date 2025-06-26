<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) && $title ? $title . ' | ' . config('app.name') : config('app.name') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex flex-col">
    <x-header :collections="$collections"></x-header>
    <main class="flex-1">
        {{ $slot }}
    </main>
    <x-flash-messages />
    <x-footer :collections="$collections"></x-footer>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script> lucide.createIcons(); </script>
</body>
</html>
