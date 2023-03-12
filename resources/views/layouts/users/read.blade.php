<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    @include('includes.head')
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('includes.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('includes.navbar')
                <!-- End of Topbar -->

                Name : {{ $user->name }} <br>
                Email :{{ $user->email }}


            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            @include('includes.footer')
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    @include('includes.script')
</body>
</html>
