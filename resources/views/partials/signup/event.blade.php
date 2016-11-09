<div>
<?php
echo Panel::normal()->withHeader($title)->withBody($description);
echo Table::withContents($users)->striped();
?>
</div>
