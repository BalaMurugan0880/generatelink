@extends('admin.layout.layout')
@php
    use Carbon\Carbon;
@endphp
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-warning mt-2">
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $user->name ?? '-' }}" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ $user->email ?? '-' }}" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password Confirmation</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text" name="designation" value="{{ $user->profile->designation ?? '-' }}"  class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone_number" value="{{ $user->profile->phone_number ?? '' }}" class="form-control" data-inputmask='"mask": "(60) 99-99999999"' data-mask>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <input type="text" name="gender" value="{{ $user->profile->gender ?? '' }}" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" name="dob" value="{{ isset($user->profile->dob) ? Carbon::createFromFormat('d/m/Y', $user->profile->dob)->format('Y-m-d') : '' }}" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="checkbox" class="custom-control-input" name="status" id="customSwitch3" {{ $user->is_active ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customSwitch3" id="toggleLabel">{{ $user->is_active ? 'Active' : 'Inactive' }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </section>
</div>


<script>
    const toggleSwitch = document.getElementById('customSwitch3');
    const toggleLabel = document.getElementById('toggleLabel');

    toggleSwitch.addEventListener('change', function() {
      if (this.checked) {
        toggleLabel.textContent = 'Active';
        toggleLabel.classList.remove('text-danger');
        toggleLabel.classList.add('text-success');
      } else {
        toggleLabel.textContent = 'Inactive';
        toggleLabel.classList.remove('text-success');
        toggleLabel.classList.add('text-danger');
      }
    });
  </script>
@endsection