@extends('signup/layout')

@section('content')
    @include('partials/signup/event')
@endsection

@section('footer')
    @parent
    <script src="/js/signup.event.js"></script>
@endsection
