@extends('layouts.app')

@section('title', 'Opportunity Details')

@section('content')
<div class="container">
    <h1>{{ $opportunity->title }}</h1>
    <p><strong>Location:</strong> {{ $opportunity->location }}</p>
    <p><strong>Start Date:</strong> {{ $opportunity->start_date->format('Y-m-d') }}</p>
    <p><strong>End Date:</strong> {{ $opportunity->end_date ? $opportunity->end_date->format('Y-m-d') : 'N/A' }}</p>
    <p><strong>Description:</strong></p>
    <p>{{ $opportunity->description }}</p>

    <a href="{{ route('organization.opportunities.edit', $opportunity) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('organization.opportunities.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
