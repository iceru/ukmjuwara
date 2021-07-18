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
    
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('admin.ukm.update') }}" enctype="multipart/form-data" method="POST" class="mt-4 mb-5">
            @csrf
            <input type="hidden" name="id" value="{{$ukm->id}}">

            <div class="row mb-3">
                <label for="title" class="col-12 col-md-2 col-form-label">Title</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" value="{{ $ukm->title }}" id="title" name="title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="description" class="col-12 col-md-2 col-form-label">Description</label>
                <div class="col-12 col-md-10">
                    <textarea type="text" class="form-control" id="description" name="description">{{ $ukm->description }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <div class="d-flex mb-3">
                        @foreach ((array)json_decode($ukm->images) as $item)
                            <img class="me-2" src="{{Storage::url('ukm-image/'.$item)}}" alt="Image" width="100">
                        @endforeach
                    </div>
                    <div class="input-group control-group increment" >
                        <input type="file" name="image[]" class="form-control">
                        <div class="input-group-btn">
                          <button class="btn btn-success" type="button"><i class="fas fa-plus    "></i> Add</button>
                        </div>
                    </div>
                      <div class="clone hide">
                        <div class="control-group input-group" style="margin-top:10px">
                          <input type="file" name="image[]" class="form-control">
                          <div class="input-group-btn">
                            <button class="btn btn-danger" type="button"><i class="fas fa-times    "></i> Remove</button>
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
                    <input type="tel" class="form-control" id="whatsapp" value="{{ $ukm->whatsapp }}" name="whatsapp">
                    <p class="form-text text-muted">
                        Contoh: 081211221111
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="instagram" class="col-12 col-md-2 col-form-label">Instagram Link</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" id="instagram" value="{{ $ukm->instagram }}" name="instagram">
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
