<!DOCTYPE html>
<html lang="en">
{{-- Head --}}
@include('backend.includes.head')

<body class="d-flex flex-column min-vh-100">
    {{-- Sidebar --}}
    @include('backend.includes.sidebar')


    <div class="page-section">
        {{-- Header --}}
        @include('backend.includes.header')

        <div class="main">
            {{-- Page Content --}}
            @yield('content')
        </div>

        {{-- Footer --}}
        @include('backend.includes.footer')
    </div>
    {{-- app-body --}}

    {{-- Scripts --}}
    @vite('resources/js/admin/app.js')
</body>

</html>