@forelse ($emplois as $e)
    <tr>
        <td class="col">{{ $e->title }}</td>
        <td class="col " >
            @if ($e->deleted_at)
                <span class="  text badge bg-danger text-dark">expired</span>
            @else
                <span class=" text badge bg-success text-dark">ongoing</span>
            @endif
        </td>

        <td class="col">
@php
   $formatted_date = date('d-m-Y', strtotime($e->created_at));
@endphp
            {{ $formatted_date }}</td>
        <td class="col">
            @php
                $date = new DateTime($e->updated_at);
                $date->modify('+' . $e->delay . ' day');
            @endphp
            {{ $date->format('d-m-Y') }}
        </td>
        <td>
            <div class="btn-group">
                <a href="{{ route('emploi.show', $e->id) }}" class="btn
                    btn-sm btn-outline-primary">Show</a>
                    <a href="{{ route('emploi.edit', $e->id) }}" class="btn
                        btn-sm btn-outline-success">Edit</a>
                        <form action="{{ route('emploi.destroy', $e->id) }}" method="POST
                            "onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                            </div>
                            </td>
        </td>
    </tr>
@empty
<tr>no job</tr>
@endforelse
