<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->currentLocale()) }}" dir="{{ language_direction() }}">

<head>
    <meta charset="utf-8" />
    <link href="{{ asset('img/favicon.png') }}" rel="apple-touch-icon" sizes="76x76">
    <link type="image/png" href="{{ asset('img/favicon.png') }}" rel="icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ setting('meta_description') }}">
    <meta name="keyword" content="{{ setting('meta_keyword') }}">
    @include('frontend.includes.meta')

    <link href="{{ asset('img/favicon.png') }}" rel="shortcut icon">
    <link type="image/ico" href="{{ asset('img/favicon.png') }}" rel="icon" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app-frontend.css', 'resources/js/app-frontend.js'])

    @livewireStyles
    @stack('after-styles')
    <x-google-analytics />

    <!-- Load chat bot styles -->
    @include('frontend.includes.chat-widget-styles')
    <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement(
            {
                pageLanguage: '{{ config('app.locale') }}',
                includedLanguages: '{{ implode(',', array_keys(config('app.available_locales'))) }}',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            },
            'google_translate_element'
        );
    }
</script>
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>

<body class="bg-pastel-light text-gray-800 dark:bg-pastel-dark dark:text-white">

    @include('frontend.includes.header')

    <main class="bg-pastel-card dark:bg-pastel-darkCard min-h-screen transition-colors duration-300">
        @yield('content')
    </main>

    @include('frontend.includes.footer')

    @livewireScripts
    @stack('after-scripts')

    <!-- Include Chat Widget -->
    @include('frontend.includes.chat-widget')

</body>
</html>