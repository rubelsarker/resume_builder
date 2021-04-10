<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PersonalController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create()
    {
        $row = Personal::where('user_id',Auth::id())->first();
        $social = Social::where('user_id',Auth::id())->first();
        return view('personal.create',compact('row','social'));
    }


    public function update(Request $request, $id)
    {
       if($request->rowId){
           $request->validate([
               'mobile'=>'required',
               'email'=>'required',
               'image'=>'mimes:jpeg,png,jpg',
               'designation'=>'required',
               'f_name'=>'required',
               'l_name'=>'required',
           ]);
           $row = Personal::find($request->rowId);
           $image = $request->file('image');
           if(isset($image)){
               $imageName = uniqid().'.'.$image->getClientOriginalExtension();
               $upload_path='upload/user';
               $image_url = $upload_path.'/'.$imageName;
               if (! File::exists($upload_path)) {
                   File::makeDirectory($upload_path, $mode = 0777, true, true);
               }
               if(file_exists($row->photo)){
                   unlink($row->photo);
               }
               $img = Image::make($image->getRealPath());
               $img->resize(200, 200)->save($upload_path.'/'.$imageName);
           }else{
               $image_url = $row->photo;
           }
           $data = [
               'mobile'=>$request->mobile,
               'email'=>$request->email,
               'designation'=>$request->designation,
               'f_name'=>$request->f_name,
               'l_name'=>$request->l_name,
               'photo'=>$image_url,
               'about'=>$request->about,
               'user_id'=>Auth::id(),
           ];
           Personal::where('id',$request->rowId)->update($data);
           return redirect()->bacK()->with('success','Personal info updated successfully!');
       }else{
           $request->validate([
               'mobile'=>'required',
               'email'=>'required',
               'image'=>'required|mimes:jpeg,png,jpg',
               'designation'=>'required',
               'f_name'=>'required',
               'l_name'=>'required',
           ]);
           $image = $request->file('image');
           if(isset($image)){
               $imageName = uniqid().'.'.$image->getClientOriginalExtension();
               $upload_path='upload/user';
               $image_url = $upload_path.'/'.$imageName;
               if (! File::exists($upload_path)) {
                   File::makeDirectory($upload_path, $mode = 0777, true, true);
               }
               $img = Image::make($image->getRealPath());
               $img->resize(200, 200)->save($upload_path.'/'.$imageName);
           }
           $data = [
               'mobile'=>$request->mobile,
               'email'=>$request->email,
               'designation'=>$request->designation,
               'f_name'=>$request->f_name,
               'l_name'=>$request->l_name,
               'photo'=>$image_url,
               'about'=>$request->about,
               'user_id'=>Auth::id(),
           ];
           Personal::create($data);
           return redirect()->bacK()->with('success','Personal info add successfully!');
       }
    }


}
