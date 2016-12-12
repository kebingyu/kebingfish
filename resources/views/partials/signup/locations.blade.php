<div class="col-md-offset-3 col-md-6">
    <ul class="list-group event-list">
        <li class="list-group-item list-group-item-info">All Locations</li>
        @foreach ($locations as $location)
            <li class="list-group-item">
                <a href="{{ $location['href'] }}">
                    {{ $location['title'] }}
                    <span class="glyphicon glyphicon-chevron-right pull-right"></span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
