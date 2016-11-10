<div class="col-md-offset-2 col-md-8">
    <?php
    echo Panel::normal()
        ->withHeader($title . Badge::withContents($goerCount))
        ->withBody($description)
        ->withFooter($expire);
    ?>

    <form class="form-horizontal signup" method="POST" action="<?php echo $url?>" accept-charset="UTF-8">
      <div class="form-group">
        <label for="name" class="col-sm-4 control-label">Name</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
        </div>
      </div>
      <div class="form-group">
        <label for="group_size" class="col-sm-4 control-label">How big is your group?</label>
        <div class="col-sm-8">
          <input type="number" class="form-control" id="group_size" name="group_size" placeholder="1">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <button type="submit" class="btn btn-default">Submit</button>
        </div>
      </div>
    </form>

    <?php
    echo Table::withContents($users)
        ->striped()
        ->withClassOnCellsInColumn('Name', 'user-name')
        ->withClassOnCellsInColumn('Group size', 'user-group-size');
    ?>
</div>
