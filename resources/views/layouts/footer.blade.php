<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-2 mb-lg-3">
                <h3>UKMJuWAra</h3>
            </div>
            <div class="col-12 col-md-5">
                <div class="footer-item">
                    <div class="d-flex ">
                        <i class="fas fa-map-marked-alt me-2 mt-2 me-lg-3"></i>
                        <span>
                            <b>PT Indonesia Tumbuh Inklusif</b> <br />
                            18 Office Park Lt.10 Unit A <br />
                            Jl. TB Simatupang No 18
                            Jakarta Selatan 12520
                        </span>
                    </div>
                    <div class="d-flex mt-2">
                        <i class="fas fa-envelope me-2 fa-fw mt-1 me-lg-3"></i>
                        <a href="mailto: info@ukmindonesia.id">info@ukmindonesia.id</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="footer-item">
                    <ul>
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
            {{-- <div class="col-12 col-md-3">
                <div class="footer-item">
                    <ul>
                        <li>
                            <a href="">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="">Terms of Services</a>
                        </li>
                    </ul>
                </div>
            </div> --}}
            <div class="col-12 col-md-1">
                <div class="footer-item social-icons">
                    <div class="d-flex" style="font-size: 1.75rem">
                        <a href="https://www.instagram.com/ukmindonesiaid" target="_blank"><i
                                class="fab fa-instagram me-2" aria-hidden="true"></i></a>
                        <a href="https://www.facebook.com/ukmindonesia.org/" target="_blank"><i
                                class="fab fa-facebook me-2" aria-hidden="true"></i></a>
                        <a href="https://www.youtube.com/channel/UCWcTn1tlRbqifDA3uY67Sfw" target="_blank"><i
                                class="fab fa-youtube" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-12 text-center copyright">
    <i class="fa fa-copyright" aria-hidden="true"></i> Copyright {{ now()->year }} | UKMJuWAra
</div>
