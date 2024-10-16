<?php

namespace App\Http\Controllers;

use App\Models\activity_type;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ActivityTypeController extends Controller
{
    public function index()
    {
        $menu = 'data';
        $submenu = 'activity-type';
        return view('pages.admin.activity_type.index', compact('menu', 'submenu')); 
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $activityTypes = activity_type::query();

            return DataTables::of($activityTypes)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a href="#" class="btn btn-warning btn-sm edit" data-id="' . $data->id . '" data-name="' . $data->name . '" data-bs-toggle="modal" data-bs-target="#editActivityTypeModal"><i class="fas fa-pencil-alt"></i> Edit</a>
                            <form id="delete-form-' . $data->id . '" 
                                  onsubmit="event.preventDefault(); confirmDelete(' . $data->id . ');" 
                                  action="' . route('activity-type.destroy', $data->id) . '" 
                                  method="POST" style="display:inline-block; margin: 0;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm delete"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>';
                })
                ->make(true);
        }

        return abort(404);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
        ]);

        activity_type::create($validated);

        return redirect()->route('activity-type.index');
    }

    public function edit($id)
    {
        $activityType = activity_type::findOrFail($id);
        return response()->json($activityType);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
        ]);

        $activityType = activity_type::findOrFail($id);
        $activityType->update($validated);

        return redirect()->route('activity-type.index');
    }

    public function destroy($id)
    {
        $activityType = activity_type::findOrFail($id);
        $activityType->delete();

        return redirect()->route('activity-type.index');
    }
}