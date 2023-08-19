@extends('dashboard.layouts.master')
@section('title', __('General Settings'))
@section('css')
@stop

@section('content')
    <div class="main-body">
         @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
         @elseif(session('delete'))
            <div class="alert alert-danger ">
                {{ session('delete') }}
            </div>
         @endif
 <!-- row opened -->
 <div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">

                <h4>{{ __('General Settings') }}</h4>
                <hr>
            </div>

            <div class="card-body">
                <form action="{{ route('setting.update') }}" method="POST"  enctype="multipart/form-data">
                    @csrf
              <div class="row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">{{ __('Title in English') }} :</label>
                        <input type="text" class="form-control" name="titel_en" value="{{ old('titel_en', $settings['titel_en'] ?? '') }}">
                        @error('titel_en')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>



                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">{{ __('Title in Arabic') }} :</label>
                        {{-- <input type="text" class="form-control" name="titel_ar"
                            value="{{ old('titel_ar',$settings ['titel_ar']) }}"> --}}
                            <input type="text" class="form-control" name="titel_ar" value="{{ old('titel_ar', $settings['titel_ar'] ?? '') }}">
                        @error('titel_ar')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
            </div>

               <div class="row">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">{{ __('Logo') }} :</label>
                        <input type="file" class="form-control" name="logo">
                        @error('logo')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
<?php
$logos = App\Models\Setting::Where('key','logo')->first();
?>
                        @if ($logos)
                            <img src="{{ asset('uploads/logos/'.$logos->value) }}" alt="Logo" style="max-width: 100px; max-height: 100px;">
                        @elseif (old('logo'))
                            <img src="{{ asset(old('logo')) }}" alt="Logo" style="max-width: 100px; max-height: 100px;">
                        @endif
                    </div>

                    {{-- <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">{{ __('Logo') }} :</label>
                        <input type="file" class="form-control" name="logo">
                        @error('logo')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror

                        @php
                            $logoSetting = $settings->where('key', 'logo_path')->first();
                            $logoPath = $logoSetting ? asset($logoSetting->value) : null;
                        @endphp

                        @if ($logoPath)
                            <img src="{{ $logoPath }}" alt="Logo" style="max-width: 100px; max-height: 100px;">
                        @endif
                    </div> --}}


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">{{ __('Contact Email') }} :</label>
                        {{-- <input type="email" class="form-control" name="contact_email" value="{{ old('contact_email', $settings ['contact_email'])}}"> --}}
                        <input type="email" class="form-control" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}">
                        @error('contact_email')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>


           <div class="row" >
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">{{ __('About in English') }} :</label>
                        <textarea class="form-control" name="about_en" rows="10">{{ old('about_en', $settings['about_en'] ?? '')}}</textarea>
                        {{-- <input type="email" class="form-control" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"> --}}
                        @error('about_en')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">{{ __('About in Arabic') }} :</label>
                        <textarea class="form-control" name="about_ar" rows="10">{{ old('about_ar', $settings['about_ar'] ?? '')}}</textarea>
                        @error('about_ar')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
           </div>

                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">{{ __('Currency') }} :</label>
                        <select name="currency">
                            <option value="SAR" {{ old('currency', data_get($settings, 'currency')) === 'SAR' ? 'selected' : '' }}>{{__('Riyal')}}</option>
                            <option value="USD" {{ old('currency', data_get($settings, 'currency')) === 'USD' ? 'selected' : '' }}>{{__('Dollar')}}</option>
                            <option value="JOD" {{ old('currency', data_get($settings, 'currency')) === 'JOD' ? 'selected' : '' }}>{{__('Dinar')}}</option>
                            <option value="EUR" {{ old('currency', data_get($settings, 'currency')) === 'EUR' ? 'selected' : '' }}>{{__('Euro')}}</option>
                            <option value="ILS" {{ old('currency', data_get($settings, 'currency')) === 'ILS' ? 'selected' : '' }}>{{__('Shekels')}}</option>
                        </select>

                        @error('currency')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>



                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Language') }} :</label>
                            <select name="language">
                                <option value="language_en" {{ old('language', data_get($settings,'language')) === 'language_en' ? 'selected' : '' }}>{{__('English language')}}</option>
                                <option value="language_ar" {{ old('language', data_get($settings ,'language')) === 'language_ar' ? 'selected' : '' }}>{{__('Arabic language')}}</option>
                            </select>
                            @error('currency')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror

                        </div>




                   </div>

                   <div class="row">

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Policy in English') }} :</label>
                            <textarea class="form-control" name="policy_en" rows="10">{{ old('policy_en', $settings ['policy_en'] ?? '')}}</textarea>
                            @error('policy_en')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">{{ __('Policy in Arabic') }} :</label>
                            <textarea class="form-control" name="policy_ar" rows="10">{{ old('policy_ar', $settings['policy_ar'] ?? '')}}</textarea>
                            @error('policy_ar')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-block col-sm-2">{{ __('Update') }}</button>
                </form>
            </div>
        </div>
    </div>
    <!--/div-->
  </div>
    </div>
    @endsection
