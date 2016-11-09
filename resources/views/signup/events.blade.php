<!DOCTYPE html>
<html lang="en">
    @include('partials/signup/header')
    <body>
    @foreach ($events as $event)
        @include('partials/signup/event', [
            'title' => $event['title'],
            'description' => $event['description'],
            'users' => $event['users'],
        ])
    @endforeach
    @include('partials/signup/footer')
    </body>
</html>
