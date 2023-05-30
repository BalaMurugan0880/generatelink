@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Vehicle</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('appointments.index')}}">Vehicle</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right"  style="float: right;">
                        <a class="btn btn-primary" href="{{ route('vehicle.index') }}"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>

            <div class="card card-warning mt-2">
                <div class="card-body">
                    <form action="{{ route('vehicle.importData') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Import Vehicle</label>
                                    <div class="input-group">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="import_vehicle">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                    </div>
                                    </div>
                                    </div>
                            </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </section>
</div>
@endsection