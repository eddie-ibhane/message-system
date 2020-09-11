@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                        You're welcome {{ Auth::user()->name }}
                    </div>
                    @if (count($messages) > 0)
                        <ul class="list-group">
                            @foreach($messages as $key => $message)
                            <a href="{{ route('read-message',$message->id) }}">
                                <li class="list-group-item">
                                    <div>
                                        From: <strong>{{ $message->userFrom->name }} | {{ $message->userFrom->email }} </strong>| {{ $message->subject }}
                        
                                    </div>
                                </li>
                            </a>
                            @endforeach
                        </ul>
                    @else
                        No messages!
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
