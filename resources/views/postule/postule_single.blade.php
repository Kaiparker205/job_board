@forelse ($postules as $postule)
    <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td><a href="{{ route('profile.show', ['profile' => $postule->user_id]) }}">{{ $postule->name }}</a>
        </td>
        <td>{{ $postule->post }}</td>
        <td id="status-{{ $postule->id }}" class="text text-center">
            @if ($postule->statu)
                <span class="badge bg-success">Confirmed</span>
            @else
                <span class="badge bg-warning text-dark">Pending</span>
            @endif
        </td>
        <td>
            <select name="action" class="form-select" data-postule="{{ $postule->id }}">
                <option selected>----------</option>
                <option value="Confirm">Confirm</option>
                <option value="Reject">Reject</option>
            </select>
        </td>
        <td>{{ $postule->created_at->diffForHumans() }}</td>
        <td>

            @if ($postule->emploi->deleted_at)
            <span class='badge bg-danger'>Expired</span>
            @else
            <span class='badge bg-success'>Done</span>
            @endif
        </td>


    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center">No applications</td>
    </tr>
@endforelse
