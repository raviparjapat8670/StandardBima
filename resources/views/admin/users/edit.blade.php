@extends('layout.app')

@section('content')
<style>
</style>
<div class="page-title">
    <div class="title_left">
        <h4>Edit User, {{$user->fname}}</h4>
    </div>

    <div class="x_panel">

        <div class="x_content">
            <br />
            <form class="form-label-left input_mask" method="POST" action="{{ route('admin.edit-user', $user->id) }}">
                @csrf <!-- CSRF token for security -->
                <div class="col-md-6 col-sm-6  form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="fname" value="{{ old('fname', $user->fname) }}" placeholder="First Name">
                    <input type="hidden" name="id" value="{{$user->id}}">

                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    @error('fname')
                    <div class="text-red">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 col-sm-6  form-group has-feedback">
                    <input type="text" class="form-control" id="inputSuccess3" name="lname" value="{{ old('lname', $user->lname) }}" placeholder="Last Name">
                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                    @error('lname')
                    <div class="text-red">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group row">

                    <label class="control-label col-md-3 col-sm-3 ">Gender</label>
                    <div class="col-md-9 col-sm-9 ">
                        <select class="select2_group form-control" name="gender">
                            <optgroup label="Select Gender">
                                <option value="male" {{ old('gender', $user->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $user->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $user->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>

                            </optgroup>

                        </select>
                    </div>
                    @error('gender')
                    <div class="text-red">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group row">

                    <label class="control-label col-md-3 col-sm-3 ">Role</label>
                    <div class="col-md-9 col-sm-9 ">
                        <select class="select2_group form-control" name="role">
                            <optgroup label="Select Role">
                                <option value="superadmin" {{ old('role', $user->role ?? '') == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                                <option value="manager" {{ old('role', $user->role ?? '') == 'manager' ? 'selected' : '' }}>Manager</option>
                                <option value="staff" {{ old('role', $user->role ?? '') == 'staff' ? 'selected' : '' }}>Staff</option>

                            </optgroup>

                        </select>
                    </div>
                    @error('role')
                    <div class="text-red">{{ $message }}</div>
                    @enderror
                </div>
                <div class=" card">
                <div class="card-header">
                            <strong>Permissions</strong>
                        </div>
                    <div class=" row">


                        @foreach ($permissions as $key=>$permission)

                        <div class="col-md-2">

                            <div class="card-body">
                                <h6 style="text-align:left;">
                                    <strong>{{ ucfirst($key) }}</strong>
                                </h6>
                                @foreach ($permission as $subkey => $subpermission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[{{$key}}][]" id="permission-{{ $subkey }}" value="{{ $subkey }}"
                                   @if(in_array($subkey, $user->permission->$key)) checked @endif >
                                    <label class="form-check-label" for="permission-{{ $subkey }}">
                                        {{ $subpermission }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>


                        @endforeach
                    </div>

                </div>
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