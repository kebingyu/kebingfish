<nav class="navbar navbar-default navbar-fixed-top marginzero">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
        aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="{{ route('miaomiao.home') }}" class="navbar-brand">Home</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="js-nav-li {{$active == 'merge' ? 'active' : '' }}">
            <a href="{{ route('miaomiao.merge.get') }}">Merge</a>
        </li>
        <li class="js-nav-li {{$active == 'vbase2' ? 'active' : '' }}">
            <a href="{{ route('miaomiao.vbase2.get') }}">VBase2 DNAPLOT</a>
        </li>
      </ul>
      <div class="navbar-header navbar-right">
        <a class="navbar-brand" href="#">By kyu</a>
      </div>
    </div>
  </div>
</nav>
