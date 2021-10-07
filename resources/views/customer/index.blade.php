@extends('layouts.app')
@section('main')
<div id="app">
    <div class="text-center" :class="loadingClass" v-on:mounted="hideLoading()"><img src="image/ajax-loader.gif" /></div>
    <customer-index :products='@json($products)' :categories='@json($categories)'>
    </customer-index>
</div>
@endsection