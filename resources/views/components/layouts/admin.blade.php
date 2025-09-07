<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Toastr --}}
    <link href="{{ asset('assets/admin/toastr/toastr.min.css') }}" rel="stylesheet">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- SweetAlert2 --}}
    <link href="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.all.min.css') }}" rel="stylesheet">

    {{-- Swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    {{-- Animate CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- CSRF Token for security --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Extra Styles --}}
    @stack('styles')
</head>
<body>
   {{-- Header (always top, full width) --}}
   @include('admin.share.header')

<div id="admin-wrapper" style="display: flex; min-height: calc(100vh - 60px);">
    {{-- Sidebar (fixed on the left) --}}
    <aside style="width: 250px; flex-shrink: 0; background: #0d6efd; color: #fff;">
        @include('admin.share.sidebar')
    </aside>

    {{-- Main Panel (content + footer) --}}
    <div class="br-mainpanel" style="flex-grow: 1; display: flex; flex-direction: column;">
        
        {{-- Page Info --}}
        @yield('page-info')

        {{-- Page Content --}}
        <div class="br-pagebody" style="flex: 1; padding: 20px; background: #fff;">
            @yield('content')
        </div>

        {{-- Footer (sticks under content, not under sidebar) --}}
        @include('admin.share.footer')
    </div>
</div>
    {{-- Extra Scripts --}}
    @stack('scripts')
</body>

</html>
