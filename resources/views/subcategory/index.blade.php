@extends('layouts.app')
@section('main')
<div id="app">
    <subcategory-index :subcategories='@json($subcategories)' :category='@json($category)'>
    </subcategory-index>
</div>
@endsection