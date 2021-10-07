@extends('layouts.app')
@section('main')
<div id="app">
    <product-edit :product='@json($product)':categories='@json($categories)'>
    </product-edit>
</div>
@endsection