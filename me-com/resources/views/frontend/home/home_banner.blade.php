<section class="banners mb-25">
    <div class="container">
        <div class="row">
            @foreach ($banners as $banner)
                <div class="col-lg-4 col-md-6 relative">
                    <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <img src="{{ asset($banner->banner_image) }}" class="brightness-75" alt="" />
                        <div class="absolute bottom-0 left-0 p-4">
                            <h4 class="text-white text-xl font-bold mb-2">
                                {{ $banner->banner_title }}
                            </h4>
                            <button class="Addbtn Addbtn-2 text-white border-2 border-black border-solid">Shop
                                Now</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
