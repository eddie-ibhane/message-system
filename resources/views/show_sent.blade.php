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
                        Welcome {{ Auth::user()->name }}
                    </div>
                    @if (count($messages) > 0)
                        <ul class="list-group">
                            @foreach($messages as $key => $message)
                                <li class="list-group-item">
                                    <div>
                                        Sent to: <strong>{{ $message->userTo->name }} | {{ $message->userTo->email }} </strong>| {{ $message->subject }}
                                        @if ($message->read)
                                            <span class="badge badge-success float-right">Read</span>
                                        @endif
                                    </div>
                                </li>
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
