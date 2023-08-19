@extends('dashboard.layouts.master')
@section('title', __('Product'))
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

<body >

<div class="container">

        <form class="needs-validation" action="{{ route('product.store') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-bottom:30px;">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">English Language</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">اللغة العربية</button>
            </li>
        </ul>
  <div class="row">
                
        <div class="col-6">
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <div class="form-group ">
                    <label for="exampleInputEmail1">{{ __('Title in English') }} :</label>
                    <input type="text" class="form-control" name="title_en" value="{{ old('title_en') }}">
                    @error('title_en')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="exampleInputEmail1">{{ __('General info in English') }} :</label>
                    <textarea name="general_info_en" class="form-control" rows="10"></textarea>
                    @error('general_info_en')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="exampleInputEmail1">{{ __('Specefications in English') }} :</label>
                    <textarea name="specefications_en" class="form-control" rows="10"></textarea>
                    @error('specefications_en')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="exampleInputEmail1">{{ __('Description in English') }} :</label>
                    <textarea name="description_en" class="form-control" rows="10"></textarea>
                    @error('description_en')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
              </div> {{-- End Eng --}}

              <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

                <div class="form-group ">
                    <label for="exampleInputEmail1">{{ __('Title in Arabic') }}:</label>
                    <input type="text" class="form-control" name="title_ar" value="{{ old('title_ar') }}"
                        >
                    @error('title_ar')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="exampleInputEmail1">{{ __('General Info in Arabic') }} :</label>
                    <textarea name="general_info_ar" class="form-control" rows="10"></textarea>
                    @error('general_info_ar')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="exampleInputEmail1">{{ __('Specefications in Arabic') }} :</label>
                    <textarea name="specefications_ar" class="form-control" rows="10"></textarea>
                    @error('specefications_ar')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="exampleInputEmail1">{{ __('Description in Arabic') }} :</label>
                    <textarea name="description_ar" class="form-control" rows="10"></textarea>
                    @error('description_ar')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div> {{--End Arabic --}}




             </div>
        </div> {{--End Tab --}}
        <div class="col-6">


            <div class="form-group">
                <label for="exampleInputEmail1">{{ __('Category Name') }} :</label>
                <select name="category_id" class="form-control">
                    {{-- <option value=""></option> --}}
                    @foreach ($categories as $value)
                        <option value="{{ $value->id }}" @if ($value->id == old('category_id')) selected @endif>
                            {{ app()->getLocale() == 'ar' ? $value->title_ar : $value->title_en }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div><br>

              <div class="form-group">
                <label for="exampleInputEmail1">{{ __('Price') }} :</label>
                <input type="number" class="form-control" name="price" value="{{ old('price') }}" >
                @error('price')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
             </div><br>

             <div class="form-group">
                <label for="exampleInputEmail1">{{ __('Discount') }} :</label>
                <input type="number" class="form-control" name="discount" value="{{ old('discount') }}">
                @error('discount')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div><br>



            <div class="form-group ">
                <label for="exampleInputEmail1">{{ __('Type') }} :</label>
                <select name="type" class="form-control">
                    <option value="ALL" @if ('ALL' == old('type')) selected @endif>
                        {{ __('ALL') }}</option>
                    <option value="NEW" @if ('NEW' == old('type')) selected @endif>
                        {{ __('NEW') }}</option>

                    <option value="MOSTBOUGHT" @if ('MOSTBOUGHT' == old('type')) selected @endif>
                        {{ __('MOSTBOUGHT') }}</option>
                    <option value="MOSTWATCHED" @if ('MOSTWATCHED' == old('type')) selected @endif>
                        {{ __('MOSTWATCHED') }}</option>

                </select>
                @error('type')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div><br>

            <div class="form-group">
                <label for="exampleInputEmail1">{{ __('Status') }} :</label>
                <select name="status" class="form-control">
                    <option value="ACTIVE" @if ('ACTIVE' == old('status')) selected @endif>
                        {{ __('ACTIVE') }}</option>
                    <option value="INACTIVE" @if ('INACTIVE' == old('status')) selected @endif>
                        {{ __('NACTIVE') }}</option>
                </select>
                @error('status')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div><br>


             <div class="form-group">
                <label for="exampleInputEmail1">{{ __('Image') }} :</label>
                <input type="file" class="form-control" name="master_image" >
                @if ($product->image)
                <img width="80" src="{{ asset('uploads/products/'.$product->master_image) }}" alt="">
                @endif
            @error('master_image')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
            @enderror
            </div><br>

               <div class="form-group">
                <label class="control-label">{{ __('Variants') }}</label>
                <br>
                <a href="#" id="showSelectLink">Show Variants</a>

                <div id="variantsContainer" style="display: none;">
                     @foreach($attributes as $attribute)
                       <table class="table table-bordered" id="dynamicAddRemove">
                 <tr>
                     <th>{{ $attribute->title_en }}</th>
                 </tr>
                 <tr>
                    <td><input type="text" name="attrr[{{ $attribute->id }}]" placeholder="Enter title" class="form-control" /></td>
                 </tr>
                     </table>
                        @endforeach
                    <br>
                </div>
                  </div>

          </div>
    </div><br>


             <button type="submit" class="text-center btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ __('Save') }}</button><br><br>

            </form>

    </div> {{--End General Row --}}
</body>

@endsection
@section('script')

<script src="{{URL::asset('dashboard/js/form-validation.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/select2/js/select2.min.js')}}"></script>

<script>
    document.getElementById('showSelectLink').addEventListener('click', function (event) {
        event.preventDefault();
        var variantsContainer = document.getElementById('variantsContainer');
        variantsContainer.style.display = variantsContainer.style.display === 'none' ? 'block' : 'none';
    });



</script>

<script src="{{ asset('dashboard/local/product.js') }}"></script>
@stop
