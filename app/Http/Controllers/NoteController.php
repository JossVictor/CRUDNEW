<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;
class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = DB::table('notes')
        ->join('categories', 'categories.id', '=', 'notes.category_id')
        ->select('notes.id','notes.title', 'notes.content', 'categories.category_name')
        ->where('notes.active', true)
        ->get();
        // dd($notes);
        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::orderBy('id', 'desc')->where('active', true)->get();
        return view('notes.create')
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Note::create([
            'title' => $request->title,
            'content' =>  $request->content,
            'category_id' => $request->category_name
        ]);

        // return to_route('notes.index');
        return redirect()->route('notes.index')
            ->with('success', 'Nota creada exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('notes.show')
            ->with('note', Note::nota_por_id($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Categories::orderBy('id', 'desc')->get();
        return view('notes.edit')
            ->with('note', Note::nota_por_id($id))
            ->with('categories', $categories);
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
        $note = Note::nota_por_id($id);
        $note->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('notes.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::nota_por_id($id);

        //$note->delete();

        $note->update([
            'active' => false
        ]);

        return redirect()->route('notes.index');
    }
}