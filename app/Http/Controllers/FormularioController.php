<?php

namespace App\Http\Controllers;

use App\Exports\AnswersExport;
use App\Exports\AnswersPDFExport;
use App\Exports\ScoreTeamsExport;
use App\Models\Answer;
use App\Models\Partner;
use App\Models\Question;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class FormularioController extends Controller
{
    
    public function index(Request $request)
    {
    $teams = Team::all();
    $filter = $request->input('team_id');
    $questions = Question::all();
    $users = User::all();
    $partners = Partner::all();
    $answers_id_partner = Answer::pluck('partner_id');
    $counter = 1;
    return view('Formulario.formulario', compact('questions', 'users', 'partners', 'teams', 'filter', 'counter', 'answers_id_partner'))->with('status', 'Respuesta guardada correctamente');
}

public function store(Request $request)
{
        $request->validate([
            'respuesta' => 'required',
            'user_id' => 'required',
            'partner_id' => 'required',
        ]);
        
        $partners = $request->input('partner_id');
        $answers = $request->input('respuesta');
        $users = $request->input('user_id');
        $teams = $request->input('team_id');
        $average = array_sum($answers) / count($answers);
        
        $answer = new Answer;
        $answer->respuesta = json_encode($answers);
        $answer->user_id = $users;
        $answer->partner_id = $partners;
        $answer->team_id = $teams;
        $answer->promedio = $average;
        $answer->save();
        
        return redirect()->route('formulario.resultados')->with('status', 'Respuesta guardada correctamente');
    }
    
    public function resultados()
    {
        $questions = Question::pluck('concepto_pregunta');
        $lastAnswer = Answer::latest()->first();
        $answers = json_decode($lastAnswer->respuesta);
        $promedio = array_sum($answers) / count($answers);
        $contador = Question::count();
        $user = auth()->user()->name;
        $partner = Partner::where('id', '=', $lastAnswer->partner_id)->first()->name;
        
        return view('Formulario.resultados', compact('answers', 'user', 'partner', 'questions', 'promedio', 'contador'))->with('status', 'Respuesta guardada correctamente');
    }
    
    
    public function resumen(Answer $answers, User $user, Partner $partner, Team $teams)
    {
        $answersData = $this->getAnswersData();
        $teams = $this->getPluckedColumn($answersData, 'team_name');
        $partners = $this->getPluckedColumn($answersData, 'partner_name');
        $answers = $this->getPluckedColumn($answersData, 'respuesta');
        $promedio = $this->getPluckedColumn($answersData, 'promedio');
        $created_at = $this->getPluckedColumn($answersData, 'created_at');
        $id = $this->getPluckedColumn($answersData, 'id');
        $user_id = $this->getPluckedColumn($answersData, 'user_id');
        
        $counter = $answersData->count();
        $users = User::all();
        $teamsData = $this->getTeamsData();
        $countTeams = $this->getCountTeams($teamsData);
        $sumTeams = $this->getSumTeams($teamsData);
        $averageTeams = $this->getAverageTeams($countTeams, $sumTeams);

        return view('Formulario.resumen', compact('teams', 'partners', 'answers', 'promedio', 'counter', 'users', 'created_at', 'id', 'user_id', 'teamsData', 'countTeams', 'sumTeams', 'averageTeams'));
    }
    
    private function getAnswersData()
    {
        return DB::table('answers')
        ->join('users', 'users.id', '=', 'answers.user_id')
        ->join('partners', 'partners.id', '=', 'answers.partner_id')
        ->join('teams', 'teams.id', '=', 'answers.team_id')
        ->select(
            'answers.respuesta',
            'answers.promedio',
            'answers.created_at',
            'answers.id',
            'teams.name as team_name',
            'partners.name as partner_name',
            'users.id as user_id'
            )
            ->get();
        }
        
        private function getPluckedColumn($data, $column)
        {
            return $data->pluck($column);
        }
        
        private function getTeamsData()
        {
            return Team::all();
        }
        
        private function getCountTeams($teamsData)
        {
            $countTeams = [];
            foreach ($teamsData as $team) {
                $countTeams[$team->id] = DB::table('answers')
                ->where('team_id', '=', $team->id)
                ->count();
            }
            return $countTeams;
        }
        
        private function getSumTeams($teamsData)
        {
            $sumTeams = [];
            foreach ($teamsData as $team) {
            $sumTeams[$team->id] = DB::table('answers')
                ->where('team_id', '=', $team->id)
                ->sum('promedio');
            }
            return $sumTeams;
    }
    
    private function getAverageTeams($countTeams, $sumTeams)
    {
        $averageTeams = [];
        foreach ($countTeams as $teamId => $count) {
            if ($count == 0) {
                $averageTeams[$teamId] = 0;
            } else {
                $averageTeams[$teamId] = $sumTeams[$teamId] / $count;
            }
        }
        return $averageTeams;
    }
    
    public function exportResultsExcel()
    {
        return Excel::download(new AnswersExport, 'results.xlsx');
    }
    
    public function exportResultsPdf()
    {
        return Excel::download(new AnswersPDFExport, 'results.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
    
    public function exportResumeTeamsExcel()
    {
        return Excel::download(new ScoreTeamsExport, 'resumeTeams.xlsx');
    }
    
    public function exportResumeTeamsPdf()
    {
        return Excel::download(new ScoreTeamsExport, 'resumeTeams.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
}

// public function index(Request $request)
// {
//     $teams = DB::table('teams')->get();
//     $filter = $request->input('team_id');
//     $roles = DB::table('roles')->get();
//     $questions = Question::all();
//     $users = User::all();
//     $partners = DB::table('partners')->get();
//     $counter = 1;
//     $answers = DB::table('answers')->get();
//     foreach ($answers as $answer) {
//         $answers_id_partner[] = collect($answer)->only('partner_id');
//     }
//     $answers_id_partner = collect($answers_id_partner);
//     $answers_id_partner = $answers_id_partner->flatten();
//     return view('Formulario.formulario', compact('questions', 'users', 'partners', 'teams', 'filter', 'roles', 'counter', 'answers_id_partner'))->with('status', 'Respuesta guardada correctamente');
// }

// public function resumen(Answer $answers, User $user, Partner $partner, Team $teams)
// {
    //     $answersData = DB::table('answers')
    //         ->join('users', 'users.id', '=', 'answers.user_id')
    //         ->join('partners', 'partners.id', '=', 'answers.partner_id')
    //         ->join('teams', 'teams.id', '=', 'answers.team_id')
    //         ->select(
//             'answers.respuesta',
//             'answers.promedio',
//             'answers.created_at',
//             'answers.id',
//             'teams.name as team_name',
//             'partners.name as partner_name',
//             'users.id as user_id'
//         )
//         ->get();

//     $teams = $answersData->pluck('team_name');
//     $partners = $answersData->pluck('partner_name');
//     $answers = $answersData->pluck('respuesta');
//     $promedio = $answersData->pluck('promedio');
//     $created_at = $answersData->pluck('created_at');
//     $id = $answersData->pluck('id');
//     $user_id = $answersData->pluck('user_id');


//     $counter = $answersData->count();
//     $users = User::all();
//     $teamsData = Team::all();
//     $quantityTeams = Team::count();
//     $countTeams = [];
//     $sumTeams = [];
//     $averageTeams = [];

//     foreach ($teamsData as $team) {
//         $countTeams[$team->id] = DB::table('answers')
//             ->where('team_id', '=', $team->id)
//             ->count();

//         $sumTeams[$team->id] = DB::table('answers')
//             ->where('team_id', '=', $team->id)
//             ->sum('promedio');

//         if ($countTeams[$team->id] == 0) {
//             $averageTeams[$team->id] = 0;
//         } else {
//             $averageTeams[$team->id] = $sumTeams[$team->id] / $countTeams[$team->id];
//         }
//     }
//     return view('Formulario.resumen', compact('teams', 'partners', 'answers', 'promedio', 'counter', 'users', 'created_at', 'id', 'user_id', 'teamsData', 'countTeams', 'sumTeams', 'averageTeams'));
// }