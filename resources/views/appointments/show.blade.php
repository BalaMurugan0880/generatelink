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

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Requester Name:</strong>
                        {{ $appointment->req_name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Requester Designation:</strong>
                        {{ $appointment->req_designation }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Pick Up URL:</strong>
                        <p id="url1">{{ $appointment->pickup_url }}</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Drop Off Url:</strong>
                        <p id="url2">{{ $appointment->dropoff_url }}</p>
                    </div>
                </div>
            </div>
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