<div class="col-md-offset-2 col-md-8">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $title }}</h3>
        </div>
        <div class="panel-body">{!! nl2br(e($description)) !!}</div>
        @if (count($location) > 0)
            @foreach ($options as $option => $count)
                <div class="panel-footer">{{ $option }}: <strong>{{ $count }}</strong></div>
            @endforeach
        @else
        <div class="panel-footer"># of persons signed up: <strong>{{ $goerCount }}</strong></div>
        @endif
        <div class="panel-footer">{{ $expire }} ({{ $expiresIn }})</div>
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
                        <td class="user-name">{{ $user['name'] }}</td>
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
