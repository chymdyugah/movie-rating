<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use App\Traits\HttpResponses;
use App\Http\Requests\MovieRequest;
use App\Models\ActMovie;
use App\Http\Requests\AddActRequest;
use App\Http\Requests\AddVoteRequest;
use App\Http\Resources\MovieResource;
use App\Models\Act;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieContoller extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movies::all();
        $movies = MovieResource::collection($movies);
        return $this->success($movies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        //
        $request->validated($request->all());
        $movie = Movies::create($request->all());
        $movie = new MovieResource($movie);
        return $this->success($movie);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $movie = Movies::find($id);
        if ($movie == null) {
            return $this->fail("Does not exist", [], 404);
        }
        echo($movie->votes()->sum('rating'));
        $movie = new MovieResource($movie);
        return $this->success($movie);
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
        //
        $movie = Movies::find($id);
        if ($movie == null) {
            return $this->fail("Does not exist", [], 404);
        }
        $movie->update($request->all());
        $movie = new MovieResource($movie);
        return $this->success($movie);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Movies::destroy($id);
        return $this->success([]);
    }

    /**
     * Search for the specified resource.
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        //
        $movies = Movies::where('name', 'like', '%'.$name.'%')->get();
        $movies = MovieResource::collection($movies);
        return $this->success($movies);
    }

    /**
     * add acts to a specified resource.
     *
     * @param  str  $id
     * @return \Illuminate\Http\Response
     */
    public function addAct(AddActRequest $request, $id)
    {
        $movie = Movies::find($id);
        if ($movie == null) {
            return $this->fail("Does not exist", [], 404);
        }
        $request->validated($request->all());
        $act = Act::find($request->act_id);
        ActMovie::create([
            'act_id' => $act->id,
            'movie_id' => $movie->id,
        ]);
        $movie = new MovieResource($movie);
        return $this->success($movie);
    }

    /**
     * add vote to a specified resource.
     *
     * @param  str  $id
     * @return \Illuminate\Http\Response
     */
    public function addVote(AddVoteRequest $request, $id)
    {
        $movie = Movies::find($id);
        if ($movie == null) {
            return $this->fail("Does not exist", [], 404);
        }
        $request->validated($request->all());
        Vote::create([
            'movie_id' => $movie->id,
            'user_id' => Auth::user()->id,
            'rating'=> $request->rating,
        ]);
        $movie = new MovieResource($movie);
        return $this->success($movie);
    }
}
