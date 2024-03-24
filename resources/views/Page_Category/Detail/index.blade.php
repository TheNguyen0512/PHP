@extends('Components.product.index')
@section('title')
<title>Details</title>
@endsection
@section('Css')
@endsection
@section('content')
@include('Components.product.hero', ['categories' => $categories, 'subcategory' => $subcategory])
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="{{ $product->image_url }}" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="{{ $product->image_url }}" src="{{ $product->image_url }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $product->product_name }}</h3>
                    <div class="product__details__rating">
                        <!-- Rating stars -->
                    </div>                    
                    <div>Brand: {{ strtoupper($product->brand) }}</div>
                    <div class="product__details__price">${{ $product->price }}</div>
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="1" id="quantity">
                            </div>
                        </div>
                    </div>
                    <a href="#" class="primary-btn">ADD TO CART</a>
                    <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                    <ul>
                        <li><br>Description: </br> <span>{!! nl2br(e($product->description)) !!}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <!-- Tabs for description, information, reviews -->
            </div>
        </div>
    </div>
</section>
@endsection
