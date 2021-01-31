@extends('admin.layout.master')

@push('css')
    <!-- owlcarousel css-->
    <link rel="stylesheet" type="text/css" href="/frontend/assets/css/owlcarousel.css">
@endpush

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Product Details
                            <small>{{ env('APP_NAME') }} Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="/"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Product Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="card">
            <div class="row product-page-main card-body">
                <div class="col-xl-4">
                    <div class="product-slider owl-carousel owl-theme" id="sync1">
                        @foreach($krishi_product->itemimage as $product_image)
                            <div class="item"><img src="{{ Storage::url($product_image['org_img']) }}" alt="" class="blur-up lazyloaded"></div>
                        @endforeach
                    </div>
                    <div class="owl-carousel owl-theme" id="sync2">
                        @foreach($krishi_product->itemimage as $product_image)
                            <div class="item"><img src="{{ Storage::url($product_image['org_img']) }}" alt="" class="blur-up lazyloaded"></div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="product-page-details product-right mb-0">
                        <h2 class="mb-2">{{ $krishi_product->name }}</h2>
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <hr>
                        <h2 class="mb-2">product description</h2>
                        {!! $krishi_product->description !!}
                        <div class="product-price digits mt-2">
                            <h3>{{ $krishi_product->wholesale_price }}৳ - {{ $krishi_product->price }}৳</h3>
                        </div>
                        <hr>
                        <div class="add-product-form">
                            <h2 class="mb-2">product details</h2>
                            <div class="add-product-wrap row">
                                <div class="col-12 col-sm-12 col-md-6">
                                    <div class="mb-1"><h6 class="product-title d-inline">Shop name : </h6> {{ $krishi_product->shop['name'] }}</div>
                                    <div class="mb-1"><h6 class="product-title d-inline">Category : </h6> {{ $krishi_product->category['name']  }}</div>
                                    <div class="mb-1"><h6 class="product-title d-inline">Total unit sold : </h6> {{ $krishi_product->total_unit_sold ?? 0  }}</div>
                                    <div class="mb-1"><h6 class="product-title d-inline">Available from : </h6> {{ $krishi_product->available_from->format('y-m-d')  }}</div>
                                    <div class="mb-1"><h6 class="product-title d-inline">Available to : </h6> {{ $krishi_product->available_to->format('y-m-d')  }}</div>
                                    <div class="mb-1"><h6 class="product-title d-inline">Frequency support : </h6> {{ ($krishi_product->frequency_support) ? 'Yes' : 'No' }}</div>
                                    <div class="mb-1"><h6 class="product-title d-inline">available stock : </h6> {{ $krishi_product->available_stock .' ' .$krishi_product->productUnit['symbol'] }}</div>
                                    <div class="mb-1"><h6 class="product-title d-inline">Regular price : </h6> {{ $krishi_product->price }} ৳</div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6">
                                    <div class="mb-1"><h6 class="product-title d-inline">Wholesale price : </h6> {{ $krishi_product->wholesale_price }} ৳</div>
                                    <div class="mb-1"><h6 class="product-title d-inline">min wholesale quantity : </h6> {{ $krishi_product->min_wholesale_quantity .' ' .$krishi_product->productUnit['symbol'] }}</div>
                                    <div class="mb-1"><h6 class="product-title d-inline">allow flash sale : </h6> {{ ($krishi_product->allow_flash_sale) ? 'Yes' : 'No' }}</div>
                                    <div class="mb-1"><h6 class="product-title d-inline">flash sale discount rate : </h6> {{ $krishi_product->flash_sale_discount_rate }}</div>
                                    <div class="mb-1"><h6 class="product-title d-inline">allow custom offer : </h6> {{ ($krishi_product->allow_custom_offer) ? 'Yes' : 'No' }}</div>
                                    <div class="mb-1"><h6 class="product-title d-inline">frequency : </h6> {{ implode(', ', $krishi_product->frequency) }}</div>
                                    <div class="mb-1"><h6 class="product-title d-inline">frequency quantity : </h6> {{ $krishi_product->frequency_quantity }}</div>
                                    <div class="mb-1"><h6 class="product-title d-inline">return policy : </h6> {{ $krishi_product->return_policy ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @if(!is_null($krishi_product->video_url))
                            <div class="product-price">
                                <h2 class="mb-2">Product video : </h2>
                                <iframe id="embedVideo" width="100%" height="400" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <hr>
                        @endif

                        <div class="m-t-15">
                            @if(in_array($krishi_product->status,['Pending','Active']))
                                <a href="{{ action('Admin\KrishiProductController@rejectProduct',$krishi_product->id) }}" class="btn btn-primary m-r-10">Reject</a>
{{--                                <button class="btn btn-primary m-r-10" type="button">Reject</button>--}}
                            @endif
                                @if(in_array($krishi_product->status,['Pending','Reject']))
                                    <a href="{{ action('Admin\KrishiProductController@approveProduct',$krishi_product->id) }}" class="btn btn-secondary">Approve</a>
{{--                                <button class="btn btn-secondary" type="button">Approve</button>--}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection

@push('js')
    <!-- Owlcarousel js-->
    <script src="/frontend/assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="/frontend/assets/js/dashboard/product-carousel.js"></script>
    <script>
        $('div.alert').delay(3000).fadeOut(350);
        $(document).ready(function (){
            var videoURL='{{ $krishi_product->video_url }}';
            if (videoURL != null){
                let embedVideo = processedVideo(videoURL);
                $('#embedVideo').attr("src",embedVideo);
            }
            function processedVideo(youTubeVideoURL){
                let regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                let match = youTubeVideoURL.match(regExp);

                if (match && match[2].length == 11) {
                    let videoSrc="//www.youtube.com/embed/" + match[2];
                    return videoSrc;
                } else {
                    return '';
                }
            }
        });

    </script>
@endpush
