<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Menu;


class AdminController extends Controller
{
    public function callAction($method, $parameters)
    {
        return parent::callAction($method, array_values($parameters));
    }
    public function mainpage(Request $req)
    {
        $data["category1"] = Menu::where('menu_category',1)->orderBy("position","asc")->take(2)->get();
        $data["category2"] = Menu::where('menu_category',2)->orderBy("position","asc")->take(1)->get();
        return view('menu',$data);
    }



    public function saveMenuItem(Request $req)
    {
        $validate = Validator::make($req->all(),[
            "menuname"=>"required",
            "price"=>"required",
            "description"=>"required",
            "imageurl"=>"required"
        ]);

        if($validate->fails())
        {
            return redirect()->back()->with('error','Fill All Fields');
        }
        $menu = new Menu;
        $menu->name = $req->menuname;
        $menu->price = $req->price;
        $menu->description = $req->description;
        $menu->image_url = $req->imageurl;
        $menu->menu_category = $req->category;

        $checkPosition = Menu::where('menu_category',$req->category)->where('position',$req->position)->first();
        if(!empty($checkPosition))
        {   
            $menu->position = $checkPosition->position;
            $menu->save();
            $checkPosition->position = $menu->id;
            $checkPosition->save();
        }
        else{
            $menu->position = $req->position;
            $menu->save();
        }


        return redirect()->back()->with('success','Food Item Added');
    }


    public function viewItem(Request $req)
    {
        $data["menu"] = Menu::orderBy("position","asc")->get();
        return view('admin.index',$data);
    }

    public function getEditItem(Request $req,$id)
    {
        $data["menu"] = Menu::where("id",$id)->first();
        if(!empty($data))
        {
            return view('admin.edititem' , $data);
        }
        else{
            return view('admin.edititem' , $data)->with('error','No Such Menu Found');
        }
        
    }

    public function editItem(Request $req)
    {
        $validate = Validator::make($req->all(),[
            "menuname"=>"required",
            "price"=>"required",
            "description"=>"required",
            "imageurl"=>"required"
        ]);

        if($validate->fails())
        {
            return redirect()->back()->with('error','Fill All Fields');
        }
        $menu = Menu::where("id",$req->menuid)->first();
        if(!empty($menu))  
        {
            $temp = $menu->position;
            $menu->name = $req->menuname;
            $menu->price = $req->price;
            $menu->description = $req->description;
            $menu->image_url = $req->imageurl;
            $checkPosition = Menu::where('menu_category',$req->category)->where('position',$req->position)->first();
            if(!empty($checkPosition))
            {   
                $menu->position = $checkPosition->position;
                $menu->save();

                $checkPosition->position = $temp;
                $checkPosition->save();
            }
            else{
                $menu->position = $req->position;
                $menu->save();
            }

            return redirect('/admin')->with('success','Item Changes Made Successfully');
        }
        
    }

    public function searchItem(Request $req)
    {
        $item = $req->itemname;
        $data["search"] = Menu::where('name','LIKE',"%{$item}%")->get();

        if(count($data["search"])>0)
        {
            return view('search',$data);
        }
        else{
            return view('search' , $data)->with('error','No Such Item Found');
        }
    }

    public function deleteItem(Request $req , $id)
    {
        $menu = Menu::where('id',$id)->delete();
        if($menu)
        {
            return back()->with('success','Item Deleted');
        }
        else{
            return back()->with('error','Error Occured');
        }
    }

    public function getAllItem(Request $req , $id){
        $data["all"] =Menu::where('menu_category',$id)->get();
        $data["id"] = $id;
        if(count($data["all"])>0)
        {
            return view('seeallitem',$data);
        }
        else{
            return view('seeallitem',$data);
        }
    }
}
