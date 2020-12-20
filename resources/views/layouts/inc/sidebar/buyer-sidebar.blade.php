<div class="col-lg-3">
    <div class="account-sidebar"><a class="popup-btn">my account</a></div>
    <div class="dashboard-left">
        <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> back</span></div>
        <div class="block-content">
            @include('merchant.partials.'.session('default_service').'')
            <ul>
                <li class="{{$active == 'dashboard' ? 'active' : ''}}"><a href="{{ url('/dashboard') }}">My Dashboard</a></li>
                <li class="{{$active == 'profile' ? 'active' : ''}}"><a href="{{ url('customer/') }}">My Profile</a></li>
                <li class="{{$active == 'shipping' ? 'active' : ''}}"><a href="{{ url('customer/shipping') }}">My Shipping Address</a></li>
                <li class="{{$active == 'billing' ? 'active' : ''}}"><a href="{{ url('/customer/billing') }}">My Billing Address</a></li>
                <li class="{{$active == 'cards' ? 'active' : ''}}"><a href="{{ url('/customer/card') }}">My Card</a></li>
                {{-- <li><a href="#">Change Password</a></li> --}}
                <li class="last"><a href="{{url('/logout')}}">Log Out</a></li>
            </ul>
        </div>
    </div>
</div>
