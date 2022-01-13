@extends('backend.layouts.app', ['title' => 'Backend User management'])

@section('content')

<h1>Backend User management</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>Backend User role management</h2>
            <p><i class="fa fa-home"></i> - Backend User role management - {{ empty($role->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/user-roles/$role->id"), 'id' => 'form-role', 'class'=>'form', 'files'=>true, 'redirect-url'=>url('admin/user-roles')]) }}
        @method($role->id ? 'PUT' : 'POST')
        
        <div class="form-body">
            {!! Form::groupText('name','ชื่อสิทธิ์', $role->name, ['required'=>'required']) !!}

            <div class="form-separator"></div>

            <h4>กำหนดสิทธิ์การใช้งาน</h4>

            <div class="row">
                @foreach (PermissionEnum::getKeys() as $item)
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="app-checkbox"> 
                            <label>
                                <input 
                                    type="checkbox" 
                                    name="permissions" 
                                    value="{{ PermissionEnum::getDescription(PermissionEnum::getValue($item)) }}"
                                    {{ $role->hasPermissionTo(PermissionEnum::getDescription(PermissionEnum::getValue($item))) ? 'checked' : '' }}
                                /> 
                                    {{ PermissionEnum::getName(PermissionEnum::getValue($item)) }}

                                    
                            </label> 
                        </div>
                    </div>
                </div>       
                @endforeach
             
            </div>
            
        </div>
        <div class="form-action">
            <a href="{{ url('admin/user-roles') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/user-role.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\UserRoleRequest', '#form-role') !!}
@endsection