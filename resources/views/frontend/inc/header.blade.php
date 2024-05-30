<header>
    <div class="header-area">
        <div class="main-header">
            <!-- Header Top -->
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="top-menu-wrapper d-flex align-items-center justify-content-between">
                                <!-- Top Left Side -->
                                <div class="top-header-left d-flex align-items-center">
                                    <!-- Logo-->
                                    <div class="logo">
                                        <a href="{{ url('/') }}"><img
                                                src="{{ static_asset('assets/images/logo/logo.png') }}" alt="logo"
                                                class="changeLogo"></a>
                                    </div>
                                    <!-- search box -->
                                    <div class="search-box search-bar d-none d-lg-block">
                                        <div class="header-search">
                                            <span class="pera">Destination, attraction</span>
                                            <div class="search-icon">
                                                <i class="ri-search-line"></i>
                                            </div>
                                            <kbd class="light-text">
                                                <abbr title="Ctrl">Search</abbr>
                                            </kbd>
                                        </div>
                                    </div>
                                    <!-- Mobile Device Seach & Theme Mode -->
                                    <div class="search-header-position d-block d-lg-none">
                                        <div class="d-flex gap-15">
                                            <div class="search-bar">
                                                <a href="javascript:void(0)" class="rounded-btn">
                                                    <i class="ri-search-line"></i>
                                                </a>
                                            </div>
                                            <!-- Theme Mode -->
                                            <button class="ToggleThemeButton change-theme-mode m-0 p-0 border-0">
                                                <i class="ri-sun-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- / Mobile Device Seach & Theme Mode-->
                                </div>
                                <!--Top Right Side -->
                                <div class="top-header-right">
                                    <!-- contact us -->
                                    <div class="contact-section">
                                        <div class="circle-primary-sm">
                                            <i class="ri-mail-line"></i>
                                        </div>
                                        <div class="info">
                                            <p class="pera">Email Anytime</p>
                                            <h4 class="title">
                                                <a href="mailto:info@nifstravels.com">info@nifstravels.com</a>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="contact-section">
                                        <div class="circle-primary-sm">
                                            <i class="ri-phone-line"></i>
                                        </div>
                                        <div class="info">
                                            <p class="pera">Call Anytime</p>
                                            <h4 class="title">
                                                <a href="tel:+919311126806">+91- 93111 26806</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Bottom -->
            <div class="header-bottom header-sticky">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="menu-wrapper">
                                <!-- Main-menu for desktop -->
                                <div class="main-menu d-none d-lg-block">
                                    <nav>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <ul class="listing" id="navigation">
                                                <li class="single-list">
                                                    <a href="{{ url('/') }}" class="single link-active"> Home </a>
                                                </li>
                                                <li class="single-list">
                                                    <a href="{{ route('about') }}" class="single">About us</a>
                                                </li>
                                                <li class="single-list">
                                                    <a href="" class="single">Why Choose us</a>
                                                </li>

                                                <li class="single-list">
                                                    <a href="{{ route('gallery') }}" class="single">Our Tour Gallery
                                                    </a>
                                                </li>
                                                <li class="single-list">
                                                    <a href="{{ route('blog') }}" class="single">News</a>
                                                </li>
                                                <li class="single-list">
                                                    <a href="{{ route('contact') }}" class="single">Contact</a>
                                                </li>
                                                <li class="d-block d-lg-none">
                                                    <div class="header-right pl-15">
                                                        <div class="d-flex align-items-center gap-12">
                                                            <div class="lang">
                                                                <i class="ri-global-line"></i>
                                                            </div>
                                                            <div class="divider gradient-divider"></div>
                                                            <div class="money">
                                                                <p class="pera">USD</p>
                                                            </div>
                                                        </div>
                                                        <div class="sign-btn">
                                                            @auth
                                                                <a href="{{ route('dashboard') }}"
                                                                    class="btn-secondary-sm">Dashboard</a>
                                                            @else
                                                                <a href="{{ route('login') }}" class="btn-secondary-sm">Sign
                                                                    In</a>
                                                            @endauth

                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="header-right">

                                                <div class="sign-btn">
                                                    @auth
                                                        <a href="{{ route('dashboard') }}"
                                                            class="btn-secondary-sm">Dashboard</a>
                                                    @else
                                                        <a href="{{ route('login') }}" class="btn-secondary-sm">Sign
                                                            In</a>
                                                    @endauth
                                                </div>
                                                <!-- Theme Mode -->
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="div">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search box -->
        <div class="search-container">
            <div class="top-section">
                <div class="search-icon">
                    <i class="ri-search-line"></i>
                </div>
                <div class="modal-search-box">
                    <input type="text" id="searchField" class="search-field"
                        placeholder="Destination, Agency, Country">
                    <button id="closeSearch" class="close-search-btn">
                        <kbd class="light-text"> ESC </kbd>
                    </button>
                </div>
            </div>
            <div class="body-section">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="listing">
                            <li>
                                <h4 class="search-label">Recent</h4>
                            </li>
                            <li class="single-list">
                                <a href="#">
                                    <div class="search-flex">
                                        <div class="content-img">
                                            <img src="{{ static_asset('assets/images/gallery/search-img-1.jpeg') }}"
                                                alt="travello">
                                        </div>
                                        <div class="content">
                                            <h4 class="title line-clamp-1">
                                                Dubai by Night City Tour with Fountain show
                                            </h4>
                                            <p class="pera line-clamp-2">
                                                Wonderful evening escapade starting at Madinat
                                                Jumeirah to the musical fountains to see another.
                                                Wonderful evening escapade starting at Madinat
                                                Jumeirah to the musical fountains to see another
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="single-list">
                                <a href="#">
                                    <div class="search-flex">
                                        <div class="content-img">
                                            <img src="{{ static_asset('assets/images/gallery/search-img-2.jpeg') }}"
                                                alt="travello">
                                        </div>
                                        <div class="content">
                                            <h4 class="title line-clamp-1">
                                                Dubai: Premium Red Dunes, Camels, Stargazing & 5*
                                                BBQ at Al Khayma Camp™️
                                            </h4>
                                            <p class="pera line-clamp-2">
                                                Give a great end to your day in Dubai with our
                                                premium evening Red Dune Desert Safari. Give a great
                                                end to your day in Dubai with our premium evening
                                                Red Dune Desert Safari.
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="single-list">
                                <a href="#">
                                    <div class="search-flex">
                                        <div class="content-img">
                                            <img src="{{ static_asset('assets/images/gallery/search-img-3.jpeg') }}"
                                                alt="travello">
                                        </div>
                                        <div class="content">
                                            <h4 class="title line-clamp-1">
                                                Admission to Global Village in Dubai
                                            </h4>
                                            <p class="pera line-clamp-2">
                                                Admission to Dubai’s biggest, multicultural festival
                                                park with replicas of iconic landmarks. Admission to
                                                Dubai’s biggest, multicultural festival park with
                                                replicas of iconic landmarks
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <h4 class="search-label">Recent</h4>
                            </li>
                            <li class="single-list">
                                <a href="#">
                                    <div class="search-flex">
                                        <div class="content-img">
                                            <img src="{{ static_asset('assets/images/gallery/search-img-1.jpeg') }}"
                                                alt="travello">
                                        </div>
                                        <div class="content">
                                            <h4 class="title line-clamp-1">
                                                Dubai by Night City Tour with Fountain show
                                            </h4>
                                            <p class="pera line-clamp-2">
                                                Wonderful evening escapade starting at Madinat
                                                Jumeirah to the musical fountains to see another.
                                                Wonderful evening escapade starting at Madinat
                                                Jumeirah to the musical fountains to see another
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="single-list">
                                <a href="#">
                                    <div class="search-flex">
                                        <div class="content-img">
                                            <img src="{{ static_asset('assets/images/gallery/search-img-2.jpeg') }}"
                                                alt="travello">
                                        </div>
                                        <div class="content">
                                            <h4 class="title line-clamp-1">
                                                Dubai: Premium Red Dunes, Camels, Stargazing & 5*
                                                BBQ at Al Khayma Camp™️
                                            </h4>
                                            <p class="pera line-clamp-2">
                                                Give a great end to your day in Dubai with our
                                                premium evening Red Dune Desert Safari. Give a great
                                                end to your day in Dubai with our premium evening
                                                Red Dune Desert Safari.
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="single-list">
                                <a href="#">
                                    <div class="search-flex">
                                        <div class="content-img">
                                            <img src="{{ static_asset('assets/images/gallery/search-img-3.jpeg') }}"
                                                alt="travello">
                                        </div>
                                        <div class="content">
                                            <h4 class="title line-clamp-1">
                                                Admission to Global Village in Dubai
                                            </h4>
                                            <p class="pera line-clamp-2">
                                                Admission to Dubai’s biggest, multicultural festival
                                                park with replicas of iconic landmarks. Admission to
                                                Dubai’s biggest, multicultural festival park with
                                                replicas of iconic landmarks
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div class="right-section" id="filterMenu">
                            <h4 class="title">Filter Options</h4>
                            <!-- List of Filter -->
                            <ul class="listing">
                                <li>
                                    <h4 class="search-label">Post Type</h4>
                                </li>
                                <li class="single-list">
                                    <div class="d-flex align-items-center gap-8">
                                        <label class="checkbox-label">
                                            <input class="checkbox-style" type="checkbox" value="remember"
                                                name="remember">
                                            <span class="checkmark-style"></span>
                                        </label>
                                        <div class="content">
                                            <p class="pera">Posts (3)</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="single-list">
                                    <div class="d-flex align-items-center gap-8">
                                        <label class="checkbox-label">
                                            <input class="checkbox-style" type="checkbox" value="remember"
                                                name="remember">
                                            <span class="checkmark-style"></span>
                                        </label>
                                        <div class="content">
                                            <p class="pera">Posts (3)</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="single-list">
                                    <div class="d-flex align-items-center gap-8">
                                        <label class="checkbox-label">
                                            <input class="checkbox-style" type="checkbox" value="remember"
                                                name="remember">
                                            <span class="checkmark-style"></span>
                                        </label>
                                        <div class="content">
                                            <p class="pera">Links (44)</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="single-list">
                                    <div class="d-flex align-items-center gap-8">
                                        <label class="checkbox-label">
                                            <input class="checkbox-style" type="checkbox" value="remember"
                                                name="remember">
                                            <span class="checkmark-style"></span>
                                        </label>
                                        <div class="content">
                                            <p class="pera">Blogs (23)</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <!-- List of Filter -->
                            <ul class="listing">
                                <li>
                                    <h4 class="search-label">Categories</h4>
                                </li>
                                <li class="single-list">
                                    <div class="d-flex align-items-center gap-8">
                                        <label class="checkbox-label">
                                            <input class="checkbox-style" type="checkbox" value="remember"
                                                name="remember">
                                            <span class="checkmark-style"></span>
                                        </label>
                                        <div class="content">
                                            <p class="pera">Articles (3)</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="single-list">
                                    <div class="d-flex align-items-center gap-8">
                                        <label class="checkbox-label">
                                            <input class="checkbox-style" type="checkbox" value="remember"
                                                name="remember">
                                            <span class="checkmark-style"></span>
                                        </label>
                                        <div class="content">
                                            <p class="pera">Poll (3)</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="single-list">
                                    <div class="d-flex align-items-center gap-8">
                                        <label class="checkbox-label">
                                            <input class="checkbox-style" type="checkbox" value="remember"
                                                name="remember">
                                            <span class="checkmark-style"></span>
                                        </label>
                                        <div class="content">
                                            <p class="pera">Article (44)</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="single-list">
                                    <div class="d-flex align-items-center gap-8">
                                        <label class="checkbox-label">
                                            <input class="checkbox-style" type="checkbox" value="remember"
                                                name="remember">
                                            <span class="checkmark-style"></span>
                                        </label>
                                        <div class="content">
                                            <p class="pera">Blogs (23)</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <!-- List of Filter -->
                            <ul class="listing">
                                <li>
                                    <h4 class="search-label">Travel</h4>
                                </li>
                                <li class="single-list">
                                    <div class="d-flex align-items-center gap-8">
                                        <label class="checkbox-label">
                                            <input class="checkbox-style" type="checkbox" value="remember"
                                                name="remember">
                                            <span class="checkmark-style"></span>
                                        </label>
                                        <div class="content">
                                            <p class="pera">Articles (3)</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="single-list">
                                    <div class="d-flex align-items-center gap-8">
                                        <label class="checkbox-label">
                                            <input class="checkbox-style" type="checkbox" value="remember"
                                                name="remember">
                                            <span class="checkmark-style"></span>
                                        </label>
                                        <div class="content">
                                            <p class="pera">Poll (3)</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="single-list">
                                    <div class="d-flex align-items-center gap-8">
                                        <label class="checkbox-label">
                                            <input class="checkbox-style" type="checkbox" value="remember"
                                                name="remember">
                                            <span class="checkmark-style"></span>
                                        </label>
                                        <div class="content">
                                            <p class="pera">Article (44)</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="single-list">
                                    <div class="d-flex align-items-center gap-8">
                                        <label class="checkbox-label">
                                            <input class="checkbox-style" type="checkbox" value="remember"
                                                name="remember">
                                            <span class="checkmark-style"></span>
                                        </label>
                                        <div class="content">
                                            <p class="pera">Blogs (23)</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="div">
                        <div class="filter_menu"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / End-Search -->
    </div>
</header>
