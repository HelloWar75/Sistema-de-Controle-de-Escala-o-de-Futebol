<?php

namespace App\Http\Controllers;

use App\Repositories\TeamRepositoryEloquent;
use App\Entities\Team;
use App\Validators\TeamValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Prettus\Validator\Exceptions\ValidatorException;

class TeamController extends Controller
{

    protected $repository;
    protected $validator;

    public function __construct(TeamRepositoryEloquent $repository, TeamValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
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

        try{

            $this->validator->with($request->all())->passesOrFail();
            $this->repository->create($request->all());

        }catch (ValidatorException $e){
            redirect(route('team.index'))->withErrors("Erro ao criar o cadastro!");
        }

        return redirect(route('team.index'))->with('status', 'Criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = [];
        $data["team"] = $this->repository->find($id)["data"];
        return view('team.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = [];
        $data["team"] = $this->repository->find($id)["data"];
        return view('team.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try{

            $this->validator->with($request->all())->passesOrFail();
            $this->repository->update($request->all(), $id);

        }catch (ValidatorException $e){
            redirect(route('team.index'))->withErrors("Erro ao atualizar o cadastro!");
        }

        return redirect(route('team.index'))->with('status', 'Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if($this->repository->delete($id)) {
            return redirect(route('team.index'))->with('status', 'Deletado com sucesso!');
        }else{
            return redirect(route('team.index'))->withErrors('Erro ao deletar o cadastro!');
        }

    }
}
