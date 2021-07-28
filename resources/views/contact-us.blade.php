<x-app-layout>
    @section('title')
        Kemitraan - UKM Juwara
    @endsection

    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 contact-info">
                    <div class="contact-title">
                        <h2>Kemitraan</h2>
                    </div>
                    <h5>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tempus dictumst magna id leo lectus sit.
                    </h5>

                    <div class="contact-items">
                        <h5>Kontak UKM Juwara</h5>
                        <div class="item">
                            <i class="fas fa-map-marked fa-fw"></i>
                            <p>Alamat UKM Juwara</p>
                        </div>
                        <div class="item">
                            <i class="fas fa-envelope fa-fw"></i>
                            <p>ukmjuwara@gmail.com</p>
                        </div>
                        <div class="item mb-4">
                            <i class="fas fa-phone-volume fa-fw"></i>
                            <p>021-212121</p>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <div class="whatsapp">
                                 <p class="me-2">Whatsapp</p>
                                 <i class="fab fa-whatsapp fa-fw "></i>
                            </div>
                            <div class="instagram">
                                <p class="me-2">Instagram</p>
                                <i class="fab fa-instagram fa-fw"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">

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
                            <h3 class="text-center fw-bold">Didukung Oleh</h3>
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
        
            <script>
                $(document).ready(function(){
                    $('#supported').slick({
                        infinite: true,
                        slidesToShow: 3,
                        slidesToScroll: 1
                    });
        
                    $('.header').slick();
        
                });
            </script>
        </div>
    </div>

</x-app-layout>
