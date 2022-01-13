@extends('frontend.layouts.preview')

@section('content')

    <div class="container">
        <div class="row content-row">
            <div class="col-lg-8 py-4">
                <div class="card card-custom">
                    <div class="card-header pt-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-custom">
                                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="news.php">{{ $registrar->title }}</a></li>
                            </ol>
                        </nav>
                        <h1 class="font-medium c-pink">{{ $registrar->title }}</h1>
                        <div class="d-flex flex-wrap mt-3">
                            <p class="date c-gray pr-4">{{ $registrar->created_at }}</p>
                            <p class="view c-gray pr-4">{{ $registrar->author->name }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="content-editor">
                            @if ($registrar->has_featured_image)
                            <img src="{{ $registrar->featured_image }}" alt="{{ $registrar->title }}">
                            @endif
                            {!! $registrar->description !!}
                        </div>

                        @if (session()->has('success'))
                        <h1>ลงทะเบียนเรียบร้อยแล้ว</h1>
                        @else
                            <form action="">
                                {{ Form::hidden('registrar_id', $registrar->id) }}
                                @foreach ($registrar->fields as $field)
                                <div class="registrar-group my-4">
                                    <label>{{ $field['name'] }}</label>
                                    <input type="text" class="form-control extra" readonly name="field_value_{{ $loop->iteration }}" />
                                </div>
                                @endforeach

                            </form>

                        @endif


                    </div>

                </div> <!-- card -->
            </div>
        </div>
    </div>

@endsection