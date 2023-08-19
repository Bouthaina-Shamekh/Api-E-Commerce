
@extends('dashboard.layouts.master')
@section('title', __('Order'))
@section('css')
    <!-- Data table css -->

@stop

@section('content')

    <div id="error_message"></div>


    <!-- End Basic modal -->
    <div class="modal" id="modalOrderDelete" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('Delete Operation') }}</h6>
                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <ul id="list_error_message3"></ul>
                <div class="modal-body">
                    <p>{{ __('Are sure of the deleting process ?') }}</p><br>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-secondary" data-bs-dismiss="modal"
                        type="button">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-danger" id="deleteOrder">{{ __('Delete') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->



    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="row row-xs wd-xl-100p">
                        <div class="col">

                    <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-hover">
                               <tbody>
                            <tr>
                                <td>
                                    <select name="user_h" id="user_h" class="form-control">
                                        <option value="">  choose user.... </option>
                                        @foreach($users as $user)
                                            <option  value="{{$user->id}}"> {{$user->name}} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="status_h" id="status_h" class="form-control">
                                <option value="">choose status.... </option>
                                <option  value="pending"> pending </option>
                                <option  value="processing">processing </option>
                                <option  value="shipped">shipped</option>
                                <option  value="cancelled"> cancelled</option>
                                <option  value="completed">completed </option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                               <td>
                                    <input type="text" value="{{old("from_1_h")}}"class="form-control text-input fc-datepicker" id="from_1_h" name="from_1_h" placeholder="from....">
                                </td>
                                <td>
                                    <input type="text" value="{{old("to_1_h")}}"class="form-control text-input fc-datepicker" id="to_1_h" name="to_1_h" placeholder="to...">
                                </td>
                                <td>
                                    <a class="btn btn-primary" id="search_1_h" name="search_1_h">filter by date</a>
                                </td>
                            </tr>
                            <tr>
                               <td>
                                    <input type="number" value="{{old("from_2_h")}}"class="form-control text-input" id="from_2_h" name="from_2_h" placeholder="from....">
                                </td>
                                <td>
                                    <input type="number" value="{{old("to_2_h")}}"class="form-control text-input" id="to_2_h" name="to_2_h" placeholder="to...">
                                </td>
                                <td>
                                    <a class="btn btn-primary" id="search_2_h" name="search_1_h">filter by total</a>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover" id="get_order" style=" text-align: center;">
                            <thead>
                                    <tr>

                                    <th>{{__('User Name')}}</th>
                                    <th>{{__('Copoun')}}</th>
                                    <th>{{__('Address')}}</th>
                                    <th>{{__('Total')}}</th>
                                    <th>{{__('Discount')}}</th>
                                    <th>{{__('Price')}}</th>
                                    <th>{{__('Order Status')}}</th>
                                    <th>{{__('Paymant Status')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
     <script src="{{URL::asset('dashboard/plugins/notify/js/notifit-custom.js')}}"></script>
    <!-- DATA TABLE JS -->
    <script src="{{ asset('dashboard/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
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
    <script src="{{ asset('dashboard/local/order.js') }}"></script>
@stop

















