<section class="popular-categories section-padding">
    <div class="container wow animate__animated animate__fadeIn">
        <div class="section-title">
            <div class="title">
                <h3>Featured Categories</h3>

            </div>
            <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow" id="carausel-10-columns-arrows">
            </div>
        </div>
        <div class="carausel-10-columns-cover position-relative">
            <div class="carausel-10-columns" id="carausel-10-columns">
                @foreach ($categories as $category)
                    <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="shop-grid-right.html"><img src="{{ asset($category->category_image) }}"
                                    alt="" /></a>
                        </figure>

                        <h6><a href="shop-grid-right.html">{{ $category->category_name }}</a></h6>
                        @foreach ($products as $product)
                            @if ($product->category_id == $category->id)
                                @if (count($products) > 0)
                                    <span>{{ count($products) }} items</span>
                                @endif
                            @else
                                <span>0 item</span>
                            @endif
                        @endforeach

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
