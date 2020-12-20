<ul class="nav nav-tabs" id="top-tab" role="tablist">
    <li class="nav-item {{$active == 'dashboard' ? 'active' : ''}}"><a  class="nav-link  {{$active == 'dashboard' ? 'active' : ''}}" href="{{ url('merchant/dashboard') }}">dashboard</a></li>

    <li class="nav-item"><a data-toggle="tab" class="nav-link {{$active == 'products' ? 'active' : ''}}" href="{{ url('merchant/krishi/products') }}">Products</a> </li>

    <li class="nav-item"><a data-toggle="tab" class="nav-link {{$active == 'inventories' ? 'active' : ''}}" href="{{ url('merchant/krishi/inventories') }}">Inventories</a> </li>

    <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#orders">Orders</a> </li>

    <li class="nav-item"><a  class="nav-link {{$active == 'profile' ? 'active' : ''}}" href="/profile">Profile</a></li>

    <li class="nav-item"><a  class="nav-link {{$active == 'shop' ? 'active' : ''}}" href="{{ url('merchant/shop') }}">shop</a></li>

    <li class="nav-item"><a  class="nav-link {{$active == 'newsfeed' ? 'active' : ''}}" href="{{ url('merchant/newsfeed/news') }}">News Feed</a></li>

    <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#settings">settings</a></li>

    <li class="nav-item"><a class="nav-link" href="/logout">logout</a> </li>
</ul>
