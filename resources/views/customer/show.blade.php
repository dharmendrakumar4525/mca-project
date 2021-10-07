
@extends('layouts.app')
@section('main')
<div id="app">
    <customer-show :product='@json($product)'>
    </customer-show>
</div>
@endsection