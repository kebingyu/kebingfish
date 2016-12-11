<div class="col-md-offset-3 col-md-6">
    <div class="alert alert-info">
        <div class="form-title">Create a new event!</div>
        <form class="form-horizontal create-event" method="POST" action="{{ $url }}" accept-charset="UTF-8">
          <div class="form-group create-event-title">
            <label for="title" class="col-sm-3 control-label">Title *</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="title" name="title" placeholder="Enter event title...">
            </div>
            <div class="col-sm-offset-3 col-sm-9">
                <ul class="error-block"></ul>
            </div>
          </div>
          <div class="form-group create-event-description">
            <label for="description" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-9">
              <textarea rows="3" class="form-control" id="description" name="description"
                placeholder="Enter event description..."></textarea>
            </div>
            <div class="col-sm-offset-3 col-sm-9">
                <ul class="error-block"></ul>
            </div>
          </div>
          @if (count($locations) > 0)
          <div class="form-group create-event-location">
            <label for="location_id" class="col-sm-3 control-label">Pick a location *</label>
            <div class="col-sm-9">
              <select class="form-control" name="location_id">
                @foreach ($locations as $index => $location)
                <option
                  aria-label="{{ $location['name'] }}"
                  value="{{ $location['id'] }}"
                  @if (!$index) {!! "selected" !!} @endif>
                  {{ $location['name'] }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          @endif
          <div class="form-group create-event-expires-at">
            <label for="expires_at" class="col-sm-3 control-label">Pick a date *</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="expires_at" name="expires_at" placeholder="Pick a date...">
            </div>
            <div class="col-sm-offset-3 col-sm-9">
                <ul class="error-block"></ul>
            </div>
          </div>
          <input type="hidden" name="type" value="{{ $type }}">
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
    </div>
</div>
