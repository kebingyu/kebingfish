@extends('signup/layout')

@section('title', $pageTitle)

@section('content')
    <events-list></events-list>
    @include('partials/signup/events')
@endsection

@section('footer')
    @parent
    <script src="/js/pickadate.js"></script>
    <script src="/js/signup.events.js"></script>
@endsection
