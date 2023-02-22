<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function create(Team $team)
    {
        return view('Team.crear', compact('team'));
    }

    public function store(Request $request, Team $team)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
        ]);

        $team->name = $validatedData['nombre'];
        $team->save();
        return redirect()->route('teams.show')->with('status', 'Equipo guardado correctamente');
    }

    public function edit(Team $team)
    {
        return view('Team.editar', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $team->name = $validatedData['name'];
        $team->save();
        return redirect()->route('teams.show')->with('status', 'Equipo actualizado correctamente');

    }

    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('teams.show')->with('status', 'Equipo eliminado correctamente');
    }

    public function show()
    {
        $teams = Team::all();
        return view('Team.show', compact('teams'));
    }
}
