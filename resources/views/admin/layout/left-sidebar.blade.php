<div class="page-sidebar">
            <div class="main-header-left d-none d-lg-block">
                <div class="logo-wrapper"><a href="index.html"><img class="blur-up lazyloaded" src="{{asset('frontend')}}/assets/images/icon/logo.png" alt=""></a></div>
            </div>
            <div class="sidebar custom-scrollbar">
                <div class="sidebar-user text-center">
                    <div><img class="img-60 rounded-circle lazyloaded blur-up" src="{{asset('frontend')}}/assets/images/dashboard/user.png" alt="#">
                    </div>
                    <h6 class="mt-3 f-14">{{ Auth::user()->first_name . ' ' .Auth::user()->last_name  }}</h6>
                    <p>{{ Auth::user()->type }}</p>
                </div>

                <ul class="sidebar-menu">
                    <li><a class="sidebar-header {{ request()->is('andbaazaradmin/dashboard') ? 'active' : '' }}" href="{{ url('andbaazaradmin/dashboard') }}"><i data-feather="home"></i><span>Dashboard</span></a></li>

{{--                    <li><a class="sidebar-header {{ request()->is('andbaazaradmin/customers') ? 'active' : '' }}"  href="{{ action('Admin\CustomerController@index') }}"><i data-feather="users"></i><span>Customers</span></a> </li>--}}

                    <li class="{{ request()->is('andbaazaradmin/customers*') ? 'active' : '' }}"><a class="sidebar-header {{ request()->is('andbaazaradmin/customers*') ? 'active' : '' }}" href="#"><i data-feather="user"></i> <span>Customers</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ (request()->is('andbaazaradmin/customers') || request()->is('andbaazaradmin/customers/active')) ? 'active' : '' }}"><a href="{{ action('Admin\CustomerController@active_customers') }}" class="{{ (request()->is('andbaazaradmin/customers') || request()->is('andbaazaradmin/customers/active')) ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Active Customers</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/customers/pending') ? 'active' : '' }}"><a href="{{ action('Admin\CustomerController@pending_customers') }}" class="{{ request()->is('andbaazaradmin/customers/pending') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Pending Customers</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/customers/rejected') ? 'active' : '' }}"><a href="{{ action('Admin\CustomerController@rejected_customers') }}" class="{{ request()->is('andbaazaradmin/customers/rejected') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Rejected Customers</span></a></li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('andbaazaradmin/merchants*') ? 'active' : '' }}"><a class="sidebar-header {{ request()->is('andbaazaradmin/merchants*') ? 'active' : '' }}" href="#"><i data-feather="user"></i> <span>Merchants</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ (request()->is('andbaazaradmin/merchants') || request()->is('andbaazaradmin/merchants/active')) ? 'active' : '' }}"><a href="{{ action('Admin\MerchantController@active_merchants') }}" class="{{ (request()->is('andbaazaradmin/merchants') || request()->is('andbaazaradmin/merchants/active')) ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Active Merchants</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/merchants/pending') ? 'active' : '' }}"><a href="{{ action('Admin\MerchantController@pending_merchants') }}" class="{{ request()->is('andbaazaradmin/merchants/pending') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Pending Merchants</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/merchants/rejected') ? 'active' : '' }}"><a href="{{ action('Admin\MerchantController@rejected_merchants') }}" class="{{ request()->is('andbaazaradmin/merchants/rejected') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Rejected Merchants</span></a></li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('andbaazaradmin/agents*') ? 'active' : '' }}"><a class="sidebar-header {{ request()->is('andbaazaradmin/agents*') ? 'active' : '' }}" href="#"><i data-feather="user-plus"></i> <span>Agents</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ (request()->is('andbaazaradmin/agents') || request()->is('andbaazaradmin/agents/active')) ? 'active' : '' }}"><a href="{{ action('Admin\AgentController@active_agents') }}" class="{{ (request()->is('andbaazaradmin/agents') || request()->is('andbaazaradmin/agents/active'))  ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Active Agents</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/agents/pending') ? 'active' : '' }}"><a href="{{ action('Admin\AgentController@pending_agents') }}" class="{{ request()->is('andbaazaradmin/agents/pending') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Pending Agents</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/agents/rejected') ? 'active' : '' }}"><a href="{{ action('Admin\AgentController@rejected_agents') }}" class="{{ request()->is('andbaazaradmin/agents/rejected') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Rejected Agents</span></a></li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('andbaazaradmin/products/category*') ? 'active' : '' }}"><a class="sidebar-header" href="#"><i data-feather="shopping-bag"></i> <span>Shops</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Krishi</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Ecommerce</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Auction</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>SME</span></a></li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('andbaazaradmin/krishi/products*') ? 'active' : '' }}"><a class="sidebar-header {{ request()->is('andbaazaradmin/krishi/products*') ? 'active' : '' }}" href="#"><i data-feather="package"></i> <span>Krishi Products</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ (request()->is('andbaazaradmin/krishi/products/active*') || request()->is('andbaazaradmin/krishi/products')) ? 'active' : '' }}"><a href="{{ action('Admin\KrishiProductController@activeProducts') }}" class="{{ (request()->is('andbaazaradmin/krishi/products/active*') || request()->is('andbaazaradmin/krishi/products')) ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Active Products</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/krishi/products/upcoming*') ? 'active' : '' }}"><a href="{{ action('Admin\KrishiProductController@upcomingProducts') }}" class="{{ request()->is('andbaazaradmin/krishi/products/upcoming*') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Upcoming Products</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/krishi/products/pending*') ? 'active' : '' }}"><a href="{{ action('Admin\KrishiProductController@pendingProducts') }}" class="{{ request()->is('andbaazaradmin/krishi/products/pending*') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Pending Products</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/krishi/products/rejected*') ? 'active' : '' }}"><a href="{{ action('Admin\KrishiProductController@rejectedProducts') }}" class="{{ request()->is('andbaazaradmin/krishi/products/rejected*') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Rejected Products</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/krishi/products/category/*') ? 'active' : '' }}"><a href="{{ action('Admin\KrishiProductCategoryController@index') }}" class="{{ request()->is('andbaazaradmin/krishi/products/category/*') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Category</span></a></li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('andbaazaradmin/products/category*') ? 'active' : '' }}"><a class="sidebar-header" href="#"><i data-feather="shopping-cart"></i> <span>Ecommerce Products</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Active Products</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Pending Products</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Rejected Products</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Category</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>circle</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Colors</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Size</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Brands</span></a></li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('andbaazaradmin/products/category*') ? 'active' : '' }}"><a class="sidebar-header" href="#"><i data-feather="package"></i> <span>Auction Products</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Active Products</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Pending Products</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Rejected Products</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Category</span></a></li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('andbaazaradmin/products/category*') ? 'active' : '' }}"><a class="sidebar-header" href="#"><i data-feather="package"></i> <span>SME Products</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Active Products</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Pending Products</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Rejected Products</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Category</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Tags</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Colors</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Size</span></a></li>
                        </ul>
                    </li>

                    <li><a class="sidebar-header {{ request()->is('andbaazaradmin/paymentmethod') ? 'active' : '' }}"  href="{{ url('andbaazaradmin/paymentmethod') }}"><i data-feather="credit-card"></i><span>Payment Methods</span></a> </li>

                    <li><a class="sidebar-header {{ request()->is('andbaazaradmin/order-tracking-stages') ? 'active' : '' }}"  href="{{ url('andbaazaradmin/order-tracking-stages') }}"><i data-feather="truck"></i><span>Order Tracking Stages</span></a> </li>

                    <li class="{{ request()->is('andbaazaradmin/coupon-codes*') ? 'active' : '' }}"><a class="sidebar-header {{ request()->is('andbaazaradmin/coupon-codes*') ? 'active' : '' }}" href="#"><i data-feather="gift"></i> <span>Promotion</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Promotion Plan</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/coupon-codes*') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/coupon-codes') }}" class="{{ request()->is('andbaazaradmin/coupon-codes*') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Coupons</span></a></li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('andbaazaradmin/products/category*') ? 'active' : '' }}"><a class="sidebar-header" href="#"><i data-feather="tv"></i> <span>News Feeds</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Active News</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Pending News</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Rejected News</span></a></li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('andbaazaradmin/products/category*') ? 'active' : '' }}"><a class="sidebar-header" href="#"><i data-feather="settings"></i> <span>Setting</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Predefined Reject Reason</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Currency</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Shipping Methods</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="#" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Site Settings</span></a></li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('andbaazaradmin/import-*') ? 'active' : '' }}"><a class="sidebar-header {{ request()->is('andbaazaradmin/import-*') ? 'active' : '' }}" href="#"><i data-feather="database"></i> <span>Export / Import Data</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ request()->is('andbaazaradmin/import-attribute') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/import-attribute')}}" class="{{ request()->is('andbaazaradmin/import-attribute') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Attribute</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/import-inventory') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/import-inventory')}}" class="{{ request()->is('andbaazaradmin/import-inventory') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Inventory</span></a></li>
                            <li class="{{ request()->is('andbaazaradmin/import-village') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/import-village')}}" class="{{ request()->is('andbaazaradmin/import-village') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Village</span></a></li>
                        </ul>
                    </li>

                    <li><a class="sidebar-header {{ request()->is('andbaazaradmin/promotion') ? 'active' : '' }}"  href="{{ url('andbaazaradmin/promotion') }}"><i data-feather="message-square"></i><span>User Message</span></a> </li>

                    <li class="{{ request()->is('andbaazaradmin/cms/*') ? 'active' : '' }}"><a class="sidebar-header {{ request()->is('andbaazaradmin/cms/*') ? 'active' : '' }}" href="#"><i data-feather="sliders"></i> <span>CMS</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ request()->is('andbaazaradmin/cms/sliders') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/cms/sliders') }}" class="{{ request()->is('andbaazaradmin/cms/sliders') ? 'active' : '' }}"><i class="fa fa-circle"></i> <span>Slider images</span></a></li>
                        </ul>
                    </li>





