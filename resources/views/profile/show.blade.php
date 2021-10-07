@extends('layouts.app')
@section('main')
<div id="app">
    <profile :user='@json($user)'> </profile>
</div>
@endsection