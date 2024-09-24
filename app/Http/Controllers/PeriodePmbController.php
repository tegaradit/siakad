<?php

namespace App\Http\Controllers;

use App\Models\Periode_pmb;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class PeriodePmbController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Periode_pmb::get())
                ->addColumn('action', function ($row) {
                    $editUrl = route('periode_pmb.edit', $row->id);
                    $deleteUrl = route('periode_pmb.destroy', $row->id);
                    $csrfToken = csrf_field();
                    $methodField = method_field('delete');

                    return <<<EOT
                        <form id="delete-form-$row->id" onsubmit="event.preventDefault(); confirmDelete($row->id);" action="$deleteUrl" method="POST">
                            $csrfToken
                            $methodField
                            <a href="$editUrl" class="btn btn-warning btn-sm edit" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <button type="submit" class="btn icon icon-left btn-danger btn-sm delete" title="Delete">
                                <i class="fas fa-trash-alt"></i> 
                                Hapus
                            </button>
                        </form>
                    EOT;
                })
                ->editColumn('start_date', function ($row) {
                    return date('d-m-Y', strtotime($row->start_date));
                })
                ->editColumn('end_date', function ($row) {
                    return date('d-m-Y', strtotime($row->end_date));
                })
                
                ->make(true);
        }

        return view('pages.admin.periode_pmb.index');
    }

    public function create() {
        $isAnotherOpen = $this->anotherIsOpen()['result'];
        return view('pages.admin.periode_pmb.add')->with(compact('isAnotherOpen'));
    }

    public function searchSemester (Request $request) {
        $search = $request->query('semester_id') != '' ? $request->query('semester_id') : 'null';
        return $request->ajax() ? Semester::where('is_active', '=', 1)->where('semester_id', 'like', "%$search%")->get() : abort(404);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'semester_id' => ['required', 'numeric', Rule::exists('semester')],
            'period_number' => ['required', 'numeric', 'max_digits:1'],
            'status' => ['required', 'numeric', Rule::in('0', '1')],
            'period_range' => ['required', 'regex:/^\d{4}-\d{2}-\d{2}\s+to\s+\d{4}-\d{2}-\d{2}$/']
        ]);

        if ($request->isAnotherOpen && $validatedData['status'] == "1") {
            Periode_pmb::where('status', '=', '1')->update(['status' => '0']);
        }

        [$startDate, $endDate] = explode(' to ', $validatedData['period_range']);
        Periode_pmb::create([
            'semester_id' => $validatedData['semester_id'], 
            'period_number' => $validatedData['period_number'],
            'start_date' => $startDate, 
            'end_date' => $endDate,
            'status' => $validatedData['status']
        ]);


        return redirect()->route('periode_pmb.index');
    }

    public function anotherIsOpen () {
        return ["result" => count(Periode_pmb::where('status', '=', 1)->get()->toArray()) > 0];
    }


    public function destroy (string $id, Periode_pmb $periode_pmb) {
        $periode_pmb->findOrFail($id)->delete();
        return redirect()->back();
    }

    public function edit (string $id) {
        $prev_period_data = Periode_pmb::findOrFail($id);
        $prev_semester_data = Semester::findOrFail($prev_period_data->semester_id);
        $isAnotherOpen = $this->anotherIsOpen()['result'];

        return view('pages.admin.periode_pmb.edit')->with(compact('prev_period_data', 'prev_semester_data', 'isAnotherOpen'));
    }

    public function update (Request $request, string $id, Periode_pmb $periode_pmb) {
        $validatedData = $request->validate([
            'semester_id' => ['required', 'numeric', Rule::exists('semester')],
            'period_number' => ['required', 'numeric', 'max_digits:1'],
            'period_range' => ['required', 'regex:/^\d{4}-\d{2}-\d{2}\s+to\s+\d{4}-\d{2}-\d{2}$/'],
            'status' => ['required', 'numeric', 'max_digits:1']
        ]);

        if ($request->isAnotherOpen && $validatedData['status'] == "1") {
            Periode_pmb::where('status', '=', '1')->update(['status' => '0']);
        }

        [$startDate, $endDate] = explode(' to ', $validatedData['period_range']);

        $periode_pmb->findOrFail($id)->update([
            'semester_id' => $validatedData['semester_id'], 
            'period_number' => $validatedData['period_number'],
            'start_date' => $startDate, 
            'end_date' => $endDate,
            'status' => $validatedData['status']
        ]);

        return redirect()->route('periode_pmb.index');
    }
}
