<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Genre::withCount('games');

        $genres = $query->orderBy('name')->paginate(10)->withQueryString();

        // $genres = Genre::latest()->paginate(12);
        return view('dashboard.genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:genres,name',
        ]);

        Genre::create($data);

        return redirect()->route('genres.index')->with('success', 'Genre added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        return view('dashboard.genres.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:genres,name,' . $genre->id,
        ]);

        $genre->update($data);

        return redirect()->route('genres.index')->with('success', 'Genre updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        if($genre->games()->exists()) {
            return back()->with('error', 'Game genre is still in use!');
        }

        $genre->delete();

        return back()->with('success', 'Genre successfully deleted.');
    }
}
