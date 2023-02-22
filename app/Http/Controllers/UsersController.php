<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit(User $user, Team $teams, Role $roles)
    {
        $roles = Role::all();
        $teams = Team::all();
        return view('Usuario.editar', compact('user', 'teams', 'roles'));
    }

    public function show()
    {
        $users = User::all();
        
        return view('Usuario.show', compact('users'));

    }
    
    // public function show($id)
    // {
    //     return response([
    //         'user' => User::find($id)
    //     ], 200);
    // }

    // public function allUser(){
    //     return response()->json(User::all());
    // }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'required',
            'role_id' => 'required|exists:roles,id',
            'team_id' => 'required|exists:teams,id',
        ]);
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'team_id' => $request->team_id,
        ]);
        return view('Usuario.show');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index');
    }

    public function exportUsersExcel()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function exportUsersPdf()
    {
        return Excel::download(new UsersExport, 'users.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

}
