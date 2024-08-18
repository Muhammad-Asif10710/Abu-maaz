<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Add your CSS stylesheets here -->
    <style>
 
        .container {
            margin-top: 60px; /* Adjust margin to accommodate the fixed navbar */
            text-align: center;
            padding: 50px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4caf50;
        }
        p {
            color: #333;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: black;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>



@include('components.header')

<div class="container">
    <h1>Your order has been placed successfully!</h1>
    <p>Thank you for shopping with us.</p>
    <!-- You can add more details or links to continue shopping, track order, etc. -->
    <a href="{{ route('welcome') }}" class="button">Continue Shopping</a>
</div>

</body>
</html>
