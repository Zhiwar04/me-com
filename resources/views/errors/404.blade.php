@extends('frontend.master_dashboard')
@section('main')
@section('title')
    404
@endsection

<!-- 404 section start -->
<section class="page_404">
    <div class="container">
        <div class="wrapper">
            <h1 class="text-center ">404</h1>
        </div>

        <div class="msg">
            <h3>Looks like you're lost</h3>
            <p>The page you are looking for is not available!</p>

            <div class="backbtn">
                <a href="/" class="btn">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Home</span>
                </a>
            </div>

        </div>
    </div>
</section>
<!-- 404 section end -->








@endsection
