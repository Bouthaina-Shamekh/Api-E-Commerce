@extends('dashboard.layouts.master')
@section('title', __('Cities'))
@section('css')
<link href="{{URL::asset('dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-color-markers/dist/css/leaflet-color-markers.css" />
    <script src="https://unpkg.com/leaflet-color-markers/dist/leaflet-color-markers.js"></script>

@stop

@section('content')

<h1>{{__('Add new City')}}</h1>
<form action="{{ route('city.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group col-md-6">

        <label for="exampleInputEmail1">{{ __('City IN English') }} :</label>
        <input type="text" class="form-control" name="name_en">
        @error('name_en')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="exampleInputEmail1">{{ __('City IN Arabic') }} :</label>
        <input type="text" class="form-control" name="name_ar">
        @error('name_ar')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>

    <button type="submit"
    class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ __('Save') }}</button>
</form>
@endsection

@section('script')
<script src="{{URL::asset('dashboard/js/form-validation.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/select2/js/select2.min.js')}}"></script>
