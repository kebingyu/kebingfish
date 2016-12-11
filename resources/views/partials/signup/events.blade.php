<div class="col-md-offset-3 col-md-6">
    <ul class="list-group event-list">
        <li class="list-group-item list-group-item-info">All active events</li>
        @foreach ($events as $event)
            <li class="list-group-item">
                <a href="{{ $event['href'] }}">
                    {{ $event['title'] }}<span class="badge goer-count">{{ $event['count'] }}</span>
                    <span class="glyphicon glyphicon-chevron-right pull-right"></span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
