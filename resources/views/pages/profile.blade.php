@extends('layouts.master')

@section('title')
    Profile
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-12 col-lg-8">
                <livewire:profile.index />
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
@endsection
