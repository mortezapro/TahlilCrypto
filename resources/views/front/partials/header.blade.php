<header class="navbar-light navbar-sticky header-static">
    <div class="navbar-top d-none d-lg-block small">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center my-2">
                <!-- Top bar left -->
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link ps-0" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://themes.getbootstrap.com/store/webestica/">Privacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Login / Join</a>
                    </li>
                </ul>
                <!-- Top bar right -->
                <div class="d-flex align-items-center">
                    <!-- Font size accessibility START -->
                    <div class="btn-group me-2" role="group" aria-label="font size changer">
                        <input type="radio" class="btn-check" name="fntradio" id="font-sm">
                        <label class="btn btn-xs btn-outline-primary mb-0" for="font-sm">A-</label>

                        <input type="radio" class="btn-check" name="fntradio" id="font-default" checked>
                        <label class="btn btn-xs btn-outline-primary mb-0" for="font-default">A</label>

                        <input type="radio" class="btn-check" name="fntradio" id="font-lg">
                        <label class="btn btn-xs btn-outline-primary mb-0" for="font-lg">A+</label>
                    </div>

                    <!-- Dark mode switch -->
                    <div class="modeswitch" id="darkModeSwitch">
                        <div class="switch"></div>
                    </div>

                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link px-2 fs-5" href="#"><i class="fab fa-facebook-square"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2 fs-5" href="#"><i class="fab fa-twitter-square"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2 fs-5" href="#"><i class="fab fa-linkedin"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2 fs-5" href="#"><i class="fab fa-youtube-square"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 pe-0 fs-5" href="#"><i class="fab fa-vimeo"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Divider -->
            <div class="border-bottom border-2 border-primary opacity-1"></div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img class="navbar-brand-item light-mode-item" src="{{ asset("storage/setting"."/".$activeHeaderLightLogo) }}" alt="logo">
                <img class="navbar-brand-item dark-mode-item" src="{{ asset("storage/setting"."/".$activeHeaderDarkLogo) }}" alt="logo">
            </a>
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="text-body h6 d-none d-sm-inline-block">Menu</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav navbar-nav-scroll mx-auto">
                    @foreach($menus as $menu)
                        @if($menu->child->count() == 0)
                            <li class="nav-item">
                                <a class="nav-link " href="#" id="homeMenu" aria-expanded="false">{{ $menu->title }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="pagesMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $menu->title }}</a>
                                <ul class="dropdown-menu" aria-labelledby="pagesMenu">
                                    @foreach($menu->child as $child1)
                                        @if($child1->child->count() == 0)
                                        <li>
                                            <a class="dropdown-item" href="#">{{ $child1->title }}</a>
                                        </li>
                                        @else
                                            <li class="dropdown-submenu dropend">
                                                <a class="dropdown-item dropdown-toggle" href="#">{{ $child1->title }}</a>
                                                <ul class="dropdown-menu dropdown-menu-start" data-bs-popper="none">
                                                    @foreach($child1->child as $child2)
                                                        <li>
                                                            <a class="dropdown-item" href="#">{{ $child2->title }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                    {{--<li class="nav-item">
                        <a class="nav-link active" href="#" id="homeMenu" aria-expanded="false">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pagesMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Analysis</a>
                        <ul class="dropdown-menu" aria-labelledby="pagesMenu">
                            <li> <a class="dropdown-item" href="#">Bitcoin Analysis</a></li>
                            <li> <a class="dropdown-item" href="#">Ethereum Analysis</a></li>
                            <li> <a class="dropdown-item" href="#">Solana Analysis</a></li>
                            <li> <a class="dropdown-item" href="#">Avax Analysis</a></li>
                            <li> <a class="dropdown-item" href="#">Cardano Analysis</a></li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item dropdown-toggle" href="#">Other Project</a>
                                <ul class="dropdown-menu dropdown-menu-start" data-bs-popper="none">
                                    <li> <a class="dropdown-item" href="#">Binance Coin Analysis</a> </li>
                                    <li> <a class="dropdown-item" href="#">Polkadot Analysis</a> </li>
                                    <li> <a class="dropdown-item" href="#">Poligan Analysis</a> </li>
                                    <li> <a class="dropdown-item" href="#">ChainLink Analysis</a> </li>
                                    <li> <a class="dropdown-item" href="#">Bloktopia Analysis</a> </li>
                                    <li> <a class="dropdown-item" href="#">Fantom Analysis</a> </li>
                                </ul>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="https://support.webestica.com/" target="_blank">
                                    <i class="text-warning fa-fw bi bi-life-preserver me-2"></i>Support
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" target="_blank">
                                    <i class="text-danger fa-fw bi bi-card-text me-2"></i>Documentation
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="postMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">News</a>
                        <ul class="dropdown-menu" aria-labelledby="postMenu">
                            <li> <a class="dropdown-item" href="#">Highlight</a> </li>
                            <li> <a class="dropdown-item" href="#"></a> </li>
                            <li> <a class="dropdown-item" href="#">Post card</a> </li>
                            <li> <a class="dropdown-item" href="#">Post overlay</a> </li>
                            <li class="dropdown-divider"></li>
                            <li> <a class="dropdown-item" href="#">Post single magazine</a> </li>
                            <li> <a class="dropdown-item" href="#">Post single classic</a> </li>
                            <li> <a class="dropdown-item" href="#">Post single minimal</a> </li>
                            <li> <a class="dropdown-item" href="#">Post single card</a> </li>
                            <li> <a class="dropdown-item" href="#">Post single review</a> </li>
                            <li> <a class="dropdown-item" href="#">Post single video</a> </li>
                            <li class="dropdown-divider"></li>
                            <li> <a class="dropdown-item" href="#">Pagination styles</a> </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown dropdown-fullwidth">
                        <a class="nav-link dropdown-toggle" href="#" id="megaMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Whitepaper</a>
                        <div class="dropdown-menu" aria-labelledby="megaMenu">
                            <div class="container">
                                <div class="row g-4 p-3 flex-fill">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card bg-transparent">
                                            <img class="card-img rounded" src="{{ asset("theme/front/assets/images/blog/16by9/small/01.jpg") }}" alt="Card image">
                                            <div class="card-body px-0 pt-3">
                                                <h6 class="card-title mb-0"><a href="#" class="btn-link text-reset fw-bold">7 common mistakes everyone makes while traveling</a></h6>
                                                <ul class="nav nav-divider align-items-center text-uppercase small mt-2">
                                                    <li class="nav-item">
                                                        <a href="#" class="text-reset btn-link">Joan Wallace</a>
                                                    </li>
                                                    <li class="nav-item">Feb 18, 2021</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card bg-transparent">
                                            <img class="card-img rounded" src="{{ asset("theme/front/assets/images/blog/16by9/small/02.jpg") }}" alt="Card image">
                                            <div class="card-body px-0 pt-3">
                                                <h6 class="card-title mb-0"><a href="#" class="btn-link text-reset fw-bold">12 worst types of business accounts you follow on Twitter</a></h6>
                                                <ul class="nav nav-divider align-items-center text-uppercase small mt-2">
                                                    <li class="nav-item">
                                                        <a href="#" class="text-reset btn-link">Lori Stevens</a>
                                                    </li>
                                                    <li class="nav-item">Jun 03, 2021</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card bg-transparent">
                                            <img class="card-img rounded" src="{{ asset("theme/front/assets/images/blog/16by9/small/03.jpg") }}" alt="Card image">
                                            <div class="card-body px-0 pt-3">
                                                <h6 class="card-title mb-0"><a href="#" class="btn-link text-reset fw-bold">Skills that you can learn from business</a></h6>
                                                <ul class="nav nav-divider align-items-center text-uppercase small mt-2">
                                                    <li class="nav-item">
                                                        <a href="#" class="text-reset btn-link">Judy Nguyen</a>
                                                    </li>
                                                    <li class="nav-item">Sep 07, 2021</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="bg-primary-softrounded">
                                            <img src="{{ asset("theme/front/assets/images/adv.png") }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-3">
                                    <div class="col-12">
                                        <ul class="list-inline mt-3">
                                            <li class="list-inline-item">Trending tags:</li>
                                            <li class="list-inline-item"><a href="#" class="btn btn-sm btn-primary-soft">Travel</a></li>
                                            <li class="list-inline-item"><a href="#" class="btn btn-sm btn-warning-soft">Business</a></li>
                                            <li class="list-inline-item"><a href="#" class="btn btn-sm btn-success-soft">Tech</a></li>
                                            <li class="list-inline-item"><a href="#" class="btn btn-sm btn-danger-soft">Gadgets</a></li>
                                            <li class="list-inline-item"><a href="#" class="btn btn-sm btn-info-soft">Lifestyle</a></li>
                                            <li class="list-inline-item"><a href="#" class="btn btn-sm btn-primary-soft">Vaccine</a></li>
                                            <li class="list-inline-item"><a href="#" class="btn btn-sm btn-success-soft">Sports</a></li>
                                            <li class="list-inline-item"><a href="#" class="btn btn-sm btn-danger-soft">Covid-19</a></li>
                                            <li class="list-inline-item"><a href="#" class="btn btn-sm btn-info-soft">Politics</a></li>
                                        </ul>
                                    </div>
                                </div> <!-- Row END -->
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">	<a class="nav-link" href="#">Events</a></li>--}}
                </ul>
            </div>
            <div class="nav flex-nowrap align-items-center">
                <div class="nav-item d-none d-md-block">
                    <a href="#" class="btn btn-sm btn-danger mb-0 mx-2">Subscribe!</a>
                </div>
                <div class="nav-item dropdown dropdown-toggle-icon-none nav-search">
                    <a class="nav-link dropdown-toggle" role="button" href="#" id="navSearch" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-search fs-4"> </i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow rounded p-2" aria-labelledby="navSearch">
                        <form class="input-group" method="post" action="#">
                            @csrf
                            <input class="form-control border-success" name="search" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-success m-0" type="submit">Search</button>
                        </form>
                    </div>
                </div>
                <div class="nav-item">
                    <a class="nav-link p-0" data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                        <i class="bi bi-text-right rtl-flip fs-2" data-bs-target="#offcanvasMenu"> </i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
