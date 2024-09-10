<?php

namespace App\Http\Controllers;

use App\Models\Calendar_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CalendarTypeController extends Controller
{
    public function index()
    {
        $menu = 'data';
        $submenu = 'calendar_type';
        $datas = Calendar_type::latest()->paginate(5);
        return view('admin.post_category.index', compact('datas', 'menu', 'submenu'));
    }
    public function create(){
        $menu = 'data';
        $submenu = 'calendar_type';
        return view('admin.post_category.form', compact('menu', 'submenu'));
    }
    function store(Request $request){
        $post = new Calendar_type();
        $post->name=$request->name;
        $post->save();
        Session::flash('success', 'Data berhasil disimpan.');
        return redirect('admin/post_category');
    }
    function show($id){
        $menu = 'data';
        $submenu = 'post_category';
        $post_category = Calendar_type::find($id);
        return view('admin.post_category.show', compact('post_category', 'menu', 'submenu'));
    }
    function edit($id){
        $menu = 'data';
        $submenu = 'post_category';
        $post_category = Calendar_type::find($id);
        return view('admin.post_category.form_edit', compact('post_category', 'menu', 'submenu'));
    }

    function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|min:5'
        ]);
        $post_category = Calendar_type::findOrFail($id);
        $post_category-> update(['name'=>$request->name]);
        return redirect()->route('post_category.index')->with(['success'=>'Data berhasil diubah!']);
    }

    function destroy( $id)
    {
        $post_category=Calendar_type::findOrFail($id);
        $post_category->delete();
        return redirect()->route('post_category.index')->with(['success'=> 'Data berhasil di hapus.']);
    }
}
