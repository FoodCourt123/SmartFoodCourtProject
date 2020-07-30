@extends('admin_layout')
@section('admin_content')
<link rel="stylesheet" href="{{asset('frontend/admin/css/admin-profile.css')}}">
<h2>User Profile Card</h2>

<div class="card">
    <img alt="" src="{{asset('frontend/admin/images/admin.png')}}">
    <h1>
        @if(session()->has('admin_name'))
        <?php
        $name = Session::get('admin_name');
        if ($name) {
            echo $name;
        }
        ?>
        @endif
    </h1>
    <p class="title">CEO & Founder, Example</p>
    <p>Harvard University</p>
    <div style="margin: 24px 0;">
        <a href="#"><i class="fa fa-dribbble"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-facebook"></i></a>
    </div>
    <p><button>Contact</button></p>
</div>
@endsection