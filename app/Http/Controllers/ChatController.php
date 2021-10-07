<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Auth::user());
        $user = Auth::user();
        $chats = Chat::where('recipient_id', $user->id)->with('user')->orderBy('created_at', 'desc')->get()->unique('sender_id')->toArray();
        // dd($chats);
        foreach ($chats as $index => $chat) {
            if ($chat["is_seen"] === null) {
                $chats[$index]['notifications'] = Chat::where('recipient_id', $user->id)->where('is_seen', null)->with('user')->count();
            }
        }
        return view('chat.index', compact('chats'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $conversation_id = '';
        if ($user->roles->pluck('name')[0] == "Customer") {
            $conversation_id = $user->id . "_" .  $request->id;
        } else {
            $conversation_id = $request->id . "_" .  $user->id;
        }
        if ($request->text) {
            $chat =  new Chat();
            $chat->conversation_id = $conversation_id;
            $chat->sender_id = $user->id;
            $chat->recipient_id = $request->id;
            $chat->text = $request->text;
            $chat->save();
        }
        $chat = Chat::where('conversation_id', $conversation_id)->orderBy('created_at', 'ASC')->get()->toArray();
        return response($chat);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $user = Auth::user();
        $conversation_id = '';
        if ($user->roles->pluck('name')[0] == "Customer") {
            $conversation_id = $user->id . "_" . $id;
        } else {
            $conversation_id = $id . "_" . $user->id;
        }
        $chat = Chat::where('conversation_id', $conversation_id)->orderBy('created_at', 'ASC')->get()->toArray();

        return view('chat.show', compact('id', 'chat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $chat = Chat::where('conversation_id', $request->id)
            ->where('sender_id', $id)->update(['is_seen' => 1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
