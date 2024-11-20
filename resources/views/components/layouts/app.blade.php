<!DOCTYPE html>
<html lang="en">

<head>
    <x-layout.head-includes />
    @livewireStyles
    @vite('resources/css/code-editor.css')
    <title>FakeCursor</title>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper" style="width: 100vw; overflow: hidden;">
        <x-layout.navbar />

        <div class="content"  style="height: calc(100vh - 110px);">
            {{ $slot }}
        </div>
        {{-- <x-layout.sidebar /> --}}
        <x-layout.footer />
    </div>
    <x-layout.scripts />

    @vite('resources/js/app.js')
    @vite('resources/js/code-editor.js')
    @vite('resources/js/chat.js')
    @livewireScripts
</body>

</html>
