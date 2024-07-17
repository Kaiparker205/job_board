@forelse ($users as $user)
    <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>
            <div class="d-flex align-items-center">

                @if (isset($user->profil->profil_path))
                    <img src="{{ asset($user->profil->profil_path) }}" alt="" style="width: 45px; height: 45px"
                        class="rounded-circle" />
                @else
                    <img src="{{ asset('avatar.jpg') }}" alt="" style="width: 45px; height: 45px"
                        class="rounded-circle" />
                @endif

                <div class="ms-3">
                    <p class="fw-bold mb-1"><a
                            href="{{ route('profile.show', ['profile' => $user->id]) }}">{{ $user->name }}</a></p>
                    <p class="text-muted mb-0">{{ $user->email }}</p>
                </div>
            </div>
        </td>
        <td class="text-center">
            @if ($user->role_id == 1)
                <span class="badge bg-success rounded-pill d-inline">Condidat</span>
            @else
                <span class="badge bg-primary rounded-pill d-inline">Company</span>
            @endif
        </td>
        <td>
            <select name="action" class="form-select" data-user="{{ $user->id }}">
                <option selected>----------</option>
                <option value="Confirm">Update</option>
                <option value="Reject">Delete</option>
            </select>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="text-center">No users</td>
    </tr>
@endforelse
