<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Library | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= urlTo('/public/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= urlTo('/public/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
    <!-- sweetalert2 -->
    <link rel="stylesheet" type="text/css" href="<?= urlTo('/public/adminlte/plugins/sweetalert2/sweetalert2.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= urlTo('/public/adminlte/css/adminlte.min.css'); ?>">
    <link rel="icon" type="image/x-icon" href="<?= urlTo('/public/adminlte/img/favicon.ico'); ?>">
    <link rel="stylesheet" href="<?= urlTo('/public/login/css/style.css'); ?>">
</head>

<style>
body {
    /* Menggunakan linear gradient untuk latar belakang */
    background: linear-gradient(135deg, #F5E8DD, #C9E4F8);
    /* Animasi perubahan warna */
    animation: changeColor 5s infinite alternate;
}

/* Animasi perubahan warna */
@keyframes changeColor {
    0% {
        background-color: #F5E8DD;
    }

    50% {
        background-color: #EED3D9;
    }

    100% {
        background-color: #F5E8DD;
    }
}

.signin-heading {
    border-bottom: 1px solid #e3b04b;
    padding-bottom: 10px;
}
</style>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5 mt-5">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <div class="img" style="background-image: url('<?= urlTo('/public/adminlte/img/bg.jfif'); ?>');">
                    </div>

                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4 signin-heading">Sign In</h3>
                            </div>
                        </div>
                        <form action="<?= urlTo('/login/login'); ?>" class="signin-form" method="post">
                            <div class="form-group mb-3">
                                <label class="label" for="name">Username</label>
                                <input type="text" class="form-control" name="Username" placeholder="Username" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password">Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="Password"
                                    required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign
                                    In</button>
                            </div>
                        </form>
                        <p class="text-center">Belum mempunyai akun?
                            <a href="<?= urlTo('/login/register'); ?>">Sign Up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- sweetalert2 -->
    <script src="<?= urlTo('/public/adminlte/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>
    <!-- jQuery -->
    <script src="<?= urlTo('/public/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= urlTo('/public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= urlTo('/public/adminlte/js/adminlte.min.js'); ?>"></script>
    <script src="<?= urlTo('/public/login/js/main.js'); ?>"></script>
    <?php if (isset($_COOKIE['alert'])): ?>
    <?php $data = unserialize($_COOKIE['alert']); ?>
    <script>
    Swal.fire({
        title: "<?= $data[1]; ?>",
        icon: "<?= $data[0]; ?>",
        showConfirmButton: false,
        timer: 2000
    });
    </script>
    <?php endif ?>

</body>

</html>