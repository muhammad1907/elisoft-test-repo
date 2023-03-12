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

                <form method="post" id="form" action="{{route('user-update',$user->id)}}">
                    @csrf 
                    @method('PATCH')

                    @if (session('errorMessage'))
                        <div class="alert alert-danger">
                            {{ session('errorMessage') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="name" value="{{ $user->name }}" placeholder="Enter Name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" name="email" value="{{ $user->email }}" placeholder="Enter Email Address..." autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
                </form>

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