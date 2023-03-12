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

               <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">User Tables</h1>
                    

                    <!-- DataTales Example -->
                    @if (session('errorMessage'))
                        <div class="alert alert-danger">
                            {{ session('errorMessage') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                       
                            <a href="{{route('user-create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add User</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         @foreach ($users as $user)
                                            <tr>
                                                
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <a href="{{ route('users.read', $user->id) }}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Detail" data-placement="bottom"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                                    <form method="POST" action="{{ route('user-delete', $user->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{ $user->id }} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

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