<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>Bootsrtap Free Admin Template - SIMINTA | Admin Dashboad Template</title>
    @include('admin.layouts.styles')
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            @include('admin.layouts.navbar_top')
        </nav>
        <nav class="navbar-default navbar-static-side" role="navigation">
            @include('admin.layouts.navbar_side')
        </nav>

        @yield('content')
            <!-- <div class="row">
            </div> -->
    </div>
    @include('admin.layouts.scripts')
    @yield('script')
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
</body>
</html>
