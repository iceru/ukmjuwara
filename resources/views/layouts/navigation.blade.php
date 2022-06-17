<nav id="nav">
    <div class="navbar container d-flex justify-content-between">
        <a class="hamburger d-block d-lg-none" data-bs-toggle="offcanvas" href="#side_navigation" role="button"
            aria-controls="side_navigation">
            <img src="/images/hamburger.png" alt="">
        </a>
        <a href="{{ route('index') }}">
            <div class="logo">
                <img src="/images/logo-white.png" alt="">
            </div>
        </a>
        <div class="d-flex align-items-center">
            <ul class="navigation d-none d-lg-flex">
                @foreach ($catalogs->slice(1, 2) as $catalog)
                    <li class="nav-item"><a class="nav-link" @if ($catalog->link) target="_blank" @endif
                            href="{{ $catalog->link ? $catalog->link : route('catalog.show', $catalog->slug) }}">{{ str_replace('#UKMJuWAra ', '', $catalog->title) }}</a>
                    </li>
                @endforeach
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">Tentang Kami</a>
                </li>
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Katalog
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                    </ul>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('article.index') }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Kemitraan</a>
                </li>
            </ul>
        </div>
    </div>
    <script>
        const $dropdown = $(".dropdown");
        const $dropdownToggle = $(".dropdown-toggle");
        const $dropdownMenu = $(".dropdown-menu");
        const showClass = "show";

        $(window).on("load resize", function() {
            if (this.matchMedia("(min-width: 768px)").matches) {
                $dropdown.hover(
                    function() {
                        const $this = $(this);
                        $this.addClass(showClass);
                        $this.find($dropdownToggle).attr("aria-expanded", "true");
                        $this.find($dropdownMenu).addClass(showClass);
                    },
                    function() {
                        const $this = $(this);
                        $this.removeClass(showClass);
                        $this.find($dropdownToggle).attr("aria-expanded", "false");
                        $this.find($dropdownMenu).removeClass(showClass);
                    }
                );
            } else {
                $dropdown.off("mouseenter mouseleave");
            }
        });
    </script>
</nav>
<div class="nav-search">
    <div class="container">
        <div class="search-content">
            <div class="text">
                Cari UKMJuWAra
            </div>
            <form action="{{ route('search') }}" role="search" id="search_form" class="d-flex" method="GET">
                @csrf
                <input type="search" class="form-control" name="search_query" required />
                <button type="submit" value="" class="btn btn-search">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
        </div>
    </div>
</div>


<div id="search">
    <div class="close"><i class="fa fa-times" aria-hidden="true"></i></div>
    <form action="{{ route('search') }}" role="search" id="search_form" method="GET">
        @csrf
        <input type="search" name="search_query" placeholder="Search" required />
        <button type="submit" value="Submit" class="btn btn-search">
            <i class="fa fa-search" aria-hidden="true"></i>
        </button>
    </form>
</div>


<div class="offcanvas offcanvas-start" tabindex="-1" id="side_navigation" aria-labelledby="sideNavigationLabel">
    <div class="d-flex justify-content-end">
        <button type="button" class="btn button-close" data-bs-dismiss="offcanvas">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button>
    </div>
    <div class="menu-overlay">
        <h1>UKMJuWAra</h1>
        <div class="list-menu">
            <ul>
                {{-- <li>
                    <a data-bs-toggle="collapse" href="#katalog" role="button" aria-expanded="false"
                        aria-controls="katalog">Katalog &nbsp; <span><i class="fa fa-caret-down"
                                aria-hidden="true"></i></span></a>
                    <div class="collapse" id="katalog">
                        <ul class="child-menu">
                            @foreach ($catalogs as $catalog)
                                <li>
                                    <a
                                        href="{{ $catalog->link ? $catalog->link : route('catalog.show', $catalog->slug) }}">{{ $catalog->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li> --}}
                @foreach ($catalogs->slice(1, 2) as $catalog)
                    <li><a @if ($catalog->link) target="_blank" @endif
                            href="{{ $catalog->link ? $catalog->link : route('catalog.show', $catalog->slug) }}">{{ str_replace('#UKMJuWAra ', '', $catalog->title) }}</a>
                    </li>
                @endforeach
                <li>
                    <a href="{{ route('about') }}">Tentang Kami</a>
                </li>
                <li>
                    <a href="{{ route('article.index') }}">Berita</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}">Kemitraan</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#search_btn').on('click', function(event) {
            $('#search').addClass('open');
            $('#search > form > input[type="search"]').focus();
        });
        $('#search .close').on('click', function(event) {
            $('#search').removeClass('open');
        });
    });
</script>
