<x-app-layout>
    @section('title')
        Kemitraan - UKM Juwara
    @endsection
    @section('meta-content')Sebagai komunitas pertama di dunia yang menghadirkan katalog member dalam format Whatsapp. Business Catalog c-commerce s.id/UKMJUWARA dan katalog pada situs www.ukmjuwara.id, kanal ini akan terus memproduksi katalog berkala dan melakukan pengembangan konten dengan menghadirkan variasi tema katalog seperti UKM JUWARA GLOBAL yang berfokus pada peningkatan penetrasi pasar global oleh pelaku UKM Iokal berikut dengan berita-berita sangat relevan dengan kebutuhan UKM untuk meroket.@endsection

    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 contact-info">
                    <div class="contact-title">
                        <h2>Kemitraan</h2>
                    </div>
                    <h4 class="mb-3">
                        <a href="https://ukmindonesia.id/" class="primary-color">ukmindonesia.id</a>
                    </h4>

                    <div class="contact-items">
                        <h5>Kontak UKM Juwara</h5>
                        <div class="item row">
                            <div class="col-1">
                                <i class="fas fa-map-marked fa-fw"></i>
                            </div>
                            <div class="col-11">
                                <p>
                                    <b>PT Indonesia Tumbuh Inklusif</b> <br />
                                    18 Office Park Lt.10 Unit A <br />
                                    Jl. TB Simatupang No 18
                                    Jakarta Selatan 12520
                                </p>
                            </div>
                        </div>
                        <div class="item row align-items-center mb-4">
                            <div class="col-1">
                                <i class="fas fa-envelope fa-fws"></i>
                            </div>
                            <div class="col-11">
                                <p>info@ukmindonesia.id</p>
                            </div>
                        </div>
                        {{-- <div class="item mb-4">
                            <i class="fas fa-phone-volume fa-fw"></i>
                            <p>021-212121</p>
                        </div> --}}
                        <div class="row mb-4">
                            <div class="col-12 col-lg-6">
                                <a href="https://www.facebook.com/ukmindonesia.org/">
                                    <div class="social facebook">
                                        <p class="me-2">Facebook</p>
                                        <i class="fab fa-facebook fa-fw "></i>
                                   </div>
                                </a>
                            </div>
                            <div class="col-12 col-lg-6">
                                <a href="https://www.instagram.com/ukmindonesiaid">
                                    <div class="social instagram">
                                        <p class="me-2">Instagram</p>
                                        <i class="fab fa-instagram fa-fw"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 col-lg-6">
                                <a href="https://www.youtube.com/channel/UCWcTn1tlRbqifDA3uY67Sfw">
                                    <div class="social youtube">
                                        <p class="me-2">Youtube</p>
                                        <i class="fab fa-youtube fa-fw"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div style="width: 100%"  class="corner-wrapper">
                        <iframe width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Universitas%20Indonesia%20Salemba+(UKM%20Juwara)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                    </iframe>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    
                </div>
            </div>

            <div class="supported-by">
                <div class="row">
                    <div class="col-12">
                        <div class="support-title">
                            <h3 class="text-center fw-light">Dipersembahkan oleh</h3>
                        </div>
                        <div id="supported">
                            @foreach ($sponsors as $sponsor)
                                <div>
                                    <img src="{{ Storage::url('sponsor-image/'.$sponsor->image) }}" alt="{{ $sponsor->title }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @if (count($sponsors_dukung) > 0)
            <div class="supported-by">
                <div class="row">
                    <div class="col-12">
                        <div class="support-title">
                            <h3 class="text-center fw-bold">Didukung oleh</h3>
                        </div>
                        <div id="supported_dukung">
                            @foreach ($sponsors_dukung as $sponsor)
                                <div>
                                    <img src="{{ Storage::url('sponsor-image/'.$sponsor->image) }}" alt="{{ $sponsor->title }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
        
            <script>
                $(document).ready(function(){
                    $('#supported').slick({
                        infinite: true,
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 4000,
                        responsive: [
                            {
                                breakpoint: 567,
                                settings: {
                                    slidesToShow: 2
                                }
                            },
                        ]
                    });
        
                    $('.header').slick();
        
                });
            </script>
        </div>
    </div>

</x-app-layout>
