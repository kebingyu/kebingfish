<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>You've found a Glitch</title>
        {!! Helpers::css() !!}
        <link rel="stylesheet" href="/css/signup.css">
    </head>
    <body class="signup">
        @include('partials/signup/nav')
        <div class="container" role="main">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="alert alert-warning" role="alert">
                        <h3>You've found a Glitch!</h3>
                        <p>You've found yourself in a weird place.<br>Probably not the place you were looking for.
                            <span class="no_wrap">¯\_(ツ)_/¯</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @include('partials/signup/footer')
    </body>
</html>
