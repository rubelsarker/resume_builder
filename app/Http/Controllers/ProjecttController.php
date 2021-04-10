<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProjecttController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Project::where('user_id',Auth::id())->get();
        return view('project.index',compact('data'));
    }


    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'title'=>'required',
            'image'=>'required|mimes:jpeg,png,jpg',
            'type'=>'required',
        ]);
        $image = $request->file('image');
        if(isset($image)){
            $imageName = Str::of($request->title)->slug('-').uniqid().'.'.$image->getClientOriginalExtension();
            $upload_path='upload/product';
            $image_url = $upload_path.'/'.$imageName;
            if (! File::exists($upload_path)) {
                File::makeDirectory($upload_path, $mode = 0777, true, true);
            }
            $img = Image::make($image->getRealPath());
            $img->resize(200, 200)->save($upload_path.'/'.$imageName);
        }
        $data = [
            'title'=>$request->title,
            'image'=>$image_url,
            'type'=>$request->type,
            'sort_des'=>$request->sort_des,
            'user_id'=>Auth::id(),
        ];
        Project::create($data);
        return redirect()->bacK()->with('success','Project add successfully!');
    }
    public function edit($id){
        $row = Project::find($id);
        return view('project.edit',compact('row'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'image'=>'mimes:jpeg,png,jpg',
            'type'=>'required',
        ]);
        $row= Project::find($id);
        $image = $request->file('image');
        if(isset($image)){
            $imageName = Str::of($request->title)->slug('-').uniqid().'.'.$image->getClientOriginalExtension();
            $upload_path='upload/product';
            $image_url = $upload_path.'/'.$imageName;
            if (! File::exists($upload_path)) {
                File::makeDirectory($upload_path, $mode = 0777, true, true);
            }
            if(file_exists($row->image)){
                unlink($row->image);
            }
            $img = Image::make($image->getRealPath());
            $img->resize(200, 200)->save($upload_path.'/'.$imageName);
        }else{
            $image_url = $row->image;
        }
        $data = [
            'title'=>$request->title,
            'image'=>$image_url,
            'type'=>$request->type,
            'sort_des'=>$request->sort_des,
            'user_id'=>Auth::id(),
        ];
        Project::where('id',$id)->update($data);
        return redirect()->bacK()->with('success','Project updated successfully!');
    }


    public function destroy($id)
    {
        $row = Project::find($id);
        if(file_exists($row->image)){
            unlink($row->image);
        }
        $row->delete();
        return redirect()->route('project.index')->with('success','Project deleted successfully!');
    }
}
