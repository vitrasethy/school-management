@extends('layouts.master')

@section('content')
    @role('super admin')
    <livewire:home.super-admin-statistic/>
    @endrole
    @role('faculty admin')
    <livewire:home.school-admin-statistic/>
    @endrole
    @role('department admin')
    <livewire:home.department-admin-statistic/>
    @endrole
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $("#sidebar li a").removeClass("active");
            $("#dashboard>a").addClass("active");
            $("#dashboard").addClass("menu-open");
        });
    </script>
@endsection
