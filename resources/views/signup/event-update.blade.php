@extends('signup/layout')

@section('content')
    @include('partials/signup/event-update')
@endsection

@section('footer')
    @parent
    <script src="/js/signup.event.update.js"></script>
@endsection
