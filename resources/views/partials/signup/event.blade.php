<div class="col-md-offset-2 col-md-8">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">
                {{ $title }}
                <span class="badge goer-count">{{ $goerCount }}</span>
            </h3>
        </div>
        <div class="panel-body">{!! nl2br(e($description)) !!}</div>
        <div class="panel-footer">
            {{ $expire }} ({{ $expiresIn }})
        </div>
        <div class="panel-footer">
            <a href="{{ $printUrl }}">
                <button type="button" class="btn btn-info">Print</button>
            </a>
            @if (!Auth::guest())
            <a href="{{ $editUrl }}">
                <button type="button" class="btn btn-primary">Edit</button>
            </a>
            <a href="{{ $resetUrl }}" class="js-event-reset">
                <button type="button" class="btn btn-danger pull-right">Reset</button>
            </a>
            @endif
        </div>
    </div>
    <div class="alert alert-info">
        <div class="form-title">Sign me up!</div>
        <form class="form-horizontal signup" method="POST" action="{{ $url }}" accept-charset="UTF-8">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="name" class="col-sm-4 control-label">Name *</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name...">
            </div>
            <div class="col-sm-offset-4 col-sm-8">
                <ul class="error-block"></ul>
            </div>
          </div>
          <div class="form-group">
            <label for="group_size" class="col-sm-4 control-label">How big is your group?</label>
            <div class="col-sm-8">
              <input type="number" class="form-control" id="group_size" name="group_size" placeholder="1">
            </div>
            <div class="col-sm-offset-4 col-sm-8">
                <ul class="error-block"></ul>
            </div>
          </div>
          @if (count($location) > 0)
          <div class="form-group create-event-location">
            <label for="location_id" class="col-sm-4 control-label">Choose food *</label>
            <div class="col-sm-8">
              <select class="form-control" name="option">
                @foreach ($location['data']['option'] as $index => $option)
                <option
                  aria-label="{{ $option }}"
                  value="{{ $option }}"
                  @if (!$index) {!! "selected" !!} @endif>
                  {{ $option }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          @endif
          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="user-name">Name</th>
                    <th class="user-group-size">Group size</th>
                    @if (count($location) > 0)
                    <th class="user-option">Food</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="user-name"><a href="{{ $user['href'] }}">{{ $user['name'] }}</a></td>
                        <td class="user-group-size">{{ $user['group_size'] }}</td>
                        @if (!is_null($user['option']))
                        <td class="user-option">{{ $user['option'] }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
