@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Received message') }}</div>

                    <div class="card-body">
                        From: {{ $message->userFrom->name }}
                        <br>
                        Email: {{ $message->userFrom->email }}
                        <br>
                        Subject: {{ $message->subject }}
                        <br>
                        <br>
                        Message: {{ $message->body }}
                        <hr>
                        <a href=" {{ route('create-message', [$message->userFrom->id, $message->subject]) }}" class="btn btn-primary btn-sm">reply</a>
                        <a href=" {{ route('delete-message', $message->id) }}" class="btn btn-danger btn-sm float-right">delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
