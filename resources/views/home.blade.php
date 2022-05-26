@extends('layouts.app')
@section('title', 'Welcome to Admin Dashboard')
@section('content')
    <section>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dashboard</h3>
            </div>
            <div class="card-body">
                <h3>Welcome to Admin Dashboard</h3>
                You are now Logged in as <h4 class="text-success">{{ auth()->user()->name }}</h4>
            </div>
        </div>
    </section>
@endsection
