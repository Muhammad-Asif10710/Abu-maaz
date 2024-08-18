<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Your Cart - Abu-Maaz.T</title>
    <style>
        /* Basic styling for demonstration purposes */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .cart-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .cart-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding: 20px 0;
        }
        .product-image {
            width: 100px;
            margin-right: 20px;
        }
        .product-details {
            flex: 1;
        }
        .product-name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .product-price {
            color: #007bff;
            margin-bottom: 5px;
        }
        .product-quantity {
            margin-bottom: 10px;
        }
        .quantity-input {
            width: 40px;
            text-align: center;
        }
        .size-select {
            margin-bottom: 10px;
        }
        .subtotal {
            font-weight: bold;
        }
        .grand-total {
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
        }
        .checkout-btn {
            background-color: black;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .checkout-btn:hover {
            background-color: #ff8f56;
        }
    </style>
</head>
<body>
@include('components.header')
<form id="checkout-form" action="/checkout" method="post">
    @csrf <!-- Include CSRF token -->

    <div class="cart-container">
        <h1>Shopping-Cart</h1>
        @foreach($cartProducts as $product)
            <div class="cart-item" data-product-id="{{ $product->product->id }}">
                <img src="{{ url('images/' . $product->product->image_url) }}" alt="Product Image" class="product-image">
                <div class="product-details">
                    <div class="product-name">{{ $product->product->name }}</div>
                    <input type="hidden" name="product_id[]" value="{{ $product->product->id }}"> <!-- Hidden field for product ID -->
                    <input type="hidden" name="product_name[]" value="{{ $product->product->name }}"> <!-- Hidden field for product name -->
                    <div class="product-price">{{ $product->product->actual_price }}</div>
                    <div class="product-quantity">
                        Quantity: <input type="number" class="quantity-input" name="quantity[]" value="{{ $product->quantity }}" min="1" data-product-id="{{ $product->product->id }}">
                    </div>
                    @if($product->product->category->name == 'Stitched')
                        <div class="size-select">
                            Size:
                            <select class="size-select" name="size[]" data-product-id="{{ $product->product->id }}">
                                <option value="xs"{{ $product->size == 'xs' ? ' selected' : '' }}>XS</option>
                                <option value="s"{{ $product->size == 's' ? ' selected' : '' }}>S</option>
                                <option value="m"{{ $product->size == 'm' ? ' selected' : '' }}>M</option>
                                <option value="l"{{ $product->size == 'l' ? ' selected' : '' }}>L</option>
                                <option value="xl"{{ $product->size == 'xl' ? ' selected' : '' }}>XL</option>
                            </select>
                        </div>
                    @endif
                   <div class="subtotal" data-product-id="{{ $product->product->id }}">Subtotal: Rs:{{ $product->subtotal }}</div>
                   <div class="delete-from-cart">
    <button class="btn btn-danger" data-product-id="{{ $product->product->id }}">Delete from Cart</button>
</div>
                </div>
            </div>
        @endforeach
        <div id="grand-total" class="grand-total">Grand Total: Rs:{{ $grandTotal }}</div>
        <button type="submit" class="checkout-btn">Proceed to Checkout</button>
    </div>        
</form>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
    $('.quantity-input').change(function() {
        var productId = $(this).data('product-id');
        var quantity = $(this).val();
        $.ajax({
            type: 'POST',
            url: '/update-cart',
            data: {
                product_id: productId,
                quantity: quantity
            },
            success: function(response) {
                $('#grand-total').html('Grand Total: Rs:' + response.cart.grand_total);
                $(`.subtotal[data-product-id="${productId}"]`).html(`Subtotal: Rs:${response.cart.subtotal}`);
            }
        });
    });

    $('.delete-from-cart button').click(function(event) {
        event.preventDefault();
        var productId = $(this).data('product-id');
        var $cartItem = $(`.cart-item[data-product-id="${productId}"]`);
        $.ajax({
            type: 'POST',
            url: '/delete-from-cart',
            data: {
                product_id: productId
            }
        }).done(function(response) {
            // Update the grand total
            $('#grand-total').html('Grand Total: Rs:' + response.usercart.grand_total);
        });
        $cartItem.fadeOut(); // Fade out the item from the page
    });
});
</script>
</br>
@include('components.footer')
</body>
</html>