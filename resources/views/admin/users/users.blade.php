@extends('layouts.app')
@push('scripts')
    @include('common.pusher')
@endpush

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Users</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('users.dashboard') }}">Administrator</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('content-wrapper')
@php
$auth = Auth::user();
@endphp
{{-- success message --}}
@if (Session::has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <strong>{{ session('message') }}</strong>
</div>
@endif
@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger">
            {{ $error }}
</div>
@endforeach
@endif
<!-- Button trigger modal -->
@if ($auth->usertype == '1')
<button type="button" class="btn btn-primary float-right my-2 mx-5" data-toggle="modal" data-target="#modelId">
  Add new user
</button>
@endif
<div class="container" id="usertable">
    @include('admin.users.realtimeuser')
</div>

<!-- ADD Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form id="adduser" action="{{ route('users.store') }}" method="POST" id="category">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                      <label for="firstname">First Name</label>
                      <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="helpId" placeholder="">
                    </div>
                    @if ($errors->has('firstname'))
                            <strong class="text-danger">{{ $errors->first('firstname') }}</strong>
                    @endif
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="helpId" placeholder="">
                    </div>
                    @if ($errors->has('lastname'))
                            <strong class="text-danger">{{ $errors->first('lastname') }}</strong>
                    @endif
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="">
                    </div>
                    @if ($errors->has('email'))
                            <strong class="text-danger">{{ $errors->first('email') }}</strong>
                    @endif
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
                    </div>
                    @if ($errors->has('password'))
                            <strong class="text-danger">{{ $errors->first('password') }}</strong>
                    @endif
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <div class="input-group">
                        <input type="password" class="form-control" name="password_confirm" id="password_confirm" aria-describedby="helpId" placeholder="">

                        </div>
                    </div>
                    @if ($errors->has('password_confirm'))
                            <strong class="text-danger">{{ $errors->first('password_confirm') }}</strong>
                    @endif
                    <div class="form-group">
                        <i class="fas fa-eye reveal"><label for="">Show Password</label></i>
                    </div>
                    <div class="form-group">
                      <label for="usertype">Usertype</label>
                      <select class="form-control" name="usertype" id="usertype">
                        <option disabled selected><span>Select Usertype</span></option>
                        <option value="2"><span>Admin</span></option>
                        <option value="3"><span>User</span></option>
                      </select>
                    </div>
                    @if ($errors->has('usertype'))
                            <strong class="text-danger">{{ $errors->first('usertype') }}</strong>
                    @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
            </div>
        </div>
    </div>
</div>



@endsection
@push('scripts')
@if(Session::has('message'))
<script>
    $(document).ready(function()
    {
        swal({
        title: "Success!",
        text: "Operation Success",
        type: "success",
        closeOnConfirm: false
        })
    });
</script>
@endif
<script>
    $(document).ready(function()
    {
        $(".displaypass").hide();
        $("#pass-btn").click(function()
        {
            $(".displaypass").toggle();
        })

        $(".reveal").on('mousedown', function()
        {

            $("#password_confirm").attr("type","text");
            $("#password").attr("type","text");
        })
        $(".reveal").on('mouseup', function()
        {
            $("#password").attr("type","password");
            $("#password_confirm").attr("type","password");

        })
    })
</script>
<script>
    $(document).ready(function()
    {
        $("#adduser").validate(
            {
                rules:
                {
                    firstname: "required",
                    lastname: "required",
                    email: "required",
                    usertype: "required",
                    password:
                    {
                        required:true,
                        minlength:6,
                    },
                    password_confirm:
                    {
                        equalTo:"#password",
                    }
                },
                messages:
                {
                    password_confirm:
                    {
                        equalTo: "Password and confirm password must match",
                    },
                    password:
                    {
                        required: "Password field is required",
                        minlength: "Password must be at least 6 characters"
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                }


            });



    });
</script>
<script>
    $(document).ready(function()
    {
        $("#edituser").validate(
            {
                rules:
                {
                    firstname: "required",
                    lastname: "required",
                    email: "required",
                    usertype: "required",
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                }


            });



    });
</script>
@endpush
