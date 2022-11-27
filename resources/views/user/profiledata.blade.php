

 <div id="user_div" class="my-3 grid-box">
                


    @foreach ($products as $key => $product)
        <div id="user{{$product->id}}">
            <h3> Name: {{$product->name}}</h3>
            <h5>Detail: {{$product->detail}}</h5>
        </div>
    @endforeach

</div>
<div class="pagination d-flex justify-content-center">{!! $products->links('pagination::bootstrap-4') !!}</div>
          
