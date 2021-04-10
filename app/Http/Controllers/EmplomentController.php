<?php

namespace App\Http\Controllers;

use App\Models\Employment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmplomentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Employment::where('user_id', Auth::id())->get();
        return view('employment.index', compact('data'));
    }


    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'from_year' => 'required',
            'to_year' => 'required',
            'company' => 'required',
            'designation' => 'required',
        ]);

        $data = [
            'from_year' => date('Y-m-d',strtotime($request->from_year)),
            'to_year' => date('Y-m-d',strtotime($request->to_year)),
            'company' => $request->company,
            'designation' => $request->designation,
            'desc' => $request->desc,
            'user_id' => Auth::id(),
        ];
        Employment::create($data);
        return redirect()->bacK()->with('success', 'Employment add successfully!');
    }

    public function edit($id)
    {
        $row = Employment::find($id);
        return view('employment.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'from_year' => 'required',
            'to_year' => 'required',
            'company' => 'required',
            'designation' => 'required',
        ]);

        $data = [
            'from_year' => date('Y-m-d',strtotime($request->from_year)),
            'to_year' => date('Y-m-d',strtotime($request->to_year)),
            'company' => $request->company,
            'designation' => $request->designation,
            'desc' => $request->desc,
            'user_id' => Auth::id(),
        ];
        Employment::where('id',$id)->update($data);
        return redirect()->bacK()->with('success', 'Employment updated successfully!');
    }


    public function destroy($id)
    {
        $row = Employment::find($id);
        $row->delete();
        return redirect()->route('employment.index')->with('success', 'Employment deleted successfully!');
    }
}
