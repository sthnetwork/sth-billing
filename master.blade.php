<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.header')
</head>
<body>
    <div class="main-wrapper">
        @include('partials.sidebar')

        <div class="page-wrapper">
            @include('partials.navbar')

            <div class="page-content container-xxl">
                @yield('content')
            </div>

            @include('partials.footer')
        </div>
    </div>

    {{-- ✅ Tambahkan stack script DI SINI sebelum penutup body --}}
    @stack('scripts')
</body>
</html>
