@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">View Appointment</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('appointments.index')}}">Appointment</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right" style="float: right;">
                        <a class="btn btn-primary" href="{{ route('appointments.index') }}"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4 mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Application Fields</h5>
                    <button id="copyDetailsBtn" class="btn btn-warning ml-auto"><i class="fas fa-clipboard"></i></button>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Requester Name:</strong>
                                <p>{{ $appointment['req_name'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Customer Name:</strong>
                                <p>{{ $appointment['customer_name'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Requester Contact:</strong>
                                <p>{{ $appointment['req_contact'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Customer Contact:</strong>
                                <p>{{ $appointment['customer_contact'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Pick Up Address:</strong>
                                <p>{{ $appointment['pickup_location'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Drop off Address:</strong>
                                <p>{{ $appointment['dropoff_location'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Pick Up URL:</strong>
                                <p id="url1">{{ $appointment['pickup_url'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Drop Off URL:</strong>
                                <p id="url2">{{ $appointment['dropoff_url'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Appointment Date:</strong>
                                <p>{{ $appointment['apt_date'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Appointment Time:</strong>
                                <p>{{ $appointment['apt_time'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Vehicle Registration Number:</strong>
                                <p>{{ $appointment['customer_vrn'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Vehicle Make:</strong>
                                <p>{{ $appointment['vehicle_make'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Vehicle Model:</strong>
                                <p>{{ $appointment['vehicle_model'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Special Notes:</strong>
                                <p>{{ $appointment['special_notes'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<script>
    document.getElementById('copyDetailsBtn').addEventListener('click', function() {
        var details = document.getElementsByClassName('card-body')[0].innerText;

        // Create a textarea element and set its value to the details
        var textarea = document.createElement('textarea');
        textarea.value = details;

        // Append the textarea to the document
        document.body.appendChild(textarea);

        // Copy the text from the textarea
        textarea.select();
        document.execCommand('copy');

        // Remove the textarea from the document
        document.body.removeChild(textarea);

        // Alert the user that the details have been copied
        toastr.success("Details Copied!");
    });
</script>

<script>
    var url1 = document.getElementById("url1");
    var url2 = document.getElementById("url2");
    url1.addEventListener("click", function() {
      var input = document.createElement("input");
      input.setAttribute("value", url1.innerText);
      document.body.appendChild(input);
      input.select();
      document.execCommand("copy");
      document.body.removeChild(input);
      toastr.success('Url copied to the clipboard.');
    });
    url1.style.cursor = 'pointer';
    url2.style.cursor = 'pointer';

    url2.addEventListener("click", function() {
      var input2 = document.createElement("input");
      input2.setAttribute("value", url2.innerText);
      document.body.appendChild(input2);
      input2.select();
      document.execCommand("copy");
      document.body.removeChild(input2);
      toastr.success('Url copied to the clipboard.');
    });
  </script>

@endsection