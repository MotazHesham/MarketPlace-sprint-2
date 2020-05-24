<!DOCTYPE html>
<html>
<head>
	<title>Seller</title>
	<link rel="icon" href="{{ asset('images/icon2.png') }}">
	<link rel="stylesheet" href="{{ asset('css/all.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/seller.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Courgette|Lobster" rel="stylesheet">
</head>
<body>

	<!-- -------------------------------------------------------- -->
	<!-- -------------------------------------------------------- -->

		<!-- start navbar -->

			@include('seller_view/navbar')

		<!-- end navbar -->	

	<!-- -------------------------------------------------------- -->
	<!-- -------------------------------------------------------- -->	

		<!-- start carousel -->

			@include('seller_view/carousel')

		<!-- end carousel -->

	<!-- -------------------------------------------------------- -->
	<!-- -------------------------------------------------------- -->

		<!-- start views -->

			<div class="main main-raised">
				@include('messages')
				@yield('content')
			</div>
			
		<!-- end views -->

	<!-- -------------------------------------------------------- -->
	<!-- -------------------------------------------------------- -->

		<!-- start footer -->

			<footer class="text-center mt-5">
		        <p>Made with <a href="#" target="_blank">ZzZ</a> by Creative Team</p>
		    </footer>

		<!-- end footer -->

	<!-- -------------------------------------------------------- -->
	<!-- -------------------------------------------------------- -->	


	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/my_script.js') }}"></script>
</body>
</html>