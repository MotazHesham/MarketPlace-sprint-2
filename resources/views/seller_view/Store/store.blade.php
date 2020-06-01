@extends('seller_view/layout_seller')

@section('content')

    <div class="container text-center header-view">
        <h1>This Your Own Store</h1>
        <p>here you can see all your product of your Store</p>
    </div>

    <div class="product_view ">
        <div class="row justify-content-md-center">

            @foreach($products as $product)

                <div>
                    <div class="col">
                        <div class="card product_part" style="width: 18rem;" style="position: relative;">

                            <img class="card-img-top" src="/storage/uploads/{{$product->img}}" alt="Card image cap" style="height: 160px">

                            <div class="card-body">
                                <h5 class="card-title">{{$product->name}}</h5>
                                <p class="card-text">{{$product->description}}</p>
                                <p class="card-text" style="position: absolute;
																    top: 0;
																    left: 0;
																    background-color: #008000a8;
																    padding: 11px;
														        font-weight: bolder;
																    color: white;">${{$product->price}}</p>
                                <div class="overlay_product text-center">
                                    <a href="/seller/orders/{{$product->id}}" class="btn btn-success"><i class="fab fa-pagelines"></i> Show Orders</a><br> <br>
                                    @if($product->approve == 0)
                                        <a href="/seller/edit/product/{{$product->id}}" style="color: white;" class="btn btn-primary"><i class="far fa-edit"></i> Edit</a>
                                        <a href="/seller/delete/product/{{$product->id}}" style="color: white;" class="btn btn-danger confirm"><i class="fas fa-trash"></i> Delete</a>
                                    @else
                                        <a href="#" class="btn btn-secondary"><i class="fas fa-check"></i>Approved</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            @endforeach


        </div>
    </div>

@endsection
