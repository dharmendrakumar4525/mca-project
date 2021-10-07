@extends('layouts.app')
@section('main')

<div id="app">
    <customer-order :orders='@json($orders)'>
    </customer-order>
</div>
@endsection