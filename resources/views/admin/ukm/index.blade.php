<x-admin-layout>
    <div class="admin-content">
        <h4>UKM</h4>
        @if (count($errors) > 0)
        <div class="alert alert-danger mt-3">
            <strong>Sorry !</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('admin.ukm.store') }}" enctype="multipart/form-data" method="POST" class="mt-4 mb-5">
            @csrf
            <div class="row mb-3">
                <label for="title" class="col-12 col-md-2 col-form-label">Nama UKM</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" value="{{ old('title') }}" id="title" name="title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="description" class="col-12 col-md-2 col-form-label">Deskripsi</label>
                <div class="col-12 col-md-10">
                    <textarea type="text" class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Images</label>
                <div class="col-sm-10">
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
                </div>
            </div>
            <div class="row mb-3">
                <label for="whatsapp" class="col-12 col-md-2 col-form-label">Whatsapp</label>
                <div class="col-12 col-md-10">
                    <input type="tel" class="form-control" value="{{ old('whatsapp') }}" id="whatsapp" name="whatsapp">
                    <p class="form-text text-muted">
                        Contoh: <b>081211221111</b>
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="instagram" class="col-12 col-md-2 col-form-label">Instagram Link</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" value="{{ old('instagram') }}" id="instagram" name="instagram">
                    <p class="form-text text-muted">
                        Full link. Contoh: <b>https://www.instagram.com/ukmindonesiaid/</b>
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="catalog" class="col-12 col-md-2 col-form-label">Katalog</label>
                <div class="col-12 col-md-10">
                    <select class="form-select" name="catalog" id="catalog">
                        <option disabled selected>Pilih Katalog</option>
                        @foreach ($catalogs as $catalog)
                        <option {{ old('catalog') == $catalog->id ? "selected" : "" }} value="{{ $catalog->id }}">{{ $catalog->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="tags" class="col-12 col-md-2 col-form-label">Kategori</label>
                <div class="col-12 col-md-10">
                    <select type="text" class="form-control" multiple aria-label="multiple size 4 select example" id="categories" name="categories[]">
                        @foreach ($categories as $category)
                            <option @if(old('categories[]')) {{ in_array($category->title, old('categories[]')) ? "selected" : "" }} @endif value="{{ $category->title }}">{{ $category->title }}</option>
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
                    <input type="text" class="form-control" value="{{ old('address') }}" id="address" name="address">
                </div>
            </div>
            <div class="row mb-3">
                <label for="catalog" class="col-12 col-md-2 col-form-label">Provinsi</label>
                <div class="col-12 col-md-10">
                    <select class="form-select" name="state" id="state">
                        <option disabled selected>Pilih Provinsi</option>
                        @foreach ($states as $state)
                        <option {{ old('state') == $state['id'] ? "selected" : "" }} value="{{ $state['id']}}">{{ $state['nama']}}</option>
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
            <div class="row mb-3">
                <label for="catalog" class="col-12 col-md-2 col-form-label">Kecamatan</label>
                <div class="col-12 col-md-10">
                    <select class="form-select" name="subDistrict" id="subDistrict">
                        <option disabled selected>Pilih Kecamatan</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-12 col-md-2"></div>
                <div class="col-12 col-md-10">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>

        <table class="table" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Images</th>
                    <th>Katalog</th>
                    <th>Kategori</th>
                    <th>Alamat</th>
                    <th>Whatsapp</th>
                    <th>Instagram</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ukms as $ukm)
                <tr>
                    <td scope="row">{{$loop->iteration}}</td>
                    <td>{{ $ukm->title }}</td>
                    <td class="description">{!! strlen($ukm->description) > 50 ? substr($ukm->description, 0, 50).'...' : $ukm->description !!}</td>
                    <td>
                        @foreach ((array)json_decode($ukm->images) as $item)
                        <div>
                            <img class="mb-2" src="{{Storage::url('ukm-image/'.$item)}}" alt="Image" width="100"
                                height="100">
                        </div>
                        @endforeach
                    </td>
                    <td>{{ $ukm->catalog->title }}</td>
                    <td class="categories">@foreach ($ukm->categories as $item)
                        <span>{{ $item->title }}</span>
                        @endforeach</td>
                    <td>{{ $ukm->address }}</td>
                    <td>{{ $ukm->whatsapp }}</td>
                    <td>{{ $ukm->instagram }}</td>

                    <td><a class="btn btn-primary btn-small d-flex align-items-center justify-content-center mb-2"
                            href="/admin/ukm/edit/{{$ukm->id}}"><i class="fas fa-edit me-1"></i> Edit</a>
                        <a class="btn btn-danger btn-small d-flex align-items-center justify-content-center"
                            href="/admin/ukm/delete/{{$ukm->id}}" onclick="return confirm('Hapus data ini?')"><i
                                class="fa fa-trash me-1" aria-hidden="true"></i> Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                responsive: true
            });

            $('.clone.hide .btn-danger').attr('disabled', 'disabled');
            $(".btn-success").click(function(){
                debugger
                var html = $(".clone").html();
                $(".clone").after(html);
                $('.btn-danger').removeAttr('disabled');
                $('.clone.hide .btn-danger').attr('disabled', 'disabled');
            });


            $('body').on("click", ".btn-danger", function() {
                $(this).parents(".control-group").remove();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
        var stateID = $('#state').val();
            if (stateID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('getCity')}}?state_id=" + stateID,
                    success: function (res) {
                        if (res) {
                            $("#city").empty();
                            $.each(res, function (key, value) {
                                if(value.id == "{{ old('city') }}") {
                                    $("#city").append(
                                        '<option selected value="' + value.id + '">' + value.nama + "</option>"
                                    );
                                } else {
                                    $("#city").append(
                                        '<option value="' + value.id + '">' + value.nama + "</option>"
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

           function subDistrict () {
               debugger
                var city_name = $('#city').find('option:selected').text();
                $("#city_name").val(city_name);
                var cityID = $('#city').val();
                if (cityID) {
                    $.ajax({
                        type: "GET",
                        url: "{{url('getSubdistrict')}}?city_id=" + cityID,
                        success: function (res) {
                            if (res) {
                                $("#subDistrict").empty();
                                $.each(res, function (key, value) {
                                    if(value.id === "{{ old('subDistrict')}}") {
                                        $("#subDistrict").append(
                                            '<option selected value="' + value.id + '">' + value.nama + "</option>"
                                        );
                                    } else {
                                        $("#subDistrict").append(
                                            '<option value="' + value.id + '">' + value.nama + "</option>"
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

        $("#state").on("change", function () {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('getCity')}}?state_id=" + stateID,
                    success: function (res) {
                        if (res) {
                            $("#city").empty();
                            $.each(res, function (key, value) {
                                $("#city").append(
                                    '<option selected value="' + value.id + '">' + value.nama + "</option>"
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

        $("#city").on("change", function () {
            var city_name = $(this).find('option:selected').text();
            $("#city_name").val(city_name);
            var cityID = $(this).val();
            if (cityID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('getSubdistrict')}}?city_id=" + cityID,
                    success: function (res) {
                        if (res) {
                            $("#subDistrict").empty();
                            $.each(res, function (key, value) {
                                $("#subDistrict").append(
                                    '<option selected value="' + value.id + '">' + value.nama + "</option>"
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