

 <table id="user_table" class="my-3 table table-striped">
                
    <thead class="thead-dark">
    <tr>
        <th scope="col">name</th>
        <th scope="col">email</th>
        <th scope="col">gender</th>
        <th scope="col">role</th>
        <th scope="col">phone</th>
        <th scope="col">image</th>
        <th scope="col">update</th>
    </tr>
    </thead>
    <tbody id="links-list" name="links-list">
    @foreach ($users as $key => $user)
        <tr id="user{{$user->id}}">
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->gender}}</td>
            <td>{{$user->role}}</td>
            <td>{{$user->phone}}</td>
            <td><img src="{{ URL::to('/').$user->image}}" width="100px" alt=""></td>
            <td class="edit">
                <button class="btn btn-secondary" value="{{$user->id}}">Edit </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="pagination d-flex justify-content-center">{!! $users->links('pagination::bootstrap-4') !!}</div>
          
