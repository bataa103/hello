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
        $validatedData = request()->validate([
            'bank' => 'required|string|max:255',
            'IBAN' => 'required|numeric',
            'thumbnail' => 'nullable|image',
            'balance' =>'required|numeric',
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

        Credit::create([
            'bank' => $validatedData['bank'],
            'IBAN' => $validatedData['IBAN'],
            'thumbnail' => $validatedData['thumbnail'],
            'balance' => $validatedData['balance'],
        ]);

        return redirect()->route('user.credit.index')->with('success', 'Credit created successfully!');
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'bank' => 'required|string|max:255',
            'IBAN' => 'required|numeric',
            'balance' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $credit = Credit::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/user/credit/thumbnail'), $filename);
            $validatedData['thumbnail'] = 'uploads/user/credit/thumbnail/' . $filename;

            // Optionally delete the old thumbnail
            if ($credit->thumbnail && file_exists(public_path($credit->thumbnail))) {
                unlink(public_path($credit->thumbnail));
            }
        }

        $credit->update($validatedData);

        return redirect()->route('user.credit.index')->with('success', 'Данс амжилттай шинэчлэгдлээ!');
    }

    public function destroy($id)
    {
        $credit = Credit::findOrFail($id);

        // Optionally delete the thumbnail file
        if ($credit->thumbnail && file_exists(public_path($credit->thumbnail))) {
            unlink(public_path($credit->thumbnail));
        }

        $credit->delete();

        return redirect()->route('user.credit.index')->with('success', 'Данс амжилттай устгагдлаа!');
    }

}
