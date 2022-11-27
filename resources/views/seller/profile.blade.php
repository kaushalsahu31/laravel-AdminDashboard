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
        <h2>Add Product</h2>
        <div class="addproduct my-3">
            <input id="name" class="form-control" placeholder="Name" type="text">
            <input id="detail" placeholder="Detail" class="form-control" type="text">
            <a href="" class="btn btn-primary">Save</a>
            
        </div>
        <div class="admin-container">
            <div class="heading">
           <h2>Product List</h2>
        </div>

        <div class="body-data"> 
            
            <div id="table_data">
                @include('seller.profiledata')
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

  $(document).on('click', '.delete button', function(event){
  event.preventDefault(); 
  let id = $(this).attr('value');
  delete_data(id);
 });


  $(document).on('click', '.addproduct a', function(event){
      
  event.preventDefault(); 
  let name=document.getElementById("name").value
  let detail=document.getElementById("detail").value
  if(name!=="" && detail!==""){
       post_data(name,detail)
  }
  
   
  
 });


  function post_data(name,detail)
 {
  $.ajax({
    type: 'POST',
   url:"/api/product",
   data: {name,detail},
    dataType: "text",
   success:function(data)
   {
        alert("Save Complete")
        fetch_data(1);
   }
  });
 }



 function delete_data(page)

 {
  $.ajax({
       type: 'DELETE',
   url:"/api/product/"+page,
   success:function(data)
   {
    alert("Save Complete")
        fetch_data(1);
   }
  });
 }

 function fetch_data(page)

 {
    pagination=page
  $.ajax({
   url:"/api/product?page="+page,
   success:function(data)
   {
    $('#table_data').html(data);
   }
  });
 }
 
});
</script>
