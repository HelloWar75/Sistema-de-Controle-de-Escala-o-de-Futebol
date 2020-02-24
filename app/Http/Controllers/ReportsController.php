<?php

namespace App\Http\Controllers;

use App\Repositories\AthletePartyRepository;
use App\Repositories\AthletePartyRepositoryEloquent;
use App\Repositories\AthleteRepositoryEloquent;
use App\Repositories\PartyRepositoryEloquent;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    //

    protected $athlete_party_repository;
    protected $athlete_repository;
    protected $party_repository;

    public function __construct(AthletePartyRepositoryEloquent $athlete_party_repository,
                                AthleteRepositoryEloquent $athlete_repository,
                                PartyRepositoryEloquent $party_repository)
    {
        $this->athlete_party_repository = $athlete_party_repository;
        $this->athlete_repository = $athlete_repository;
        $this->party_repository = $party_repository;
    }

    public function index()
    {
        $data = [];

        $tmp_atheletes = $this->athlete_repository->paginate(10);

        foreach ($tmp_atheletes["data"] as $k => $v)
        {

            $tmp_party_num = $this->athlete_party_repository->count([
                'athlete_id' => $v["id"]
            ]);

            $tmp_atheletes["data"][$k]["count"] = $tmp_party_num;

        }

        $pagination = $tmp_atheletes["meta"]["pagination"];
        $data["athletes"] = $tmp_atheletes["data"];
        $data["links"] = paginate(route('reports.index'), $pagination["current_page"], $pagination["total"], $pagination["per_page"]);

        return view('reports.index', $data);
    }

    public function report2()
    {
        $data = [];
        $tmp_patidas = $this->party_repository->paginate(10);

        $pagination = $tmp_patidas["meta"]["pagination"];
        $data["report"] = $tmp_patidas["data"];
        $data["links"] = paginate(route('reports.index'), $pagination["current_page"], $pagination["total"], $pagination["per_page"]);

        return view('reports.rep2', $data);
    }

    public function report2_selected($id)
    {
        $data = [];
        $party = $this->party_repository->find($id)["data"];
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

        return view('reports.rep2_selected', $data);
    }

    public function report_partidas_disputadas()
    {
        $all_parties = $this->party_repository->all()["data"];

        foreach ($all_parties as $key => $value)
        {

            $team_1 = [];
            $team_2 = [];

            $escalation = $this->athlete_party_repository->findWhere([
                'party_id' => $value["id"]
            ])["data"];

            foreach ($escalation as $k => $v)
            {
                $escalation[$k] = $v["athlete"];
            }

            foreach ($escalation as $k => $v)
            {
                if($v["team"]["id"] == $value["team_1"]["id"])
                {
                    array_push($team_1, $v);
                }else{
                    array_push($team_2, $v);
                }

            }

            $all_parties[$key]["team_1_escalation"] = $team_1;
            $all_parties[$key]["team_2_escalation"] = $team_2;

        }

        return response()->json($all_parties);
    }

    public function report_per_athlete()
    {

        $tmp_atheletes = $this->athlete_repository->all();

        foreach ($tmp_atheletes["data"] as $k => $v)
        {

            $tmp_party_num = $this->athlete_party_repository->count([
                'athlete_id' => $v["id"]
            ]);

            $tmp_atheletes["data"][$k]["count"] = $tmp_party_num;

        }

        return response()->json($tmp_atheletes["data"]);

    }
}
