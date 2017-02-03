<div class="col-md-offset-2 col-md-8">
    <div class="alert alert-info">
        <div class="form-title">Edit this event</div>
        <form class="form-horizontal update-event" method="PATCH" action="{{ $url }}" accept-charset="UTF-8">
          {{ csrf_field() }}
          <div class="form-group create-event-title">
            <label for="title" class="col-sm-3 control-label">Title *</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="title" name="title" value="{{ $title }}">
            </div>
            <div class="col-sm-offset-3 col-sm-9">
                <ul class="error-block"></ul>
            </div>
          </div>
          <div class="form-group create-event-description">
            <label for="description" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-9">
              <textarea rows="3" class="form-control" id="description" name="description">{{ $description }}</textarea>
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
                @foreach ($locations as $location)
                <option
                  aria-label="{{ $location['name'] }}"
                  value="{{ $location['id'] }}"
                  @if ($location['id'] == $location_id) {!! "selected" !!} @endif>
                  {{ $location['name'] }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          @endif
          <div class="form-group create-event-expires-at">
            <label for="expires_at" class="col-sm-3 control-label">Pick a date</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="expires_at" name="expires_at" value="{{ $expire }} ">
              <p class="help-block">(Leave it blank so the event never expires.)</p>
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
          <input type="hidden" class="success-url" data-url="{{ $successUrl }}">
        </form>
    </div>
</div>
