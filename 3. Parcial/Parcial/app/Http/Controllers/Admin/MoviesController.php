<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Movie;
use App\Actor;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        
        if (!empty($keyword)) {
            $actor = Actor::where('fakename', 'LIKE', "%$keyword%")->first();
            $actor_id = ($actor) ? $actor->id : 0;

            $movies = Movie::where('actor_id', 'LIKE', "%$actor_id%")
                ->orWhere('title', 'LIKE', "%$keyword%")
                ->orWhere('year', 'LIKE', "%$keyword%")
                ->orWhere('duration', 'LIKE', "%$keyword%")
                ->orWhere('role', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $movies = Movie::paginate($perPage);
        }

        return view('admin.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $actors = Actor::all();
        return view('admin.movies.create', [
            'actors' => $actors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'actor_id' => 'required',
			'title' => 'required',
			'year' => 'required',
			'duration' => 'required',
			'role' => 'required'
		]);
        $requestData = $request->all();
        
        Movie::create($requestData);

        return redirect('admin/movies')->with('flash_message', 'Movie added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $movie = Movie::findOrFail($id);

        return view('admin.movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $actors = Actor::all();

        return view('admin.movies.edit', [
            'movie' => $movie,
            'actors' => $actors
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'actor_id' => 'required',
			'title' => 'required',
			'year' => 'required',
			'duration' => 'required',
			'role' => 'required'
		]);
        $requestData = $request->all();
        
        $movie = Movie::findOrFail($id);
        $movie->update($requestData);

        return redirect('admin/movies')->with('flash_message', 'Movie updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Movie::destroy($id);

        return redirect('admin/movies')->with('flash_message', 'Movie deleted!');
    }
}
