<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(5);

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpeg,jpg,svg,gif|max:2048',
            'title' => 'required|min:5',
            'content' => 'required|min:10',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        Post::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'image' => 'image|mimes:png,jpeg,jpg,svg,gif|max:2048',
            'title' => 'required|min:5',
            'content' => 'required|min:10',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());
            Storage::delete('public/posts/' . $post->image);
            $post->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'content' => $request->content,
            ]);
        } else {
            $post->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);
        }
        return redirect()->route('posts.index')->with('success', 'Data Berhasil Diubah');
    }

    public function destroy(Post $post)
    {
        Storage::delete('public/posts/' . $post->image);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Data Berhasil Dihapus');
    }
}
