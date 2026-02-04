<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Genre;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Game::with('genres');
        $genres = Genre::all();

        // Search
        if($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Sort
        if($request->sort === 'asc') {
            $query->orderBy('title', 'asc');
        } elseif($request->sort === 'desc') {
            $query->orderBy('title', 'desc');
        } else {
            $query->latest();
        }

        $games = $query->paginate(3)->withQueryString();

        if($request->ajax()) {
            return view('dashboard.games.table.tablegames', compact('games'))->render();
        }

        return view('dashboard.games.index', compact('games', 'genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::orderBy('name')->get();

        return view('dashboard.games.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'cover' => 'nullable|url',
            'rating' => 'required|numeric|min:0|max:10',
            'developer' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'description' => 'required|string',
            'genres'=> 'required|array',
            'genres.*'=> 'exists:genres,id',
        ]);

        // if($request->hasFile('cover')) {
        //     $data['cover'] = $request->file('cover')->store('cover', 'public');
        // }

        $game = Game::create($data);

        if($request->filled('genres')) {
            $game->genres()->attach($request->genres);
        }

        
        return redirect()->route('games.index')->with('success', 'Game added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        $game->load('genres');
        $genres = Genre::orderBy('name')->get();

        return view('dashboard.games.edit', compact('game', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $data = $request->validate([
            'title' => 'required',
            'cover' => 'nullable|url',
            'rating' => 'required',
            'developer' => 'required',
            'publisher' => 'required',
            'description' => 'required',
            'genres' => 'array',
        ]);

        $game->update($data);

        $game->genres()->sync($request->genres ?? []);

        return redirect()->route('games.index')->with('success', 'Game update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $game->genres()->detach();
        $game->delete();
        return back()->with('success', 'Game successfully deleted.');
    }
}
