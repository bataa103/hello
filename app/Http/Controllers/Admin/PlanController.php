<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plan;

class PlanController extends Controller
{
    /**
     * Display all users with their plans.
     */
    public function index()
    {
        $users = User::with('plan')->get(); // Fetch users with their plans
        $plans = Plan::all(); // Fetch all plans
        return view('admin.plan.index', compact('users', 'plans'));
    }

    /**
     * Save user plans.
     */
    public function savePlan(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'plans.*.start_date' => 'required|date',
            'plans.*.end_date' => 'required|date|after_or_equal:plans.*.start_date',
            'plans.*.plan_id' => 'required|exists:plans,id', // Ensure the plan ID exists
        ]);

        // Iterate through the submitted data and save it
        foreach ($validated['plans'] as $userId => $planData) {
            $user = User::findOrFail($userId); // Ensure the user exists

            $user->update([
                'status_start_date' => $planData['start_date'],
                'status_end_date' => $planData['end_date'],
                'plan_id' => $planData['plan_id'], // Save the selected plan ID
            ]);
        }

        return redirect()->route('admin.plan.index')->with('success', 'Plans updated successfully!');
    }

    /**
     * Display all plans.
     */
    public function listPlans()
    {
        $plans = Plan::all(); // Fetch all plans
        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Store a newly created plan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        Plan::create($validated);

        return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully.');
    }

    /**
     * Show the form for editing an existing plan.
     */
    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Update an existing plan.
     */
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

    /**
     * Delete a plan.
     */
    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return redirect()->route('admin.plans.index')->with('success', 'Plan deleted successfully.');
    }
}


// class PlanController extends Controller
// {
//         // Display a list of all user plans
//         public function index()
//         {
//             $plans = Plan::all();
//             return view('admin.plans.index', compact('plans'));
//         }


//         // Store a newly created plan
//         public function store(Request $request)
//         {
//             $validated = request()->validate([
//                 'name' => 'required|string|max:255',
//                 'description' => 'nullable|string',
//                 'price' => 'required|numeric',
//             ]);

//             Plan::create($validated);

//             return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully.');
//         }

//         // Show the form for editing an existing plan
//         public function edit($id)
//         {
//             $plan = Plan::findOrFail($id);
//             return view('admin.plans.edit', compact('plan'));
//         }

//         // Update an existing plan
//         public function update(Request $request, $id)
//         {
//             $plan = Plan::findOrFail($id);

//             $validated = $request->validate([
//                 'name' => 'required|string|max:255',
//                 'description' => 'nullable|string',
//                 'price' => 'required|numeric',
//             ]);

//             $plan->update($validated);

//             return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully.');
//         }

//         // Delete a plan
//         public function destroy($id)
//         {
//             $plan = Plan::findOrFail($id);
//             $plan->delete();

//             return redirect()->route('admin.plans.index')->with('success', 'Plan deleted successfully.');
//         }
// }
