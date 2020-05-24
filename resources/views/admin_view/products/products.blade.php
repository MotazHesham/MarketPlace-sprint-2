@extends('admin_view/layout_admin')

@section('content')

 
    <div class="container text-center header-view">
      <h1>Manage Your <span>Items</span></h1>
      <p>here you can manage all your items in shop ...edit or delete anything</p>
    </div>

<div class="product_view">
  <div class="row justify-content-md-center">

   @foreach($products as $product)
   <div>
     <div class="col">
        <div class="card product_part" style="width: 18rem;position: relative;">
           <img src="/storage/uploads/{{$product->img}}" class="card-img-top" alt="...">
             <div class="card-body text-center" >
                    <h2 class="card-title">{{$product->name}}</h2>
                    <h6 class="card-subtitle mb-2 text-muted">{{$product->description}}</h6>
                    <p class="card-text" style="position: absolute;
                                    top: 0;
                                    left: 0;
                                    background-color: green;
                                    padding: 11px;
                                    font-weight: bolder;
                                    color: white;">${{$product->price}}</p>
                   <a href="/admin/product/details/{{$product->id}}" class="btn btn-success"><i class="fab fa-pagelines"></i> View</a>
                   @if($product->approve==0)  <a href="/admin/products/approve/{{$product->id}}" style="color: white;" class="btn btn-primary"><i class="fas fa-lock-open"></i> approve</a> 
                   @endif
                     <a href="/admin/products/destroy/{{$product->id}}	" style="color: white;" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
             </div>
       </div>
    </div>
  </div>

  @endforeach

  </div>
</div>

@endsection