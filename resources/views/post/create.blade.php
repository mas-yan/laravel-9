@extends('layout.master')
@section('content')
    <div class="container my-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card shadow border-0 rounded">
            <div class="card-body">
              <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="image" class="font-weight-bold">Image</label>
                  <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                  @error('image')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="title" class="font-weight-bold">Title</label>
                  <input type="text" name="title" placeholder="Masukkan Title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror">
                  @error('title')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="Content" class="font-weight-bold">Content</label>
                  <textarea name="content" placeholder="Masukkan Content" class="form-control @error('content') is-invalid @enderror">{{old('content')}}</textarea>
                  @error('content')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
                <button class="btn-md btn-primary btn" type="submit">Add</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('script')
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'content' );
</script>
@endsection