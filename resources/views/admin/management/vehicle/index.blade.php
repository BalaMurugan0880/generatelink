@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Vehicle List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('appointments.index')}}">Vehicle</a></li>
                <li class="breadcrumb-item active">List</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 margin-tb mb-2">
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('vehicle.create') }}"><i class="fas fa-plus" style="color: #ffffff;"></i></a>
                    </div>
                </div>
            </div>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Vehicle Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $filteredAppointment)
                            <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ isset($filteredAppointment['apt_date']) ? date('d/m/Y', strtotime($filteredAppointment['apt_date'])) : '-' }}</td>
                            <td>
                                <form action="{{ route('appointments.destroy',$filteredAppointment['id']) }}" method="POST">

                                    <a class="btn-xs btn-info" data-toggle="modal" data-target="#updateStatusModal" data-appointment-id="{{ $filteredAppointment['id'] }}"><i class="fas fa-eye"></i></a>


                                    {{-- <a class="btn-xs btn-primary" href="{{ route('appointments.edit',$filteredAppointment['id']) }}"><i class="far fa-edit"></i></a>

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-xs btn-danger" id="deleteButton"><i class="fas fa-trash-alt"></i></button> --}}

                                </form>
                            </td>
                        </tr>
                        <input type="hidden" id="status_{{ $filteredAppointment['id'] }}" value="{{ $filteredAppointment['status'] }}">
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    <th>Vehicle Name</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>

            {!! $vehicles->links() !!}
        </div>
    </section>
</div>




@endsection