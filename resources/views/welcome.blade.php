<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials/signup/header')
    </head>
    <body class="signup">
        @include('partials/signup/nav')
        <div class="container" role="main">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <ul class="list-group event-list">
                        <li class="list-group-item">
                            <a href="/signup/events">Signup Events</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @include('partials/signup/footer')
    </body>
</html>
