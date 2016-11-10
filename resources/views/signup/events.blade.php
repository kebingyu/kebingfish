<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials/signup/header')
        <link rel="stylesheet" href="/css/bootstrap-datepicker3.min.css">
    </head>
    <body class="signup signup-events">
        @include('partials/signup/nav')
        <div class="container" role="main">
            <div class="row">
                @include('partials/signup/events')
            </div>
        </div>
        @include('partials/signup/footer')
        <script src="/js/bootstrap-datepicker.min.js"></script>
        <script src="/js/signup.events.js"></script>
    </body>
</html>
