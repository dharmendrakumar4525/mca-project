@extends('layouts.app')
@section('main')
<div id="app">
    <category-edit :category='@json($category)'></category-edit>
</div>

@endsection