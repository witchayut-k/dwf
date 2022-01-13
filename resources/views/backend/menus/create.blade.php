@extends('backend.layouts.app', ['title' => 'จัดการเมนูเว็บไซต์'])

@section('content')

<h1>จัดการเมนูเว็บไซต์</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>จัดการเมนูเว็บไซต์</h2>
            <p><i class="fa fa-home"></i> - จัดการเมนูเว็บไซต์ - {{ empty($menu->id) ? 'Create' : 'Edit' }}</p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/menus/$menu->id"), 'id' => 'form-menu', 'class'=>'form',
        'files'=>true, 'redirect-url'=>route('menus.index')]) }}
        @method($menu->id ? 'PUT' : 'POST')

        <div class="form-body">
            {!! Form::groupText('title', 'ชื่อเมนู', $menu->title, ['required'=>'required']) !!}

            <div class="form-group">
                <label>ตำแหน่งเมนู</label>
                <div class="app-radio inline round"> 
                    <label>
                        <input type="radio" name="menu_position" value="top_menu" {{ $menu->menu_position == 'top_menu' ? 'checked' : '' }}> Top Menu 
                    </label> 
                </div>
                <div class="app-radio inline round"> 
                    <label>
                        <input type="radio" name="menu_position" value="footer_menu" {{ $menu->menu_position == 'footer_menu' ? 'checked' : '' }}> Footer Menu
                    </label> 
                </div>
            </div>

            <div class="form-group">
                <label>เมนูหลัก</label>
                <div class="btn-group hierarchy-select" id="parent-menu">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="selected-label pull-left">&nbsp;</span>
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu open">
                        <div class="hs-searchbox">
                            <input type="text" class="form-control" autocomplete="off">
                        </div>
                        <ul class="dropdown-menu inner" role="menu">
                            @php $selected = $menu->parent_id == null ? "data-default-selected" : "" @endphp
                            <li data-value="" data-level="1" {{ $selected }}>
                                <a href="#">ไม่มี</a>
                            </li>
                            @foreach ($mainMenus as $mainMenu)
                                @php $selected = $menu->parent_id == $mainMenu->id ? "data-default-selected" : "" @endphp
                                <li data-value="{{ $mainMenu->id }}" data-level="1" {{ $selected }}>
                                    <a href="#">{{ $mainMenu->title }}</a>
                                </li>
                                @foreach ($mainMenu->children as $subMenu)
                                @php $selected = $menu->parent_id == $subMenu->id ? "data-default-selected" : "" @endphp
                                <li data-value="{{ $subMenu->id }}" data-level="2" {{ $selected }}>
                                    <a href="#">{{ $subMenu->title }}</a>
                                </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                    <input class="hidden hidden-field" name="parent_id" readonly="readonly" aria-hidden="true" type="text"/>
                </div>
            </div>

            <div class="clearfix"></div>


            <div class="form-group">
                <label>ประเภทเนื้อหาเมนู</label>
                @foreach (MenuTypeEnum::getKeys() as $item)
                <div class="app-radio inline round"> 
                    <label>
                        <input type="radio" name="menu_type_id" value="{{ MenuTypeEnum::getValue($item) }}" {{ $menu->menu_type_id == MenuTypeEnum::getValue($item) ? 'checked' : '' }}> {{ MenuTypeEnum::getDescription(MenuTypeEnum::getValue($item)) }} 
                    </label> 
                </div>
                @endforeach
            </div>

            <div class="form-group">
                <div class="group-content" style="display: none">
                    {!! Form::groupSelect('content_picker', 'เลือกเนื้อหาเว็บไซต์', $contents, $menu->content_id, ['data-live-search'=>'true']) !!}
                </div>
    
                <div class="group-content-type" style="display: none">
                    {!! Form::groupSelect('content_type_picker', 'เลือกหมวดหมู่เนื้อหา', $contentTypes, $menu->content_id, ['data-live-search'=>'true']) !!}
                </div>
    
                <div class="group-url" style="display: none">
                    {!! Form::groupText('url', 'ระบุที่อยู่ลิงค์', $menu->url, ['placeholder'=>'https://']) !!}
                </div>

                <div class="group-internal-link" style="display: none">
                    <select name="internal_link" class="selectpicker">
                        <option value="faqs">FAQ</option>
                        <option value="contact-us">Contact Form</option>
                        <option value="contacts">Contact Information</option>
                    </select>
                </div>
            </div>
           

            <div class="form-group">
                <label for="" class="control-label">สถานะการแสดงผล</label>
                <label class="switch has-label">
                    <input type="checkbox" name="published" {{ $menu->published ? "checked" : "" }} />
                    เปิดใช้งาน
                </label>
            </div>
        </div>
        <div class="form-action">
            <a href="{{ url('admin/menus') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('backend/js/pages/menu.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Backend\MenuRequest', '#form-menu') !!}
@endsection