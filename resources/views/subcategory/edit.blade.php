@extends('layouts.app')
@section('main')
<div id="app">
    <subcategory-edit :subcategory='@json($subcategory)' :categories='@json($categories)'></subcategory-edit>
</div>
@endsection