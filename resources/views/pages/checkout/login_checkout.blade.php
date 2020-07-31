@extends('layout2')
<link rel="shortcut icon" href="../frontend/images/ico/favicon.ico">
<link rel="apple-touch-icon" href="../frontend/images/ico/apple-touch-icon">
@section('content')
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập</h2>
						<form action="{{URL::to('/login')}}" method="post">
							{{csrf_field()}}
							<input type="email" placeholder="địa chỉ email" name="customer_email"/>
							<input type="password" placeholder="mật khẩu" name="customer_password"/>
							<span>
								<div class="clearfix"></div>
								@if(session()->has('check_sign'))
								<div class = "eror">
								<strong>Thông báo: </strong>
								<?php
								$noti = Session::get('check_sign');
								if ($noti) {
								echo $noti;
								Session::put('check_sign',null);
								} 
								?>
			</div>
			@endif
			<div class="clearfix"></div>		
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng kí!</h2>
						<form action="{{URL::to('/signup')}}" method="post">
							{{csrf_field()}}
							<input type="text" placeholder="tên" name="customer_name" />
							<input type="email" placeholder="địa chỉ" name="customer_email"/>
							<input type="text" placeholder="số điện thoại" name="customer_phone"/>
							<input type="password" placeholder="mật khẩu" name="customer_password"/>
							<button type="submit" class="btn btn-default">Đăng kí</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form--> 
@endsection