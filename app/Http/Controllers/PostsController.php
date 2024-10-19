<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\CommonMark\MarkdownConverter;


class PostsController extends Controller
{

    /**
     * @var MarkdownConverterInterface
     */
    protected $converter;

    /**
     * PostsController constructor.
     *
     * @param MarkdownConverterInterface $converter
     */
    public function __construct(MarkdownConverter $converter)
    {
        $this->converter = $converter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): Renderable
    {
        $posts = Post::orderBy('id', 'desc')->paginate(9);
       // dd($posts);
        return view('index', compact('posts'));
    }

    public function list()
    {
        //dd('hi');
        $posts = Post::all();
        // dd($posts);
        return view('list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($slug)
    {
        if (is_numeric($slug)) {
            $post = Post::findOrFail($slug);
        } else {
            $post = Post::where('slug', $slug)->firstOrFail();
        }

        // Prevent showing draft posts to the public
        if (!$post->publish) {
            session()->flash('error', 'This post is not published yet!');
            return redirect('/');
        }

        $post->description = $this->converter->convertToHtml($post->description);
        return view('show', compact('post'));
    }


    /* public function show($slug)
     {
         if (is_numeric($slug)) {
             $post = Post::findOrFail($slug);
         } else {
             $post = Post::where('slug', $slug)->firstOrFail();
         }

         if (empty($post)) {
             session()->flash('error', 'Tutorial not found !');
             return redirect('/');
         }

         $post->description = $this->converter->convertToHtml($post->description);
         return view('show', compact('post'));
     }*/

    /**
     * Show a preview of the post before publishing.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function preview(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3|max:150',
            'description' => 'required|min:3',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->slug = Str::slug($request->title) . '-' . time();
        $post->publish = false; // Mark as unpublished since it's a preview

        // Regular expression to match image URLs
        $imageRegex = '/<img[^>]+src="([^">]+)"/';
        $featuredImage = null;

        // Check if an image URL is found in the description
        if (preg_match($imageRegex, $post->description, $matches)) {
            $featuredImage = $matches[1]; // The first match (image URL)
        }

        $post->featured_image = $featuredImage;

        // Convert description to HTML using the same converter as in show method
        $post->description = $this->converter->convertToHtml($post->description);

        //dd($post);
        // Return the view for preview (could be the same or different from 'show')
        return view('preview.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3|max:150',
            'description' => 'required|min:3',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->slug = Str::slug($request->title) . '-' . time();

        // Check if the user clicked "Save as Draft" or "Save Tutorial"
        if ($request->input('action') == 'draft') {
            $post->publish = false; // Mark as draft
            $message = 'Tutorial saved as draft!';
        } else {
            $post->publish = true; // Mark as published
            $message = 'Tutorial published successfully!';
        }

        // Use regular expression to extract the first image URL from Markdown-style image tags
        $imageRegex = '/!\[.*?\]\((.*?)\)/'; // Matches Markdown images like ![](url)
        if (preg_match($imageRegex, $post->description, $matches)) {
            $post->featured_image = $matches[1]; // The first image URL
        } else {
            // If no featured image is found, do not proceed with saving
            session()->flash('error', 'No featured image found in the description.');
            return back()->withInput(); // Redirect back with input data
        }

        if ($post->save()) {
            session()->flash('success', $message);
            return redirect()->route('posts.show', $post->slug);
        }

        session()->flash('error', 'Error saving tutorial!');
        return back()->withInput();
    }



    /* public function store(Request $request)
     {
         $this->validate($request, [
             'title' => 'required|min:3|max:150',
             'description' => 'required|min:3',
         ]);

         $post = new Post();
         $post->title = $request->title;
         $post->description = $request->description;
         $post->slug = Str::slug($request->title) . '-' . time();

         // Regular expression to match image URLs
         $imageRegex = '/<img[^>]+src="([^">]+)"/';
         $featuredImage = null;

         // Check if an image URL is found in the description
         if (preg_match($imageRegex, $request->description, $matches)) {
             $featuredImage = $matches[1]; // The first match (image URL)
         }

         // Assign the found image URL as the featured image (if available)
         $post->featured_image = $featuredImage;

         if ($post->save()) {
             session()->flash('success', 'Tutorial saved successfully!');
             return redirect()->route('posts.show', $post->slug);
         }

         session()->flash('error', 'Error saving tutorial!');
         return back()->withInput();
     }*/


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(int $id)
    {
        $post = Post::find($id);

        if (empty($post)) {
            session()->flash('error', 'Tutorial not found !');
            return redirect()->route('posts.index');
        }

        return view('edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, int $id)
    {
        $post = Post::find($id);

        if (empty($post)) {
            session()->flash('error', 'Tutorial not found !');
            return redirect()->route('posts.index');
        }

        // TODO: This is just for the Live heroku project,
        // TODO: you can remove this if you want to use the localhost
        if ($post->slug === 'awesome-big-tutorial-with-markdown-1651298756') {
            session()->flash('error', 'Sorry, You can not modify this tutorial because of heroku Publishing. Please create another tutorial and Edit that. !');
            return redirect()->route('posts.index');
        }

        $this->validate($request, [
            'title' => 'required|min:3|max:150',
            'description' => 'required|min:3',
        ]);

        $post->title = $request->title;
        $post->description = $request->description;

        if ($post->save()) {
            session()->flash('success', 'Tutorial updated successfully !');
            return redirect()->route('posts.show', $post->slug);
        }

        session()->flash('error', 'Error updating tutorial !');
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(int $id)
    {
        $post = Post::find($id);

        if (empty($post)) {
            session()->flash('error', 'Tutorial not found !');
            return back();
        }

        // TODO: This is just for the Live heroku project,
        // TODO: you can remove this if you want to use the localhost
        if ($post->slug === 'awesome-big-tutorial-with-markdown-1651298756') {
            session()->flash('error', 'Sorry, You can not delete this tutorial because of heroku Publishing. Please create another tutorial and Delete that. !');
            return redirect()->route('posts.index');
        }

        if ($post->delete()) {
            session()->flash('success', 'Tutorial deleted successfully !');
        } else {
            session()->flash('error', 'Error deleting tutorial !');
        }

        return back();
    }
}
