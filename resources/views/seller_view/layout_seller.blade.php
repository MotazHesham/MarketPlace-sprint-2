<!DOCTYPE html>
<html>
<head>
	<title>Seller</title>
	<link rel="icon" href="{{ asset('images/icon2.png') }}">
	<link rel="stylesheet" href="{{ asset('css/all.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/seller.css') }}">
	<link rel="stylesheet" href="{{ asset('css/chat.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Courgette|Lobster" rel="stylesheet">
</head>
<body>

	<!-- ##################################################### -->
	<!-- ##################################################### -->

		<!-- start navbar -->

			@include('seller_view/navbar')

		<!-- end navbar -->

	<!-- ##################################################### -->
	<!-- ##################################################### -->

		<!-- start carousel -->

		<div style="height: 680px;
					background-color: royalblue;
					position: relative;">
			<img src="{{ asset('images/online_shopping.svg') }}" style="height: 500px;
							position: absolute;
							top: 16%;
							left: 10%;">
				<img src="{{ asset('images/shopping_app.svg') }}" 	 style="height: 500px;
							position: absolute;
							top: 14%;
							right:5%;">
		</div>

		<!-- end carousel -->

	<!-- ##################################################### -->
	<!-- ##################################################### -->

		<!-- start chat box -->

			<div class="chating" id="chating"></div>

		<!-- end chat box -->

		<!-- Start Contacts menu -->
			<div class="card mb-sm-3 mb-md-0 contacts_card">

					<!-- contacts header -->
				<div class="card-header">
					<div class="input-group">
						<div class="input-group-prepend">
							<span style="color: white">Contacts</span>
						</div>
					</div>
				</div>

				<div class="card-body contacts_body">
					<ui class="contacts">

						<!-- here updated ajax call -->

					</ui>
				</div>

			</div>
		<!-- End Contacts menu -->

<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

		<!-- start views -->

			<div class="main main-raised">
				@include('messages')
				@yield('content')
			</div>

		<!-- end views -->

	<!-- ##################################################### -->
	<!-- ##################################################### -->

		<!-- start footer -->

			<footer class="text-center mt-5">
		        <p>Made with <a href="#" target="_blank">ZzZ</a> by Creative Team</p>
		    </footer>

		<!-- end footer -->

	<!-- ##################################################### -->
	<!-- ##################################################### -->


	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/my_script.js') }}"></script>
	<script src="{{ asset('js/my_script_chat.js') }}"></script>
</body>
</html>
