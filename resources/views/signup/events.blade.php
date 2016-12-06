<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials/signup/header')
    </head>
    <body class="signup signup-events">
        <div id="app">
            <navbar></navbar>
            <div class="container" role="main">
                <div class="row">
                    @include('partials/signup/events')
                </div>
            </div>
            @include('partials/signup/modal')
            @include('partials/signup/footer')
            <script src="/js/pickadate.js"></script>
            <script src="/js/signup.events.js"></script>
        </div>
    </body>
</html>
