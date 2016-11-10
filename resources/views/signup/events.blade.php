<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials/signup/header')
        <link rel="stylesheet" href="/css/bootstrap-datepicker3.min.css">
    </head>
    <body>
        <?php
        echo Table::withContents($events)->bordered();
        echo Form::open(['url' => $url, 'class' => 'create-event']);
        echo ControlGroup::generate(Form::label('title', 'Title'), [
            [
                'input' => ['type' => 'text', 'title', '']
            ],
            [
                'label' => ['description', 'Description'],
                'input' => ['type' => 'textarea', 'description', '']
            ],
            [
                'label' => ['expires_at', 'Expires on'],
                'input' => ['type' => 'text', 'expires_at', '']
            ],
            [
                'input' => ['type' => 'submit', 'Submit']
            ],
        ]);
        echo Form::close();
        ?>
        @include('partials/signup/footer')
        <script src="/js/bootstrap-datepicker.min.js"></script>
        <script src="/js/signup.events.js"></script>
    </body>
</html>
