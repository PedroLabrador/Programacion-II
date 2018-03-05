<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Actor;
use Illuminate\Http\Request;

class ActorsController extends Controller
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
            $actors = Actor::where('name', 'LIKE', "%$keyword%")
                ->orWhere('fakename', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('gender', 'LIKE', "%$keyword%")
                ->orWhere('oscars', 'LIKE', "%$keyword%")
                ->orWhere('nominated', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $actors = Actor::paginate($perPage);
        }

        return view('admin.actors.index', compact('actors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.actors.create');
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
			'name' => 'required',
			'date' => 'required',
			'gender' => 'required',
			'oscars' => 'required',
			'nominated' => 'required'
		]);
        $requestData = $request->all();
        
        Actor::create($requestData);

        return redirect('admin/actors')->with('flash_message', 'Actor added!');
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
        $actor = Actor::findOrFail($id);

        return view('admin.actors.show', compact('actor'));
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
        $actor = Actor::findOrFail($id);

        return view('admin.actors.edit', compact('actor'));
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
			'name' => 'required',
			'date' => 'required',
			'gender' => 'required',
			'oscars' => 'required',
			'nominated' => 'required'
		]);
        $requestData = $request->all();
        
        $actor = Actor::findOrFail($id);
        $actor->update($requestData);

        return redirect('admin/actors')->with('flash_message', 'Actor updated!');
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
        Actor::destroy($id);

        return redirect('admin/actors')->with('flash_message', 'Actor deleted!');
    }
}
