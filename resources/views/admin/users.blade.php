@extends('layouts.app')

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
@if (Auth::user()->usertype == '1')


<button type="button" class="btn btn-primary float-right my-2 mx-5" data-toggle="modal" data-target="#modelId">
  Add new user
</button>
@endif
<div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>E-mail</th>
                <th>Usertype</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($users as $key=>$user)
            <tr>
                <td scope="row">{{ $key+1}}</td>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                @if ($user->usertype == 1)
                <td class="text-success">SuperAdmin</td>
                @elseif ($user->usertype == 2)
                <td class="text-warning">Admin</td>
                @elseif ($user->usertype == 3)
                <td class="text-danger">User</td>
                @endif
                <td>
                    <div class="form-row">
                    {{-- view button --}}
                    <a name="" id="" href="{{ route('users.viewprofile',$user->id) }}" role="button">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
                <td>
                    <!-- Button trigger edit modal -->
                        @if (Auth::user()->usertype == '1')
                        <a name="" id="" href="#" role="button" data-toggle="modal" data-target="#editModal{{ $user->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                </td>
                <td>
                        <form id="deleteform" action="{{ route('users.destroy',$user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="javascript:;" onclick="document.getElementById('deleteform').submit();">
                                <i class="fas fa-trash"></i>
                            </a>
                        </form>
                        @endif
                    </div>
                    {{-- EDIT MODAL --}}
                    <!-- Modal -->
                    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit User: {{ $user->firstname }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('users.update',$user->id) }}" method="POST" id="edituser">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                          <label for="firstname">First Name</label>
                                          <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="helpId" placeholder=""
                                            value="{{ $user->firstname }}">
                                        </div>
                                        @if ($errors->has('firstname'))
                                                <strong class="text-danger">{{ $errors->first('firstname') }}</strong>
                                        @endif
                                        <div class="form-group">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="helpId" placeholder=""
                                            value="{{ $user->lastname }}">
                                        </div>
                                        @if ($errors->has('lastname'))
                                                <strong class="text-danger">{{ $errors->first('lastname') }}</strong>
                                        @endif
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder=""
                                            value="{{ $user->email }}">
                                        </div>
                                        @if ($errors->has('email'))
                                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                        @endif
                                        {{-- <div class="form-group">
                                            <button type="button" class="btn btn-primary btn-sm" id="pass-btn">Change Password</button>
                                        </div>
                                        <div class="displaypass">
                                            <div class="form-group">
                                                <label for="oldpassword">Enter Old Password</label>
                                                <input type="text" class="form-control" name="oldpassword" id="oldpassword" aria-describedby="helpId" placeholder=""
                                                value="{{ $user->password }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="newpassword">Enter New Password</label>
                                                <input type="text" class="form-control" name="newpassword" id="newpassword" aria-describedby="helpId" placeholder=""
                                                value="{{ $user->password }}">
                                            </div>
                                            @if ($errors->has('password'))
                                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                            @endif
                                            <div class="form-group">
                                                <label for="confirm_password">Confirm Password</label>
                                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" aria-describedby="helpId" placeholder="">
                                            </div>
                                            @if ($errors->has('confirm_password'))
                                                    <strong class="text-danger">{{ $errors->first('confirm_password') }}</strong>
                                            @endif

                                        </div> --}}
                                        <div class="form-group">
                                          <label for="usertype">Usertype</label>
                                          <select class="form-control" name="usertype" id="usertype">
                                            <option value="{{ $user->usertype }}"selected>
                                                @if ($user->usertype == '1')
                                                <span>SuperAdmin</span>
                                                @elseif ($user->usertype == '2')
                                                <span>Admin</span>
                                                @elseif ($user->usertype == '3')
                                                <span>User</span>
                                                @endif
                                            </option>
                                            <option value="2">Admin</option>
                                            <option value="3">User</option>
                                          </select>
                                        </div>
                                        @if ($errors->has('usertype'))
                                                <strong class="text-danger">{{ $errors->first('usertype') }}</strong>
                                        @endif

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </td>

            </tr>
            @empty
            <tr>
                <td> Empty Users </td>
             </tr>


            @endforelse

        </tbody>

    </table>
    {{ $users->links() }}
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
                        <input type="password" class="form-control" name="confirm_password" id="password_confirm" aria-describedby="helpId" placeholder="">
                    </div>
                    @if ($errors->has('confirm_password'))
                            <strong class="text-danger">{{ $errors->first('confirm_password') }}</strong>
                    @endif
                    <div class="form-group">
                        <i class="fas fa-eye reveal">Show Password</i>
                    </div>
                    <div class="form-group">
                      <label for="usertype">Usertype</label>
                      <select class="form-control" name="usertype" id="usertype">
                        <option selected><span>Select Usertype</span></option>
                        <option value="2">Admin</option>
                        <option value="3">User</option>
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
                    confirm_password:
                    {
                        equalTo:"password",
                    }
                },
                messages:
                {
                    password:
                    {
                        required: "Password field is required",
                        maxlength: "description must be 100 characters or below"
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
                    password:
                    {
                        required:true,
                        minlength:6,
                    },
                    confirm_password:
                    {
                        equalTo:"password",
                    }
                },
                messages:
                {
                    password:
                    {
                        required: "Password field is required",
                        maxlength: "description must be 100 characters or below"
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
@endpush
