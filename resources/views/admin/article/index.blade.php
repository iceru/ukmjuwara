<x-admin-layout>
    <div class="admin-content">
        <h4>Artikel</h4>
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

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.article.store') }}" enctype="multipart/form-data" method="POST"
            class="mt-4 mb-5">
            @csrf
            <div class="row mb-3">
                <label for="title" class="col-12 col-md-2 col-form-label">Title</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" id="title" name="title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="description" class="col-12 col-md-2 col-form-label">Article Content</label>
                <div class="col-12 col-md-10">
                    <textarea type="text" class="form-control" id="description" name="description"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="image" class="col-12 col-md-2 col-form-label">Featured Image</label>
                <div class="col-12 col-md-10">
                    <input type="file" class="form-control" id="image" name="image"></input>
                </div>
            </div>
            <div class="row mb-3">
                <label for="author" class="col-12 col-md-2 col-form-label">Author</label>
                <div class="col-12 col-md-10">
                    <select class="form-select" name="author" id="author">
                        @foreach (App\Models\User::all() as $user)
                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="time_read" class="col-12 col-md-2 col-form-label">Read Time</label>
                <div class="col-12 col-md-10">
                    <input type="number" class="form-control" id="time_read" name="time_read">
                    <p class="form-text text-muted">
                        Dalam satuan menit
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="tags" class="col-12 col-md-2 col-form-label">Tags</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" id="tags" name="tags">
                    <p class="form-text text-muted">
                        (Tag dipisah dengan spasi, contoh: tag1 tag2 tag3)
                    </p>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-12 col-md-2"></div>
                <div class="col-12 col-md-10">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Featured Image</th>
                        <th>Author</th>
                        <th>Read Time</th>
                        <th>Tags</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $article->title }}</td>
                            <td>{!! strlen($article->description) > 150 ? substr($article->description, 0, 150) . '...' : $article->description !!}</td>
                            <td><img class="mb-2"
                                    src="{{ Storage::url('article-image/' . $article->image) }}" alt="Image"
                                    width="100"></td>
                            <td>{{ $article->author }}</td>
                            <td>{{ $article->time_read }} menit</td>
                            <td>
                                @foreach ($article->tags as $tag)
                                    {{ $tag->tag_name }}
                                @endforeach
                            </td>
                            <td><a class="btn btn-warning btn-small d-flex align-items-center justify-content-center mb-2"
                                    href="/berita/{{ $article->slug }}" target="_blank"><i class="fas fa-eye me-1"
                                        aria-hidden="true"></i> Preview</a>
                                <a class="btn btn-primary btn-small d-flex align-items-center justify-content-center mb-2"
                                    href="/admin/article/edit/{{ $article->id }}"><i class="fas fa-edit me-1"></i>
                                    Edit</a>
                                <a class="btn btn-danger btn-small d-flex align-items-center justify-content-center"
                                    href="/admin/article/delete/{{ $article->id }}"
                                    onclick="return confirm('Hapus data ini?')"><i class="fa fa-trash me-1"
                                        aria-hidden="true"></i> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
