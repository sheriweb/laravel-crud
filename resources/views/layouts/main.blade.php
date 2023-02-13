<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8"/>
    <title>Dashboard</title>
    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('vendors/images/apple-touch-icon.png')}}"/>
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('vendors/images/favicon-32x32.png')}}"/>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('vendors/images/favicon-16x16.png')}}"/>

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet"/>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/core.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/icon-font.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/css/responsive.bootstrap4.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/styles/style.css')}}"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>

@include('layouts.header')
@include('layouts.sidebar')

<div class="mobile-menu-overlay"></div>

<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="title pb-20">
            @yield('content')
        </div>
    </div>
</div>

<!-- js -->
<script src="{{asset('vendors/scripts/core.js')}}"></script>
<script src="{{asset('vendors/scripts/script.min.js')}}"></script>
<script src="{{asset('vendors/scripts/process.js')}}"></script>
<script src="{{asset('vendors/scripts/layout-settings.js')}}"></script>
<script src="{{asset('src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/scripts/datatable-setting.js')}}"></script>
<script src="{{asset('vendors/scripts/dashboard3.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@yield('scripts')
</body>
</html>
