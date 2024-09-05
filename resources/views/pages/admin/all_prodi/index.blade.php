@extends('layouts.home-layout')

@section('home-content')
    <li>
        <a href="javascript: void(0);" class="has-arrow">
            <i data-feather="sliders"></i>
            <span data-key="t-tables">Tables</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            <li><a href="tables-editable.html" data-key="t-editable-table">All Prodi</a></li>
        </ul>
    </li>
@endsection
