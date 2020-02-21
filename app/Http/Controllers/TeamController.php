<?php

namespace App\Http\Controllers;

use App\Repositories\TeamRepositoryEloquent;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{

    protected $repository;

    public function __construct(TeamRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [];
        $repo_data = $this->repository->paginate(2);
        $pagination = $repo_data["meta"]["pagination"];
        $data["teams"] = $repo_data["data"];
        $data["links"] = paginate(route('team.index'), $pagination["current_page"], $pagination["total"], $pagination["per_page"]);

        //dd($data["links"]);
        return view('team.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
          'name' => 'required|unique:teams|max:255|min:5'
        ]);

        if ( $validator->fails() ) {
          return redirect(route('team.create'))->withErrors($validator)->withInput();
        }

        $name = $request->name;
        $this->repository->create([
          'name' => $name
        ]);

        return redirect(route('team.index'))->with('status', 'Criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
}
