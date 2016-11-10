<div>
<?php
echo Panel::normal()
    ->withHeader($title . Badge::withContents($goerCount))
    ->withBody($description)
    ->withFooter($expire);
echo Form::open(['url' => $url, 'class' => 'signup']);
echo Form::label('signup', 'Signup here!');
echo ControlGroup::generate(Form::label('name', 'Name'), [
    [
        'input' => ['type' => 'text', 'name', '']
    ],
    [
        'label' => ['group_size', 'How big is your group'],
        'input' => ['type' => 'number', 'group_size', '']
    ],
    [
        'input' => ['type' => 'submit', 'Submit']
    ],
]);
echo Form::close();
echo Table::withContents($users)
    ->striped()
    ->withClassOnCellsInColumn('Name', 'user-name')
    ->withClassOnCellsInColumn('Group size', 'user-group-size');
?>
</div>
