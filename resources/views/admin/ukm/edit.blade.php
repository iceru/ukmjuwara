<x-admin-layout>
    <div class="admin-content">
        <h4>UKM</h4>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Sorry !</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('admin.ukm.update') }}" enctype="multipart/form-data" method="POST"
            class="mt-4 mb-5">
            @csrf
            <input type="hidden" name="id" value="{{ $ukm->id }}">

            <div class="row mb-3">
                <label for="title" class="col-12 col-md-2 col-form-label">Nama UKM</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" value="{{ $ukm->title }}" id="title" name="title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="description" class="col-12 col-md-2 col-form-label">Deskripsi</label>
                <div class="col-12 col-md-10">
                    <textarea type="text" class="form-control" id="description" name="description">{{ $ukm->description }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="title" class="col-12 col-md-2 col-form-label">Produk</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" value="{{ $ukm->product }}" id="product" name="product">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Images</label>
                <div class="col-sm-10">
                    <div class="d-flex mb-3">
                        @foreach ((array) json_decode($ukm->images) as $item)
                            <img class="image me-2" src="{{ Storage::url('ukm-image/' . $item) }}" alt="Image"
                                width="100" height="100">
                        @endforeach
                    </div>
                    <div class="input-group control-group increment">
                        <input type="file" name="image[]" class="form-control">
                        <div class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="fas fa-plus    "></i> Add</button>
                        </div>
                    </div>
                    <div class="clone hide">
                        <div class="control-group input-group" style="margin-top:10px">
                            <input type="file" name="image[]" class="form-control">
                            <div class="input-group-btn">
                                <button class="btn btn-danger" type="button"><i class="fas fa-times    "></i>
                                    Remove</button>
                            </div>
                        </div>
                    </div>
                    <p class="form-text text-muted">
                        Image tidak perlu di input kembali jika tidak ingin diganti
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="whatsapp" class="col-12 col-md-2 col-form-label">Whatsapp</label>
                <div class="col-12 col-md-10">
                    <input type="tel" class="form-control" id="whatsapp" value="{{ $ukm->whatsapp }}"
                        name="whatsapp">
                    <p class="form-text text-muted">
                        Contoh: 081211221111
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="instagram" class="col-12 col-md-2 col-form-label">Instagram Link</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" id="instagram" value="{{ $ukm->instagram }}"
                        name="instagram">
                </div>
            </div>
            <div class="row mb-3">
                <label for="catalog" class="col-12 col-md-2 col-form-label">Katalog</label>
                <div class="col-12 col-md-10">
                    <select class="form-select" name="catalog" id="catalog">
                        <option disabled>Pilih Katalog</option>
                        @foreach ($catalogs as $catalog)
                            <option {{ $ukm->catalog->id == $catalog->id ? 'selected' : '' }}
                                value="{{ $catalog->id }}">{{ $catalog->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="program" class="col-12 col-md-2 col-form-label">Program</label>
                <div class="col-12 col-md-10">
                    <select class="form-select" name="program" id="program">
                        <option disabled>Pilih Program</option>
                        @foreach ($programs as $program)
                            @if ($ukm->program_id)
                                <option {{ $ukm->program->id == $program->id ? 'selected' : '' }}
                                    value="{{ $program->id }}">{{ $program->title }}</option>
                            @else
                                <option value="{{ $program->id }}">{{ $program->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="catalog" class="col-12 col-md-2 col-form-label">Jenis Kelamin Pemilik</label>
                <div class="col-12 col-md-10">
                    <select class="form-select" name="owner_gender" id="owner_gender">
                        <option disabled selected>Pilih Jenis Kelamin Pemilik</option>
                        <option {{ $ukm->owner_gender == 'pria' ? 'selected' : '' }} value="pria">Pria</option>
                        <option {{ $ukm->owner_gender == 'wanita' ? 'selected' : '' }} value="wanita">Wanita</option>
                        <option {{ $ukm->owner_gender == 'pria-wanita' ? 'selected' : '' }} value="pria-wanita">Pria
                            & Wanita</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="achievement" class="col-12 col-md-2 col-form-label">Capaian</label>
                <div class="col-12 col-md-10">
                    <textarea type="text" class="form-control" id="description" name="achievement">{{ $ukm->achievement }}</textarea>
                </div>
            </div>
            <div class="row mb-3 non-global">
                <label for="operational_hours" class="col-12 col-md-2 col-form-label">Jam Operasional</label>
                <div class="col-12 col-md-5 mb-2 mb-md-0">
                    <input type="time" class="form-control" value="{{ $ukm->operational_hours }}"
                        id="operational_hours" name="operational_hours">
                </div>
                <div class="col-12 col-md-5">
                    <input type="time" class="form-control" value="{{ $ukm->operational_hours_end }}"
                        id="operational_hours_end" name="operational_hours_end">
                </div>
            </div>
            <div class="row mb-3 global">
                <label for="permission" class="col-12 col-md-2 col-form-label">Perizinan</label>
                <div class="col-12 col-md-10">
                    <textarea type="text" class="form-control" id="description" name="permission">{{ $ukm->permission }}</textarea>
                </div>
            </div>
            <div class="row mb-3 global">
                <label for="capacity" class="col-12 col-md-2 col-form-label">Kapasitas</label>
                <div class="col-12 col-md-10">
                    <textarea type="text" class="form-control" id="capacity" name="capacity">{{ $ukm->capacity }}</textarea>
                </div>
            </div>
            <div class="row mb-3 global">
                <label for="minimum_order" class="col-12 col-md-2 col-form-label">Minimum Order Quantity untuk
                    Ekspor</label>
                <div class="col-12 col-md-10">
                    <textarea type="text" class="form-control" id="minimum_order" name="minimum_order">{{ $ukm->minimum_order }}</textarea>
                </div>
            </div>
            <div class="row mb-3 global">
                <label for="fulfillment_duration" class="col-12 col-md-2 col-form-label">Durasi masa tunggu pemenuhan
                    pesanan</label>
                <div class="col-12 col-md-10">
                    <textarea type="text" class="form-control" id="fulfillment_duration" name="fulfillment_duration">{{ $ukm->fulfillment_duration }}</textarea>
                </div>
            </div>
            <div class="row mb-3 global">
                <label for="preferred_incoterm" class="col-12 col-md-2 col-form-label">Preferred Incoterm</label>
                <div class="col-12 col-md-10">
                    <textarea type="text" class="form-control" id="preferred_incoterm" name="preferred_incoterm">{{ $ukm->preferred_incoterm }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="tags" class="col-12 col-md-2 col-form-label">Kategori</label>
                <div class="col-12 col-md-10">
                    <select type="text" class="form-control" multiple aria-label="multiple size 4 select example"
                        id="categories" name="categories[]">
                        @foreach ($categories as $category)
                            <option {{ in_array($category->title, $categories_array) ? 'selected' : '' }}
                                value="{{ $category->title }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    <p class="form-text text-muted">
                        Untuk memilih lebih dari satu kategori, gunakan <b>Ctrl+Left Click</b>
                    </p>
                </div>
            </div>

            <div class="row mb-3">
                <label for="instagram" class="col-12 col-md-2 col-form-label">Alamat Lengkap</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" value="{{ $ukm->address }}" id="address"
                        name="address">
                </div>
            </div>
            <div class="row mb-3">
                <label for="instagram" class="col-12 col-md-2 col-form-label">Rentang Harga Produk</label>
                <div class="col-12 col-md-10">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <input type="text" class="form-control" id="min_price" name="min_price"
                                placeholder="Harga Minimum" value="{{ $ukm->min_price }}">
                        </div>
                        <div class="col-12 col-lg-6">
                            <input type="text" class="form-control" id="max_price" name="max_price"
                                placeholder="Harga Maksimum" value="{{ $ukm->max_price }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="catalog" class="col-12 col-md-2 col-form-label">Provinsi</label>
                <div class="col-12 col-md-10">
                    <select class="form-select" name="state" id="state">
                        <option disabled selected>Pilih Provinsi</option>
                        @foreach ($states as $state)
                            <option {{ $state['id'] == $ukm->state ? 'selected' : '' }}
                                value="{{ $state['id'] }}">
                                {{ $state['nama'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="catalog" class="col-12 col-md-2 col-form-label">Kota</label>
                <div class="col-12 col-md-10">
                    <select class="form-select" name="city" id="city">
                        <option disabled selected>Pilih Kota</option>
                    </select>
                </div>
            </div>

            <input type="text" name="city_name" id="city_name" hidden>
            <input type="text" name="state_name" id="state_name" hidden>

            <div class="row mb-3">
                <label for="catalog" class="col-12 col-md-2 col-form-label">Kecamatan</label>
                <div class="col-12 col-md-10">
                    <select class="form-select" name="subDistrict" id="subDistrict">
                        <option disabled selected>Pilih Kecamatan</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="catalog" class="col-12 col-md-2 col-form-label">Sliders UKM</label>
                <div class="col-12 col-md-10">
                    <input type="file" class="form-control" multiple name="sliders[]" accept="image/*">
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-12 col-md-2"></div>
                <div class="col-12 col-md-10">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $(".btn-success").click(function() {
                var html = $(".clone").html();
                $(".clone").after(html);
            });

            //hide all extra input
            $('.non-global').hide();
            $('.global').hide();
            var catalog = $('#catalog option:selected').text().toLowerCase();
            if (catalog.indexOf('global') !== -1)
                $('.global').show();
            else
                $('.non-global').show();

            $('body').on("click", ".btn-danger", function() {
                $(this).parents(".control-group").remove();
            });

            //Dependant Dropdown Input Location
            var state_name = $('#state').find('option:selected').text();
            $("#state_name").val(state_name);
            var stateID = $('#state').val();
            if (stateID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getCity') }}?state_id=" + stateID,
                    success: function(res) {
                        if (res) {
                            $("#city").empty();
                            $.each(res, function(key, value) {
                                if (value.id == '{{ $ukm->city }}') {
                                    $("#city").append(
                                        '<option selected value="' + value.id + '">' + value
                                        .nama + "</option>"
                                    );
                                } else {
                                    $("#city").append(
                                        '<option value="' + value.id + '">' + value.nama +
                                        "</option>"
                                    );
                                }
                            });
                            subDistrict();
                        } else {
                            $("#city").empty();
                        }
                    },
                });
            } else {
                $("#city").empty();
            }

            function subDistrict() {
                var city_name = $('#city').find('option:selected').text();
                $("#city_name").val(city_name);
                var cityID = $('#city').val();
                if (cityID) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('getSubdistrict') }}?city_id=" + cityID,
                        success: function(res) {
                            if (res) {
                                $("#subDistrict").empty();
                                $.each(res, function(key, value) {
                                    if (value.id === '{{ $ukm->subDistrict }}') {
                                        $("#subDistrict").append(
                                            '<option selected value="' + value.id + '">' +
                                            value.nama + "</option>"
                                        );
                                    } else {
                                        $("#subDistrict").append(
                                            '<option value="' + value.id + '">' + value
                                            .nama + "</option>"
                                        );
                                    }
                                });
                            } else {
                                $("#subDistrict").empty();
                            }
                        },
                    });
                } else {
                    $("#subDistrict").empty();
                }
            }
        });

        //check whether the catalog is ukm global or not
        $('#catalog').on('change', function() {
            $('.non-global').hide();
            $('.global').hide();
            var catalog = $('#catalog option:selected').text().toLowerCase();
            if (catalog.indexOf('global') !== -1)
                $('.global').show();
            else
                $('.non-global').show();
        })

        $("#state").on("change", function() {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getCity') }}?state_id=" + stateID,
                    success: function(res) {
                        if (res) {
                            $("#city").empty();
                            $.each(res, function(key, value) {
                                $("#city").append(
                                    '<option value="' + value.id + '">' + value.nama +
                                    "</option>"
                                );
                            });
                        } else {
                            $("#city").empty();
                        }
                    },
                });
            } else {
                $("#city").empty();
            }
        });

        $("#city").on("change", function() {
            var city_name = $(this).find('option:selected').text();
            $("#city_name").val(city_name);
            var cityID = $(this).val();
            if (cityID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getSubdistrict') }}?city_id=" + cityID,
                    success: function(res) {
                        if (res) {
                            $("#subDistrict").empty();
                            $.each(res, function(key, value) {
                                $("#subDistrict").append(
                                    '<option value="' + value.nama + '">' + value.nama +
                                    "</option>"
                                );
                            });
                        } else {
                            $("#subDistrict").empty();
                        }
                    },
                });
            } else {
                $("#subDistrict").empty();
            }
        });
    </script>

</x-admin-layout>
