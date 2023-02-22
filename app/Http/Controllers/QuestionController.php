<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function create(Question $question)
    {
        return view('Preguntas.crear', compact('question'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pregunta' => 'required|unique:questions,concepto_pregunta|max:255',
        ]);
    
        if (Question::count() >= 5) {
            return redirect()->route('pregunta.show')->with('status', 'No se pueden guardar más preguntas');
        }
    
        $question = Question::create([
            'concepto_pregunta' => $request->input('pregunta'),
        ]);
    
        return back()->with('status', 'Pregunta guardada correctamente');
    }
    public function edit(Question $question)
    {
        return view('Preguntas.editar', compact('question'));
    }


    public function update(Request $request, Question $question)
    {
        $request->validate([
            'pregunta' => 'required',
        ]);
        $question->concepto_pregunta = $request->pregunta;
        $question->save();
        session()->flash('status', 'Pregunta actualizada correctamente');
        return redirect()->route('pregunta.show');
    }

    public function show()
    {
        $preguntas = Question::all();
        return view('Preguntas.show', compact('preguntas'));
    }

    public function destroy(Question $question)
    {
        $question->delete();
        session()->flash('status', 'Pregunta eliminada correctamente');
        return redirect()->route('pregunta.show');
    }
}
