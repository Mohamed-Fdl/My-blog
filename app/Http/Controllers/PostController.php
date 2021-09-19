<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $recent_posts = Post::orderByDesc('created_at')->skip(3)->take(5)->get();
        if (request()->category) {
            $post = Post::with('categories')->whereHas('categories', function ($q) {
                $q->where('slug', request()->category);
            })->paginate(3);
            return view('welcome', ['posts' => $post, 'recent_posts' => $recent_posts]);
        }
        $posts = Post::orderByDesc('created_at')->paginate(3);
        return view('welcome', ['posts' => $posts, 'recent_posts' => $recent_posts]);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->get();
        $recent_posts = Post::orderByDesc('created_at')->skip(3)->take(5)->get();
        return view('blog', ['single' => $post, 'recent_posts' => $recent_posts]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required',
            'name' => 'required',
            'content' => 'required',
            'image' => 'image|required'
        ]);
        $validated['slug'] = Str::slug($validated['name'], '-');
        $path = $request->file('image')->store('avatars');
        $validated['image'] = $path;
        $post = Post::create($validated);
        $id = $post->id;
        if ($request->category_id) {
            DB::table('category_post')->insert([
                'category_id' => $request->category_id,
                'post_id' => $id
            ]);
        }
        $request->session()->flash('success', 'Post created successfully!');
        return back();
    }

    public function search()
    {
        $recent_posts = Post::orderByDesc('created_at')->skip(3)->take(5)->get();
        $q = request()->q;
        $post = Post::where('name', 'like', "%$q%")->orWhere('content', 'like', "%$q%")->get();
        return view('welcome', ['posts' => $post, 'recent_posts' => $recent_posts]);
    }

    public function store_comment(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'comment' => 'required',
            'post_id' => 'required'
        ]);
        Comment::create($validated);
        $request->session()->flash('success', 'Comment posted successfully!');
        return back();
    }

    public function seeAll()
    {
        $post = Post::orderByDesc('created_at')->get();
        return view('admin.posts.resume', ['posts' => $post]);
    }

    public function edit(Request $request, $id)
    {
        $validated = $request->validate([
            'author' => 'required',
            'name' => 'required',
            'content' => 'required',
            'image' => 'image|required'
        ]);
        $validated['slug'] = Str::slug($validated['name'], '-');
        $path = $request->file('image')->store('avatars');
        $validated['image'] = $path;
        Post::where('id', $id)->update($validated);
        return redirect('/admin/posts');
    }
}
