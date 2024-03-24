<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Products</span>
                    </div>
                    <ul>
                        @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('category.show', ['id' => $category->category_id]) }}" class="show-overlay cate-li" data-target="overlay{{$category->category_id}}">{{$category->category_name}}</a>
                            <div id="overlay{{$category->category_id}}" class="overlay">
                                <h2>{{$category->category_name}}</h2>
                                <ul>
                                    @foreach ($subcategory as $subcat)
                                    @if ($subcat->parent_id == $category->category_id)
                                    <li>
                                        <a href="{{ route('category.show', ['id' => $subcat->category_id]) }}" class="cate-li" data-target="overlay{{$subcat->category_id}}">{{$subcat->category_name}}</a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do you need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
                <div class="hero__item set-bg" data-setbg="img/hero/Online-electronic-store.jpg">
                    <div class="hero__text">
                        <a href="#" class="primary-btn">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
