<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Tables\Posts;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Requests\PostStoreRequest;

class PostController extends Controller
{

    public function index()
    {
        return view('posts.index' , 
        [
            'posts' => Posts::class,  

        ]);
    }

    public function create()
    {
        $categories = Category::pluck('name','id')->toArray();

        return view('posts.create', compact('categories'));

    }

    public function store(PostStoreRequest $request)
    {
        Post::create($request->validated());
        Toast::title('Post was created!')
        ->success()
        ->autoDismiss(3);


        return redirect()->route('posts.index');

    }

    public function show($id)
    {
        //
    }

    public function edit(Post $post)
    {
        $categories = Category::pluck('name','id')->toArray();

        return view('posts.edit', compact('post','categories'));

    }

    public function update(PostStoreRequest $request, Post $post)
    {
        $post->update($request->validated());
        Toast::title('Post was Updated!')
        ->info()
        ->autoDismiss(3);

        return redirect()->route('posts.index');

    }

    public function destroy(Post $post)
    {
        $post->delete();
        Toast::title('Post Deleted Successfully!')
        ->warning()
        ->autoDismiss(3);

        return redirect()->back();

    }

}
