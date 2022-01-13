@extends('frontend.layouts.web')

@section('content')
<div class="wrapper-inner bg-white sitemap">
    <div class="container">
        <div class="row content-row justify-content-center">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">แผนผังเว็บไซต์</li>
                    </ol>
                </nav>
                <h1 class="title-line c-pink mb-2 pt-2">แผนผังเว็บไซต์</h1>
            </div>
            <div class="columns">
            @foreach ($menu as $nav)
                @if (count($nav->published_children) == 0) 
                    <div class="content">
                        {!! NavHelper::RenderMenuItem($nav, "root-item") !!}
                    </div>
                @else
                    <div class="content">
                        {!! NavHelper::RenderMenuItem($nav, "root-item") !!}
                        <ul>
                            @foreach ($nav->published_children as $submenu) 
                                @if (count($submenu->children) == 0)
                                    <li><i class="fa fa-angle-right"></i>{!! NavHelper::RenderMenuItem($submenu, "l1-item") !!}</li>
                                @else
                                    @php $submenu2 = ""; @endphp
            
                                    @foreach ($submenu->published_children as $item) 
                                        @php $submenu2 .= '<li><i class="fa fa-angle-right"></i>' . NavHelper::RenderMenuItem($item) . '</li>' @endphp
                                    @endforeach
            
                                    <li>
                                        <i class="fa fa-angle-right"></i>{!! NavHelper::RenderMenuItem($submenu, "l1-item") !!}
                                        <ul>{!! $submenu2 !!}</ul>
                                    </li>
                                @endif
                            @endforeach
        
                        </ul>
                    </div>
                @endif
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection