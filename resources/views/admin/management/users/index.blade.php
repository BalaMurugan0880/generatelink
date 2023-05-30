@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">User Management</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
                <li class="breadcrumb-item active">List</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="col-lg-12 margin-tb mb-2">
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('users.create') }}"><i class="fas fa-plus" style="color: #ffffff;"></i></a>
                </div>
            </div>



        <div class="table-responsive table-responsive-sm">
            <table id="usersTable" class="table table-bordered table-striped data-table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Role</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Date Of Birth</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php $i = 0; @endphp
                     @foreach ($users as $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name ?? '-' }}</td>
                                <td>{{ $user->email ?? '-' }}</td>
                                <td>{{ $user->profile->designation ?? '-' }}</td>
                                <td>{{ $user->role->name ?? '-' }}</td>
                                <td>{{ $user->profile->phone_number ?? '-' }}</td>
                                <td>{{ $user->profile->gender ?? '-' }}</td>
                                <td>{{ $user->profile->dob ?? '-' }}</td>
                                <td>{{ $user->is_active ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <form action="{{ route('users.destroy',$user['id']) }}" method="POST">

                                    <a class="btn-xs btn-info" data-toggle="modal" data-target="#updateStatusModal" data-appointment-id="{{ $user['id'] }}"><i class="fas fa-eye"></i></a>


                                     <a class="btn-xs btn-primary" href="{{ route('users.edit',$user['id']) }}"><i class="far fa-edit"></i></a>

                                   @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-xs btn-danger" id="deleteButton"><i class="fas fa-trash-alt"></i></button>

                                </form>
                            </td>
                        </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Role</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Date Of Birth</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>
        </div>

        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        // Initialize the DataTable with searching set to false
        var dataTable = $('#usersTable').DataTable({

        });


    });


</script>
@endsection