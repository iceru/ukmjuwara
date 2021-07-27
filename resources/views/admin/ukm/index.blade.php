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
                <label for="title" class="col-12 col-md-2 col-form-label">Title</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" id="inputTitle" name="inputTitle">
                </div>
            </div>
            <div class="row mb-3">
                <label for="description" class="col-12 col-md-2 col-form-label">Description</label>
                <div class="col-12 col-md-10">
                    <textarea type="text" class="form-control" id="inputDescription" name="inputDescription"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <div class="input-group control-group increment" >
                        <input type="file" name="inputImage[]" class="form-control">
                        <div class="input-group-btn">
                          <button class="btn btn-success" type="button"><i class="fas fa-plus    "></i> Add</button>
                        </div>
                      </div>
                      <div class="clone hide">
                        <div class="control-group input-group" style="margin-top:10px">
                          <input type="file" name="inputImage[]" class="form-control">
                          <div class="input-group-btn">
                            <button class="btn btn-danger" type="button"><i class="fas fa-times    "></i> Remove</button>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="whatsapp" class="col-12 col-md-2 col-form-label">Whatsapp</label>
                <div class="col-12 col-md-10">
                    <input type="tel" class="form-control" id="inputWhatsapp" name="inputWhatsapp">
                    <p class="form-text text-muted">
                        Contoh: 081211221111
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="instagram" class="col-12 col-md-2 col-form-label">Instagram Link</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" id="inputInstagram" name="inputInstagram">
                </div>
            </div>
            <div class="row mb-3">
                <label for="catalog" class="col-12 col-md-2 col-form-label">Katalog</label>
                <div class="col-12 col-md-10">
                    <select class="form-select" name="inputCatalog" id="inputCatalog">
                        @foreach ($catalogs as $catalog)
                            <option value="{{ $catalog->id }}">{{ $catalog->title }}</option>
                        @endforeach
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
                    <th>Whatsapp</th>
                    <th>Instagram</th>
                    <th>Katalog</th>
                    <th>Featured</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ukms as $ukm)
                <tr>
                    <td scope="row">{{$loop->iteration}}</td>
                    <td>{{ $ukm->title }}</td>
                    <td>{!! substr($ukm->description, 0, 40) . '...' !!}</td>
                    <td> 
                        @foreach ((array)json_decode($ukm->images) as $item)
                        <img class="mb-2" src="{{Storage::url('ukm-image/'.$item)}}" alt="Image" width="100">
                        @endforeach
                    </td>
                    <td>{{ $ukm->whatsapp }}</td>
                    <td>{{ $ukm->instagram }}</td>
                    <td>{{ $ukm->catalog->title }}</td>
                    <td>{{ $ukm->featured }}</td>
                    <td><a class="btn btn-primary btn-small d-flex align-items-center justify-content-center mb-2" href="/admin/ukm/edit/{{$ukm->id}}"><i class="fas fa-edit me-1"></i> Edit</a>
                        <a class="btn btn-danger btn-small d-flex align-items-center justify-content-center" href="/admin/ukm/delete/{{$ukm->id}}" onclick="return confirm('Hapus data ini?')"><i class="fa fa-trash me-1" aria-hidden="true"></i> Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();

            $(".btn-success").click(function(){
                var html = $(".clone").html();
                $(".clone").after(html);
            });

            $('body').on("click", ".btn-danger", function() {
                $(this).parents(".control-group").remove();
            });
        });

        tinymce.init({
          selector: 'textarea',
          toolbar_mode: 'floating',
          tinycomments_mode: 'embedded',
          tinycomments_author: 'Author name',
          height: "480"
       });
    </script>

</x-admin-layout>
