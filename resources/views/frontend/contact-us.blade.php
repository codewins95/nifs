

@extends('layouts.master')
@section('title', 'Home')
@section('content')

        <!-- Breadcrumbs S t a r t -->
        <section class="breadcrumbs-area breadcrumb-bg">
            <div class="container">
                <h1 class="title wow fadeInUp" data-wow-delay="0.0s">Contact us</h1>
                <div class="breadcrumb-text">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav wow fadeInUp" data-wow-delay="0.1s">
                        <ul class="breadcrumb listing">
                            <li class="breadcrumb-item single-list"><a href="{{url('/')}}" class="single">Home</a></li>
                            <li class="breadcrumb-item single-list" aria-current="page"><a href="javascript:void(0)"
                                    class="single active">Contact us</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </section>
        <!--/ End-of Breadcrumbs-->


                <!-- Contact area S t a r t -->
                <section class="contact-area section-padding2">
                    <div class="position-relative contact-bg-before">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-xl-7 col-lg-9">
                                    <div class="contact-card">
                                        <h4 class="contact-heading">Feel Free to Write us Anytime</h4>
                                        <form method="post" class="contact-form">
                                            <div class="row g-4">
                                                <div class="col-sm-6">
                                                    <input class="custom-form" type="text" placeholder="Enter your name">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input class="custom-form" type="text" placeholder="Enter your email">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input class="custom-form" type="text" placeholder="Your Phone">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input class="custom-form" type="text" placeholder="Select subject">
                                                </div>
                                                <div class="col-sm-12">
                                                    <textarea class="custom-form-textarea" id="exampleFormControlTextarea1"
                                                        rows="3" placeholder="Enter your message..."></textarea>
                                                </div>
                                            </div>
                                            <div class="mt-40">
                                                <button type="submit" class="send-btn">Send Message</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ End-of Contact-->

                <!-- Map -->
                <iframe class="map-frame"
                    src="https://www.google.com/maps/embed/v1/place?q=USA,+Turkish &key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"
                    height="500" style="border: 15px" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <!-- / Map -->

@endsection
