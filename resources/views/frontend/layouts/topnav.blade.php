<nav class="navbar navbar-expand-lg">
    <ul class="navbar-nav mr-auto header-menu-list">
        <div class="form-search mb">
            {!! Form::open(['url'=>'search', 'id'=>'form-search']) !!}
            <div class="position-relative">
                <span class="ic-search"></span>
                <input type="search" name="q" class="form-control" placeholder="{{ __('shared.search') }}">
            </div>
            {{ Form::close() }}
        </div>
        {{-- <li class="nav-item {{ request()->is('/') ? 'active' : '' }}"> --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ url('') }}">{{ __('shared.home') }} <span class="sr-only">(current)</span></a>
        </li>

        {!! NavHelper::RenderTopMenu() !!}
        
        <li class="nav-item border-bottom-0">
            {!! Form::open(['url'=>'search', 'id'=>'form-search', 'method'=>'get']) !!}
            <div class="form-search">
                <div class="position-relative">
                    <span class="ic-search"></span>
                    <input type="search" class="form-control" name="q" placeholder="{{ __('shared.search') }}">
                </div>
            </div>
            {!! Form::close() !!}
        </li>

        <li class="menu-mb"><a href="#">สมาชิก</a></li>
        <li class="menu-mb"><a href="{{ route('backend') }}" target="_blank">ADMIN</a></li>
        <li class="menu-mb"><a href="#">ร้องทุกข์-ร้องเรียน</a></li>
        <li class="menu-mb"><a href="#">INTRANET</a></li>
    </ul>
</nav>