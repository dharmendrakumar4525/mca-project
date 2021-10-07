@extends('layouts.app')
@section('main')
<div id="app">
    <product-index :products='@json($products)'>
    </product-index>
</div>
@endsection