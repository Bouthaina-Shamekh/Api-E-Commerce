@extends('dashboard.layouts.master')
@section('title', __('Product'))
@section('css')


<link href="{{ asset('dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
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
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


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
                    <form class="needs-validation" action="{{ route('variant.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm">

                            <input type="number" name="product_id" value="{{ $id }}" hidden>


                        <div class="form-group col-md-6">

                            <label for="exampleInputEmail1">{{ __('product name') }} :</label>
                            <input type="text" class="form-control" name="title_ar" value="{{ App\Models\Product::find($id)->title_en }}" disabled>
                            @error('title_ar')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Price') }} :</label>
                            <input type="number" class="form-control" name="price" value="{{ App\Models\Product::find($id)->price }}" required>
                            @error('price')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Discount') }} :</label>
                            <input required type="number" class="form-control" name="discount" value="{{ App\Models\Product::find($id)->discount }}">
                            @error('discount')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Image') }} :</label>
                            <input type="file" class="form-control" name="image" value="{{App\Models\Product::find($id)->master_image}}">
                            @error('image')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="table-responsive">
                            <table class="table mg-b-0 text-md-nowrap">

                                <tbody>


                                    @foreach ($data as $da)
                                    @php
                                        $options=App\Models\Option::where('attribute_id',$da->attribute_id)->where('product_id',$id)->get()
                                    @endphp
                                        <tr>
                                            <th scope="row">{{App\Models\Attribute::find($da->attribute_id)->title_en  }}</th>
                                            @foreach ($options as $q)
                                                <td>
                                        <label class="checkbox  col-3  h5"style="">
                                        <input required class="icheck-green largerCheckbox"type="radio" name="{{$da->attribute_id}}" id="{{$q->id }}" value="{{$q->id }}">
                                        <span> {{$q->title_en }}</span>
                                        </label>

                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                            </table>
                        </div>




                    </div>
                        <button type="submit"
                            class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script
  src="https://code.jquery.com/jquery-3.6.3.min.js"
  integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
  crossorigin="anonymous"></script>

<script src="{{URL::asset('dashboard/js/form-validation.js')}}"></script>

<script src="{{ asset('dashboard/plugins/select2/js/select2.min.js') }}"></script>
@stop
