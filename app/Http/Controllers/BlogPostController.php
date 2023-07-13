<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;


class BlogPostController extends Controller
{

    // Show all blog posts
    public function index()
    {
        // $blogPosts = BlogPost::with('comments')->get();
        return  BlogPost::all();
        // return response()->json($blogPosts);
    }

    // Show a specific blog post and its comments
    public function show($id)
    {
        $blogPost = BlogPost::with('comments')->find($id);

        if (!$blogPost) {
            return response()->json(['message' => 'Blog post not found'], 404);
        }
        // return response()->json($blogPost);
        return view('detailspost', ['post' => $blogPost]);
    }

    // Create a new blog post
    public function store(Request $request)
    {
        $blogPost = BlogPost::create($request->all());

        return response()->json($blogPost, 201);
    }

    // Update an existing blog post
    public function update(Request $request, $id)
    {
        $blogPost = BlogPost::find($id);

        if (!$blogPost) {
            return response()->json(['message' => 'Blog post not found'], 404);
        }

        $blogPost->update($request->all());

        return response()->json($blogPost);
    }

    // Delete a blog post
    public function delete($id)
    {
        $blogPost = BlogPost::find($id);

        if (!$blogPost) {
            return response()->json(['message' => 'Blog post not found'], 404);
        }

        $blogPost->delete();

        return response()->json(['message' => 'Blog post deleted']);
    }

    public function addComment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $blogPost = BlogPost::find($id);

        if (!$blogPost) {
            return response()->json(['message' => 'Blog post not found'], 404);
        }

        $comment = new Comment($request->all());
        $blogPost->comments()->save($comment);
        return redirect('/blogposts/'.$id);
    }

    function getCommentbyId($postid)
    {
        return Comment::where('blogpost_id ', '=', $postid)->get();
    }
}
