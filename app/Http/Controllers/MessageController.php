<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $messages = Message::with('userFrom')->where('user_id_to', Auth::id())->notDeleted()->get();
        $authUser = Auth::user();
        return view('home', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $id = 0, string $subject = '')
    {
        if($id === 0) {
            $users = User::where('id', '!=', Auth::id())->get();
        } else {
            $users = User::where('id', $id)->get();
        }
        if($subject !== '') $subject = 'Re: '. $subject;

        // dd($users);
        return view('create', compact(['users', 'subject']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subject' => 'required',
            'body' => 'required'
        ]);
        $message = new Message();
        $message->user_id_from = Auth::id();
        $message->user_id_to = $request->input('to');
        $message->subject = $request->input('subject');
        $message->body = $request->input('body');
        $message->save();

        return redirect()->to('/home')->with('status', 'Message sent successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSentMessages()
    {
        $messages = Message::with('userTo')->where('user_id_from', Auth::id())->get();
        return view('show_sent', compact('messages'));
    }


    public function readMessage(int $id)
    {
        $message = Message::with('userFrom')->find($id);

        $message->read = true;
        $message->save();

        return view('read', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        $message->deleted = true;
        $message->save();

        return redirect()->to('/home')->with('status', 'Message moved to trash');
    }

    public function deleted()
    {
        $messages = Message::with('userFrom')->where('user_id_to', Auth::id())->Deleted()->get();

        return view('deleted', compact('messages'));
    }

    public function recoverMessages(int $id)
    {
        $messages = Message::find($id);
        $messages->deleted = false;
        $messages->save();

        return redirect()->to('/home')->with('message', $messages);
    }
}
