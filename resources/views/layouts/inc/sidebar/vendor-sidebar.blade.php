@php $shop = Baazar::shop() @endphp
<div class="col-lg-3">
    <div class="dashboard-sidebar">
        <div class="profile-top">
            <div class="profile-image">
                <img id="shop-img-sidebar" src="{{!empty($shop->logo) ? asset($shop->logo) : asset('/uploads/shops/logos/shop-1.png')}}" alt="" class="img-fluid">
            </div>
            <div class="profile-detail">
                <h5><a href="{{ url('merchant/shop') }}">{{ $shop->name }}</a></h5>
                <h6>750 followers | 10 review</h6>
                <h6>{{ $shop->email }}</h6>
            </div>
        </div>
        <div class="faq-tab">
            <ul class="nav nav-tabs" id="top-tab" role="tablist">
                <li class="nav-item {{$active == 'dashboard' ? 'active' : ''}}"><a  class="nav-link  {{$active == 'dashboard' ? 'active' : ''}}" href="{{ url('merchant/dashboard') }}">dashboard</a></li>                                     
                <li class="nav-item"> 
                  <a class="nav-link collapsed text-truncate navSymbol" href="#submenu1" data-toggle="collapse" data-target="#submenu1"> <span class="d-none d-sm-inline">Products</span></a> 
                  <div class="collapse" id="submenu1" aria-expanded="false">
                    <ul class="flex-column pl-2 nav">
                      <li class="nav-item"> 
                        <a  class="nav-link {{$active == 'product' ? 'active' : ''}}" href="{{ url('merchant/e-commerce/products') }}">E-commerce Products</a>
                        <a  class="nav-link {{$active == 'smeProduct' ? 'active' : ''}}" href="{{ url('merchant/sme/products') }}">SME Products</a>
                        <a  class="nav-link {{$active == 'auction' ? 'active' : ''}}" href="{{ url('merchant/auction/products') }}">Auction</a>
                      </li>
                    </ul>
                  </div> 
                </li>
                
                <li class="nav-item">
                  <a class="nav-link collapsed text-truncate Symbol" href="#submenu2" data-toggle="collapse" data-target="#submenu2"> <span class="d-none d-sm-inline">Inventories</span></a>
                  <div class="collapse" id="submenu2" aria-expanded="false">
                    <ul class="flex-column pl-2 nav">
                      <li class="nav-item"> 
                        <a  class="nav-link {{$active == 'inventory' ? 'active' : ''}}" href="{{ url('merchant/e-commerce/inventories') }}">E-commerce Inventories</a>
                        <a  class="nav-link {{$active == 'smeInventory' ? 'active' : ''}}" href="{{ url('merchant/sme/inventories') }}">SME Inventories</a>
                      </li>
                    </ul>
                  </div> 
                </li>            
                </li>
                
                
                <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#orders">Orders</a> </li>
               
                <li class="nav-item"><a  class="nav-link {{$active == 'profile' ? 'active' : ''}}" href="{{ url('merchant/profile/') }}">Profile</a></li>
                
                <li class="nav-item"><a  class="nav-link {{$active == 'shop' ? 'active' : ''}}" href="{{ url('merchant/shop') }}">shop</a>
                </li>
                <li class="nav-item"><a  class="nav-link {{$active == 'newsfeed' ? 'active' : ''}}" href="{{ url('merchant/newsfeed/news') }}">News Feed</a></li>

                <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#settings">settings</a></li> 
                
                <li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#logout" href="{{url('logout')}}">logout</a> </li>           
            </ul>
        </div>
        <div id="map" class="mt-2"></div>
    </div>
</div>

@push('css')
<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
      height: 200px;
    }
    /* Optional: Makes the sample page fill the window. */ 
      .navSymbol[data-toggle].collapsed:before {
      content: "▾";
      float:right; 
  }
  .navSymbol[data-toggle]:not(.collapsed):before {
      content: "▴";
      float:right;
  }
  .Symbol[data-toggle].collapsed:before {
      content: "▾";
      float:right; 
  }
  .Symbol[data-toggle]:not(.collapsed):before {
      content: "▴";
      float:right;
  }
  </style>
@endpush

@push('js')
<script>
    var marker;

    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: {lat: {{ $shop->lat }}, lng: {{ $shop->lng }}}
      });
      // var image = 'http://localhost/andbaazar/public/frontend/assets/images/icon/logo.png';
      marker = new google.maps.Marker({
        map: map,
        draggable: false,
        animation: google.maps.Animation.DROP,
        position: {lat: {{ $shop->lat }}, lng: {{ $shop->lng }}},
        title: '{{ $shop->name }}'
        // icon: image
      });
      marker.addListener('dragend', ddd);
    }

    function ddd() {
      console.log(marker.position.lat());
      console.log(marker.position.lng());
    }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtygZ5JPTLgwFLA8nU6bb4d_6SSLlTPGw&callback=initMap">
  </script>
@endpush
