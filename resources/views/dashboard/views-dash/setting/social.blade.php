@extends('dashboard.layouts.master')
@section('title', __('SocialMedia Settings'))
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

                <h4>{{ __('Social Media Settings') }}</h4>
                <hr>
            </div>

            <div class="card-body">
                <form action="{{route('social.update')}}" method="POST">
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">{{ __('Facebook') }} :</label>
                        <input type="text" class="form-control" name="facebook" value="{{ old('facebook',$settings['facebook'] ?? '')}}">
                        @error('facebook')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">{{ __('Facebook') }} :</label>
                        <input type="text" class="form-control" name="facebook" value="{{ old('facebook',data_get($settings, 'facebook'))}}">
                        @error('facebook')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div> --}}

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">{{ __('Snapshat') }} :</label>
                        <input type="text" class="form-control" name="snapshat" value="{{ old('snapshat',$settings['snapshat'] ?? '')}}">
                        @error('snapshat')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">{{ __('WhatsApp') }} :</label>
                        <input type="text" class="form-control" name="whatsapp" value="{{ old('whatsapp',$settings['whatsapp'] ?? '')}}">
                        @error('whatsapp')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
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
