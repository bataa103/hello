<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{
        // Display a list of all user plans
        public function index()
        {
            $plans = Plan::all();
            return view('admin.plans.index', compact('plans'));
        }


        // Store a newly created plan
        public function store(Request $request)
        {
            $validated = request()->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
            ]);

            Plan::create($validated);

            return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully.');
        }

        // Show the form for editing an existing plan
        public function edit($id)
        {
            $plan = Plan::findOrFail($id);
            return view('admin.plans.edit', compact('plan'));
        }

        // Update an existing plan
        public function update(Request $request, $id)
        {
            $plan = Plan::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
            ]);

            $plan->update($validated);

            return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully.');
        }

        // Delete a plan
        public function destroy($id)
        {
            $plan = Plan::findOrFail($id);
            $plan->delete();

            return redirect()->route('admin.plans.index')->with('success', 'Plan deleted successfully.');
        }
}
