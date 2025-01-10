<?php

namespace App\Http\Controllers\Admin;

use App\Models\Save;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveController
{
    public function index()
    {
        $saves = Save::where('user_id', Auth::id())->get();
        return view('admin.saves.index', compact('saves'));
    }

    public function create()
    {
        return view('admin.saves.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Save::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.save.index')->with('success', 'Save added successfully.');
    }

    public function show(Save $save)
    {
        if ($save->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.saves.show', compact('save'));
    }

    public function edit(Save $save)
    {
        if ($save->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.saves.edit', compact('save'));
    }

    public function update(Request $request, Save $save)
    {
        if ($save->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $save->update($request->only(['title', 'amount', 'date', 'description']));

        return redirect()->route('admin.save.index')->with('success', 'Save updated successfully.');
    }

    public function destroy(Save $save)
    {
        if ($save->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $save->delete();

        return redirect()->route('admin.save.index')->with('success', 'Save deleted successfully.');
    }
}
