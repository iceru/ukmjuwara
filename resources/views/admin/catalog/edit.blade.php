<x-admin-layout>
    <div class="admin-content">
        <h4>Katalog UKM</h4>
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
        <form action="{{ route('admin.catalog.update') }}" enctype="multipart/form-data" method="POST"
            class="mt-4 mb-5">
            @csrf
            <input type="hidden" name="id" value="{{ $catalog->id }}">

            <div class="row mb-3">
                <label for="title" class="col-12 col-md-2 col-form-label">Title</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" value="{{ $catalog->title }}" id="title" name="title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="description" class="col-12 col-md-2 col-form-label">Description</label>
                <div class="col-12 col-md-10">
                    <textarea class="form-control" name="description" id="description" rows="3">{{ $catalog->description }}</textarea>
                </div>
            </div>
            <div class="row mb-3" hidden>
                <label for="title" class="col-12 col-md-2 col-form-label">Slug</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" value="{{ $catalog->slug }}" id="slug" name="slug">
                </div>
            </div>
            <div class="row mb-3">
                <label for="link" class="col-12 col-md-2 col-form-label">Link Katalog</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" value="{{ $catalog->link }}" id="link" name="link">
                    <p class="form-text text-muted">
                        Link harus lengkap, contoh: https://google.com. <strong>Diisi jika katalog hanya berupa
                            link</strong>
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="image" class="col-12 col-md-2 col-form-label">Image</label>
                <div class="col-12 col-md-10">
                    <img src="{{ Storage::url('catalog-image/' . $catalog->image) }}" alt="image"
                        class="mb-3" width="200">
                    <input type="file" class="form-control" id="image" name="image">
                    <p class="form-text text-muted">
                        Image tidak perlu di input kembali jika tidak ingin diganti
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="catalog" class="col-12 col-md-2 col-form-label">Featured</label>
                <div class="col-12 col-md-10">
                    <select class="form-select" name="featured" id="featured">
                        <option {{ $catalog->featured == 'no' ? 'selected' : '' }} value="no">No</option>
                        <option {{ $catalog->featured == 'yes' ? 'selected' : '' }} value="yes">Yes</option>
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
    </div>

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();

            $(".btn-success").click(function() {
                var html = $(".clone").html();
                $(".clone").after(html);
            });

            $('body').on("click", ".btn-danger", function() {
                $(this).parents(".control-group").remove();
            });
        });
    </script>

</x-admin-layout>
