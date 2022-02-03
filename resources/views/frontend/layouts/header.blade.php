<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 header-top-group justify-content-start disabled">
                    <p class="topic-text">การแสดงผล</p>
                    <div class="header-top-row d-flex">
                        <a class="btn btn-display1">ก</a>
                        <a class="btn btn-display2">ก</a>
                        <a class="btn btn-display3">ก</a>
                    </div>
                    <div class="header-top-row d-flex">
                        <a id="decreasetext" class="btn btn-increase">+</a>
                        <div class="fontsize">ก</div>
                        <a id="increasetext" class="btn btn-reduce">-</a>
                    </div>
                    {{-- <div class="header-top-row d-flex">
                        <a class="lang-flag th"></a>
                        <a class="lang-flag en"></a>
                    </div> --}}
                </div>
                <div class="col-md-6 header-top-group justify-content-end link">
                    <ul>
                        <li><a href="#">สมาชิก</a></li>
                        <li><a href="{{ route('backend') }}">ADMIN</a></li>
                        <li><a href="http://complain.dwf.go.th/" target="_blank">ร้องทุกข์-ร้องเรียน</a></li>
                        <li><a href="#">INTRANET</a></li>
                    </ul>
                    <a href="http://complain.dwf.go.th/public/fraudComplaint.do" target="_blank">
                        <img src="{{ asset('images/ร้องเรียนการทุจริต.png') }}" alt="ร้องเรียนการทุจริต" class="img-btn ml-2">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-menu">
        <div class="container">
            <div class="header-row row justify-content-center">
                <div class="col-md-6 header-menu-col left">
                    <a href="{{ url('') }}" class="logo"></a>
                    <marquee class="txt-running font-medium c-pink">ยึดมั่นหลักธรรมาภิบาล มุ่งเน้นบริการด้วยความโปร่งใสและตรวจสอบได้</marquee>
                </div>
                <div class="col-md-6 header-menu-col right bg-city text-right">
                    <p class="txt-intro font-medium c-pink">“สตรีและครอบครัวมั่นคง สังคมเสมอภาค”</p>
                    <ul class="list-social float-right my-2">
                        <li><a href="https://www.facebook.com/egovthai?fref=ts" target="_blank" class="social-ic facebook"></a></li>
                        <li><a href="https://www.youtube.com/channel/UCXtsy6w-fx3fkESr-C6UaAA" target="_blank" class="social-ic youtube"></a></li>
                        <li><a href="https://www.instagram.com/pr.dwf123/?utm_medium=copy_link" target="_blank" class="social-ic instagram"></a></li>
                        <li><a href="mailto:contact@dwf.go.th" class="social-ic mail"></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="navbar-container d-flex justify-content-center">
           @include('frontend.layouts.topnav')
        </div>
        <a class="hamburger"></a>
    </div>
</header>

