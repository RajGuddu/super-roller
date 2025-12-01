<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
</head>
<body>
    <div class="container text-center">
        <h1>Basic Form Submission</h1>
        <div class="d-flex justify-content-center">
            <form action="<?=current_url()?>" method="post">
                <input type="text" class="form-control" name="email" value="">
                <small class="text-danger"><?php echo isset($validation) ? $validation->showError('email') : ''; ?> </small>
                <input type="text" class="form-control" name="password" value="">
                <small class="text-danger"><?php echo isset($validation) ? $validation->showError('password') : ''; ?> </small>
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
</body>
</html>