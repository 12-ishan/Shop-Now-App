@extends('layout.admin')
@section('content')

<div class="row">


<div class="col-lg-12 col-ml-12">
        <div class="row">
            <!-- basic form start -->

            <div class="col-12 mt-5 start-form-sec">

                <div class="card">
                    <div class="card-body">

                        <!-- <h4 class="header-title">Basic form</h4> -->
                         <p id="err" style="color:red;"></p>

                        <form id="roleForm" method="post" action="@if(isset($editStatus)){{ route('role.update', $role->id) }} @else {{ route('role.store')}}@endif" enctype='multipart/form-data'>

                            {{ csrf_field() }}

                            @if(isset($editStatus))
                            @method('PUT')
                            @endif


                            @if(session()->has('message'))
                            <div class="alert alert-danger">
                                {{ session()->get('message') }}
                            </div>
                            @endif


                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach

                            <div class="row">

                                <div class="col-6 mt-5">
                                    <div class="form-group">
                                        <label for="roleName">Role Name</label>
                                        <input type="text" class="form-control" id="roleName" name="roleName" placeholder="Enter role" value="{{old('roleName',  isset($role->roleName) ? $role->roleName : NULL)}}">
                                    </div>
                                </div> 
                            </div>
                            @foreach($permissionHead as $value)
                            
                            <div>
                                <input type="checkbox" class="checkBoxClass" name="permissions[]" value="{{$value->id}}">  
                                @isset($value->name){{$value->name}}@else NA @endif
                            </div>
                                    
                            @endforeach
                           
                            @if(isset($role->id))
                            <input type="hidden" name="id" value="{{ $role->id }}">
                            @endif
                           
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- basic form end -->
        </div>
    </div>
</div>

@section('js')
<script src="{{ asset('assets/admin/js/console/role.js') }}"></script>
@append

<script type="text/javascript">

 $(document).ready(function(){

    $("#roleForm").submit(function(){

        if($("#roleName").val()=="")
        {
            $("#err").text("Please enter role name");
            $("#roleName").focus();
            return false;
        }
        });
    });
 
 </script>

@endsection