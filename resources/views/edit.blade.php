<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product information') }}
        </h2>
    </x-slot>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container">
    <h1 class="my-5">Edit Product</h1>
    <form action="{{route('product_update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="form-control" name="id" value="{{$editdata->id}}">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" value="{{$editdata->name}}" id="name">
  </div>
  <div class="mb-3">
    <label for="type" class="form-label">Type</label>
    <input type="text" class="form-control" name="type" id="type" value="{{$editdata->type}}">
  </div>
  <div class="mb-3">
  <input class="form-control" name="newimage" type="file" id="formFile">
  <img src="{{asset('uploads/'.$editdata->image)}}" style="height: 120px; width: 150px;">
  <input class="form-control" name="oldimage" type="text" value="{{$editdata->image}}">
  
</div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>

</x-app-layout>
