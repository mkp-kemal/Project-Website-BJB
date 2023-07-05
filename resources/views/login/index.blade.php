<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style_login.css">

    <!-- FONT GOOGLE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <title>Login</title>
</head>

<body>
    <section class="login d-flex">
        <div class="login-left w-100 h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="kolom col-7">
                    <div class="Logo text-center">
                        <img src="imgs/bjbLogo.png" alt="">
                        <!-- <img src="img/mkpLogo.png" alt=""> -->
                    </div>
                    <div class="header">
                        <h1 class="welcome">Selamat Datang...</h1>
                        <p>Hallo, <b>Login</b> untuk akses</p>
                    </div>

                    <div class="login-form">
                        <form action="/login" method="post">
                            @if (session()->has('loginError'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ion-icon name="alert-circle-outline"></ion-icon> {{ session('loginError') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="close"></button>
                                </div>
                            @endif

                            @if (session()->has('logoutSuccess'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <ion-icon name="alert-circle-outline"></ion-icon> {{ session('logoutSuccess') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="close"></button>
                                </div>
                            @endif

                            @if (!empty($loginSuccess))
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.all.min.js"></script>
                                <script>
                                    Swal.fire({
                                        title: 'Success!',
                                        text: '{{ $loginSuccess }}',
                                        icon: 'success',
                                        showConfirmButton: false
                                    });

                                    setTimeout(() => {
                                        location.href = '/dashboard';
                                    }, 1000);
                                </script>
                            @endif


                            <div id="error" style="color:red; display:none;font-style: italic;">
                                <ion-icon name="alert-circle-outline"></ion-icon> Username harus diisi tanpa spasi atau
                                titik
                            </div>

                            @csrf
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" placeholder="Masukan Username" required autofocus
                                autocomplete="true" onkeyup="validateInput()">

                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukan Password" required>

                            <a href="#" class="text-decoration-none text-center">Lupa password?</a>
                            <button class="signin" type="submit" id="btnLogin" name="btnlogin">Sign In</button>
                            <button class="signin-google">
                                <img src="imgs/googleIcon.png" alt="" width="30">
                                Sign In With Google
                            </button>
                        </form>

                        <div class="NoAccount text-center" style="display: ">
                            <span class="d-inline">Tidak punya akun?
                                <a href="#" class="signup text-decoration-none d-inline">Daftar
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
                <footer class="text-center align-items-center">
                    <span style="color: white; font-size: 13px;"><b>&copy; 2023 Muhammad Kemal Pasha. All rights
                            reserved.</b></span>
                </footer>
            </div>
        </div>

        <div class="login-right w-100 h-100">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="imgs/bjb.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="imgs/bjb2.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="imgs/bjb3.jpeg" class="d-block w-100" alt="...">
                    </div>
                </div>
            </div>

        </div>

    </section>

    <script>
        function validateInput() {
            var input = document.getElementById("username").value;
            var btn = document.getElementById("btnLogin");
            var regex = /[\s.]/;

            if (/\s/.test(input) || /\./.test(input)) {
                document.getElementById("error").style.display = "block";
                btn.disabled = true;
                btn.style.backgroundColor = "grey";
            } else {
                document.getElementById("error").style.display = "none";
                btn.disabled = false;
                btn.style.backgroundColor = "blue";
            }
        }
    </script>


    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
