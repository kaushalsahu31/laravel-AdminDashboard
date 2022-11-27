<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

    <div class="container">
        <div class="admin-container">
            <div class="heading">
           <h2>Users List</h2>
        </div>

        <div class="body-data"> 
            <div class="filter row">
                 <div class="name col-3">
                    <input type="text" class="form-control" name="name" placeholder="Name" id="name_search">
                </div>
                 <div class="email col-3">
                  <input type="text" class="form-control" name="Email" placeholder="Email" id="email_search">
                </div>
                <div class="gender col-2">
                   <select class="form-control" name="gender" id="gender_search">
                       <option selected value="">Gender</option>
                       <option value="male">Male</option>
                       <option value="female">Female</option>
                   </select>
                </div>
                <div class="role col-2">
                   <select class="form-control" name="role" id="role_search">
                       <option selected value="">Roles</option>
                       <option value="admin">Admin</option>
                       <option value="seller">Seller</option>
                       <option value="user">User</option>
                   </select>
                </div>
                <div class="searchbox col-2">
                   <button class="btn btn-primary" id="search">Search</button>
                </div>
            </div>
            <div id="table_data">
                @include('admin.admindata')
            </div>
            
           
            <div id="modal" class="modal">
                <div class="modal-container">
                    <div class="flex">
                        <div class="closebox">
                            <h2>Change Role</h2>
                            <span id="closs">x</span>
                        </div>
                        <div id="roles" class="roles">
                            <div class="img">
                                <a href="admin">
                                    <img src="{{ URL::to('/').'/assets/2206368.png'}}" width="100px" alt="">
                                    <p class="my-4">Admin</p>
                                </a>
                            </div>
                            <div class="img">
                                 <a href="seller">
                                    <img src="{{ URL::to('/').'/assets/3372723.png'}}" width="100px" alt="">
                                    <p class="my-4">Seller</p>
                                </a>
                            </div>
                            <div class="img">
                                 <a href="user">
                                    <img src="{{ URL::to('/').'/assets/149071.png'}}" width="100px" alt="">
                                    <p class="my-4">User</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        
    </div>

            
        </main>
    </div>
</body>
</html>
<script>
    var search =""
    var userid =""
    var pagination =""
$(document).ready(function(){

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault(); 
  var page = $(this).attr('href').split('page=')[1];
  fetch_data(page,search);
 });

$(document).on('click', '#search', function(event){
  event.preventDefault(); 
  filter()
 });

  $(document).on('click', '#roles a', function(event){
  event.preventDefault(); 
  var role = $(this).attr('href');
  post_data(userid,role)
 });

  $(document).on('click', '.edit button', function(event){
  event.preventDefault(); 
    userid = $(this).attr('value');
    document.getElementById("modal").style.display="flex"
  
 });
   $(document).on('click', '#closs', function(event){
  event.preventDefault(); 
    document.getElementById("modal").style.display="none"
  
 });

  function post_data(userid,role)
 {
  $.ajax({
    type: 'PATCH',
   url:"/api/admin/"+userid,
   data: {role},
    dataType: "text",
   success:function(data)
   {
        alert("Save Complete")
        document.getElementById("modal").style.display="none"
        fetch_data(pagination,search);
   }
  });
 }

 function filter() {
    let name = document.getElementById("name_search").value
    let email = document.getElementById("email_search").value
    let role = document.getElementById("role_search").value
    let gender = document.getElementById("gender_search").value

    search = name!=""?"&name="+name:""
    search += email!=""?"&email="+email:""
    search += role!=""?"&role="+role:""
    search += gender!=""?"&gender="+gender:""
    fetch_data(1,search)

 }
 function fetch_data(page,search)

 {
    pagination=page
  $.ajax({
   url:"/admin/fetch_data?page="+page+search,
   success:function(data)
   {
    $('#table_data').html(data);
   }
  });
 }
 
});
</script>
