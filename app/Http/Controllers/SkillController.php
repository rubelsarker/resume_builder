<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Skill::where('user_id', Auth::id())->get();
        return view('skill.index', compact('data'));
    }


    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'skill_label' => 'required|numeric',
            'skill' => 'required',
        ]);

        $data = [
            'skill_label' => $request->skill_label,
            'skill' => $request->skill,
            'user_id' => Auth::id(),
        ];
        Skill::create($data);
        return redirect()->bacK()->with('success', 'Skill add successfully!');
    }

    public function edit($id)
    {
        $row = Skill::find($id);
        return view('skill.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'skill_label' => 'required|numeric',
            'skill' => 'required',
        ]);

        $data = [
            'skill_label' => $request->skill_label,
            'skill' => $request->skill,
            'user_id' => Auth::id(),
        ];
        Skill::where('id',$id)->update($data);
        return redirect()->bacK()->with('success', 'Skill updated successfully!');
    }


    public function destroy($id)
    {
        $row = Skill::find($id);
        $row->delete();
        return redirect()->route('skill.index')->with('success', 'Skill deleted successfully!');
    }
}
