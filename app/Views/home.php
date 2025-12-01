<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paypal Integration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
</head>
<body>
    <div class="container text-center">
        <h1>Paypal Integration</h1>
        <div class="d-flex justify-content-center">
            <div class="card mt-4" style="width: 18rem;">
                <img src="<?=base_url('public/assets/images/mango.jpg')?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Mango</h5>
                    <p class="card-text">Price: $1</p>
                    <a href="<?=base_url('checkout')?>" class="btn btn-primary">Pay with Paypal</a>
                </div>
            </div>
            <div class="card mt-4" style="width: 18rem;">
                <img src="<?=base_url('public/assets/images/mango.jpg')?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Mango</h5>
                    <p class="card-text">Price: $1</p>
                    <a href="<?=base_url('checkout')?>" class="btn btn-primary">Pay with Paypal</a>
                </div>
            </div>
            <div class="card mt-4" style="width: 18rem;">
                <img src="<?=base_url('public/assets/images/mango.jpg')?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Mango</h5>
                    <p class="card-text">Price: $1</p>
                    <a href="<?=base_url('checkout')?>" class="btn btn-primary">Pay with Paypal</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>