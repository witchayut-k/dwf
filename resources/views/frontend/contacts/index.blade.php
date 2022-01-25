@extends('frontend.layouts.web')

@section('content')
<div class="wrapper-inner bg-white">
    <div class="container">
        <div class="row content-row justify-content-center">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ติดต่อเรา</li>
                    </ol>
                </nav>
                <h1 class="title-line c-pink mb-2 pt-2">ติดต่อเรา</h1>
            </div>
            <div class="col-md-10">
                <div style="margin-top: 30px"></div>
                <div class="row">
                    <div class="col-md-6">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7750.786459211!2d100.516216!3d13.755144!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xba9cb9bc19c071f8!2z4LiB4Lij4Lih4LiB4Li04LiI4LiB4Liy4Lij4Liq4LiV4Lij4Li14LmB4Lil4Liw4Liq4LiW4Liy4Lia4Lix4LiZ4LiE4Lij4Lit4Lia4LiE4Lij4Lix4Lin!5e0!3m2!1sth!2sth!4v1643083335685!5m2!1sth!2sth" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <div class="col-md-6">
                        <p><strong>กรมกิจการสตรีและสถาบันครอบครัว (สค.)</strong></p><br />
                        <p>ชั้น 12-14 (อาคารใหม่) 1034 <br />ถนน กรุงเกษม <br />แขวง คลองมหานาค เขตป้อมปราบศัตรูพ่าย <br />
                            กรุงเทพมหานคร 10100</p><br />
                        <p>โทรศัพท์ : 0-2659-6762 , 0-2659-6763</p>
                        <p>โทรสาร : 0-2659-6764</p>
                        <p>e-mail : <a href="mailto:contact@dwf.go.th" target="_blank">contact@dwf.go.th</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection