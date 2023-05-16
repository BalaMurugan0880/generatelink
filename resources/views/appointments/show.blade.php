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

            @foreach ($filteredAppointment as $item)
            @php
                $applicationFields = json_decode(html_entity_decode($item['applicationFields']), true);
            @endphp

            <div class="card shadow mb-4 mt-4">
                <div class="card-header">
                    <h5 class="card-title">Application Fields</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Requester Name:</strong>
                                {{ $applicationFields['req_name'] ?? '-' }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Customer Name:</strong>
                                {{ $applicationFields['customer_name'] ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Requester Contact:</strong>
                                <p>{{ $applicationFields['req_contact'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Customer Contact:</strong>
                                <p>{{ $applicationFields['customer_contact'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Pick Up Address:</strong>
                                <p>{{ $applicationFields['pickup_location'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Drop off Address:</strong>
                                <p>{{ $applicationFields['dropoff_location'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Pick Up URL:</strong>
                                <p id="url1">{{ $applicationFields['pickup_url'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Drop Off URL:</strong>
                                <p id="url2">{{ $applicationFields['dropoff_url'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Appointment Date:</strong>
                                <p>{{ $applicationFields['apt_date'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Appointment Time:</strong>
                                <p>{{ $applicationFields['apt_time'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Vehicle Registration Number:</strong>
                                <p>{{ $applicationFields['customer_vrn'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Vehicle Make:</strong>
                                <p>{{ $applicationFields['vehicle_make'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Vehicle Model:</strong>
                                <p>{{ $applicationFields['vehicle_model'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Special Notes:</strong>
                                <p>{{ $applicationFields['special_notes'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        </div>
    </section>
</div>

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