{{--                    <li class="{{ request()->is('andbaazaradmin/products/category*') ? 'active' : '' }}"><a class="sidebar-header" href="#"><i data-feather="briefcase"></i> <span>Products</span><i class="fa fa-angle-right pull-right"></i></a>--}}
{{--                        <ul class="sidebar-submenu">--}}
{{--                            <li class="{{ request()->is('andbaazaradmin/products/category*') ? 'active' : '' }}">--}}
{{--                                <a href="#" ><i class="fa fa-cubes"></i> <span>Categories</span> <i class="fa fa-angle-right pull-right"></i></a>--}}
{{--                                <ul class="sidebar-submenu">--}}
{{--                                    <li class="{{ request()->is('andbaazaradmin/products/category') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/products/category') }}" class="{{ request()->is('andbaazaradmin/products/category') ? 'active' : '' }}" ><i class="fa fa-server"></i> Category</a></li>--}}
{{--                                    <li class="{{ request()->is('andbaazaradmin/products/category/*') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/products/category-tree-view') }}" class="{{ request()->is('andbaazaradmin/products/category-tree-view') ? 'active' : '' }}"><i class="fa fa-sliders"></i> Sub Category</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}

{{--                            <li class="{{ request()->is('andbaazaradmin/products/krishi/category*') ? 'active' : '' }}">--}}
{{--                                <a href="#" ><i class="fa fa-cubes"></i> <span>Krishi Categories</span> <i class="fa fa-angle-right pull-right"></i></a>--}}
{{--                                <ul class="sidebar-submenu">--}}
{{--                                    <li class="{{ request()->is('andbaazaradmin/products/krishi/category') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/products/krishi/category') }}" class="{{ request()->is('andbaazaradmin/products/krishi/category') ? 'active' : '' }}" ><i class="fa fa-server"></i>Add Category</a></li>--}}
{{--                                    <li class="{{ request()->is('andbaazaradmin/products/krishi/category/*') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/products/krishi/all-category') }}" class="{{ request()->is('andbaazaradmin/products/krishi/all-category') ? 'active' : '' }}"><i class="fa fa-sliders"></i> All Category</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}

{{--                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'active' : '' }}"><a href="{{url('andbaazaradmin/products/tag')}}" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-tags"></i> Tags</a></li>--}}

