@extends('layouts.app')
@section('main')
<div id="app">
    <category-create :categories='@json($categories)'></category-create>
</div>

@endsection