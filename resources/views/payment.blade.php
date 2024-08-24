<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h1>Payment</h1>
        <p id="priceMessage" class="lead"></p>
        <form id="paymentForm">
            <div class="mb-3">
                <label for="paymentAmount" class="form-label">Enter Amount</label>
                <input type="number" id="paymentAmount" class="form-control" required min="1">
                <div id="message" class="mt-3"></div>
            </div>
            <button type="submit" class="btn btn-primary">Submit Payment</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function getRandomPrice(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        const minPrice = 100000;
        const maxPrice = 125000;
        const minimumPrice = getRandomPrice(minPrice, maxPrice);

        document.getElementById('priceMessage').innerText = `The minimum registration price is Rp${minimumPrice.toLocaleString()}.`;

        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const enteredAmount = parseFloat(document.getElementById('paymentAmount').value);
            const messageDiv = document.getElementById('message');

            if (isNaN(enteredAmount) || enteredAmount <= 0) {
                messageDiv.innerHTML = '<div class="alert alert-danger">Invalid amount entered.</div>';
                return;
            }

            if (enteredAmount < minimumPrice) {
                const amountUnderpaid = minimumPrice - enteredAmount;
                messageDiv.innerHTML = `<div class="alert alert-warning">You are still underpaid Rp${amountUnderpaid.toLocaleString()}</div>`;
            } else if (enteredAmount > minimumPrice) {
                const amountOverpaid = enteredAmount - minimumPrice;
                const userResponse = confirm(`Sorry, you overpaid Rp${amountOverpaid.toLocaleString()}. Would you like to enter a balance?`);

                if (userResponse) {
                    messageDiv.innerHTML = `<div class="alert alert-success">Your balance of Rp${amountOverpaid.toLocaleString()} has been added to your wallet.</div>`;
                    setTimeout(function() {
                        window.location.href = '/home';
                    }, 1000); 
                } else {
                    document.getElementById('paymentAmount').value = '';
                    messageDiv.innerHTML = '<div class="alert alert-info">Please enter the amount again.</div>';
                }
            } else {
                messageDiv.innerHTML = '<div class="alert alert-success">Payment is successful.</div>';
                setTimeout(function() {
                    window.location.href = '/home';
                }, 1000); 
            }
        });
    </script>
</body>
</html>
