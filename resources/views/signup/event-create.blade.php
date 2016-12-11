@extends('signup/layout')

@section('content')
    @include('partials/signup/event-create')
@endsection

@section('footer')
    @parent
    <script src="/js/signup.event.create.js"></script>
@endsection
