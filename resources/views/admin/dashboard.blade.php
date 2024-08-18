<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
      <style>
    .dashboard-wrapper {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        margin: 20px;
    }
    .dashboard-card {
        margin: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
    }
    table {
        width: 100%;
    }
    .divider {
    margin: 20px 0;
    border-bottom: 1px solid #ccc;
}
</style>
    </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<main>

    @include('components.header')
    
    <div class="dashboard-wrapper">
        <div class="dashboard-card">
        <div class="container">
  <div class="row justify-content-center">
    <div class="col-auto">
    <a href="/admin/addproduct">
  <button class="btn btn-dark">Add Product</button>
</a>
    </div>
  </div>
</div>
<table>
    <thead>
        <tr>
            <th style="border-bottom: 1px solid black;">Order ID</th>
            <th style="border-bottom: 1px solid black;">User ID</th>
            <th style="border-bottom: 1px solid black;">User Name</th>
            <th style="border-bottom: 1px solid black;">Address</th>
            <th style="border-bottom: 1px solid black;">Payment Method</th>
            <th style="border-bottom: 1px solid black;">Phone Number</th>
            <th style="border-bottom: 1px solid black;">Postal Code</th>
            <th style="border-bottom: 1px solid black;">Grand Total</th>
            <th style="border-bottom: 1px solid black;">Product ID</th>
            <th style="border-bottom: 1px solid black;">Product Name</th>
            <th style="border-bottom: 1px solid black;">Quantity</th>
            <th style="border-bottom: 1px solid black;">Size</th>
            <th style="border-bottom: 1px solid black;">Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            @php
                $uniqueProducts = $order->order_products->unique('product_id');
            @endphp
            @foreach($uniqueProducts as $orderProduct)
                <tr>
                    <td>{{ $loop->first ? $order->id : '' }}</td>
                    <td>{{ $loop->first ? $order->user_id : '' }}</td>
                    <td>{{ $loop->first ? $order->user->name : '' }}</td>
                    <td>{{ $loop->first ? $order->address : '' }}</td>
                    <td>{{ $loop->first ? $order->payment_method : '' }}</td>
                    <td>{{ $loop->first ? $order->phone_number : '' }}</td>
                    <td>{{ $loop->first ? $order->postal_code : '' }}</td>
                    <td>{{ $loop->first ? $order->grand_total : '' }}</td>
                    <td>{{ $orderProduct->product_id }}</td>
                    <td>{{ $orderProduct->product->name }}</td>
                    <td>{{ $orderProduct->quantity }}</td>
                    <td>{{ $orderProduct->size }}</td>
                    <td>{{ $loop->first ? $order->description : '' }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="13"><hr></td>
            </tr>
        @endforeach
    </tbody>
</table>
        </div>
    </div>
    @include('components.footer')

</main>
   
</body>
</html>