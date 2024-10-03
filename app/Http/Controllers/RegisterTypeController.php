<?php

namespace App\Http\Controllers;

use App\Models\register_type;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RegisterTypeController extends Controller
{
    public function index()
    {
        return view('pages.admin.register_type.index'); 
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $registerTypes = register_type::query();

            return DataTables::of($registerTypes)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a href="#" class="btn btn-warning btn-sm edit" data-id="' . $data->id . '" data-name="' . $data->name . '" data-bs-toggle="modal" data-bs-target="#editRegisterTypeModal"><i class="fas fa-pencil-alt"></i> Edit</a>
                            <form id="delete-form-' . $data->id . '" 
                                  onsubmit="event.preventDefault(); confirmDelete(' . $data->id . ');" 
                                  action="' . route('register-type.destroy', $data->id) . '" 
                                  method="POST" style="display:inline-block; margin: 0;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm delete"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>';
                })
                ->make(true);
        }

        return abort(404);
    }

    // public function create()
    // {
    //     return view('pages.admin.register_type.form'); // Ganti dengan path view yang sesuai
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
        ]);

        register_type::create($validated);

        return redirect()->route('register-type.index');
    }

    public function edit($id)
    {
        $registerType = register_type::findOrFail($id);
        return response()->json($registerType);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
        ]);

        $registerType = register_type::findOrFail($id);
        $registerType->update($validated);

        return redirect()->route('register-type.index');
    }

    public function destroy($id)
    {
        $registerType = register_type::findOrFail($id);
        $registerType->delete();

        return redirect()->route('register-type.index');
    }
}
