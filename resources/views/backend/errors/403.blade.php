@extends('backend.layouts.app')

@section('content')

<h1>403 | Forbidden</h1>

<div class="block block-condensed">
    <div class="app-heading">
        <div class="d-flex justify-between align-center">
            <div>
                {!! $e->getMessage() !!}
            </div>
        </div>
    </div>

    <div class="block-content">
       
    </div>                            
</div>

@endsection
