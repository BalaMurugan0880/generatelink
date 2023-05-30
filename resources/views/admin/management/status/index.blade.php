@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Appointment Status</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('appointments.index')}}">Appointment</a></li>
                <li class="breadcrumb-item active">Status</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">

          <div class="status-filter mb-2">
            <div class="d-flex align-items-center">
                <label for="status" class="form-label me-2">Filter by Status : &nbsp;</label>
                <div class="flex-grow-1">
                    <select id="status" class="form-control short-dropdown" name="status">
                        <option value="">All</option>
                        <option value="Pending Approval">Pending Approval</option>
                        <option value="Booking Confirmed">Booking Confirmed</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="table-responsive table-responsive-sm">
            <table id="statusTable" class="table table-bordered table-striped data-table">
                <thead>
                <tr>
                    <th>No</th>
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
                            <td class="status">{{ $filteredAppointment['status'] ?? '-' }}</td>
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
        </div>

            {!! $filteredAppointments->links() !!}
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateStatusModalLabel">Update Appointment Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Add your form elements for updating the appointment status here -->
          <form id="updateStatusForm">
            <!-- Status dropdown -->
            <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control" id="status" name="status">
                <option value="Pending Approval">Pending Approval</option>
                <option value="Booking Confirmed">Booking Confirmed</option>
                <option value="Completed">Completed</option>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="updateStatusButton">Update</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Assign the CSRF token value to a JavaScript variable
    const csrfToken = '{{ csrf_token() }}';

    // Get the update status form and button
    const updateStatusForm = document.getElementById('updateStatusForm');
    const updateStatusButton = document.getElementById('updateStatusButton');

    // Get the appointment ID from the clicked "Show" button and set it in the form action URL
    $('#updateStatusModal').on('show.bs.modal', function (event) {
      const button = $(event.relatedTarget);
      const appointmentId = button.data('appointment-id');
      updateStatusForm.action = '/status/' + appointmentId;

      // Set the selected option in the status dropdown
      const statusValue = $('#status_' + appointmentId).val();
      $('#status_' + appointmentId).val(statusValue);
    });

    // Handle the form submission
    updateStatusButton.addEventListener('click', function () {
    // Send an AJAX request to update the appointment status
    const formData = new FormData(updateStatusForm);
    const url = updateStatusForm.action;

    fetch(url, {
        method: 'POST',
        headers: {
        'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the request headers
        },
        body: formData
    })
        .then(response => {
        if (!response.ok) {
            throw new Error('Request failed with status ' + response.status);
        }
        return response.json();
        })
        .then(data => {
        console.log(data);
        // Display the success message using toastr
        toastr.success(data.success);

        // Close the modal
        $('#updateStatusModal').modal('hide');

        // Delay the page reload to allow toastr to display the message
        setTimeout(() => {
            // Reload the page
            window.location.reload();
        }, 1000); // Adjust the delay time as needed
        })
        .catch(error => {
        console.error(error);
        // Display an error message to the user
        alert('An error occurred. Please try again later.');
        });
    });



  </script>

<script>
$(document).ready(function() {
    // Initialize the DataTable with searching set to false
    var dataTable = $('#statusTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel',
            'csv',
            'print',
            'colvis'
        ],
        lengthChange: false
        // Other options and configurations
    });
    var row = $('<div class="row"></div>').insertBefore('#statusTable_wrapper .dataTables_filter');
    var buttonsCol = $('<div class="col-sm-12 col-md-6"></div>').appendTo(row);
    var searchCol = $('<div class="col-sm-12 col-md-6"></div>').appendTo(row);

    // Move the buttons container to the buttons column
    dataTable.buttons().container().appendTo(buttonsCol);

    // Move the search input to the search column
    $('#statusTable_filter').appendTo(searchCol);

    // Handle filter change event
    $('#status').on('change', function() {
        var status = $(this).val();

        // Filter the datatable based on the selected status
        dataTable.column(12).search(status).draw();
    });
});


  </script>



@endsection