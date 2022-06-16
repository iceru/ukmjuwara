<x-admin-layout>
    <div class="admin-content">
        <h4>Kategori Produk</h4>

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

        <form action="{{ route('admin.category.store') }}" enctype="multipart/form-data" method="POST"
            class="mt-4 mb-5">
            @csrf
            <div class="row mb-3">
                <label for="title" class="col-12 col-md-2 col-form-label">Title</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" id="title" name="title">
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

        <table class="table" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $category->title }}</td>

                        <td>
                            @if ($category->image)
                                <img class="mb-2"
                                    src="{{ Storage::url('category-image/' . $category->image) }}" alt="Image"
                                    width="60">
                            @else
                                -
                            @endif
                        </td>

                        <td><a class="btn btn-primary btn-small d-flex align-items-center justify-content-center mb-2"
                                href="{{ route('admin.category.edit', $category->id) }}"><i
                                    class="fas fa-edit me-1"></i> Edit</a>
                            <a class="btn btn-danger btn-small d-flex align-items-center justify-content-center"
                                href="/admin/category/delete/{{ $category->id }}"
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
