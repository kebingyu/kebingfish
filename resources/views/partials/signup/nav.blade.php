<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/" class="navbar-brand">Home</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="{{ route('signup.events.read') }}">All Events</a></li>
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Create Event <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('signup.event.create') }}?type=1">Regular Event</a></li>
            <li><a href="{{ route('signup.event.create') }}?type=2">Event with options</a></li>
          </ul>
        </li>
        <li><a href="#">About</a></li>
      </ul>
    </div>
  </div>
</nav>
