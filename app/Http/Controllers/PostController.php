<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')->orderBy('id')->paginate();

        return view('home', compact('posts'));
    }

    public function store(PostStoreRequest $request): RedirectResponse
    {
        $id = DB::table('posts')->insertGetId([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ]);

        return redirect()->route('show-post-page', $id);
    }

    public function show($id)
    {
        $post = DB::table('posts')->find($id);

        if (!$post) {
            abort(404);
        }

        return view('post.show', compact('post'));
    }

    public function edit($id)
    {
        $post = DB::table('posts')->find($id);
        if (!$post) {
            abort(404);
        }

        return view('post.edit', compact('post'));
    }

    public function update($id, PostUpdateRequest $request)
    {
        $post = DB::table('posts')->find($id);

        if (!$post) {
            abort(404);
        }

        Db::table('posts')->where('id', $post->id)->update($request->validated());

        return redirect()->route('show-post-page', $id);
    }
}
