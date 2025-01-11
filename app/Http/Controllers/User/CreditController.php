<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Credit;

class CreditController extends Controller
{

    public function index()
    {
        $credits = Credit::all();
        return view('user.credit.index', compact('credits'));
    }



    public function store()
    {
        $validatedData = $request->validate([
            'bank' => 'required|string|max:255',
            'IBAN' => 'required|numeric',
            'thumbnail' => 'nullable|image',
        ]);

        if(request()->hasFile('thumbnail')){
            $file = request()->file('thumbnail');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/user/credit/thumbnail'),$filename);

            $validatedData['thumbnail'] = 'uploads/user/credit/thumbnail' . $filename;
        }
        else
        {
            $validatedData['thumbnail'] = null;
        }

        Credit::query()-create([
            'bank' => $validatedData['bank'],
            'IBAN' => $validatedData['IBAN'],
            'thumbnail' => $validatedData['thumbnail'],
        ]);

        return redirect()->route('user.credit.index')->with('success', 'Credit created successfully!');
    }


    // public function edit($id)
    // {
    //     $credit = Credit::findOrFail($id);
    //     return view('user.credit.edit', compact('credit'));
    // }


    // public function update(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'bank' => 'required|string|max:255',
    //         'thumbnail' => 'nullable|image',
    //     ]);

    //     $credit = Credit::findOrFail($id);
    //     $credit->update($validatedData);

    //     return redirect()->route('user.credit.index')->with('success', 'Credit updated successfully!');
    // }

    // public function destroy($id)
    // {
    //     $credit = Credit::findOrFail($id);
    //     $credit->delete();

    //     return redirect()->route('user.credit.index')->with('success', 'Credit deleted successfully!');
    // }
}
