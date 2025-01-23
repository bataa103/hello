<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plan;


class PlanController extends Controller
{

        public function index()
        {
            $plans = Plan::all();
            return view('admin.plan.index', compact('plans'));
        }



        public function store(Request $request)
        {
            $validated = request()->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
            ]);

            Plan::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
            ]);

            return redirect()->route('admin.plan.index')->with('success', 'Plan created successfully.');
        }


        public function update(Request $request, $id)
        {
            $plan = Plan::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
            ]);

            $plan->update($validated);

            return redirect()->route('admin.plan.index')->with('success', 'Plan updated successfully.');
        }

        public function destroy($id)
        {
            $plan = Plan::findOrFail($id);
            $plan->delete();

            return redirect()->route('admin.plan.index')->with('success', 'Plan deleted successfully.');
        }
}
