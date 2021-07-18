<nav>
    <div class="navbar container d-flex justify-content-between">
        <a href="/">
            <div class="logo">
                <h3>#UKMJUWARA</h3>
            </div>
        </a>
        <div class="d-flex align-items-center">
            <ul class="navigation">
                <li class="nav-item">
                    <a class="nav-link" href="/tentang-kami">Tentang Kami</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Katalog
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach ($catalogs as $catalog)
                        <li><a class="dropdown-item" href="{{ route('catalog.show', $catalog->slug) }}">{{ $catalog->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/berita">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/kemitraan">Kemitraan</a>
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
