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
</tr>
@empty
<tr>
    <td> Empty Users </td>
</tr>
@endforelse
