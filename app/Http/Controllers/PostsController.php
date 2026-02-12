<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\CommonMark\MarkdownConverter;


class PostsController extends \App\Http\Controllers\Controller
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

        $this->middleware('auth')->except([
            'index',
            'show',
            'list',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): Renderable
    {
        $posts = Project::orderBy('id', 'desc')->paginate(9);

        $ogData = [
            'title' => env('AUTHOR') . ' - Web Developer Portfolio',
            'description' => 'Showcasing the expertise of ' . env('AUTHOR') . ' in web app design, development, and customization, with proven skills in PHP Laravel, C# .NET, and more.',
            'image' => asset(env('AUTHOR_IMAGE')), // Dynamic author image
            'url' => url()->current(), // Current page URL
            'type' => 'website',
        ];

        return view('index', compact('posts','ogData'));
    }

    public function list()
    {
        //dd('hi');
        $posts = Project::all();
        // dd($posts);
        $ogData = [
            'title' => 'Posts List',
            'description' => 'Explore a curated list of posts on various project.',
            'image' => asset('images/default-og-image.jpg'), // Default image
            'url' => url()->current(),
            'type' => 'website',
        ];

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
            $post = Project::findOrFail($slug);
        } else {
            $post = Project::where('slug', $slug)->firstOrFail();
        }

        // Prevent showing draft posts to the public
        if (!$post->publish) {
            session()->flash('error', 'This post is not published yet!');
            return redirect('/');
        }

        // Generate OG data for the post
        $ogData = [
            'title' => $post->title,
            'description' => Str::limit(strip_tags($post->description), 150), // Truncate description and remove HTML tags
            'image' => $post->featured_image ? asset($post->featured_image) : asset('images/default-post-image.jpg'),
            'url' => url('/post/' . $post->slug),
            'type' => 'article',
        ];

        $post->description = $this->converter->convertToHtml($post->description);
        return view('show', compact('post','ogData'));
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

    public function uploadProjectImages(Request $request)
    {
        $this->validate($request, [
            'images_files' => 'required|array|min:1',
            'images_files.*' => 'required|image|max:5120',
        ]);

        $storedImages = [];
        foreach ((array) $request->file('images_files', []) as $imageFile) {
            if ($imageFile) {
                $storedPath = $imageFile->store('projects', 'public');
                $storedImages[] = '/storage/' . $storedPath;
            }
        }

        return response()->json([
            'images' => $storedImages,
        ], 201);
    }

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
            'link' => 'nullable|string|max:2048',
            'description' => 'required|min:3',
            'stacks' => 'nullable|string|max:2048',
            'images' => 'required_without:images_files|array|min:1',
            'images.*' => 'required|string|max:2048',
            'images_files' => 'required_without:images|array|min:1',
            'images_files.*' => 'required|image|max:5120',
            'publish' => 'nullable|boolean',
        ]);

        $post = new Project();
        $post->title = $request->title;
        $post->link = $this->normalizeExternalLink($request->input('link'));
        $post->description = $request->description;
        $post->slug = Str::slug($request->title) . '-' . time();
        $post->publish = (bool) $request->input('publish', false);

        if ($request->hasFile('images_files')) {
            $storedImages = [];
            foreach ((array) $request->file('images_files', []) as $imageFile) {
                if ($imageFile) {
                    $storedPath = $imageFile->store('projects/previews', 'public');
                    $storedImages[] = '/storage/' . $storedPath;
                }
            }
            $post->images = $storedImages;
            $post->featured_image = $storedImages[0] ?? null;
        } else {
            $images = $request->input('images', []);
            if (!is_array($images)) {
                $images = [];
            }
            $post->images = collect($images)
                ->map(fn ($v) => is_string($v) ? $this->normalizePublicPath($v) : null)
                ->filter()
                ->values()
                ->all();
            $post->featured_image = (is_array($post->images) && count($post->images)) ? $post->images[0] : null;
        }

        $stacksRaw = (string) $request->input('stacks', '');
        $post->stacks = collect(explode(',', $stacksRaw))
            ->map(fn ($v) => trim($v))
            ->filter()
            ->unique()
            ->values()
            ->all();

        // images/featured_image are derived from either uploaded files or the provided image paths.

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
            'link' => 'nullable|string|max:2048',
            'description' => 'required|min:3',
            'stacks' => 'nullable|string|max:2048',
            'images' => 'required_without:images_files|array|min:1',
            'images.*' => 'required|string|max:2048',
            'images_files' => 'required_without:images|array|min:1',
            'images_files.*' => 'required|image|max:5120',
            'publish' => 'nullable|boolean',
        ]);

        $post = new Project();
        $post->title = $request->title;
        $post->link = $this->normalizeExternalLink($request->input('link'));
        $post->description = $request->description;
        $post->slug = Str::slug($request->title) . '-' . time();

        $post->publish = (bool) $request->input('publish', false);
        $message = $post->publish ? 'Project published successfully!' : 'Project saved as draft!';

        if ($request->hasFile('images_files')) {
            $storedImages = [];
            foreach ((array) $request->file('images_files', []) as $imageFile) {
                if ($imageFile) {
                    $storedPath = $imageFile->store('projects', 'public');
                    $storedImages[] = '/storage/' . $storedPath;
                }
            }
            $post->images = $storedImages;
            $post->featured_image = $storedImages[0] ?? null;
        } else {
            $images = $request->input('images', []);
            if (!is_array($images)) {
                $images = [];
            }
            $post->images = collect($images)
                ->map(fn ($v) => is_string($v) ? $this->normalizePublicPath($v) : null)
                ->filter()
                ->unique()
                ->values()
                ->all();
            $post->featured_image = (is_array($post->images) && count($post->images)) ? $post->images[0] : null;
        }

        $stacksRaw = (string) $request->input('stacks', '');
        $post->stacks = collect(explode(',', $stacksRaw))
            ->map(fn ($v) => trim($v))
            ->filter()
            ->unique()
            ->values()
            ->all();

        // images/featured_image are derived from either uploaded files or the provided image paths.

        if ($post->save()) {
            session()->flash('success', $message);
            return redirect()->route('projects.show', $post->slug);
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
    public function edit($id)
    {
        if (is_numeric($id)) {
            $post = Project::find($id);
        } else {
            $post = Project::where('slug', $id)->first();
        }

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
    public function update(Request $request, $id)
    {
        if (is_numeric($id)) {
            $post = Project::find($id);
        } else {
            $post = Project::where('slug', $id)->first();
        }

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
            'link' => 'nullable|string|max:2048',
            'description' => 'required|min:3',
            'publish' => 'nullable|boolean',
            'stacks' => 'nullable|string|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'required|string|max:2048',
            'images_files' => 'nullable|array',
            'images_files.*' => 'required|image|max:5120',
        ]);

        $post->title = $request->title;
        $post->link = $this->normalizeExternalLink($request->input('link'));
        $post->description = $request->description;

        if ($request->has('publish')) {
            $post->publish = (bool) $request->input('publish');
        } else {
            $post->publish = false;
        }

        if ($request->hasFile('images_files')) {
            $storedImages = [];
            foreach ((array) $request->file('images_files', []) as $imageFile) {
                if ($imageFile) {
                    $storedPath = $imageFile->store('projects', 'public');
                    $storedImages[] = '/storage/' . $storedPath;
                }
            }
            $post->images = $storedImages;
            $post->featured_image = $storedImages[0] ?? null;
        } elseif ($request->has('images')) {
            $images = $request->input('images', []);
            if (!is_array($images)) {
                $images = [];
            }
            $post->images = collect($images)
                ->map(fn ($v) => is_string($v) ? $this->normalizePublicPath($v) : null)
                ->filter()
                ->unique()
                ->values()
                ->all();
            $post->featured_image = (is_array($post->images) && count($post->images)) ? $post->images[0] : null;
        }

        $stacksRaw = (string) $request->input('stacks', '');
        $post->stacks = collect(explode(',', $stacksRaw))
            ->map(fn ($v) => trim($v))
            ->filter()
            ->unique()
            ->values()
            ->all();

        // If images were not provided, keep existing images/featured_image.

        if ($post->save()) {
            session()->flash('success', 'Project updated successfully!');
            return redirect()->route('projects.show', $post->slug);
        }

        session()->flash('error', 'Error updating project!');
        return back()->withInput();
    }

    private function normalizeExternalLink($raw)
    {
        $value = is_string($raw) ? trim($raw) : '';
        if ($value === '') {
            return null;
        }

        // If user pasted without scheme, assume https.
        if (!preg_match('/^[a-z][a-z0-9+.-]*:\/\//i', $value)) {
            $value = 'https://' . ltrim($value, '/');
        }

        return $value;
    }

    public function togglePublish(Project $project)
    {
        $project->publish = !$project->publish;
        $project->save();

        session()->flash('success', $project->publish ? 'Project published.' : 'Project set to draft.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($id)
    {
        if (is_numeric($id)) {
            $post = Project::find($id);
        } else {
            $post = Project::where('slug', $id)->first();
        }

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

    private function normalizePublicPath($path): ?string
    {
        if ($path === null) {
            return null;
        }

        $path = trim((string) $path);
        if ($path === '') {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://', '//', 'data:'])) {
            return $path;
        }

        if (Str::startsWith($path, '/')) {
            return $path;
        }

        return '/' . $path;
    }
}
