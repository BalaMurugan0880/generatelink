@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Appointment List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('appointments.index')}}">Appointment</a></li>
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
                        <a class="btn btn-success" href="{{ route('appointments.create') }}"><i class="fas fa-plus" style="color: #ffffff;"></i></a>
                    </div>
                </div>
            </div>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    {{-- <th>Appointment ID</th> --}}
                    <th>Appointment Date</th>
                    <th>Requester Name</th>
                    <th>Appointment Time</th>
                    <th>Pick Up Location</th>
                    <th>Customer Name</th>
                    <th>Customer Contact</th>
                    <th>Customer VRN</th>
                    <th>Vehicle Make</th>
                    <th>Vehicle Model</th>
                    <th>Drop-Off Location</th>
                    <th>Notes</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($filteredAppointments as $filteredAppointment)
                            <tr>
                            <td>{{ ++$i }}</td>
                            {{-- <td>{{ $filteredAppointment['id'] }}</td> --}}
                            <td>{{ isset($filteredAppointment['apt_date']) ? date('d/m/Y', strtotime($filteredAppointment['apt_date'])) : '-' }}</td>
                            <td>{{ $filteredAppointment['req_name'] ?? '-' }}</td>
                            <td>{{ $filteredAppointment['apt_time'] ?? '-' }} </td>
                            <td>{{ $filteredAppointment['pickup_location'] ?? '-' }}</td>
                            <td>{{ $filteredAppointment['customer_name'] ?? '-' }}</td>
                            <td>{{ $filteredAppointment['customer_contact'] ?? '-' }}</td>
                            <td>{{ $filteredAppointment['customer_vrn'] ?? '-' }}</td>
                            <td>{{ $filteredAppointment['vehicle_make'] ?? '-' }}</td>
                            <td>{{ $filteredAppointment['vehicle_model'] ?? '-' }}</td>
                            <td>{{ $filteredAppointment['dropoff_location'] ?? '-' }}</td>
                            <td>{{ $filteredAppointment['special_notes'] ?? '-' }}</td>
                            <td>{{ $filteredAppointment['status'] ?? '-' }}</td>
                            <td>
                                <form action="{{ route('appointments.destroy',$filteredAppointment['id']) }}" method="POST">

                                    <a class="btn-xs btn-info" href="{{ route('appointments.show',$filteredAppointment['id']) }}"><i class="fas fa-eye"></i></a>

                                    {{-- <a class="btn-xs btn-primary" href="{{ route('appointments.edit',$filteredAppointment['id']) }}"><i class="far fa-edit"></i></a>

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-xs btn-danger" id="deleteButton"><i class="fas fa-trash-alt"></i></button> --}}

                                </form>
                            </td>
                        </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    {{-- <th>Appointment ID</th> --}}
                    <th>Appointment Date</th>
                    <th>Requester Name</th>
                    <th>Appointment Time</th>
                    <th>Pick Up Location</th>
                    <th>Customer Name</th>
                    <th>Customer Contact</th>
                    <th>Customer VRN</th>
                    <th>Vehicle Make</th>
                    <th>Vehicle Model</th>
                    <th>Drop-Off Location</th>
                    <th>Notes</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>

            {!! $filteredAppointments->links() !!}
        </div>
    </section>
</div>



@endsection