<x-admin-layout>
    <div class="admin-content">
        <h4>Sponsor</h4>
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

        <form action="{{ route('admin.sponsor.store') }}" enctype="multipart/form-data" method="POST" class="mt-4 mb-5">
            @csrf
            <div class="row mb-3">
                <label for="title" class="col-12 col-md-2 col-form-label">Title</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" id="title" name="title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="link" class="col-12 col-md-2 col-form-label">Link</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" id="link" name="link">
                    <p class="form-text text-muted">
                       Opsional
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="image" class="col-12 col-md-2 col-form-label">Image</label>
                <div class="col-12 col-md-10">
                    <input type="file" class="form-control" id="image" name="image"></input>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-12 col-md-2"></div>
                <div class="col-12 col-md-10">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>

        <table class="table contain" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sponsors as $sponsor)
                <tr>
                    <td scope="row">{{$loop->iteration}}</td>
                    <td>{{ $sponsor->title }}</td>
                    <td>{{ $sponsor->link }}</td>
                    <td><img class="mb-2" src="{{Storage::url('sponsor-image/'.$sponsor->image )}}" alt="Image" width="70" height="70"></td>
                    <td><a class="btn btn-primary btn-small d-flex align-items-center justify-content-center mb-2" href="/admin/sponsor/edit/{{$sponsor->id}}"><i class="fas fa-edit me-1"></i> Edit</a>
                        <a class="btn btn-danger btn-small d-flex align-items-center justify-content-center" href="/admin/sponsor/delete/{{$sponsor->id}}" onclick="return confirm('Hapus data ini?')"><i class="fa fa-trash me-1" aria-hidden="true"></i> Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#table').DataTable([
                responsive: true
            ]);

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
