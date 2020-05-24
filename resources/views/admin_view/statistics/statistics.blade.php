@extends('admin_view/layout_admin')

@include('functions')
@section('content')

	<div class="container text-center header-view">
		<h1 style="color: black;" >Dashboard</h1>
		<p>here you can see statistics of your website ..... </p>
	</div>

	<!-- Home Stat  -->
	<div class="home-stat">
		<div class="container text-center">
			<div class="row">

				<!-- Total Members -->
				<div class="col">
					<div class="card text-white total-members  mb-3 stat" style="max-width: 18rem;">
						<div class="card-header"><i class="fa fa-users"></i> Total members</div>
						<div class="card-body">
							<h5 class="card-title"> {{$data['users']}} </h5>
						</div>
					</div>
				</div>

				<!-- Total Items -->
				<div class="col">
					<div class="card text-white total-items mb-3 stat" style="max-width: 18rem;">
						<div class="card-header"><i class="fa fa-tags"></i> Total Products</div>
						<div class="card-body">
							<h5 class="card-title">{{$data['products']}} </h5>
						</div>
					</div>
				</div>

				<!-- Total Items pennding -->
				<div class="col">
					<div class="card text-white total-pending-items mb-3 stat" style="max-width: 18rem;">
						<div class="card-header"><i class="fa fa-tag"></i> Total Pending Items</div>
						<div class="card-body">
							<h5 class="card-title"> {{$data['pending']}} </h5>
						</div>
					</div>
				</div>

				<!-- Total Comments -->
				<div class="col">
					<div class="card text-white total-comments mb-3 stat" style="max-width: 18rem;">
						<div class="card-header"><i class="fa fa-comments"></i> Total Comments</div>
						<div class="card-body">
							<h5 class="card-title"> {{$data['comments']}} </h5>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- latest added -->
	<div class="latest">
		<div class="container">
			<div class="row">

				<!-- latest added user -->
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header text-center"><i class="fas fa-users"></i> Lastest 5 Registerd Users</div>
						@foreach ($data['user'] as $user)
						  <div class='card-item'>
						  	{{ $user->name }}
						  	<div class='text-right' style='font-size:13px;color:black'>
						  		{{ calculate_diff_date($user->created_at) }}
						  	</div>
						  </div>
					  	@endforeach
					</div>

				</div>

				<!-- latest added items -->
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header text-center"><i class="fas fa-tag"></i> Lastest 5 Added Products</div>
						@foreach ($data['latest_products'] as $product)
						    <div class='card-item'>
							    	{{ $product->name }}
						  	  <div class='text-right' style='font-size:13px;color:black'>
						  		{{ calculate_diff_date($product->created_at) }}
						  	  </div>
						 	</div>
					    @endforeach
					</div>
				</div>

				<!-- latest added comments -->
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header text-center"><i class="fas fa-comments"></i> Lastest 5 Comments</div>
						@foreach($data['latest_comment'] as $comment)
							<div class='comment-box'>
								<span class='comment-owner'>
									<img src="/storage/uploads/{{$comment->user->img}}" style="height: 50px;width: 50px;border-radius: 50px">
									{{ $comment->user->name }}
								</span>

								<span class='comment-content'>
                                   {{$comment->comment }}
					    			<div class='text-right' style='font-size:13px;color:black'> {{calculate_diff_date($comment->created_at  )}} </div>
				    			</span>
					    	</div>			
						@endforeach
						
					</div>
				</div>

			</div>
		</div>
	</div>

@endsection