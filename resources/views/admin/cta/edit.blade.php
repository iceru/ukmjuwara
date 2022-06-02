<x-admin-layout>
    <div class="admin-content">
        <h4>Homepage CTA</h4>

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
        <form action="{{ route('admin.cta.update') }}" enctype="multipart/form-data" method="POST"
            class="mt-4 mb-5">
            @csrf
            <input type="hidden" name="id" value="{{ $cta->id }}">

            <div class="row mb-3">
                <label for="title" class="col-12 col-md-2 col-form-label">Title</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" value="{{ $cta->title }}" id="title" name="title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="title" class="col-12 col-md-2 col-form-label">Description</label>
                <div class="col-12 col-md-10">
                    <textarea class="form-control" name="description" id="description" rows="3">{{ $cta->description }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="link" class="col-12 col-md-2 col-form-label">Link</label>
                <div class="col-12 col-md-10">
                    <input type="text" class="form-control" value="{{ $cta->link }}" id="link" name="link">
                </div>
            </div>
            <div class="row mb-3">
                <label for="image" class="col-12 col-md-2 col-form-label">Image</label>
                <div class="col-12 col-md-10 edit-image">
                    @if ($cta->image)
                        <img src="{{ Storage::url('category-image/' . $cta->image) }}" alt="image"
                            class="mb-3" width="200">
                    @endif
                    <input type="file" class="form-control" id="image" name="image"></input>
                    @if ($cta->image)
                        <p class="form-text text-muted">
                            Image tidak perlu di input kembali jika tidak ingin diganti
                        </p>
                    @endif

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
</x-admin-layout>
