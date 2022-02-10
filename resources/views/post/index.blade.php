@extends('layout.master')
@section('content')
<div class="container mt-5">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow border-0 rounded">
        <div class="card-body">
          <a href="{{route('posts.create')}}" class="mb-3 btn btn-success">Tambah Post</a>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Content</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($posts as $post)
                  <tr>
                    <td class="text-center">
                      <img class="img-fluid rounded" width="50px" src="{{Storage::url('public/posts/').$post->image}}" alt="">
                    </td>
                    <td>{{$post->title}}</td>
                    <td>{!!$post->content!!}</td>
                    <td class="text-center">
                      <form onsubmit="return confirm('Apakah Anda Yakin Ingin Mneghapus?')" action="{{route('posts.destroy', $post->id)}}" method="post">
                        <a href="{{route('posts.edit', $post->id)}}" class="btn btn-warning">Edit</a>
                        |
                        @csrf
                        @method('DELETE')
                        <button class="btn-danger btn" type="submit">Hapus</button>
                      </form>
                    </td>
                  </tr>
              @empty
                  <div class="alert alert-danger">
                    Data Post Belum Tersedia
                  </div>
              @endforelse
            </tbody>
          </table>
          {{ $posts->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection