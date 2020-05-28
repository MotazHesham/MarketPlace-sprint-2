@extends('seller_view/layout_seller')

@include('functions')
@section('content')


	<div class="container text-center header-view">
		<h1><span>{{$data->name}}</span> Orders</h1>
		<p></p>
	</div>
	<div class="row">
		@if($data->order != null)
			@foreach($data->order as $order)


				<div class="col">
				    <div class="container">
				    	<div style="background-color: #67656512;padding: 25px;border-radius: 12px 50px 12px 50px;">
							<h4><span class="price" style="color:black"><i class="fas fa-truck" style="color: #569a91"></i></span> Order

								<span style="float: right;padding: 10px;font-size:18px;background-color: #3fa9784f">Quantity: <b>{{$order->pivot->quntity}}</b></span></h4>
							<hr>
							<div class="row">
								<div class="col">
										<p style="padding: 10px">Name: <b>{{ $order->name }}</b></p>
										<p style="padding: 10px">Email: <b>{{ $order->email }}</b></p>
										<p style="padding: 10px">Telephone: <b>{{ $order->telephone }}</b></p>
								</div>
								<div class="col">
										<p style="padding: 10px">Address: <b>{{ $order->address}}</b></p>
										<p style="padding: 10px">City: <b>{{ $order->city }}</b></p>
										<p style="padding: 10px">State: <b>{{ $order->state }}</b></p>
								</div>

							</div>
							<div style="background-color: #203e20d6;
																    padding: 12px;
																    border-radius: 10px 21px;
																    color: white;
																    font-weight: bold;">
								TOTAL: <b style="float: right;">$<span>{{ ($data->price) * ($order->pivot->quntity)}}</span></b>
							</div>
						</div>
				    </div>
				</div>

			@endforeach
		</div>
	@endif
	@if($data->order->isEmpty())
			<div class="container text-center">
				<h3 class="alert alert-secondary"> No Requested Orders Yet For <span style="color:royalblue">{{$data->name}}</span></h1>
			</div>
	@endif
@endsection
