@extends('layouts.app')

@section('title', 'Edit Opportunity')

@section('content')
<div class="container">
    <h1>Edit Opportunity</h1>

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

    <form action="{{ route('organization.opportunities.update', $opportunity) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Opportunity Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $opportunity->title) }}" required />
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $opportunity->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $opportunity->location) }}" required />
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $opportunity->start_date->format('Y-m-d')) }}" required />
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date (Optional)</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', optional($opportunity->end_date)->format('Y-m-d')) }}" />
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('organization.opportunities.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
