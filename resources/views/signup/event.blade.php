<!DOCTYPE html>
<html lang="en">
    @include('partials/signup/header')
    <body>
<?php
echo Panel::normal()->withHeader($title)->withBody($description);
echo Table::withContents($users)->striped();
?>
    @include('partials/signup/footer')
    </body>
</html>
