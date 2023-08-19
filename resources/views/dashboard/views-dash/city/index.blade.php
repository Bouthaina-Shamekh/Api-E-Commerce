@extends('dashboard.layouts.master')
@section('title', __('Cities'))
@section('css')
    <!-- Data table css -->
    <link href="{{ asset('assets/scss/plugins/dataTables.bootstrap5.scss') }}" rel="stylesheet" />
    <link href="{{ asset('assets/scss/plugins/buttons.bootstrap5.scss') }}" rel="stylesheet">
    <link href="{{ asset('assets/scss/plugins/responsive.bootstrap5.scss') }}" rel="stylesheet" />
@stop

@section('content')

<h1>{{__('AlL Cities')}}</h1>
    @if (session('msg'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msg') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{__('City IN English')}}</th>
                <th>{{__('City IN Arabic')}}</th>
                <th>{{__('Actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cities as $cities)


            <tr>

                    <td>{{ $cities->id }}</td>
                    <td>
                        {{ $cities->name_en }}
                    </td>
                    <td>
                        {{ $cities->name_ar }}
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('city.edit', $cities->id) }}"><i class="las la-pen"></i></i></a>

                        <form class="d-inline" action="{{ route('city.destroy', $cities->id)}}"
                              method="POST">
                            @csrf
                            @method('delete')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure')"><i class="las la-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach

        </tbody>
    </table>




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


