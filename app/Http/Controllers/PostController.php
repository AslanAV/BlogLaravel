<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
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
}
