<nav class="navbar navbar-default navbar-fixed-top marginzero">
  <div class="container-fluid">
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="js-nav-li {{$active == 'home' ? 'active' : '' }}">
            <a href="{{ route('miaomiao.home') }}">Home</a>
        </li>
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
