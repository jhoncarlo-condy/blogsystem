@php
    $auth = Auth::user();
@endphp
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
        <a name=""  id="" href="{{ route('users.show', $user->id) }}" role="button">
            <i class="fas fa-eye"></i>
        </a>
    </td>
    @if ($auth->usertype == '1')
    <td>
        <!-- Button trigger edit modal -->
            <a name="" style="color:green;" id="" href="#" role="button" data-toggle="modal" data-target="#editModal{{ $user->id }}">
                <i class="fas fa-edit"></i>
            </a>
    </td>
    <td>
            <form id="deleteform" action="{{ route('users.destroy',$user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"  style="border: 0; background: none;color:red;">
                    <i class="fas fa-trash    "></i>
                </button>
            </form>
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
    @endif
</tr>
@empty
<tr>
    <td> Empty Users </td>
    </tr>


@endforelse
