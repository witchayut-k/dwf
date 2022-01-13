@php $auth = Auth::user() @endphp

<div class="app-header">
    <ul class="app-header-buttons">
        <li class="visible-mobile"><a href="#" class="btn btn-link btn-icon"
                data-sidebar-toggle=".app-sidebar.dir-left"><span class="fa fa-align-justify"></span></a></li>
        <li class="hidden-mobile"><a href="#" class="btn btn-link btn-icon"
                data-sidebar-minimize=".app-sidebar.dir-left"><span class="fa fa-align-justify"></span></a></li>
    </ul>

    <ul class="app-header-buttons pull-right">
        <li>
            <div class="contact contact-rounded contact-bordered contact-lg contact-ps-controls hidden-xs">
                <div class="contact-container">
                    <a href="#">{{ $auth->name }}</a>
                    <span><a href="{{ url('admin/logout') }}">ออกจากระบบ</a></span>
                </div>
                <img src="{{ $auth->avatar_image_resized }}" alt="{{ $auth->name }}">
            </div>
        </li>
    </ul>
</div>