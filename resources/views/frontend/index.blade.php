@extends('frontend.layout.home')
<!-- /TOP HEADER -->
@section('content')
    <style>
        .company-title {
            margin: 0px 0px 0px 25px;
            font-weight: bold;
            font-size: 14px;
        }
    </style>
    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="#" class="logo">
                            <img src="{{ asset('public/frontend/img/logo2.png') }}" alt="">
                        </a>
                        <p class="company-title">Auto Spare Parts Tradings LLC.</p>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-5">
                    <!-- <div class="header-search">
            <form>
             <select class="input-select">
              <option value="0">All Categories</option>
              <option value="1">Category 01</option>
              <option value="1">Category 02</option>
             </select>
             <input class="input" placeholder="Search here">
             <button class="search-btn">Search</button>
            </form>
           </div> -->
                </div>
                <!-- /SEARCH BAR -->
                <!-- SEARCH BAR -->
                <div class="col-md-4">
                    <div class="header-search">
                        <form method="GET" action="{{ route('frontend') }}">
                            <select class="input-select" name="company_id">
                                <option value="">All Companies</option>
                                @foreach ($company as $value)
                                    <option value="{{ $value->id }}"
                                        {{ request('company_id') == $value->id ? 'selected' : '' }}>
                                        {{ old('company_name', $value->company_name) }}</option>
                                @endforeach
                                {{-- <option value="1">Category 02</option> --}}
                            </select>
                            <input class="input" name="search" value="{{ request('search') }}" placeholder="Search here">
                            <button type="submit" class="search-btn">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->


            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->





    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">New Products</h3>
                        <!-- <div class="section-nav">
                                <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
                                <li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
                                <li><a data-toggle="tab" href="#tab1">Cameras</a></li>
                                <li><a data-toggle="tab" href="#tab1">Accessories</a></li>
                                </ul>
                            </div> -->
                    </div>
                </div>
                <!-- /section title -->
            </div>
            <div class="row">
                @foreach ($product as $item)
                    <a href="{{ route('productid', $item->id) }}">
                        <div class="col-md-3">
                            <div class="product">
                                <div class="product-img">
                                    {{-- <img src="{{ asset('public/frontend/img/product01.png') }}" alt=""> --}}
                                    <img src="{{ asset('public/uploads/product/' . $item->product_image) }}" alt="">
                                    <div class="product-label">
                                        <span class="sale">Stock</span>
                                        <span class="new">{{ $item->stock?->quantity ?? 0 }}</span>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-name">{{ $item->company?->company_name }}</p>
                                    <h3 class="product-name"><a href="#">{{ $item->product_name }}</a></h3>
                                    <h4 class="product-price">{{ $item->unit_price }} <del
                                            class="product-old-price">{{ $item->old_price }}</del></h4>
                                    @if ($item->stock?->quantity <= 5)
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                    @else
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    @endif
                                    <div class="product-btns">
                                        <p class="text-success"
                                            style="color: {{ $item->stock?->quantity <= 5 ? 'red' : 'green' }}; font-weight: bold;">
                                            {{ $item->stock?->quantity <= 5 ? 'Low Stock' : 'Stock Available' }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                {{ $product->links() }}
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- FOOTER -->
@endsection
