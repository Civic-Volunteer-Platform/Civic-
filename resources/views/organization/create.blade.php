@extends('layouts.app')

@section('title', 'Create Opportunity')

@section('content')
<div class="container">
    <h1>Create Opportunity</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Errors!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('organization.opportunities.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Opportunity Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required />
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required />
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" required />
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date (Optional)</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" />
        </div>

        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('organization.opportunities.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
