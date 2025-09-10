@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1 class="text-danger">403 - Unauthorized</h1>
        <p>You do not have permission to view this page.</p>
        <a href="{{ url('/') }}" class="btn btn-secondary">Back to Home</a>
    </div>
@endsection
