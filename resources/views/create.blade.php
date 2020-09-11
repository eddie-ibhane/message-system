@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Send message') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/send" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="to">To</label>
                            <select class="form-control" name="to" id="to">
                                @foreach($users as $key => $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} , {{ $user->email }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                          <label for="subject">Subject</label>
                          <input type="text" class="form-control" name="subject" id="mySubject" value="{{ $subject }}" placeholder="Enter subject">
                        </div>

                        <div class="form-group">
                          <label for="message">Enter new message</label>
                          <textarea class="form-control" id="myMessage" name="body" rows="3" placeholder="Enter message"></textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
