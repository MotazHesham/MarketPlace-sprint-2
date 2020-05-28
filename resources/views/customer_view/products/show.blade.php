@extends('customer_view/layout_customer')

@include('functions')
@section('content')


<div class="container text-center header-view">
	<h1><span>{{$product->name}}</span> item </h1>
	<p>here you can see all info about that item...</p>
</div>

<div class="container">
	<div class="row">

		<div class="col">
			<div class="upload-img">
				<img id="img" src="/storage/uploads/{{$product->img}}" name="img">
			</div>
		</div>

		<div class="col">
			<div class="card">
			  <h5 class="card-header text-center">Item Info</h5>
			  <div class="card-body profile-info">
			    <div>Name : <span>{{$product->name}}</span> </div>
			    <div>Description : <span>{{$product->description}}</span> </div>
			    <div>Price : <span>{{$product->price}}</span> </div>
					<div>Seller :
						<span>
							<a>{{$product->user->name}}
								<button type="button" style="margin-left:15px"
												class="btn btn-info start_chat"
												data-touserid   ="{{ $product->user->id }}"
												data-touserimg   ="{{ $product->user->img }}"
												data-tousername ="{{ $product->user->name }}"
												data-touserstatus ="{{ $product->user->login_status }}">Start Chat
								</button>
							</a>
						</span>
					</div>
			  </div>
			</div>
			<a class="btn btn-success btn-block" href="/add_to_cart/{{$product->id}}">Add To Cart</a>
		</div>

	</div>
</div>



<div class="container">
	 <div class="card" style="margin-top:20px;">
	  <div class="card-header text-center"><i class="fa fa-comments"></i> Comments</div>
	  	@Auth
		 <div class='comment-box'>
			 <span class='comment-owner'><image style='height:35px;width:35px;border-radius:50%' src="/storage/uploads/{{Auth::user()->img}}"></span>
			 <span class='comment-content'>
				 <form action='/comments/insert-comment' method='post' class='comment_form' >
				 	{{ csrf_field() }}
					 <input type='hidden' value='{{ $product->id }}' name='product_id'>
					 <input type='hidden' value='{{Auth::user()->id}}' name='user_id'>
					 <input type='text' name='written_comment' id='written_comment' autocomplete='off' placeholder='Write a comment...'>
				 </form>
			 </span>
		 </div>
		 @endAuth
		 <hr style='border-width:2px'>
			  <!-- fetch comments using ajax ^_- -->
			 <div id='fetch_comments' class='comment-box' data-itemid='{{ $product->id }}'></div>

	 </div>
 </div>

@endsection
