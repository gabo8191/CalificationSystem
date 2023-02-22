<?php

namespace App\Http\Controllers;

use App\Exports\ParnersExport;
use App\Models\Partner;
use App\Models\Team;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PartnerController extends Controller
{

    public function create()
    {
        $teams = Team::all();
        $partner = Partner::all();
        return view('Partner.crear', compact('partner', 'teams'));
    }

    public function store(Request $request, Partner $partner)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'email' => 'required|email|unique:partners,email',
            'team_id' => 'required|exists:teams,id'
        ]);

        $partner->name = $validatedData['nombre'];
        $partner->email = $validatedData['email'];
        $partner->team_id = $validatedData['team_id'];
        $partner->save();

        return redirect()->route('partners.show', $partner);
    }

    public function edit(Partner $partner)
    {
        $teams = Team::all();
        return view('Partner.editar', compact('partner', 'teams'));
    }

    public function update(Request $request, Partner $partner)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'email' => 'required|email|max:255|unique:partners,email,' . $partner->id,  //esta linea lo que hace es que si el email no se modifica no lo valide como unico
            'team_id' => 'required|exists:teams,id',
        ]);

        $partner->name = $validatedData['nombre'];
        $partner->email = $validatedData['email'];
        $partner->team_id = $validatedData['team_id'];
        $partner->save();

        return redirect()->route('partners.show', $partner);
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route('partners.show');
    }

    public function show()
    {
        $partners = Partner::all();
        $teams = Team::all();
        return view('Partner.show', compact('partners', 'teams'));
    }

    public function exportPartnersExcel()
    {
        return Excel::download(new ParnersExport, 'partners.xlsx');
    }

    public function exportPartnersPDF()
    {
        return Excel::download(new ParnersExport, 'partners.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
}
