<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Game;
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
        $query = Game::query();

        // Search
        if($request->filled('search')) {
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

        return view('dashboard.games.index', compact('games'));

        // $games = Game::paginate(2);
        // return view('dashboard.games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'rating' => 'nullable|numeric',
        ]);

        Game::create($data);
        return redirect()->route('games.index');
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
        return view('dashboard.games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $game->update($request->all());
        return redirect()->route('games.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $game->genres()->detach();
        $game->delete();
        return back();
    }
}
