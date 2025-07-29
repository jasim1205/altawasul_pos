@extends('frontend.layout.home')
@section('content')
    <style>
        .img-container {
            overflow: hidden;
            display: inline-block;
        }

        .img-container img {
            transition: transform 0.4s ease;
            display: block;
        }

        .img-container:hover img {
            transform: scale(1.2);
            /* zoom in */
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
                        <h3 class="title">{{ $product->product_name }}</h3>
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
                <div class="col-md-6 img-container">
                    <img src="{{ asset('public/uploads/product/' . $product->product_image) }}" alt="">
                </div>

                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>{{ $product->product_name }}</th>
                        </tr>
                        <tr>
                            <th>Company</th>
                            <th>{{ $product->company->company_name }}</th>
                        </tr>
                        <tr>
                            <th>Model</th>
                            <th>{{ $product->product_model }}</th>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <th>{{ $product->unit_price }}</th>
                        </tr>
                    </table>

                </div>
            </div>


            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- FOOTER -->
@endsection
