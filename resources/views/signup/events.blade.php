<!DOCTYPE html>
<html lang="en">
    @include('partials/signup/header')
    <body>
    <?php
    echo Table::withContents($events)->bordered();
    echo Form::open(['url' => $url]);
    echo ControlGroup::generate(Form::label('title', 'Title'), [
        [
            'input' => ['type' => 'text', 'title', '']
        ],
        [
            'label' => ['description', 'Description'],
            'input' => ['type' => 'text', 'description', '']
        ],
        [
            'input' => ['type' => 'submit', 'Submit']
        ],
    ]);
    echo Form::close();
    ?>
    @include('partials/signup/footer')
    </body>
</html>
