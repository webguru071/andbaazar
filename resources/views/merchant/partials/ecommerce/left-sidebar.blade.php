<ul class="nav nav-tabs" id="top-tab" role="tablist">
    <li class="nav-item {{$active == 'dashboard' ? 'active' : ''}}"><a  class="nav-link  {{$active == 'dashboard' ? 'active' : ''}}" href="{{ url('merchant/dashboard') }}">dashboard</a></li>
    <li class="nav-item">
        <a class="nav-link  text-truncate navSymbol {{ (Request::is('merchant/e-commerce/products') || Request::is('merchant/sme/products')||Request::is('merchant/krishi/products')||Request::is('merchant/auction/products'))?'':'collapsed'}}" href="#submenu1" data-toggle="collapse" data-target="#submenu1" aria-expanded="{{ (Request::is('merchant/e-commerce/products') || Request::is('merchant/sme/products')||Request::is('merchant/krishi/products')||Request::is('merchant/auction/products'))?'true':'false'}}"> <span class="d-none d-sm-inline">Products</span></a>
        <div class="collapse {{ (Request::is('merchant/e-commerce/products') || Request::is('merchant/sme/products')||Request::is('merchant/krishi/products')||Request::is('merchant/auction/products'))?'show':''}}" id="submenu1">
            <ul class="flex-column pl-2 nav">
                <li class="nav-item">
                    <a  class="nav-link {{$active == 'product' ? 'active' : ''}}" href="{{ url('merchant/e-commerce/products') }}">E-commerce Products</a>
                    <a  class="nav-link {{$active == 'smeProduct' ? 'active' : ''}}" href="{{ url('merchant/sme/products') }}">SME Products</a>
                    <a  class="nav-link {{$active == 'krishi' ? 'active' : ''}}" href="{{ url('merchant/krishi/products') }}">Krishi Products</a>
                    <a  class="nav-link {{$active == 'auction' ? 'active' : ''}}" href="{{ url('merchant/auction/products') }}">Auction</a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link text-truncate Symbol {{ (Request::is('merchant/e-commerce/inventories') || Request::is('merchant/sme/inventories'))?'':'collapsed'}}" href="#submenu2" data-toggle="collapse" data-target="#submenu2" aria-expanded="{{ (Request::is('merchant/e-commerce/inventories') || Request::is('merchant/sme/inventories'))?'true':'false'}}" > <span class="d-none d-sm-inline">Inventories</span></a>
        <div class="collapse {{ (Request::is('merchant/e-commerce/inventories') || Request::is('merchant/sme/inventories'))?'show':''}}" id="submenu2">
            <ul class="flex-column pl-2 nav">
                <li class="nav-item">
                    <a  class="nav-link  {{$active == 'inventory' ? 'active' : ''}}" href="{{ url('merchant/e-commerce/inventories') }}">E-commerce Inventories</a>
                    <a  class="nav-link {{$active == 'smeInventory' ? 'active' : ''}}" href="{{ url('merchant/sme/inventories') }}">SME Inventories</a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#orders">Orders</a> </li>

    <li class="nav-item"><a  class="nav-link {{$active == 'profile' ? 'active' : ''}}" href="/profile">Profile</a></li>

    <li class="nav-item"><a  class="nav-link {{$active == 'shop' ? 'active' : ''}}" href="{{ url('merchant/shop') }}">shop</a>
    </li>
    <li class="nav-item"><a  class="nav-link {{$active == 'newsfeed' ? 'active' : ''}}" href="{{ url('merchant/newsfeed/news') }}">News Feed</a></li>

    <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#settings">settings</a></li>

    <li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#logout" href="{{url('logout')}}">logout</a> </li>
</ul>
