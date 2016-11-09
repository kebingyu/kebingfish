<div>
<?php
echo Panel::normal()->withHeader($title)->withBody($description);
echo Form::open(['url' => $url]);
echo Form::label('name', 'Signup here!');
echo InputGroup::withContents(Form::text('name'))->appendButton(Button::primary('Submit')->submit());
echo Form::close();
echo Table::withContents($users)->striped();
?>
</div>
