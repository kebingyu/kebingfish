<div class="col-md-offset-3 col-md-6">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">
                {{ $location['name'] }}
            </h3>
        </div>
        @foreach ($location['data']['option'] as $option)
        <div class="panel-footer">{{ $option }}</div>
        @endforeach
    </div>
</div>
