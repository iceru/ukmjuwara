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
    
        @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('admin.article.store') }}" enctype="multipart/form-data" method="POST" class="mt-4 mb-5">
            @csrf
            <div class="row mb-3">
                <label for="title" class="col-12 col-md-2 col-form-label">Title</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" value="{{ $article->title }}" id="title" name="title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="description" class="col-12 col-md-2 col-form-label">Article Content</label>
                <div class="col-12 col-md-10">
                    <textarea type="text" class="form-control" id="description" name="description">{{ $article->description }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="image" class="col-12 col-md-2 col-form-label">Featured Image</label>
                <div class="col-12 col-md-10">
                    <img src="{{ Storage::url('article-image/'.$article->image) }}" alt="image" class="mb-3" width="200">
                    <input type="file" class="form-control" id="image" name="image"></input>
                    <p class="form-text text-muted">
                        Image tidak perlu di input kembali jika tidak ingin diganti
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="author" class="col-12 col-md-2 col-form-label">Author</label>
                <div class="col-12 col-md-10">
                    <select class="form-select" name="author" id="author">
                        @foreach (App\Models\User::all() as $user)
                            <option {{old('author') == $user->name ? 'selected' : ''}} value="{{ $user->name }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="time_read" class="col-12 col-md-2 col-form-label">Read Time</label>
                <div class="col-12 col-md-10">
                    <input type="number" value="{{ $article->time_read }}" class="form-control" id="time_read" name="time_read">
                </div>
            </div>
            <div class="row mb-3">
                <label for="tags" class="col-12 col-md-2 col-form-label">Tags</label>
                <div class="col-12 col-md-10">
                    <input type="text" value="@foreach ($article->tags as $tag){{$tag->tag_name}} @endforeach"  class="form-control" id="tags" name="tags">
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
