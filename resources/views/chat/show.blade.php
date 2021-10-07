@extends('layouts.app')
@section('main')
<div id="app">
    <chat-show :id='@json($id)':messages='@json($chat)'>
    </chat-show>
</div>

@endsection