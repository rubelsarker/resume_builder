<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function update(Request $request, $id)
    {
        $data = [

            'facebook'=>$request->facebook,
            'twitter'=>$request->twitter,
            'linked_in'=>$request->linked_in,
            'website'=>$request->website,
            'user_id'=>Auth::id(),
        ];

        if($request->rowId){
            Social::where('id',$request->rowId)->update($data);
            return redirect()->bacK()->with('success','Social link updated successfully!');
        }else{
            Social::create($data);
            return redirect()->bacK()->with('success','Social link add successfully!');
        }
    }

}
