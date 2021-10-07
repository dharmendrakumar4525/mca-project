@extends('layouts.app')
@section('main')
<div id="app">
    <addressindex :addresses='@json($addresses)'> </addressindex>
</div>
@endsection