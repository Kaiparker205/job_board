<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Company</th>
            <th>Location</th>
            <th>Posted</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jobListings as $job)
            <tr>
                <td>{{ $job->id }}</td>
                <td>{{ $job->title }}</td>
                <td>{{ $job->employeur->name }}</td>
                <td>
                    @forelse ($job->employeur->contacts as $contact)
                        {{ $contact->address }}
                    @empty
                        No address
                    @endforelse
                </td>
                <td>{{ $job->created_at->format('Y-m-d') }}</td>
                <td>
                    <form action="{{ route('admin.jobs.delete', ['id' => $job->id]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination-links">
    {{ $jobListings->links() }}
</div>
