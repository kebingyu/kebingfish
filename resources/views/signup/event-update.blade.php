<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials/signup/header')
    </head>
    <body class="signup signup-events">
        @include('partials/signup/nav')
        <div class="container" role="main">
            <div class="row">
            @include('partials/signup/event-update')
            </div>
        </div>
        @include('partials/signup/modal')
        @include('partials/signup/footer')
        <script src="/js/signup.events.js"></script>
    </body>
</html>
