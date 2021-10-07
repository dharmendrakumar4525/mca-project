@extends('layouts.app')
@section('main')
<div id="app">
    <seller-solditem :orders='@json($orders)' :products='@json($products)'  :customers='@json($customers)'> </seller-solditem>
</div>
@endsection