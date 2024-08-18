<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Details</title>
    <!-- Bootstrap CSS -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        /* Additional custom styles */
        body {
            padding: 20px;
        }
        .grand-total-section {
            background-color: #f8f9fa;
            padding: 10px;
            margin-top: 20px;
        }
        .grand-total-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
    <h1 class="mt-5" style="font-family: cursive; text-decoration: underline;">Checkout Details</h1>
        <form action="{{ route('place-order') }}" method="POST" class="needs-validation" novalidate>
    @csrf <!-- CSRF Token -->

    <!-- Address input -->
    <div class="form-group mt-4">
        <label for="address" class="form-label">Address:</label>
        <input type="text" class="form-control" id="address" name="address" required>
        <div class="invalid-feedback">Please enter your address.</div>
    </div>

    <!-- Payment method input -->
    <div class="form-group">
        <label for="payment_method" class="form-label">Payment Method</label>
        <select class="form-control" id="payment_method" name="payment_method">
            <option value="cash_on_delivery">Cash on Delivery</option>
        </select>
    </div>

    <!-- Phone number input -->
    <div class="form-group">
        <label for="phone_number" class="form-label">Phone Number:</label>
        <input type="tel" class="form-control" id="phone_number" name="phone_number" required pattern="[0-9]{11,}">
        <div class="invalid-feedback">Please enter a valid phone number (at least 11 digits).</div>
    </div>

    <!-- Postal code input -->
    <div class="form-group">
        <label for="postal_code" class="form-label">Postal Code:</label>
        <input type="number" class="form-control" id="postal_code" name="postal_code" required>
        <div class="invalid-feedback">Please enter a valid postal code.</div>
    </div>

    <!-- Description input -->
    <div class="form-group">
        <label for="description" class="form-label">Description:</label>
        <textarea class="form-control" id="description" name="description" placeholder="Enter your description for stitched products..." required></textarea>
        <div class="invalid-feedback">Please enter a description.</div>
    </div>

    <!-- Grand total section -->
    <div class="grand-total-section">
        <span class="grand-total-label">Grand Total:</span>
        <span class="grand-total-value">Rs:{{ $grandTotal }}</span>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary mt-3">Place Order</button>
</form>

<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var form = document.querySelector('.needs-validation');
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        }, false);
    })();
</script>
</body>
</html>
