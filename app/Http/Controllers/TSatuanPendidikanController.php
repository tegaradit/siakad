<?php

namespace App\Http\Controllers;

use App\Models\Educational_unit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TSatuanPendidikanController extends Controller
{
    public function index()
    {
         return view('pages.admin.educational_unit.index');
    }

    public function getEducationalUnitData()
    {
        $educationalunit = Educational_unit::select([
        'id_sp',
        'nm_lemb',
        'nss',
        'npsn',
        'nm_singkat',
        'jln',
        'rt',
        'rw',
        'nm_dsn',
        'ds_kel',
        'kode_pos',
        'lintang',
        'bujur',
        'no_tel',
        'no_fax',
        'email',
        'website',
        'stat_sp',
        'sk_pendirian_sp',
        'tgl_sk_pendirian_sp',
        'tgl_berdiri',
        'sk_izin_operasi',
        'tgl_sk_izin_operasi',
        'no_rek',
        'nm_bank',
        'unit_cabang',
        'nm_rek',
        'a_mbs',
        'luas_tanah_milik',
        'luas_tanah_bukan_milik',
        'a_lptk',
        'kode_reg',
        'npwp',
        'nm_wp',
        'flag',
        'id_pembina',
        'id_blob',
        'id_stat_milik',
        'id_wil',
        'id_kk',
        'id_bp',]);
        return DataTables::of($educationalunit)->make(true);
    }
}