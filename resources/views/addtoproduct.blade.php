<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

    @include('components.header')

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    
<form method="POST" action="/productsadd" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="actual_price">Actual Price</label>
        <input type="number" class="form-control" id="actual_price" name="actual_price" required>
    </div>
    <div class="form-group">
        <label for="discount">Discount</label>
        <input type="number" class="form-control" id="discount" name="discount" required>
    </div>
    <div class="form-group">
        <label for="discounted_price">Discounted Price</label>
        <input type="number" class="form-control" id="discounted_price" name="discounted_price" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <div class="form-group">
        <label for="rating">Rating</label>
        <input type="number" class="form-control" id="rating" name="rating" required>
    </div>
    <div class="form-group">
        <label for="colors">Colors</label>
        <input type="text" class="form-control" id="colors" name="colors" required>
        <small class="text-muted">Note: Enter colors separated by commas (e.g. red, blue, green)</small>
    </div>
    <div class="form-group">
        <label for="image_url">Image URL</label>
        <input type="file" class="form-control" id="image_url" name="image_url" required>
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select class="form-select" id="category_id" name="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</br>
    <button type="submit" class="btn btn-primary">Create Product</button>
</form>
</body>
</html>