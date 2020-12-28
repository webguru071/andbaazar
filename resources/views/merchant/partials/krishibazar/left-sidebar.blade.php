<ul class="nav nav-tabs" id="top-tab" role="tablist">
    <li class="nav-item {{$active == 'dashboard' ? 'active' : ''}}"><a  class="nav-link  {{$active == 'dashboard' ? 'active' : ''}}" href="{{ url('merchant/dashboard') }}">dashboard</a></li>

    <li class="nav-item"><a class="nav-link {{ (Request::is('merchant/krishi/products') || Request::is('merchant/krishi/products/*')) ? 'active' : ''}}" href="{{ url('merchant/krishi/products') }}">Products</a> </li>

    <li class="nav-item"><a class="nav-link" href="#orders">Orders</a> </li>

    <li class="nav-item"><a  class="nav-link {{ Request::is('profile') ? 'active' : ''}}" href="{{ url('profile') }}">Profile</a></li>

    <li class="nav-item"><a  class="nav-link {{ (Request::is('merchant/shop') || Request::is('merchant/shop/*')) ? 'active' : ''}}" href="{{ url('merchant/shop') }}">shop</a></li>

    <li class="nav-item"><a  class="nav-link {{ (Request::is('merchant/newsfeed/news') || Request::is('merchant/newsfeed/news/*')) ? 'active' : ''}}" href="{{ url('merchant/newsfeed/news') }}">News Feed</a></li>

    <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#settings">settings</a></li>

    <li class="nav-item"><a class="nav-link" href="{{ url('logout') }}">logout</a> </li>
</ul>
