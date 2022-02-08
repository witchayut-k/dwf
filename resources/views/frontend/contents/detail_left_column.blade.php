@extends('frontend.layouts.web')

@section('content')
<div class="wrapper-inner">
    <div class="container">
        <div class="row content-row">
            <div class="col-lg-4 py-4">
                @include('frontend.contents.partials.sidebar')
            </div>
            
            <div class="col-lg-8 py-4">
                @include('frontend.contents.partials.body')
            </div>
        
        </div>
    </div>
</div>
@endsection