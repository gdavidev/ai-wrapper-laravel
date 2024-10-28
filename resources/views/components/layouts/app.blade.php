<!DOCTYPE html>
<html lang="en">

<head>
    <x-layout.head-includes />
    <title>FakeCursor</title>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper" style="width: 100vw; overflow: hidden;">
        <x-layout.navbar />

        <div class="content"  style="height: calc(100vh - 120px);">
            {{ $slot }}
        </div>
        {{-- <x-layout.sidebar /> --}}
        <x-layout.footer />
    </div>
    <x-layout.scripts />
</body>

</html>
