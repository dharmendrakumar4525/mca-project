@extends('layouts.app')
@section('main')
<div id="app">
    <product-create :categories='@json($categories)'>
    </product-create>
</div>
@endsection