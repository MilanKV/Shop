<!DOCTYPE html>
<html lang="en">
{{-- Head --}}
@include('backend.components.layout.head')

<body class="d-flex flex-column min-vh-100">
    {{-- Sidebar --}}
    @include('backend.components.layout.sidebar')


    <div class="page-section">
        {{-- Header --}}
        @include('backend.components.layout.header')

        <div class="main">
            {{-- Page Content --}}
            @yield('content')
        </div>

        {{-- Footer --}}
        @include('backend.components.layout.footer')
    </div>
    {{-- app-body --}}

    {{-- Scripts --}}
    @vite('resources/js/admin/app.js')
</body>

</html>