@extends('dashboard.layouts.master')
@section('title', __('Variant'))
@section('css')
    <!-- Data table css -->
    <link href="{{ asset('assets/scss/plugins/dataTables.bootstrap5.scss') }}" rel="stylesheet" />
    <link href="{{ asset('assets/scss/plugins/buttons.bootstrap5.scss') }}" rel="stylesheet">
    <link href="{{ asset('assets/scss/plugins/responsive.bootstrap5.scss') }}" rel="stylesheet" />
@stop

@section('content')

    <div id="error_message"></div>


    <!-- End Basic modal -->

    <div class="modal" id="modalVariantDelete" style="display: none;" aria-hidden="true">
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
                    <button type="submit" class="btn btn-danger" id="deleteVariant">{{ __('Delete') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- row --> 

    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
             <div class="col-sm-6 col-md-3 mg-t-10">
                            <a class="btn btn-info-gradient btn-block"
                                style="font-weight: bold; color: beige;" href="/admin/addVarint/{{ $id }}">{{ __('Add New Variant') }}</a>

                        </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover" id="get_variant" style=" text-align: center;">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">{{ __('Product') }}</th>
                                    <th class="border-bottom-0">{{ __('Image') }}</th>
                                    <th class="border-bottom-0">{{ __('Price') }}</th>
                                    <th class="border-bottom-0">{{ __('Discount') }}</th>
                                    <th class="border-bottom-0">{{ __('Attribute') }}</th>
                                    <th class="border-bottom-0">{{ __('Processes') }}</th>
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
    <script src="{{ asset('dashboard/local/variant.js') }}"></script>
@stop
