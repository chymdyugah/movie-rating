<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMovieRequest;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\Act;
use App\Http\Requests\StoreActRequest;
use App\Http\Resources\ActResource;
use App\Models\ActMovie;
use App\Models\Movies;

class ActController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acts = Act::all();
        $acts = ActResource::collection($acts);
        return $this->success($acts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActRequest $request)
    {
        $request->validated($request->all());
        $act = Act::create($request->all());
        $act = new ActResource($act);
        return $this->success($act);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $act = Act::find($id);
        if ($act == null) {
            return $this->fail("Does not exist", [], 404);
        }
        $act = new ActResource($act);
        return $this->success($act);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $act = Act::find($id);
        if ($act == null) {
            return $this->fail("Does not exist", [], 404);
        }
        $act->update($request->all());
        $act = new ActResource($act);
        return $this->success($act);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Act::destroy($id);
        return $this->success([]);
    }

    /**
     * add acts to a specified resource.
     *
     * @param  Act  $id
     * @return \Illuminate\Http\Response
     */
    public function addMovie(AddMovieRequest $request, Act $id)
    {
        $act = Act::find($id);
        if ($act == null) {
            return $this->fail("Does not exist", [], 404);
        }
        $request->validated($request->all());
        $movie = Movies::find($request->act_id);
        ActMovie::create([
            'act_id' => $act->id,
            'movie_id' => $movie->id,
        ]);
        $act = new ActResource($act);
        return $this->success($act);
    }
}
