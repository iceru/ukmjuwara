<nav>
    <div class="navbar container d-flex justify-content-between">
        <a class="hamburger d-block d-md-none" data-bs-toggle="offcanvas" href="#side_navigation" role="button" aria-controls="side_navigation">
             <img src="/images/hamburger.png" alt="">
        </a>
        <a href="{{ route('index') }}">
            <div class="logo">
                <h3>#UKMJUWARA</h3>
            </div>
        </a>
        <div class="d-flex align-items-center">
            <ul class="navigation d-none d-md-flex">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">Tentang Kami</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Katalog
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach ($catalogs as $catalog)
                        <li><a class="dropdown-item" href="{{ $catalog->link ? $catalog->link : route('catalog.show', $catalog->slug) }}">{{ $catalog->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('article.index') }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Kemitraan</a>
                </li>
            </ul>
            <div class="search">
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
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


<div class="offcanvas offcanvas-start" tabindex="-1" id="side_navigation" aria-labelledby="sideNavigationLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="sideNavigationLabel">Offcanvas</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div>
        Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
      </div>
      <div class="dropdown mt-3">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
          Dropdown button
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </div>
    </div>
  </div>
