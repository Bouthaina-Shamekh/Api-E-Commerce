@extends('dashboard.layouts.master')
@section('title', __('Product'))
@section('css')
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
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="row row-xs wd-xl-80p">
                        <div class="col-sm-6 col-md-3 mg-t-10">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route('product.update' , $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row row-sm">

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Title in English') }} :</label>
                            <input type="text" class="form-control" name="title_en" value="{{ old('title_en' , $product->title_en) }}">
                            @error('title_en')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Title in Arabic') }} :</label>
                            <input type="text" class="form-control" name="title_ar" value="{{ old('title_ar' , $product->title_ar) }}"
                                required>
                            @error('title_ar')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Price') }} :</label>
                            <input type="number" class="form-control" name="price" value="{{ old('price' , $product->price) }}" required>
                            @error('price')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Discount') }} :</label>
                            <input type="number" class="form-control" name="discount" value="{{ old('discount' , $product->discount) }}">
                            @error('discount')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Image') }} :</label>
                            <input type="file" class="form-control" name="master_image">
                            @error('file')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Category Name') }} :</label>
                            <select name="category_id" class="form-control">
                                @foreach ($categories as $value)
                                    <option value="{{ $value->id }}" @if ($value->id == old('category_id' , $product->category_id)) selected @endif>
                                        {{ app()->getLocale() == 'ar' ? $value->title_ar : $value->title_en }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Type') }} :</label>
                            <select name="type" class="form-control">
                                <option value=""></option>
                                <option value="ALL" @if ('ALL' == old('type' , $product->type)) selected @endif>
                                    {{ __('ALL') }}</option>
                                <option value="NEW" @if ('NEW' == old('type' , $product->type)) selected @endif>
                                    {{ __('NEW') }}</option>
                                <option value="MOSTBOUGHT" @if ('MOSTBOUGHT' == old('type' , $product->type)) selected @endif>
                                    {{ __('MOSTBOUGHT') }}</option>
                                <option value="MOSTWATCHED" @if ('MOSTWATCHED' == old('type' , $product->type)) selected @endif>
                                    {{ __('MOSTWATCHED') }}</option>
                                <option value="MOSTFAVOURITE" @if ('MOSTFAVOURITE' == old('type' , $product->type)) selected @endif>
                                    {{ __('MOSTFAVOURITE') }}</option>
                            </select>
                            @error('type')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>



                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Status') }} :</label>
                            <select name="status" class="form-control">
                                <option value="ACTIVE" @if ('ACTIVE' == old('status' , $product->status)) selected @endif>
                                    {{ __('ACTIVE') }}</option>
                                <option value="INACTIVE" @if ('INACTIVE' == old('status' , $product->status)) selected @endif>
                                    {{ __('NACTIVE') }}</option>
                            </select>
                            @error('status')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('General in Arabic') }} :</label>
                            <textarea name="general_info_ar" class="form-control" rows="10">{{ old('general_info_ar' , $product->general_info_ar) }}</textarea>
                            @error('general_info_ar')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('General in English') }} :</label>
                            <textarea name="general_info_en" class="form-control" rows="10">{{ old('general_info_en' , $product->description_ar) }}</textarea>
                            @error('general_info_en')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Specefications in Arabic') }} :</label>
                            <textarea name="specefications_ar" class="form-control" rows="10">{{ old('specefications_ar' , $product->specefications_ar) }}</textarea>
                            @error('specefications_ar')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Specefications in English') }} :</label>
                            <textarea name="specefications_en" class="form-control" rows="10">{{ old('specefications_en' , $product->specefications_en) }}</textarea>
                            @error('specefications_en')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Description in Arabic') }} :</label>
                            <textarea name="description_ar" class="form-control" rows="10">{{ old('description_ar' , $product->description_ar) }}</textarea>
                            @error('description_ar')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Description in English') }} :</label>
                            <textarea name="description_en" class="form-control" rows="10">{{ old('description_en' , $product->description_ar) }}</textarea>
                            @error('description_en')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <input type="hidden" name="lat" id="lat" value="{{ old('lat' , $product->lat) }}">

                        <input type="hidden" name="lng" id="lng" value="{{ old('lng' , $product->lng) }}">
                        <div id="map" class="form-group col-md-12"></div>
                        </div>
                        <button type="submit"
                            class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
