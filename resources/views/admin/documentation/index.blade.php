@extends('layout.app')

@section('content')
<style>
</style>


<div class="page-title">
    <div class="title_left">
        <h3>Documentations</h3>
    </div>
    <div class="title_right">
        <a href="{{route('admin.add-documentation')}}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Add New Documentation"><i class="fa fa-plus-circle"></i></a>
    </div>

    <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <]button class="btn btn-secondary" type="button">Go!</>
                        </span>
                    </div>
                </div>
            </div> -->
</div>

<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="card-box table-responsive">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Mandatory</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($documentations as $documentation)
                                        <tr>
                                            <td>{{$documentation->name}}</td>
                                            <td>{{$documentation->description}}</td>
                                            <td>{{$documentation->mandatory}}</td>
                                            <td>@if($documentation->status==1) Active @else Deactive @endif</td>
                                            <td>{{$documentation->created_at}}</td>
                                            <td> <a href="{{route('admin.edit-occupation',Crypt::encrypt($occupation->id))}}">
                                                    <i class="fa fa-edit"></i>
                                                </a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                {{ $documentations->links('admin.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






</div>



@endsection

@push('page_css')
<!-- iCheck -->
<!-- <link href="{{asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet"> -->
<!-- Datatables -->
<!-- 
<link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet"> -->
@endpush
@push('page_scripts')
<!-- iCheck -->
<!-- <script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script> -->
<!-- Datatables -->
<!-- <script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
<script src="{{asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
<script src="{{asset('vendors/jszip/dist/jszip.min.js')}}"></script>
<script src="{{asset('vendors/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('vendors/pdfmake/build/vfs_fonts.js')}}"></script> -->
@endpush