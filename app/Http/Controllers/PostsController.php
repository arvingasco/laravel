<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function __construct() {
        $this->middleware('auth')
            ->only(['create', 'store','edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view(
            'posts.index',
            ['posts' => BlogPost::withCount('comment')->get()]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePost $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePost $request)
    {
        $validated = $request->validated();
        $post = BlogPost::create($validated);

        $request->session()->flash('status', 'Meme was successfully created!');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        return view('posts.show', ['post' => BlogPost::with('comment')->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

        if (Gate::denies('update', $post)) {
            abort(403, "Forbidden: You do not have authorisation to edit this memee=.");
        };

        return view('posts.partials.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $this->authorize('update', $post);

        $validated = $request->validated();
        $post->fill($validated)->save();

        $request->session()->flash('status', 'Meme was successfully updated!');

        return redirect()->route('posts.show', ['post' => $post-> id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);

        if (Gate::denies('delete', $post)) {
            abort(403, "Forbidden: You do not have authorisation to delete this meme.");
        };

        $post->delete();

        session()->flash('status', 'Meme was successfully deleted.');
        return redirect()->route('posts.index');
    }
}
