@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Thanks for registering at {{\Illuminate\Support\Facades\Auth::user()->name}}!
                        We will be building up the functionality rapidly to include:</p>
                        <ul>
                            <li> A interactive form and table allowing you to easy add to, edit and view your applications. </li>
                            <li> An analytics hub to view progress indicators and receive valuable feedback. </li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
