<?php

namespace App\Http\Controllers;

use App\Repositories\AthletePartyRepositoryEloquent;
use App\Repositories\AthleteRepositoryEloquent;
use App\Repositories\PartyRepositoryEloquent;
use App\Repositories\TeamRepositoryEloquent;
use App\Validators\PartyValidator;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class EscalationController extends Controller
{

    protected $repository;
    protected $team_repository;
    protected $validator;
    protected $athlete_repository;
    protected $athlete_party_repository;

    public function __construct(PartyRepositoryEloquent $repository, TeamRepositoryEloquent $team_repository, AthleteRepositoryEloquent $repo_athlete, AthletePartyRepositoryEloquent $repo_athlete_party, PartyValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->team_repository = $team_repository;
        $this->athlete_repository = $repo_athlete;
        $this->athlete_party_repository = $repo_athlete_party;
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
        $data["escalations"] = $repo_data["data"];
        $data["links"] = paginate(route('escalation.index'), $pagination["current_page"], $pagination["total"], $pagination["per_page"]);

        return view('escalation.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $data = [];

        switch ($request->get('step')) {

            case null:
                $data["teams"] = $this->team_repository->all()["data"];
                return view('escalation.create_start', $data);
                break;
            case "1":
                $data["teams"] = $this->team_repository->findWhere([
                    ['id', '!=', $request->get('first_team')]
                ])["data"];
                $data["first_team"] = $request->get('first_team');
                return view('escalation.create_step_1', $data);
                break;
            case "2":
                $data["first_team"] = $request->get('first_team');
                $data["second_team"] = $request->get('second_team');
                $data["athletes_first_team"] = $this->athlete_repository->findWhere([
                    'team_id' => $data["first_team"]
                ])["data"];
                $data["athletes_second_team"] = $this->athlete_repository->findWhere([
                    'team_id' => $data["second_team"]
                ])["data"];
                return view('escalation.create_step_2', $data);
        }

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
        $party_data = [
            'name' => $request->name,
            'team_1_id' => 1,
            'team_2_id' => 2,
            'party_date' => $request->party_date
        ];

        try{
            $this->validator->with($party_data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $creted_id = $this->repository->create($party_data)["data"]["id"];
        }catch (ValidatorException $e){
            return redirect(route('escalation.index'))->withErrors($e->getMessage());
        }

        foreach ($request->athletes_team_1 as $v) {
            $this->athlete_party_repository->create([
                'party_id' => $creted_id,
                'athlete_id' => $v
            ]);
        }

        foreach ($request->athletes_team_2 as $v) {
            $this->athlete_party_repository->create([
                'party_id' => $creted_id,
                'athlete_id' => $v
            ]);
        }

        return redirect(route('escalation.index'))->with('status', 'Criado com sucesso!');

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
        $data = [];
        $party = $this->repository->find($id)["data"];
        $data["party"] = $party;

        /*
         * First Team
         */

        $first_team_selected = $this->athlete_party_repository->findWhere([
            'party_id' => $party["id"]
        ])["data"];

        $first_team_all = $this->athlete_repository->findWhere([
            'team_id' => $party["team_1"]["id"]
        ])["data"];

        $first_team_tmp = [];

        foreach ($first_team_selected as $v)
        {
            array_push($first_team_tmp, $v["athlete"]);
        }

        foreach ($first_team_all as $k => $v)
        {
            $first_team_all[$k]["selected"] = false;
            foreach($first_team_tmp as $vs)
            {
                if( $v["id"] === $vs["id"] )
                {
                    $first_team_all[$k]["selected"] = true;
                }
            }
        }

        /*
         * Second Team
         */

        $second_team_selected = $this->athlete_party_repository->findWhere([
            'party_id' => $party["id"]
        ])["data"];

        $second_team_all = $this->athlete_repository->findWhere([
            'team_id' => $party["team_2"]["id"]
        ])["data"];

        $second_team_tmp = [];

        foreach ($second_team_selected as $v)
        {
            array_push($second_team_tmp, $v["athlete"]);
        }

        foreach ($second_team_all as $k => $v)
        {
            $second_team_all[$k]["selected"] = false;
            foreach($second_team_tmp as $vs)
            {
                if( $v["id"] === $vs["id"] )
                {
                    $second_team_all[$k]["selected"] = true;
                }
            }
        }

        $data["athletes_first_team"] = $first_team_all;
        $data["athletes_second_team"] = $second_team_all;

        return view('escalation.show', $data);
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
        $data = [];
        $party = $this->repository->find($id)["data"];
        $data["party"] = $party;

        /*
         * First Team
         */

        $first_team_selected = $this->athlete_party_repository->findWhere([
            'party_id' => $party["id"]
        ])["data"];

        $first_team_all = $this->athlete_repository->findWhere([
            'team_id' => $party["team_1"]["id"]
        ])["data"];

        $first_team_tmp = [];

        foreach ($first_team_selected as $v)
        {
            array_push($first_team_tmp, $v["athlete"]);
        }

        foreach ($first_team_all as $k => $v)
        {
            $first_team_all[$k]["selected"] = false;
            foreach($first_team_tmp as $vs)
            {
                if( $v["id"] === $vs["id"] )
                {
                    $first_team_all[$k]["selected"] = true;
                }
            }
        }

        /*
         * Second Team
         */

        $second_team_selected = $this->athlete_party_repository->findWhere([
            'party_id' => $party["id"]
        ])["data"];

        $second_team_all = $this->athlete_repository->findWhere([
            'team_id' => $party["team_2"]["id"]
        ])["data"];

        $second_team_tmp = [];

        foreach ($second_team_selected as $v)
        {
            array_push($second_team_tmp, $v["athlete"]);
        }

        foreach ($second_team_all as $k => $v)
        {
            $second_team_all[$k]["selected"] = false;
            foreach($second_team_tmp as $vs)
            {
                if( $v["id"] === $vs["id"] )
                {
                    $second_team_all[$k]["selected"] = true;
                }
            }
        }

        $data["athletes_first_team"] = $first_team_all;
        $data["athletes_second_team"] = $second_team_all;
        return view('escalation.edit', $data);
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
        try{
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $this->repository->update($request->all(), $id);
        }catch (ValidatorException $e){
            return redirect(route('escalation.index'))->withErrors($e->getMessage());
        }

        return redirect(route('escalation.index'))->with('status', 'Atualizado com sucesso!');
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
        $this->athlete_party_repository->deleteWhere([
            'party_id' => $id
        ]);
        $this->repository->delete($id);
        return redirect(route('escalation.index'))->with('status', 'Deletado com sucesso!');
    }
}
