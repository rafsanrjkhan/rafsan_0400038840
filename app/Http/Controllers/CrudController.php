<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud;
use Session;
use Carbon\Carbon;
class CrudController extends Controller
{
    public function add()
    {
        return view('add');
    }

    public function list()
    {
        $products = Crud::all();
        return view('dashboard', compact('products'));
    }

    public function insert(Request $req)
    { 
        $crud = new Crud();
        $crud->name = $req->name;
        $crud->type = $req->type;
        if($req->hasFile('image'))
        {
            $file = $req->file('image');
            $filename = uniqid().$file->getClientOriginalName();
            $file->move('uploads/', $filename);
            $crud->image = $filename;
        }
        
        $crud->save();
        Session::flash('message', 'Product is Added');
        return redirect()->route('dashboard');
    }


    public function delete(Request $req)
    {
        $product = Crud::find($req->id);
        $path = public_path('uploads/'.$product->image);
        if(file_exists($path))
        {
            unlink($path);
        }
        $product->delete();
        Session::flash('message', 'Product is Deleted');
        return redirect()->route('dashboard');
    }

    public function edit(Request $req)
    {
        $editdata = Crud::find($req->id);
        return view('edit', compact('editdata'));
    }

    public function update(Request $req)
    {
        $crud = Crud::find($req->id);
        $crud->name = $req->name;
        $crud->type = $req->type;
        if($req->hasFile('newimage'))
        {
            $destination = public_path('uploads/'.$req->oldimage);
            if(file_exists($destination)){
                unlink($destination);
            }
            $file = $req->file('newimage');
            $filename = uniqid().$file->getClientOriginalName();
            $file->move('uploads/', $filename);
            $crud->image = $filename;
        }
        
        $crud->update();
        Session::flash('message', 'Product is Updated');
        return redirect()->route('dashboard');
    }

    public function add_cart(Request $req)
    {
         $crud = Crud::find($req->id);
         
         if($req->status==0)
         {
            $crud->is_active = 1;
            $crud->change_status_time = Carbon::now();
         }
         $crud->update();
         Session::flash('message', 'Product is Added in the Cart');
         return redirect()->route('product_cartList');
    }

    public function remove_cart(Request $req)
    {
         $crud = Crud::find($req->id);
         
         if($req->status==1)
         {
            $crud->is_active = 0;
            $crud->change_status_time = Carbon::now();
         }
         $crud->update();
         Session::flash('message', 'Product is removed from the Cart');
         return redirect()->route('product_cartList');
    }

    public function cart(Request $req)
    {
        $products = Crud::all();
        return view('cart', compact('products'));
    }
}
