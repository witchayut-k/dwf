@extends('frontend.layouts.web')

@section('content')
<div class="wrapper-inner bg-white">
    <div class="container">

        <div class="row content-row justify-content-center">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                    </ol>
                </nav>
                <h1 class="title-line c-pink mb-2 pt-2">FAQ คำถามที่พบบ่อย</h1>
            </div>
            <div class="col-md-10">
                <div id="faq" class="mt-3 mb-4">
                    @foreach ($faqs as $faq)
                    <div class="card card-collapse" data-id="{{ $faq->id }}">
                        <div class="card-header" id="heading-{{ $faq->id }}">
                            <h5 class="collapse-title collapsed" data-toggle="collapse" data-target="#collapse-{{ $faq->id }}" aria-expanded="true" aria-controls="collapse-{{ $faq->id }}" >
                                <span>{{ $loop->iteration }}. {{ $faq->title }}</span>
                            </h5>
                        </div>

                        <div id="collapse-{{ $faq->id }}" class="collapse" aria-labelledby="heading-{{ $faq->id }}" data-parent="#faq">
                            <div class="card-body">
                                {!! $faq->content !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                   
                    {{-- <div class="card card-collapse">
                        <div class="card-header" id="headingTwo">
                            <h5 class="collapse-title collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <span>2. Lorem Ipsum is simply dummy text</span>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faq">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <div class="card card-collapse">
                        <div class="card-header" id="headingThree">
                            <h5 class="collapse-title collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <span>3. Lorem Ipsum is simply dummy text of</span>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faq">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <div class="card card-collapse">
                        <div class="card-header" id="headingFour">
                            <h5 class="collapse-title collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <span>4. Lorem Ipsum is simply dummy text of the printing and typesetting</span>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faq">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <div class="card card-collapse">
                        <div class="card-header" id="headingFive">
                            <h5 class="collapse-title collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                <span>5. Lorem Ipsum is simply dummy text of the printing</span>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#faq">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            $('.card').on('click', function () {
                const id = $(this).data('id');

                setTimeout(() => {
                    if ($(this).find('.show').length) {
                         $.ajax({
                            url: "{{ url('faq') }}/" + id,
                            type: 'PUT',
                            success: function (resp) {
                                console.log(resp);
                            },
                            error: function () {
                                // alert('Error occured, please contact administrator');
                            }
                        });
                    }
                }, 1000);

               
            });

            
        });
    </script>
@endsection