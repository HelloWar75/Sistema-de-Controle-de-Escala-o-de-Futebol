<?php

namespace App\Http\Controllers;

use App\Athlete;
use App\Repositories\AthleteRepository;
use App\Repositories\AthleteRepositoryEloquent;
use App\Repositories\PositionRepositoryEloquent;
use App\Repositories\TeamRepositoryEloquent;
use App\Validators\AthleteValidator;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class AthleteController extends Controller
{

    protected $repository;
    protected $validator;
    protected $team_repository;
    protected $position_repository;

    public function __construct(AthleteRepositoryEloquent $repository, TeamRepositoryEloquent $team_repository, PositionRepositoryEloquent $position_repository, AthleteValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->team_repository = $team_repository;
        $this->position_repository = $position_repository;
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
        $repo_data = $this->repository->paginate(10);
        $pagination = $repo_data["meta"]["pagination"];
        $data["athletes"] = $repo_data["data"];
        $data["links"] = paginate(route('athlete.index'), $pagination["current_page"], $pagination["total"], $pagination["per_page"]);

        //dd($data["links"]);
        return view('athlete.index', $data);
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
        $data["teams"] = $this->team_repository->all()["data"];
        $data["positions"] = $this->position_repository->all()["data"];

        return view('athlete.create', $data);
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
        //dd($request->all());
        try{
            $this->validator->with($request->all())->passesOrFail();
            $this->repository->create($request->all());
        }catch (ValidatorException $e){
            redirect(route('athlete.index'))->withErrors("Erro ao criar o cadastro!");
        }

        return redirect(route('athlete.index'))->with('status', 'Criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Athlete  $athlete
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = [];
        $data["athlete"] = $this->repository->find($id)["data"];
        $data["teams"] = $this->team_repository->all()["data"];
        $data["positions"] = $this->position_repository->all()["data"];
        return view('athlete.show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Athlete  $athlete
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = [];
        $data["athlete"] = $this->repository->find($id)["data"];
        $data["teams"] = $this->team_repository->all()["data"];
        $data["positions"] = $this->position_repository->all()["data"];
        return view('athlete.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Athlete  $athlete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try{
            $this->validator->with($request->all())->passesOrFail();
            $this->repository->update($request->all(), $id);
        }catch (ValidatorException $e){
            redirect(route('athlete.index'))->withErrors("Erro ao criar o cadastro!");
        }

        return redirect(route('athlete.index'))->with('status', 'Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Athlete  $athlete
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if($this->repository->delete($id)) {
            return redirect(route('athlete.index'))->with('status', 'Deletado com sucesso!');
        }else{
            return redirect(route('athlete.index'))->withErrors('Erro ao deletar o cadastro!');
        }
    }
}
