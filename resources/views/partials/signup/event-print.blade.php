<div class="col-md-offset-3 col-md-6">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $title }}</h3>
        </div>
        <div class="panel-body">{!! nl2br(e($description)) !!}</div>
        <div class="panel-footer"># of persons signed up: <strong>{{ $goerCount }}</strong></div>
        <div class="panel-footer">{{ $expire }} ({{ $expiresIn }})</div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="user-name">Name</th>
                    <th class="user-group-size">Group size</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="user-name">{{ $user['name'] }}</td>
                        <td class="user-group-size">{{ $user['group_size'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
