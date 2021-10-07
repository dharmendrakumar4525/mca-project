@extends('layouts.app')
@section('main')
<div id="app">
    <chat-index :chats='@json($chats)'/>
</div>

@endsection