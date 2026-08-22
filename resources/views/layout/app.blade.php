{{-- INCLUDE HEADER --}}
@include('partial.header')
<body>

    <div class="container-fluid g-0">
        <div class="row g-0">
{{-- INCLUDE SIDE BAR --}}
@include('partial.sidebar')
            <!-- MAIN CONTENT -->
    <div class="col-lg-10 g-0">
{{-- INCLUDE NAVBAR --}}
@include('partial.navbar')
{{-- CONTENT WILL BE HERE --}}
@yield('content')
{{-- INCLUDE FOOTER --}}
@include('partial.footer')