{{--                            <li class="{{ request()->is('andbaazaradmin/products/color/*') ? 'active' : '' }}"><a href="{{url('andbaazaradmin/products/color')}}" class="{{ request()->is('andbaazaradmin/products/color') ? 'active' : '' }}"><i class="fa fa-puzzle-piece"></i> Color</a></li>--}}

{{--                            <li class="{{ request()->is('andbaazaradmin/products/size/*') ? 'active' : '' }}"><a href="{{url('andbaazaradmin/products/size')}}" class="{{ request()->is('andbaazaradmin/products/size') ? 'active' : '' }}"><i class="fa fa-pencil-square-o"></i> Size</a></li>--}}

{{--                            <li class="{{ request()->is('andbaazaradmin/products/brand/*') ? 'active' : '' }}"><a href="{{url('andbaazaradmin/products/brand')}}" class="{{ request()->is('andbaazaradmin/products/brand') ? 'active' : '' }}"><i class="fa fa-pencil-square-o"></i> Brand</a></li>--}}

{{--                            <li class="{{ request()->is('andbaazaradmin/products/product_list*') ? 'active' : '' }}">--}}
{{--                                <a  href="#" class="sidebar-header"><i data-feather="menu" ></i><span>Product Request</span><i class="fa fa-angle-right pull-right"></i></a>--}}
{{--                                <ul class="sidebar-submenu">--}}
{{--                                    <li class="{{ request()->is('andbaazaradmin/e-commerce/products/*') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/e-commerce/products/')}}" class="{{ request()->is('andbaazaradmin/e-commerce/products/') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i> E-com Products</a></li>--}}
{{--                                    <li class="{{ request()->is('andbaazaradmin/sme/products/*') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/sme/products/')}}" class="{{ request()->is('andbaazaradmin/sme/products/') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i> SME Products</a></li>--}}
{{--                                    <li class="{{ request()->is('andbaazaradmin/krishi/products/*') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/krishi/products/')}}" class="{{ request()->is('andbaazaradmin/krishi/products/') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i> Krishi Products</a></li>--}}
{{--                                    <li class="{{ request()->is('andbaazaradmin/sme/products/*') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/auction/products/')}}" class="{{ request()->is('andbaazaradmin/auction/products/') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i> Auction Products</a></li>--}}
{{--                                    <li class="{{ request()->is('andbaazaradmin/products/AllProduct/*') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/products/AllProduct')}}" class="{{ request()->is('andbaazaradmin/products/AllProduct') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i> All Products </a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

                    {{-- <li class="{{ request()->is('andbaazaradmin/products/shop/*') ? 'active' : '' }}"><a class="sidebar-header" href="#"><i data-feather="shopping-bag"></i><span>Shops</span><i class="fa fa-angle-right pull-right"></i></a>

                        <ul class="sidebar-submenu">
                            <li><a href="<a href="{{ 'andbaazaradmin/shop' }}"><i class="fa fa-pencil-square-o"></i> All Shop</a></li>
                            <li><a href="<a href="{{ 'andbaazaradmin/shop/create' }}"><i class="fa fa-pencil-square-o"></i> Create Shop</a></li>
                        </ul>

                   </li> --}}

{{--                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/paymentmethod') ? 'active' : '' }}"  href="{{ url('andbaazaradmin/paymentmethod') }}" class="{{ request()->is('andbaazaradmin/paymentmethod') ? 'active' : '' }}"><i data-feather="credit-card"></i><span>Payment Method</span></a> </li>--}}

{{--                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/shippingmethod') ? 'active' : '' }}"  href="{{ url('andbaazaradmin/shippingmethod') }}" class="{{ request()->is('andbaazaradmin/shippingmethod') ? 'active' : '' }}"><i data-feather="truck"></i><span>Shipping Method</span></a> </li>--}}

{{--                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/promotion') ? 'active' : '' }}"  href="{{ url('andbaazaradmin/promotion') }}"><i data-feather="align-left"></i><span>Promotion</span></a> </li>--}}

{{--                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/promotionplan') ? 'active' : '' }}" href="{{ url('andbaazaradmin/promotionplan') }}" ><i data-feather="archive"></i><span>Promotion Plan</span></a> </li>--}}

{{--                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/promotionhead') ? 'active' : '' }}" href="{{ url('andbaazaradmin/promotionhead') }}" ><i data-feather="droplet"></i><span>Promotion Head</span></a> </li>--}}

{{--                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/currency') ? 'active' : '' }}" href="{{ url('andbaazaradmin/currency') }}" ><i data-feather="dollar-sign"></i><span>Currency</span></a> </li>--}}

{{--                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/courier') ? 'active' : '' }}" href="{{ url('andbaazaradmin/courier') }}" ><i data-feather="send"></i><span>Courier</span></a> </li>--}}


{{--                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/reject') ? 'active' : '' }}" href="{{ url('andbaazaradmin/reject') }}" ><i data-feather="send"></i><span>Reject List</span></a> </li>--}}

{{--                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/merchant') ? 'active' : '' }}" href="{{ url('andbaazaradmin/merchant') }}" ><i data-feather="users"></i><span>Merchant profiles</span></a> </li>--}}

{{--                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/shop') ? 'active' : '' }}" href="{{ url('andbaazaradmin/shop') }}" ><i data-feather="shopping-bag"></i><span>Shop List</span></a> </li>--}}

{{--                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/contact-us') ? 'active' : '' }}" href="{{ url('andbaazaradmin/contact-us') }}" ><i data-feather="message-circle"></i><span>Contact us Messages</span></a> </li>--}}

{{--                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/newsfeed') ? 'active' : '' }}" href="{{ url('andbaazaradmin/newsfeed') }}" ><i data-feather="message-square"></i><span>Feed</span></a> </li>--}}




              {{-- Export Import Route  --}}

{{--                   <li class="{{ request()->is('andbaazaradmin/products/product_list*') ? 'active' : '' }}">--}}
{{--                    <a  href="#" class="sidebar-header"><i data-feather="menu" ></i><span>Import Export</span><i class="fa fa-angle-right pull-right"></i></a>--}}
{{--                    <ul class="sidebar-submenu">--}}
{{--                        <li class="{{ request()->is('andbaazaradmin/attribute-import/*') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/attribute-import/')}}" class="{{ request()->is('andbaazaradmin/attribute-import/') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i>Attribute</a></li>--}}
{{--                        <li class="{{ request()->is('andbaazaradmin/inventory-import/*') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/inventory-import/')}}" class="{{ request()->is('andbaazaradmin/inventory-import/') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i>Inventory</a></li>--}}
{{--                        <li class="{{ request()->is('andbaazaradmin/village-import/*') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/village-import/')}}" class="{{ request()->is('andbaazaradmin/village-import/') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i> Village</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}


                   {{-- <li class="{{ request()->is('andbaazaradmin/merchant/*') ? 'active' : '' }}"><a href="#" class="sidebar-header" ><i class="fa fa-facebook"></i> <span>Vendor Profile</span> <i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ request()->is('andbaazaradmin/merchant') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/merchant/') }}" class="{{ request()->is('andbaazaradmin/merchant') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i> Profile list</a></li>

                        </ul>
                    </li> --}}


{{--                    <li class="{{ request()->is('andbaazaradmin/product_list/*') ? 'active' : '' }}"><a class="sidebar-header" href="#"><i data-feather="menu" ></i><span>Product Request</span><i class="fa fa-angle-right pull-right"></i></a>--}}
{{--                        <ul class="sidebar-submenu">--}}
{{--                            <li class="{{ request()->is('andbaazaradmin/product_list') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/product_list')}}" class="{{ request()->is('andbaazaradmin/product_list') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i> Products list</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

                    {{-- <li class="{{ request()->is('andbaazaradmin/shop/*') ? 'active' : '' }}"><a class="sidebar-header" href="#"><i data-feather="menu" ></i><span>Shop</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ request()->is('andbaazaradmin/shop') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/shop')}}" class="{{ request()->is('andbaazaradmin/shop') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i> Shop list</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li class="{{ request()->is('andbaazaradmin/contact-us/*') ? 'active' : '' }}"><a class="sidebar-header" href="#"><i data-feather="menu" ></i><span>Contact us Message</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ request()->is('andbaazaradmin/contact-us') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/contact-us')}}" class="{{ request()->is('andbaazaradmin/contact-us') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i> Message List</a></li>
                        </ul>
                    </li>  --}}
                     {{-- <li><a class="sidebar-header" href="invoice.html"><i data-feather="archive"></i><span>Invoice</span></a>
                    </li>
                    <li><a class="sidebar-header" href="login.html"><i data-feather="log-in"></i><span>Login</span></a>
                    </li> --}}

                </ul>
            </div>
        </div>

