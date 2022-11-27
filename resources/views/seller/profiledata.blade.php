

 <table id="user_table" class="my-3 table table-striped">
                
    <thead class="thead-dark">
    <tr>
        <th scope="col">name</th>
        <th scope="col">detail</th>
        <th scope="col">delete</th>
    </tr>
    </thead>
    <tbody id="links-list" name="links-list">
    @foreach ($products as $key => $product)
        <tr id="user{{$product->id}}">
            <td>{{$product->name}}</td>
            <td>{{$product->detail}}</td>
            <td class="delete">
                <button class="btn btn-secondary" value="{{$product->id}}">delete </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="pagination d-flex justify-content-center">{!! $products->links('pagination::bootstrap-4') !!}</div>
          
