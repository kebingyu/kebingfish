<div class="col-md-offset-2 col-md-8">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">
                {{ $title }}<span class="badge goer-count">{{ $goerCount }}</span>
            </h3>
        </div>
        <div class="panel-body">{{ $description }}</div>
        <div class="panel-footer">{{ $expire }}</div>
    </div>
    <div class="alert alert-info">
        <div class="form-title">Sign me up!</div>
        <form class="form-horizontal signup" method="POST" action="{{ $url }}" accept-charset="UTF-8">
          <div class="form-group">
            <label for="name" class="col-sm-4 control-label">Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name...">
            </div>
            <ul class="error-block"></ul>
          </div>
          <div class="form-group">
            <label for="group_size" class="col-sm-4 control-label">How big is your group?</label>
            <div class="col-sm-8">
              <input type="number" class="form-control" id="group_size" name="group_size" placeholder="1">
            </div>
            <ul class="error-block"></ul>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
    </div>
    <div class="table-responsive">
        <?php
        echo Table::withContents($users)
            ->striped()
            ->withClassOnCellsInColumn('Name', 'user-name')
            ->withClassOnCellsInColumn('Group size', 'user-group-size');
        ?>
    </div>
</div>
