@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Source Management</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('sources.index')}}">Source</a></li>
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
                    <a class="btn btn-success" href="{{ route('sources.create') }}"><i class="fas fa-plus" style="color: #ffffff;"></i></a>
                </div>
            </div>



        <div class="table-responsive table-responsive-sm">
            <table id="sourcesTable" class="table table-bordered table-striped data-table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Source Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php $i = 0; @endphp
                     @foreach ($sources as $source)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $source->name ?? '-' }}</td>
                            <td>
                                <form action="{{ route('sources.destroy',$source['id']) }}" method="POST">

                                    {{-- <a class="btn-xs btn-info" data-toggle="modal" data-target="#updateStatusModal" data-appointment-id="{{ $source['id'] }}"><i class="fas fa-eye"></i></a> --}}


                                     <a class="btn-xs btn-primary" href="{{ route('sources.edit',$source['id']) }}"><i class="far fa-edit"></i></a>

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
                    <th>Source Name</th>
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
        var dataTable = $('#sourcesTable').DataTable({

        });


    });


</script>
@endsection