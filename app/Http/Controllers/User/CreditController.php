<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Credit;
use Illuminate\Support\Facades\Auth;

class CreditController extends Controller
{

    public function index()
    {
        $credits = Credit::where('user_id', Auth::id())->get();
        return view('user.credit.index', compact('credits'));
    }


    public function store(Request $request)
    {
        $userId = Auth::id();


        $validatedData = $request->validate([
            'bank' => 'required|string|max:255',
            'IBAN' => 'required|numeric',
            'thumbnail' => 'nullable|image|max:2048',
            'balance' => 'required|numeric|min:0',
        ]);


        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/user/credit/thumbnail'), $filename);

            $validatedData['thumbnail'] = 'uploads/user/credit/thumbnail/' . $filename;
        } else {
            $validatedData['thumbnail'] = null;
        }


        if (!$userId) {
            return redirect()->route('user.credit.index')->withErrors('User not authenticated.');
        }


        Credit::create([
            'bank' => $validatedData['bank'],
            'IBAN' => $validatedData['IBAN'],
            'thumbnail' => $validatedData['thumbnail'],
            'balance' => $validatedData['balance'],
            'user_id' => $userId,
        ]);

        return redirect()->route('user.credit.index')->with('success', 'Credit created successfully!');
    }




    public function update(Request $request, $id)
    {
        $credit = Credit::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $validatedData = $request->validate([
            'bank' => 'required|string|max:255',
            'IBAN' => 'required|numeric|unique:credits,IBAN,' . $credit->id,
            'balance' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/user/credit/thumbnail'), $filename);
            $validatedData['thumbnail'] = 'uploads/user/credit/thumbnail/' . $filename;


            if ($credit->thumbnail && file_exists(public_path($credit->thumbnail))) {
                unlink(public_path($credit->thumbnail));
            }
        }

        $credit->update($validatedData);

        return redirect()->route('user.credit.index')->with('success', 'Credit updated successfully!');
    }


    public function destroy($id)
    {
        $credit = Credit::where('id', $id)->where('user_id', Auth::id())->firstOrFail();


        if ($credit->thumbnail && file_exists(public_path($credit->thumbnail))) {
            unlink(public_path($credit->thumbnail));
        }

        $credit->delete();

        return redirect()->route('user.credit.index')->with('success', 'Credit deleted successfully!');
    }
}
