@forelse ($postules as $postule)
<tr>
    <th scope="row">{{ $loop->iteration }}</th>
    <td><a
            href="{{ route('profile.show', ['profile' => $postule->user_id]) }}">{{ $postule->name }}</a>
    </td>
    <td>{{ $postule->post }}</td>
  

</tr>
@empty
<tr>
    <td colspan="6" class="text-center">No applications</td>
</tr>
@endforelse
