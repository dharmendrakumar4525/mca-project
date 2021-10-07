@extends('layouts.app')
@section('main')
<div id="app">
    <category-index :categories='@json($categories)'>
    </category-index>
</div>
@endsection