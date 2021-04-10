<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Education::where('user_id', Auth::id())->get();
        return view('education.index', compact('data'));
    }


    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'degree' => 'required',
            'institute' => 'required',
            'result' => 'required|numeric',
            'passing_year' => 'required|numeric',
        ]);

        $data = [
            'degree' => $request->degree,
            'institute' => $request->institute,
            'result' => $request->result,
            'passing_year' => $request->passing_year,
            'user_id' => Auth::id(),
        ];
        Education::create($data);
        return redirect()->bacK()->with('success', 'Education add successfully!');
    }

    public function edit($id)
    {
        $row = Education::find($id);
        return view('education.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'degree' => 'required',
            'institute' => 'required',
            'result' => 'required|numeric',
            'passing_year' => 'required|numeric',
        ]);

        $data = [
            'degree' => $request->degree,
            'institute' => $request->institute,
            'result' => $request->result,
            'passing_year' => $request->passing_year,
            'user_id' => Auth::id(),
        ];
        Education::where('id',$id)->update($data);
        return redirect()->bacK()->with('success', 'Education updated successfully!');
    }


    public function destroy($id)
    {
        $row = Education::find($id);
        $row->delete();
        return redirect()->route('education.index')->with('success', 'Education deleted successfully!');
    }
}
