<div>
<?php
echo Panel::normal()->withHeader($title)->withBody($description)->withFooter($expire);
echo Form::open(['url' => $url, 'class' => 'signup']);
echo Form::label('name', 'Signup here!');
echo InputGroup::withContents(Form::text('name'))->appendButton(Button::primary('Submit')->submit());
echo Form::close();
echo Table::withContents($users)
    ->striped()
    ->withClassOnCellsInColumn('#', 'user-count')
    ->withClassOnCellsInColumn('name', 'user-name');
?>
</div>
