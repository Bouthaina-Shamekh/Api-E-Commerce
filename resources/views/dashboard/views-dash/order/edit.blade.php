@extends('dashboard.layouts.master')
@section('title', __('Order'))
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
        <div class="col-md-6">
            <div class="mb-3">
                <label>{{__('User Name')}}</label>
                <input type="text" name="user_id"  class="form-control" value="{{$order->user->name}}" disabled>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label>{{__('Copoun')}}</label>
                <input type="text" name="copoun_id"  class="form-control" value="{{ $order->copoun->code }}" disabled>
            </div>
        </div>
    </div>


    <div class="row">
    <div class="col-md-6">
        <label>{{__('Address')}}</label>
        <input type="text" name="address_id"  class="form-control" value="{{ $order->address->title}}" disabled>
    </div>



    <div class="col-md-6">
        <label>{{__('Tottal')}}</label>
        <input type="text" name="total"  class="form-control" value="{{ $order->total}}" disabled>
    </div>
    </div>


    <div class="row">
    <div class="col-md-6">
        <label>{{__('Price')}}</label>
        <input type="text" name="price" class="form-control" value="{{ $order->price }}" disabled>
    </div>

    <div class="col-md-6">
        <label>{{__('Discount')}}</label>
        <input type="text" name="discount" class="form-control" value="{{ $order->discount }}" disabled>
    </div>
    </div>



    <div class="row">
    <div class="col-md-6">
        <label>{{__('Order Status')}}</label>
        <select name="status" class="form-control" disabled>



                <option value="pending" {{$order->status == 'pending' ? 'selected' : '' }}>{{__('Pending')}} </option>

                <option value="processing" {{$order->status == 'processing' ? 'selected' : '' }}>{{__('Processing')}}</option>

                <option value="shipped"{{$order->status == 'shipped' ? 'selected' : '' }}>{{__('Shipped')}}</option>

                <option value="cancelled" {{$order->status == 'cancelled' ? 'selected' : '' }}>{{__('Cancelled')}}</option>

                <option value="completed"{{$order->status == 'completed' ? 'selected' : '' }}>{{__('Completed')}}</option>

        </select>
    </div>

    <div class="col-md-6">
        <label> {{__('Paymant Status')}}</label>
        <select name="payment_status" class="form-control" disabled>



                <option value="pending" {{$order->payment_status == 'pending' ? 'selected' : '' }}>{{__('Pending')}}</option>

                <option value="failed" {{$order->payment_status == 'failed' ? 'selected' : '' }}>{{__('Failed')}}</option>

                <option value="paid" {{$order->payment_status == 'paid' ? 'selected' : '' }}>{{__('Paid')}}</option>

                <option value="refunded" {{$order->payment_status == 'refunded' ? 'selected' : '' }}>{{__('Refunded')}}</option>

        </select>
    </div>
    </div>


    <h1 style="text-align: center; margin-top: 20px;background-color: #565ef7; padding-right: 131px;">{{__('OrderItem')}}</h1>


    <div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label>{{__('Product Name in English')}}</label>
            <input type="text" name="product_id"  class="form-control" value="{{$orderItem->product->title_en}}" disabled>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>{{__('Product Name in Arabic')}}</label>
            <input type="text" name="product_id"  class="form-control" value="{{$orderItem->product->title_ar}}" disabled>
        </div>
    </div>
    </div>


<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label>{{__('Product Name')}}</label>
            <input type="text" name="product_name"  class="form-control" value="{{$orderItem->product_name}}" disabled>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>{{__('Price Item')}}</label>
            <input type="text" name="price"  class="form-control" value="{{$orderItem->price}}" disabled>
        </div>
    </div>
</div>

















































@endsection
@section('script')
    <!-- DATA TABLE JS -->
    <script src="{{ asset('dashboard/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/table-data.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <script src="{{ asset('dashboard/js/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('dashboard/js/select2.js') }}"></script>
@stop
