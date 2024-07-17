@forelse ($postules as $postule)
    <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td><a href="{{ route('profile.show', ['profile' => $postule->user_id]) }}">{{ $postule->name }}</a>
        </td>
        <td>{{ $postule->post }}</td>
        <td>
            <select name="action" class="form-select" data-postule="{{ $postule->id }}">
                <option selected>----------</option>
                <option value="Confirm">Confirm</option>
                <option value="Reject">Reject</option>
            </select>
        </td>

    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center">No applications</td>
    </tr>
@endforelse
