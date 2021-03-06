@extends('app')

@section('content')
<div class="container">

    <h1>Products</h1>
    <a href="{{route('products.create')}}" class="btn btn-default">Create</a>
    <br>
    <br>
   
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th>Action</th>
        </tr> 
        @foreach($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{str_limit($product->description, $limit = 100, $end = '...') }}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->category->name}}</td>
            <td>
                <a href="{{route('products.edit',['id'=>$product->id])}}" class="btn btn-default">Editar</a>
                <a href="{{route('products.images',['id'=>$product->id])}}" class="btn btn-default"> Images</a>
                <a href="{{route('products.destroy',['id'=>$product->id])}}" class="btn btn-default"> Deletar </a>
            </td>
        </tr>       
        @endforeach
    
    </table>
	
	{!! $products->render() !!}
</div>
@endsection