@extends('layouts.app')
@section('main')
<div id="app">
    <customer-cart :cartitems='@json($cartItems)' :total='@json($total)'>
    </customer-cart>
</div>
@endsection