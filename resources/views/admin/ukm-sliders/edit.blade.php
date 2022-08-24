<x-admin-layout>
    <div class="admin-content">
        <h4>Update Slider Images</h4>
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

        <form action="{{ route('admin.ukm-sliders.update') }}" enctype="multipart/form-data" method="POST"
            class="mt-4 mb-5">
            @csrf
            <input type="text" name="id" value="{{ $slider->id }}" hidden readonly>
            <div class="row mb-3">
                <label for="link" class="col-12 col-md-2 col-form-label">Link</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" value="{{ $slider->link }}" id="link"
                        name="link">
                </div>
            </div>
            <div class="row mb-3">
                <label for="image" class="col-12 col-md-2 col-form-label">Image</label>
                <div class="col-12 col-md-10 edit-image">
                    <img src="{{ Storage::url('slider-image/' . $slider->image) }}" alt="image" class="mb-3"
                        width="200">
                    <input type="file" class="form-control" id="image" name="image"></input>
                    <p class="form-text text-muted">
                        Image tidak perlu di input kembali jika tidak ingin diganti
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="ukm" class="col-12 col-md-2 col-form-label">UKM</label>
                <div class="col-12 col-md-10">
                    <select class="form-select" name="ukm" id="dselect">
                        @foreach ($ukms as $ukm)
                            <option {{ $slider->ukm->id == $ukm->id ? 'selected' : '' }} value={{ $ukm->id }}>
                                {{ $ukm->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
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
