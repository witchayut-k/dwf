@php
$user = Auth::user();
@endphp

<div class="app-sidebar app-navigation app-navigation-fixed scroll app-navigation-style-light app-navigation-open-hover dir-left"
    data-type="close-other">
    <a href="{{ url('') }}" class="app-navigation-logo"></a>
    <nav>
        <ul>

            @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_LANDING_PAGE)]))
            <li>
                <a href="{{ url('admin/landing-pages') }}">
                    <span class="fa fa-th-large"></span> Landing Page</a>
            </li>
            @endif

            @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_CONTENT)]))
            <li class="openable">
                <a href="javascript:;">
                    <span class="fa fa-th-large"></span> จัดการเนื้อหาเว็บไซต์</a>
                <ul>
                    <li><a href="{{ url('admin/contents') }}">เนื้อหา</a></li>
                    <li><a href="{{ url('admin/content-types') }}">ประเภทเนื้อหา</a></li>
                </ul>
            </li>
            @endif

            @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_MENU)]))
            <li>
                <a href="{{ url('admin/menus') }}">
                    <span class="fa fa-th-large"></span> จัดการเมนูเว็บไซต์</a>
            </li>
            @endif

            {{-- @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_MENU)]))
            <li>
                <a href="{{ url('admin/budgets') }}">
                    <span class="fa fa-th-large"></span> ข้อมูลงบประมาณเผยแพร่</a>
            </li>
            @endif --}}

            @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_WEBLINK)]))
            <li class="openable">
                <a href="javascript:;">
                    <span class="fa fa-th-large"></span> Link Management</a>
                <ul>
                    <li><a href="{{ url('admin/weblinks') }}">Content</a></li>
                    <li><a href="{{ url('admin/weblink-types') }}">หมวดหมู่</a></li>
                </ul>
            </li>
            @endif

            @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_BACKEND_USER)]))
            <li class="openable">
                <a href="javascript;;">
                    <span class="fa fa-th-large"></span>
                    <span class="caption">Backend User<br />Management</span>
                </a>
                <ul>
                    <li><a href="{{ url('admin/users') }}">Users</a></li>
                    <li><a href="{{ url('admin/user-roles') }}">User Roles</a></li>
                </ul>
            </li>
            @endcan

            @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_RSS_FEED)]))
            <li>
                <a href="{{ url('admin/feeds') }}" class="disabled">
                    <span class="fa fa-th-large"></span> RSS Feed</a>
            </li>
            @endif

            <li>
                <a href="{{ url('admin/profile') }}">
                    <span class="fa fa-th-large"></span> Profile Management</a>
            </li>

            @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_FAQ)]))
            <li>
                <a href="{{ url('admin/faqs') }}">
                    <span class="fa fa-th-large"></span> FAQ</a>
            </li>
            @endif

            @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_DOWNLOAD)]))
            <li class="openable">
                <a href="javascript;;">
                    <span class="fa fa-th-large"></span> จัดการข้อมูล Download</a>
                <ul>
                    <li><a href="{{ url('admin/documents') }}">ข้อมูล Download</a></li>
                    <li><a href="{{ url('admin/document-types') }}">หมวดหมู่เอกสาร</a></li>
                </ul>
            </li>
            @endif

            @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_BANNER)]))
            <li>
                <a href="{{ url('admin/banners') }}">
                    <span class="fa fa-th-large"></span> จัดการแบนเนอร์</a>
            </li>
            @endif

            @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_CONTACT)]))
            <li class="openable">
                <a href="javascript:;">
                    <span class="fa fa-th-large"></span> ระบบติดต่อสอบถาม</a>
                <ul>
                    <li><a href="{{ url('admin/contacts') }}">ช่องทางการติดต่อ</a></li>
                    <li><a href="{{ url('admin/messages') }}">การติดต่อจากหน้าเว็บ</a></li>
                </ul>
            </li>
            @endif

            @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_ALBUM)]))
            <li>
                <a href="{{ url('admin/albums') }}">
                    <span class="fa fa-th-large"></span> ระบบคลังภาพ</a>
            </li>
            @endif

            @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_VIDEO)]))
            <li class="openable">
                <a href="javascript:;">
                    <span class="fa fa-th-large"></span> ระบบคลังวีดีโอ</a>
                <ul>
                    <li><a href="{{ url('admin/videos') }}">วีดีโอทั้งหมด</a></li>
                    <li><a href="{{ url('admin/video-categories') }}">หมวดหมู่วีดีโอ</a></li>
                </ul>
            </li>
            @endif

            @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_EVENT)]))
            <li>
                <a href="{{ url('admin/events') }}">
                    <span class="fa fa-th-large"></span> ระบบปฏิทินกิจกรรม</a>
            </li>
            @endif

            <li>
                <a href="{{ url('sitemap') }}" target="_blank">
                    <span class="fa fa-th-large"></span> แผนผังเว็บไซต์</a>
            </li>

            @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_SURVEY)]))
            <li>
                <a href="{{ url('admin/surveys') }}">
                    <span class="fa fa-th-large"></span> จัดการแบบสำรวจ</a>
            </li>
            @endif

            @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_REGISTRAR)]))
            <li>
                <a href="{{ url('admin/registrars') }}">
                    <span class="fa fa-th-large"></span> ระบบลงทะเบียน</a>
            </li>
            @endif

            @if ($user->hasAnyPermission([PermissionEnum::getDescription(PermissionEnum::MANAGE_PETITION)]))
            <li>
                <a href="{{ url('admin/petitions') }}">
                    <span class="fa fa-th-large"></span> <span
                        class="caption">ระบบรับเรื่องร้องเรียน<br>และระบบแจ้งเบาะแสทุจริต</span></a>
            </li>
            @endif

            {{-- @if ($user->hasAnyPermission(['manage map']) || $user->hasRole('Administrator'))
            <li>
                <a href="{{ url('admin/maps') }}" class="disabled">
                    <span class="fa fa-th-large"></span> Map</a>
            </li>
            @endif --}}
        </ul>
    </nav>
</div>