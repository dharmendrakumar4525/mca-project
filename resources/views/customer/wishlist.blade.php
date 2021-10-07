@extends('layouts.app')
@section('main')

<div id="app">
    <customer-wishlist :wishlist='@json($wishlist)'>
    </customer-wishlist>
</div>
@endsection