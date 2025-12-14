<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $totalTodos = $user->todos()->count();
        $completedTodos = $user->todos()->where('is_completed', true)->count();
        $pendingTodos = $user->todos()->where('is_completed', false)->count();

        $query = $user->todos();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $todos = $query->latest()->paginate(5); 

        return view('todos.index', compact('todos', 'totalTodos', 'completedTodos', 'pendingTodos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable'
        ]);

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('todos.index')->with('success', 'Tugas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        if ($todo->user_id != Auth::id()) abort(403); // GANTI auth()->id() JADI Auth::id()
        return view('todos.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        if ($todo->user_id != Auth::id()) abort(403);
        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate(['title' => 'required']);
        if ($todo->user_id != Auth::id()) abort(403);

        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->has('is_completed')
        ]);
        
        return redirect()->route('todos.index')->with('success', 'Tugas diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        if ($todo->user_id != Auth::id()) abort(403);
        
        $todo->delete();
        return redirect()->route('todos.index')->with('success', 'Tugas dihapus');
    }

    public function toggleComplete(Todo $todo)
    {
        if ($todo->user_id != \Illuminate\Support\Facades\Auth::id()) abort(403);

        $todo->update([
            'is_completed' => !$todo->is_completed
        ]);

        $status = $todo->is_completed ? 'selesai dikerjakan! 🎉' : 'kembali ke status proses.';
        
        return back()->with('success', 'Tugas berhasil ditandai ' . $status);
    }
}