@extends('layout.app')

@section('content')
<style>
</style>
<div class="page-title">
    <div class="title_left">
        <h4>Edit Documentation, {{$documentation->title}}</h4>
    </div>

    <div class="x_panel">

        <div class="x_content">
            <br />
            <form class="form-label-left input_mask" method="POST" action="{{ route('admin.edit-documentation', Crypt::encrypt($documentation->id)) }}">
                @csrf <!-- CSRF token for security -->
                <div class="col-md-12 col-sm-12  form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="name" value="{{ old('name', $documentation->name) }}" placeholder="Name">

                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    @error('name')
                    <div class="text-red">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6 col-sm-6">

<label class="control-label col-md-3 col-sm-3 ">Mandatory</label>
<div class="col-md-9 col-sm-9 ">
    <select class="select2_group form-control" name="mandatory">
        <optgroup label="Select Status">
            <option value="1" {{ old('mandatory', $documentation->mandatory ?? '') == '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('mandatory', $documentation->mandatory ?? '') == '0' ? 'selected' : '' }}>No</option>

        </optgroup>

    </select>
</div>
@error('mandatory')
<div class="text-red">{{ $message }}</div>
@enderror
</div>
                <div class="form-group col-md-6 col-sm-6">

                    <label class="control-label col-md-3 col-sm-3 ">Status</label>
                    <div class="col-md-9 col-sm-9 ">
                        <select class="select2_group form-control" name="status">
                            <optgroup label="Select Status">
                                <option value="1" {{ old('status', $documentation->status ?? '') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $documentation->status ?? '') == '0' ? 'selected' : '' }}>Deactive</option>

                            </optgroup>

                        </select>
                    </div>
                    @error('status')
                    <div class="text-red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12 col-sm-12  form-group has-feedback">
                    <label for="exampleTextarea" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="exampleTextarea" rows="3">{{ old('description', $documentation->description ?? '')}}</textarea>
                    @error('description')
                    <div class="text-red">{{ $message }}</div>
                    @enderror
                </div>
    


                <!-- <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">Date Of Birth <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                            <script>
                                function timeFunctionLong(input) {
                                    setTimeout(function() {
                                        input.type = 'text';
                                    }, 60000);
                                }
                            </script>
                        </div>
                    </div> -->

                <div class="form-group row">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <a href="{{route('admin.users')}}" type="button" class="btn btn-primary">Cancel</a>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>

            </form>
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