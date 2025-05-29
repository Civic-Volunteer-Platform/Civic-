@extends('layouts.app')

@section('title', 'Opportunities')

@section('content')
<div class="container">
    <h1>Opportunities</h1>
    <a href="{{ route('organization.opportunities.create') }}" class="btn btn-primary mb-3">Create New Opportunity</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($opportunities->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($opportunities as $opportunity)
                <tr>
                    <td>{{ $opportunity->title }}</td>
                    <td>{{ $opportunity->location }}</td>
                    <td>{{ $opportunity->start_date->format('Y-m-d') }}</td>
                    <td>{{ $opportunity->end_date ? $opportunity->end_date->format('Y-m-d') : '-' }}</td>
                    <td>
                        <a href="{{ route('organization.opportunities.show', $opportunity) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('organization.opportunities.edit', $opportunity) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('organization.opportunities.destroy', $opportunity) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this opportunity?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $opportunities->links() }}
    @else
        <p>No opportunities found.</p>
    @endif
</div>
@endsection
