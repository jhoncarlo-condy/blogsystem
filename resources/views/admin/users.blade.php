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
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary float-right my-2 mx-5" data-toggle="modal" data-target="#modelId">
  Add new category
</button>

<div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>E-mail</th>
                <th>Usertype</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($users as $key=>$user)
            <tr>
                <td scope="row">{{ $key+1}}</td>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                @if ($user->usertype = 1)
                <td class="text-success">SuperAdmin</td>
                @elseif ($user->usertype = 2)
                <td class="text-warning">Admin</td>
                @elseif ($user->usertype = 3)
                <td class="text-success">User</td>
                @endif
                <td>
                    <!-- Button trigger edit modal -->
                    <div class="form-row">

                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal{{ $user->id }}">
                            <i class="fas fa-edit"></i>Edit
                          </button>

                        <form action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" id="delete">
                            <i class="fas fa-eraser"></i>Delete
                            </button>
                        </form>

                    </div>
                    {{-- EDIT MODAL --}}
                    <!-- Modal -->
                    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit User: {{ $user->firstname }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                          <label for="title"></label>
                                          <input type="text" class="form-control" name="title"  aria-describedby="helpId" placeholder="" value="">
                                        </div>
                                        <div class="form-group">
                                          <label for="description"></label>
                                          <textarea class="form-control" name="description" id="" col="60" rows="5" maxlength="100"></textarea>
                                        </div>

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
    {{-- {{ $user->links() }} --}}
</div>

<!-- ADD Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="category">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                      <label for="firstname">First Name</label>
                      <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="helpId" placeholder="">
                    </div>
                    {{-- @if ($errors->has('title'))
                            <strong class="text-danger">{{ $errors->first('title') }}</strong>
                    @endif --}}
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="helpId" placeholder="">
                    </div>
                    {{-- @if ($errors->has('description'))
                          <strong class="text-danger">{{ $errors->first('description') }}</strong>

                    @endif --}}
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="usertype">Usertype</label>
                      <select class="form-control" name="usertype" id="usertype">
                        <option selected><span>Select Usertype</span></option>
                        <option value="2">Admin</option>
                        <option value="3">User</option>
                      </select>
                    </div>
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
