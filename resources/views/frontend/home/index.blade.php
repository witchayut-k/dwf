@extends('frontend.layouts.web')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

@include('frontend.home.partials.banner')
@include('frontend.home.partials.tab_menu')
@include('frontend.home.partials.social_link')
@include('frontend.home.partials.news')
@include('frontend.home.partials.event')
@include('frontend.home.partials.department_link')
@include('frontend.home.partials.video')
@include('frontend.home.partials.rss')
@include('frontend.home.partials.registrar')
@include('frontend.home.partials.related_link')

@if (count($landingPages) > 0)
@include('frontend.home.partials.modal_landing')
@endif

@endsection
