<footer class="bg-dark pt-5 mt-4">
    <div class="container">
        <!-- About and Newsletter START -->
        <div class="row pt-3 pb-4">
            <div class="col-md-3">
                <img src="" alt="footer logo">
            </div>{{ asset("storage/setting"."/".$activeFooterLightLogo) }}
            <div class="col-md-5">
                <p class="text-muted">The next-generation blog, news, and magazine theme for you to start sharing your stories today! This Bootstrap 5 based theme is ideal for all types of sites that deliver the news.</p>
            </div>
            <div class="col-md-4">
                <!-- Form -->
                <form class="row row-cols-lg-auto g-2 align-items-center justify-content-end">
                    <div class="col-12">
                        <input type="email" class="form-control" placeholder="Enter your email address">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary m-0">Subscribe</button>
                    </div>
                    <div class="form-text mt-2">By subscribing you agree to our
                        <a href="#" class="text-decoration-underline text-reset">Privacy Policy</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- About and Newsletter END -->

        <!-- Divider -->
        <hr>

        <!-- Widgets START -->
        <div class="row pt-5">
            <!-- Footer Widget -->
            <div class="col-md-6 col-lg-3 mb-4">
                <h5 class="mb-4 text-white">Recent post</h5>
                <!-- Item -->
                @foreach($footerLatestPosts as $post)
                    <div class="mb-4 position-relative">
                        <div>
                            @foreach($post->categories as $category)
                                <a href="#" class="badge bg-primary mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>{{ $category->title }}</a>
                            @endforeach
                        </div>
                        <a href="post-single-3.html" class="btn-link text-white fw-normal">{{ $post->title }}</a>
                        <ul class="nav nav-divider align-items-center small mt-2 text-muted">
                            <li class="nav-item position-relative">
                                <div class="nav-link">by <a href="#" class="stretched-link text-reset btn-link">{{ $post->user->name }}</a>
                                </div>
                            </li>
                            <li class="nav-item">{{ date('d M', strtotime($post->created_at)) }}</li>
                        </ul>
                    </div>
                @endforeach
            </div>

            <!-- Footer Widget -->
            <div class="col-md-6 col-lg-3 mb-4">
                <h5 class="mb-4 text-white">UseFull Links</h5>
                <div class="row">
                    <div class="col-6">
                        <ul class="nav flex-column text-primary-hover">
                            <li class="nav-item"><a class="nav-link pt-0" href="#">Bitcoin</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Metaverse</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Investments</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Extract Coin</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Analysis</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Blockchain</a></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="nav flex-column text-primary-hover">
                            <li class="nav-item"><a class="nav-link pt-0" href="#">Defy</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Decentralized</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Technology</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Wallet</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">NFT</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Exchanges</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Footer Widget -->
            <div class="col-sm-6 col-lg-3 mb-4">
                <h5 class="mb-4 text-white">Follow Us In</h5>
                <ul class="nav flex-column text-primary-hover">
                    <li class="nav-item"><a class="nav-link pt-0" href="#"><i class="fab fa-whatsapp fa-fw me-2"></i>WhatsApp</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fab fa-youtube fa-fw me-2"></i>YouTube</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="far fa-bell fa-fw me-2"></i>Website Notifications</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="far fa-envelope fa-fw me-2"></i>Newsletters</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-headphones-alt fa-fw me-2"></i>Podcasts</a></li>
                </ul>
            </div>

            <!-- Footer Widget -->
            <div class="col-sm-6 col-lg-3 mb-4">
                <h5 class="mb-4 text-white">Our mobile App (coming soon)</h5>
                <p class="text-muted">Download our App and get the latest Breaking News Alerts and latest headlines and daily articles near you.</p>
                <div class="row g-2">
                    <div class="col">
                        <a href="#"><img class="w-100" src="{{ asset("theme/front/assets/images/app-store.svg") }}" alt="app-store"></a>
                    </div>
                    <div class="col">
                        <a href="#"><img class="w-100" src="{{ asset("theme/front/assets/images/google-play.svg") }}" alt="google-play"></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Widgets END -->

        <!-- Hot topics START -->
        <div class="row">
            <h5 class="mb-2 text-white">Hot categories</h5>
            <ul class="list-inline text-primary-hover lh-lg">
                @foreach($footerHotCategories as $category )
                    <li class="list-inline-item"><a href="#">{{ $category->title }}</a></li>
                @endforeach
            </ul>
        </div>
        <!-- Hot topics END -->
    </div>

    <!-- Footer copyright START -->
    <div class="bg-dark-overlay-3 mt-5">
        <div class="container">
            <div class="row align-items-center justify-content-md-between py-4">
                <div class="col-md-6">
                    <div class="text-center text-md-start text-primary-hover text-muted">
                        ©2023 <a href="#" class="text-reset btn-link" target="_blank">Morteza Goodarzi</a>. All rights reserved
                    </div>
                </div>
                <div class="col-md-6 d-sm-flex align-items-center justify-content-center justify-content-md-end">
                    <!-- Language switcher -->
                    <div class="dropup me-0 me-sm-3 mt-3 mt-md-0 text-center text-sm-end">
                        <a class="dropdown-toggle text-primary-hover" href="#" role="button" id="languageSwitcher" data-bs-toggle="dropdown" aria-expanded="false">
                            English (coming soon))
                        </a>
                        <ul class="dropdown-menu min-w-auto" aria-labelledby="languageSwitcher">
                            <li><a class="dropdown-item" href="#">English</a></li>
                            <li><a class="dropdown-item" href="#">German </a></li>
                            <li><a class="dropdown-item" href="#">French</a></li>
                        </ul>
                    </div>
                    <!-- Links -->
                    <ul class="nav text-primary-hover text-center text-sm-end justify-content-center justify-content-center mt-3 mt-md-0">
                        <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
                        <li class="nav-item"><a class="nav-link pe-0" href="#">Cookies</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
