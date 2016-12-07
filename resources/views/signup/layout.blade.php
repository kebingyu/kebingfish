<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials/signup/header')
    </head>
    <body class="signup">
        <div id="signup">
            @section('navbar')
                <navbar></navbar>
            @show
            <div class="container" role="main">
                <div class="row">
                    @yield('content')
                </div>
            </div>
            @include('partials/signup/modal')
        </div>
        @section('footer')
            @include('partials/signup/footer')
        @show
    </body>
</html>
