<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="css/style_setting.css">

    <style>
        .password-toggle ion-icon {
            font-size: 20px;
            color: #888;
            padding: 3px;
            background-color: #fff;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <img src="imgs/bjbLogo.png" style="margin-top: 20px;" alt="" width="65">
                        </span>
                    </a>
                </li>

                <li>
                    <a href="/">
                        <span class="icon">
                            <ion-icon name="home"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="help"></ion-icon>
                        </span>
                        <span class="title">Bantuan</span>
                    </a>
                </li> --}}

                <li style="cursor: pointer;">
                    <a id="password-link">
                        <span class="icon">
                            <ion-icon name="lock-closed"></ion-icon>
                        </span>
                        <span class="title">Ubah Password</span>
                    </a>
                </li>

                <li style="cursor: pointer;">
                    <a id="pin-link">
                        <span class="icon">
                            <ion-icon name="keypad-outline"></ion-icon>
                        </span>
                        <span class="title">Ubah Pin</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>

            @if (session()->has('Failed'))
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.all.min.js"></script>
                <script>
                    Swal.fire(
                        'Ooops!',
                        '{{ session('Failed') }}',
                        'error'
                    )
                </script>
            @endif

            @if (session()->has('Success'))
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.all.min.js"></script>
                <script>
                    Swal.fire(
                        'Berhasil!',
                        '{{ session('Success') }}',
                        'success'
                    )
                </script>
            @endif

            <div class="profile-container">
                <?php
                $balance = DB::table('balance')->value('balance');
                $formattedBalance = 'Rp ' . number_format($balance, 0, ',', '.');
                ?>

                <div class="profile">
                    <img src="https://i.postimg.cc/dVyNr8c8/profil.png" alt="Foto Profil">
                    <h3>
                        <i>{{ Auth::user()->username }}</i>
                    </h3>
                    <h4 style="color: green;">
                        {{ $formattedBalance }}
                    </h4>
                </div>
                <form class="settings-form">
                    <h2>Pengaturan Akun</h2>

                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat:</label>
                        <textarea id="address" name="address" disabled>{{ Auth::user()->address }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="credit_number">No. Kartu ATM:</label>
                        <input type="text" id="credit_number" name="credit_number"
                            value="{{ Auth::user()->credit_number }}" disabled>
                    </div>


                    <div class="form-group">
                        <label for="contact">No. HP:</label>
                        <input type="tel" id="contact" name="contact" value="{{ Auth::user()->contact }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="{{ Auth::user()->email }}">
                    </div>
                    <div class="button-container">
                        <button type="submit" class="submit-button">Simpan</button>
                        <button type="button" class="cancel-button">Batal</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="changePassword" style="z-index: 2" class="modalChangePasswordPin">
            <div class="modal-content-changePassword">
                <span class="closebtn">&times;</span>
                <h2 style="margin-bottom: 20px;">Ubah Password</h2>
                <form action="" method="post">
                    @csrf
                    <label for="oldPassword">Masukan Password Lama</label>
                    <input type="password" id="changePassword-input" name="oldPassword" required>
                    <label for="newPassword">Masukan Password Baru</label>
                    <div class="visibilityIconPassword">
                        <input type="password" id="changeNewPassword-input" name="newPassword" required>
                        <span class="password-toggle" onclick="togglePasswordVisibility()">
                            <ion-icon name="eye-outline"></ion-icon>
                        </span>
                    </div>
                    <button class="btnChangePassword" type="submit" name="submitPin" id="submit-pin">Ganti</button>
                </form>
            </div>
        </div>

        <div id="changePin" style="z-index: 2" class="modalChangePasswordPin">
            <div class="modal-content-changePassword modal-content-changePin">
                <span class="closebtnpin">&times;</span>
                <h2 style="margin-bottom: 20px;">Ubah Pin</h2>
                <label for="oldPassword">Masukan Pin Lama</label>
                <input type="password" id="changePassword-input" name="oldPassword" autocomplete="off" autofocus
                    required>
                <label for="newPassword">Masukan Pin Baru</label>
                <input type="password" id="changeNewPassword-input" name="newPassword" autocomplete="off" required>
                <button class="btnChangePassword" type="submit" name="submitPin" id="submit-pin">Ganti</button>
            </div>
        </div>
    </div>

    {{-- ===================== VISIBILITY PASSWORD ===================== --}}
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('changeNewPassword-input');
            var passwordToggle = document.querySelector('.password-toggle ion-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.setAttribute('name', 'eye-off-outline');
            } else {
                passwordInput.type = 'password';
                passwordToggle.setAttribute('name', 'eye-outline');
            }
        }
    </script>

    {{-- ===================== MODAL UBAH PASSWORD ===================== --}}
    <script>
        var changePassword = document.getElementById("password-link");
        var modalChangePasswordPin = document.getElementById("changePassword");
        var closeBtn = document.querySelector('.closebtn');

        changePassword.addEventListener('click', function() {
            modalChangePasswordPin.style.display = 'block'
        });

        closeBtn.addEventListener('click', function() {
            modalChangePasswordPin.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target == modalChangePasswordPin) {
                modalChangePasswordPin.style.display = "none";
            }
        });
    </script>


    {{-- ===================== MODAL UBAH PIN ===================== --}}
    <script>
        var changePin = document.getElementById("pin-link");
        var modalChangePin = document.getElementById("changePin");
        var closeBtnPin = document.querySelector('.closebtnpin');

        changePin.addEventListener('click', function() {
            modalChangePin.style.display = 'block';
        });

        closeBtnPin.addEventListener('click', function() {
            modalChangePin.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target == modalChangePin) {
                modalChangePin.style.display = "none";
            }
        });
    </script>

    <!-- =========== JS HAMBURGER MENU =========  -->
    <script src="js/hamburger.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
