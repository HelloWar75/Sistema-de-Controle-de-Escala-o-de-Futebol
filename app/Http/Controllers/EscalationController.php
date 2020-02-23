<?php

namespace App\Http\Controllers;

use App\Repositories\PartyRepositoryEloquent;
use App\Repositories\TeamRepositoryEloquent;
use App\Validators\PartyValidator;
use Illuminate\Http\Request;

class EscalationController extends Controller
{

    protected $repository;
    protected $team_repository;
    protected $validator;

    public function __construct(PartyRepositoryEloquent $repository, TeamRepositoryEloquent $team_repository, PartyValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->team_repository = $team_repository;
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
        $data["escalations"] = $repo_data["data"];
        $data["links"] = paginate(route('escalation.index'), $pagination["current_page"], $pagination["total"], $pagination["per_page"]);

        return view('escalation.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [];
        return view('escalation.create');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }
}
