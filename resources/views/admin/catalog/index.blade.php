<x-admin-layout>
    <div class="admin-content">
        <h4>Katalog UKM</h4>

        @if (count($errors) > 0)
            <div class="alert alert-danger mt-3">
                Terdapat Masalah Pada Input Data<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.catalog.store') }}" enctype="multipart/form-data" method="POST"
            class="mt-4 mb-5">
            @csrf
            <div class="row mb-3">
                <label for="title" class="col-12 col-md-2 col-form-label">Title</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" id="title" name="title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="description" class="col-12 col-md-2 col-form-label">Description</label>
                <div class="col-12 col-md-10">
                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="link" class="col-12 col-md-2 col-form-label">Link Katalog</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" id="link" name="link">
                    <p class="form-text text-muted">
                        Link harus lengkap, contoh: https://google.com. <strong>Diisi jika katalog hanya berupa
                            link</strong>
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="image" class="col-12 col-md-2 col-form-label">Image</label>
                <div class="col-12 col-md-10">
                    <input type="file" class="form-control" id="image" name="image">
                </div>
            </div>

            <div class="row mb-3">
                <label for="catalog" class="col-12 col-md-2 col-form-label">Featured</label>
                <div class="col-12 col-md-10">
                    <select class="form-select" name="featured" id="featured">
                        <option value="no" selected>No</option>
                        <option value="yes">Yes</option>
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
                    <th>Slug</th>
                    <th>Link</th>
                    <th>Featured</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($catalogs as $catalog)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $catalog->title }}</td>
                        <td>{{ $catalog->description }}</td>
                        <td>{{ $catalog->slug }}</td>
                        <td>{{ $catalog->link }}</td>
                        <td class="text-capitalize">{{ $catalog->featured }}</td>
                        <td><img src="{{ Storage::url('catalog-image/' . $catalog->image) }}" width="150" alt=""></td>
                        <td><a class="btn btn-primary btn-small d-flex align-items-center justify-content-center mb-2"
                                href="{{ route('admin.catalog.edit', $catalog->id) }}"><i
                                    class="fas fa-edit me-1"></i> Edit</a>
                            <a class="btn btn-danger btn-small d-flex align-items-center justify-content-center"
                                href="/admin/catalog/delete/{{ $catalog->id }}"
                                onclick="return confirm('Hapus data ini?')"><i class="fa fa-trash me-1"
                                    aria-hidden="true"></i> Delete</a>
                        </td>
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
