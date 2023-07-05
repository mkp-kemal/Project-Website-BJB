@auth
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <!-- ======= Styles ====== -->
        <link rel="stylesheet" href="css/style_home.css">
    </head>

    <body>
        <div class="container">

            <!-- =============== NAVIGATION ================ -->
            <div class="navigation">
                <ul>
                    <li>
                        <a href="#">
                            <span class="icon">
                                <!-- <ion-icon name="logo-apple"></ion-icon> -->
                                <img src="imgs/bjbLogo.png" style="margin-top: 20px;" alt="" width="65">
                            </span>
                            <!-- <span class="title">bjb</span> -->
                        </a>
                    </li>

                    <li>
                        <a href="/dashboard">
                            <span class="icon">
                                <ion-icon name="home"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>

                    <li id="modal-link">
                        <a>
                            <span class="icon">
                                <ion-icon name="cash"></ion-icon>
                            </span>
                            <span class="title">Transfer Bank</span>
                        </a>
                    </li>

                    <li>
                        <a href="#wallet" id="modal-link-wallet">
                            <span class="icon">
                                <ion-icon name="wallet"></ion-icon>
                            </span>
                            <span class="title">E-Wallet</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="open-modal">
                            <span class="icon">
                                <ion-icon name="logo-reddit"></ion-icon>
                            </span>
                            <span class="title">Chatbot</span>
                        </a>
                    </li>

                    <li>
                        <a href="/setting" id="settings-link">
                            <span class="icon">
                                <ion-icon name="settings"></ion-icon>
                            </span>
                            <span class="title">Pengaturan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/logout" onclick="return confirm('Yakin ingin keluar ?')">
                            <span class="icon">
                                <ion-icon name="log-out" style="color: rgba(147, 0, 0, 0.628);"></ion-icon>
                            </span>
                            <span class="title" style="color: rgba(147, 0, 0, 0.628);"><b>Keluar</b></span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- ========================= MAIN ==================== -->
            <div class="main">
                <div class="topbar">
                    <div class="toggle">
                        <ion-icon name="menu-outline"></ion-icon>
                    </div>
                    <p class="sayNama"><b>Halo, {{ Auth::user()->name }}
                        </b></p>
                </div>

                <div class="middleBar">
                    <!-- ======================= Cards ================== -->
                    <div class="cardBox">
                        <div class="card">
                            <div>
                                @foreach ($balance as $blc)
                                    <?php
                                    $amount = $blc->balance;
                                    $formattedAmount = 'Rp ' . number_format($amount, 0, ',', '.');

                                    $in = $blc->in;
                                    $formattedIn = 'Rp ' . number_format($in, 0, ',', '.');

                                    $out = $blc->out;
                                    $formattedOut = 'Rp ' . number_format($out, 0, ',', '.');
                                    ?>
                                    <div class="text">Saldo</div>
                                    <div class="text" style="font-size: 10px"><b>{{ $blc->account_number }}</b></div>
                                    <div class="cardName">
                                        {{ $formattedAmount }}
                                    </div>
                            </div>

                            <div class="iconDompet">
                                <ion-icon name="wallet"></ion-icon>
                            </div>
                        </div>

                        <div class="card status">
                            <div>
                                <div class="text">Tipe Kartu</div>
                                <div class="cardName cardNameStatus"><b>
                                        {{ $blc->type_account }}
                                    </b></div>
                            </div>

                            <div class="{{ $blc->type_account }}">
                                <ion-icon name="card"></ion-icon>
                            </div>
                        </div>

                        <div class="card">
                            <div>
                                <div class="text">Pemasukan</div>
                                <div class="cardName">
                                    {{ $formattedIn }}
                                </div>
                            </div>

                            <div class="iconPemasukan">
                                <ion-icon name="arrow-down-outline"></ion-icon>
                            </div>
                        </div>

                        <div class="card">
                            <div>
                                <div class="text">Pengeluaran</div>
                                <div class="cardName">
                                    {{ $formattedOut }}
                                </div>
                            </div>

                            <div class="iconPengeluaran">
                                <ion-icon name="arrow-up-outline"></ion-icon>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- ================ history ================= -->
                    <div class="history">
                        <div class="recentOrders">
                            <div class="cardHeader">
                                <h2>History Transaksi</h2>
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
                                            'Good!',
                                            '{{ session('Success') }}',
                                            'success'
                                        )
                                    </script>
                                @endif

                                <form action="{{ route('dashboard') }}" method="get" class="search-form">
                                    @csrf
                                    <input type="text" name="search" id="input-cari" autocomplete="off"
                                        placeholder="Cari transaksi..." value="{{ $searchTerm ?? '' }}">
                                </form>

                                <!-- <a href="#" class="btn">View All</a> -->
                            </div>

                            <div id="recentOrders">

                                <div id="search-results">
                                    @if ($history->isEmpty())
                                        <p>Tidak ada hasil pencarian.</p>
                                    @else
                                        <table>
                                            <thead>
                                                <tr>
                                                    <td>No</td>
                                                    <td>No. Rekening</td>
                                                    <td>Bank</td>
                                                    <td>Atas Nama</td>
                                                    <td>Nominal</td>
                                                    <td>Tanggal</td>
                                                    <td>Status</td>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $i = ($history->currentPage() - 1) * $history->perPage() + 1;
                                                @endphp
                                                @foreach ($history as $hsr)
                                                    @php
                                                        $nominal = $hsr->nominal;
                                                        $formattedNominal = 'Rp ' . number_format($nominal, 0, ',', '.');
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $hsr->account_number }}</td>
                                                        <td>{{ $hsr->type_bank }}</td>
                                                        <td>{{ $hsr->name }}</td>
                                                        <td
                                                            class="{{ $hsr->status === 'transfer' ? 'green-text' : 'red-text' }}">
                                                            {{ $formattedNominal }}</td>
                                                        <td>{{ $hsr->date }}</td>
                                                        <td><span
                                                                class="status {{ $hsr->status }}">{{ $hsr->status }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                                <div class="pagination">
                                    <ul>
                                        {{-- Tombol Previous --}}
                                        @if ($history->currentPage() > 1)
                                            <li>
                                                <a href="{{ $history->previousPageUrl() }}" rel="prev">&laquo;
                                                    Previous</a>
                                            </li>
                                        @endif

                                        {{-- Nomor Halaman --}}
                                        @foreach ($history->getUrlRange(1, $history->lastPage()) as $page => $url)
                                            <li class="{{ $page == $history->currentPage() ? 'active' : '' }}">
                                                <a href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        {{-- Tombol Next --}}
                                        @if ($history->hasMorePages())
                                            <li>
                                                <a href="{{ $history->nextPageUrl() }}" rel="next">Next &raquo;</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- ========================= CHATBOT ==================== -->
        <div id="chatbotModal" class="chatbot-modal">
            <div class="chatbot-modal-content">
                <span class="close">&times;</span>
                <h2>Chatbot</h2>
                <i style="color: red">*pesan ini akan hilang jika halaman di refresh</i>
                <div id="chatbox">
                    <div class="headerBot"
                        style="background-color: #337ab7; border-radius: 5px; padding: 8px; color: white">
                        Saya adalah asisten anda, Silakan ketik: <br>1. (Tampilkan Detail Akun) <br>2. (Pengeluaran
                        Terbesar) <br>3. (Pengeluaran Terkecil) <br>4. (Pengeluaran Terbaru)
                    </div>
                </div>
                <input type="text" id="userInput" placeholder="Ketik pesan..." />
            </div>
        </div>

        <!-- ========================= MODAL TRANSFER SESAMA BANK ==================== -->
        <div id="modal-bank" class="modal">
            <!-- Modal content Transfer Bank -->
            <div class="modal-content-trasnfer-bank">
                <span class="close">&times;</span>
                <h2 style="margin-bottom: 20px;">Transfer Bank</h2>
                <form action="/create" method="POST" onsubmit="return validateForm()" id="form-transfer-bank">
                    @csrf
                    <label for="bank">Bank:</label>
                    <select id="bank" name="type_bank" required>
                        <option value="">-- Pilih Bank --</option>
                        <option value="BJB">BJB</option>
                        <option value="BRI">BRI</option>
                        <option value="MANDIRI">Mandiri</option>
                    </select>

                    <div id="warning" style="color:red"></div>

                    <label for="nomor-rekening">Nomor Rekening:</label>
                    <input type="text" id="nomor-rekening" name="account_number" autocomplete="off" disabled>


                    <label for="nama-rekening">Pemilik Rekening:</label>
                    <input type="text" id="nama-rekening" name="name" required readonly>

                    <label for="amount">Nominal:</label>
                    <input type="text" id="amount" name="nominal" required>

                    <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">

                    <button type="button" class="btnTransfer" id="submit-btn" disabled>Transfer</button>

                    <div id="pin-transfer" style="z-index: 2" class="modal modal2">
                        <div class="modal-content-pin">
                            <span class="closebtn">&times;</span>
                            <h2 style="margin-bottom: 20px;">Masukan Pin</h2>
                            <p style="font-family: Arial, Helvetica, sans-serif; margin-bottom: 5px; font-size: 14px;">
                                Konfirmasi bahwa
                                kamu,
                                <b>
                                    {{ Auth::user()->name }}
                                </b>
                            </p>
                            <label for="nomor-rekening">Masukan Password:</label>
                            <input type="password" id="pin-input" name="pin" autocomplete="off" autofocus required>
                            <button class="btnTransfer" type="submit" name="submitPin" id="submit-pin">Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>





        <!-- =========================================================JAVASCRIPT OOP========================================================= -->

        <script>
            var inputCari = document.getElementById('input-cari');
            var searchResults = document.getElementById('search-results');

            inputCari.addEventListener('input', function() {
                var searchTerm = inputCari.value.trim();

                // Hanya mengirim permintaan pencarian jika panjang kata kunci lebih dari 2 karakter
                if (searchTerm.length > 2) {
                    delay(function() {
                        var form = document.querySelector('.search-form');
                        form.submit();
                    }, 500);
                }
            });

            // Fungsi delay untuk menunda pengiriman permintaan
            var delay = (function() {
                var timer = 0;
                return function(callback, ms) {
                    clearTimeout(timer);
                    timer = setTimeout(callback, ms);
                };
            })();
        </script>


        <script>
            var openBtn = document.querySelector(".open-modal");
            var modal = document.getElementById("chatbotModal");
            var chatbox = document.getElementById("chatbox");
            var userInput = document.getElementById("userInput");

            openBtn.addEventListener("click", function() {
                modal.style.display = "block";
            });

            var closeBtn = document.querySelector(".close");
            closeBtn.addEventListener("click", function() {
                modal.style.display = "none";
            });

            window.addEventListener("click", function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            });

            userInput.addEventListener("keydown", function(event) {
                if (event.key === "Enter") {
                    var userMessage = userInput.value;
                    userInput.value = "";


                    var chatbubbleUser = document.createElement("div");
                    chatbubbleUser.className = "chat-bubble userChat";
                    chatbubbleUser.textContent = userMessage;

                    chatbox.appendChild(chatbubbleUser);

                    // Mengirim pesan pengguna ke fungsi getBotResponse()
                    var botResponse = getBotResponse(userMessage);

                    setTimeout(function() {
                        var chatbubbleBot = document.createElement("div");
                        chatbubbleBot.className = "chat-bubble bot";
                        chatbubbleBot.textContent = botResponse;

                        chatbox.appendChild(chatbubbleBot);

                        // Scroll ke bawah setelah menambahkan respons chatbot
                        chatbox.scrollTop = chatbox.scrollHeight;
                    }, 1000);
                }
            });

            userInput.addEventListener("keydown", function(event) {
                var message = event.target.value;
                var maxLength = 42; // Batas jumlah karakter

                if (message.length >= maxLength && event.key !== "Backspace") {
                    event.preventDefault();
                    event.target.value += "\n";
                }
            });

            function getBotResponse(message) {
                var response = "";
                var choose =
                    " Silakan ketik: 1. (Tampilkan Detail Akun)   2. (Pengeluaran Terbesar)   3. (Pengeluaran Terkecil)  4. (Pengeluaran Terbaru)";
                // const maxNominal = "{{ DB::table('history')->where('id_user', Auth::user()->id_user)->max('nominal') }}"
                const maxNominal =
                    "{{ DB::table('history')->where('id_user', Auth::user()->id_user)->where('status', 'sukses')->max('nominal') }}";
                const minNominal =
                    "{{ DB::table('history')->where('id_user', Auth::user()->id_user)->where('status', 'sukses')->min('nominal') }}"
                const latestHistory =
                    "{{ DB::table('history')->where('id_user', Auth::user()->id_user)->orderBy('date', 'asc')->limit(1)->pluck('date')->first() }}"

                if (message.toLowerCase().includes("namamu")) {
                    response =
                        "Nama saya adalah `Chatbot` buatan Muhammad Kemal Pasha pada website ini difungsikan sebagai asisten anda dalam mempermudah pengumpulan data. " +
                        choose;
                } else if (message.toLowerCase().includes("nama kamu")) {
                    response =
                        "Nama saya adalah `Chatbot` buatan Muhammad Kemal Pasha pada website ini difungsikan sebagai asisten anda dalam mempermudah pengumpulan data. " +
                        choose;
                } else if (message.toLowerCase().includes("halo")) {
                    response = "Hai {{ Auth::User()->name }}! " + choose;
                } else if (message.toLowerCase().includes("nama saya")) {
                    response =
                        "Nama kamu adalah {{ Auth::User()->name }}, kamu adalah tuan saya. Saya siap membantu anda 😊 " +
                        choose;
                } else if (message.toLowerCase().includes("hallo")) {
                    response = "Hai {{ Auth::User()->name }}! " + choose;
                } else if (message.toLowerCase().includes("hai")) {
                    response = "Halo {{ Auth::User()->name }}! " + choose;
                } else if (message.toLowerCase().includes("1")) {
                    response =
                        "Detail Akun: Username: {{ Auth::User()->username }}, Alamat: {{ Auth::User()->address }}, No.Rek: {{ Auth::User()->account_number }}, Tipe Kartu: {{ Auth::User()->type_account }}, No.Kartu: {{ Auth::User()->credit_number }} ";
                } else if (message.toLowerCase().includes("2")) {
                    response = "Transaksi terbesar anda adalah: Rp" + maxNominal;
                } else if (message.toLowerCase().includes("3")) {
                    response = "Transaksi terkecil anda adalah: Rp" + minNominal;
                } else if (message.toLowerCase().includes("4")) {
                    response = "Transaksi terakhir anda pada tanggal " + latestHistory;
                } else if (message.toLowerCase().includes("saldo")) {
                    response =
                        "Untuk mengecek saldo Anda, silakan lihat pada halaman dashboard";
                } else if (message.toLowerCase().includes("masalah transfer")) {
                    response =
                        "Mohon maaf atas ketidaknyamanannya, sebagai informasi, jika transfer berstatus `gagal`, saldo tidak akan dikurangi";
                } else if (message.toLowerCase().includes("kabar")) {
                    response =
                        "Saya adalah sistem sebagai asisten anda dalam mempermudah pengumpulan data, tapi terimaskasih atas perhatiannya. " +
                        choose;
                } else if (message.toLowerCase().includes("sejarah bank")) {
                    response =
                        "Bank bjb didirikan sebagai hasil dinasionalisasi perusahaan Belanda, De Erste Nederlansche Indische Shareholding N.V., sebuah bank hipotek di Bandung, berdasarkan Peraturan Pemerintah Republik Indonesia Nomor 33/1960. Tindak lanjutnya, Pemerintah Provinsi Jawa Barat mendirikan PD Bank Karya Pembangunan Daerah Jawa Barat melalui Akta Notaris Noezar dengan Surat Keputusan Gubernur Provinsi Jawa Barat nomor 7/GKDH/BPD/61 tanggal 20 Mei 1961. Modal dasar pertama bank tersebut berasal dari kas daerah sebesar Rp 2.500.000,00. Untuk memperkuat posisi hukumnya, dikeluarkan Peraturan Daerah Provinsi Jawa Barat Nomor 11/PD-DPRD/72 tanggal 27 Juni 1972 yang mengatur status Bank Karya Pembangunan Daerah Jawa Barat sebagai perusahaan daerah di bidang perbankan." +
                        choose;
                } else if (message.toLowerCase().includes("terimakasih")) {
                    response = "Sama-sama!" + choose;
                } else if (message.toLowerCase().includes("terima kasih")) {
                    response = "Sama-sama!" + choose;
                } else {
                    response = "Maaf, saya tidak mengerti. " + choose;
                }

                return response;
            }
        </script>


        <script>
            class TransferBank {
                constructor() {
                    // atribut untuk penggunaan ajax berfungsi untuk penyamaan rekening di database--------------------------------------------------------
                    this._nomorRekeningInput = document.getElementById('nomor-rekening');
                    this._namaRekeningInput = document.getElementById('nama-rekening');
                    this._nomorRekeningInput.addEventListener('input', this.nomorRekening.bind(this));



                    // atribut untuk keamanan Form Transfer Bank--------------------------------------------------------
                    this.choseBank = document.getElementById("bank");
                    this.rekeningNumber = document.getElementById("nomor-rekening");
                    this.warning = document.getElementById("warning");
                    this.submitButton = document.getElementById("submit-btn");
                    // ubaheun
                    this.cek = document.getElementById("form-transfer-bank");
                    this.formModal = document.getElementById("pin-transfer");
                    this.closePin = document.getElementsByClassName("closebtn")[0]

                    this.choseBank.addEventListener("change", () => {
                        this.bankList();
                    });
                    this.rekeningNumber.addEventListener("input", () => {
                        this.minRekening();
                    });
                    this.submitButton.addEventListener("click", () => {
                        this.openFormModal();
                    });
                    this.cek.addEventListener("submit", this.openFormModal.bind(this));
                    this.closePin.addEventListener("click", this.closePinTf.bind(this));



                    // atribut untuk modal form Transfer Bank--------------------------------------------------------
                    this.modal = document.getElementById("modal-bank");
                    this.link = document.getElementById("modal-link");
                    this.closeButton = document.querySelector(`.${"close"}`);
                }
                // ubaheun
                openFormModal(event) {
                    // event.preventDefault();
                    this.formModal.style.display = "block";
                }

                closePinTf() {
                    this.formModal.style.display = "none";
                }



                // fungsi dan encapsulation untuk ajax--------------------------------------------------------
                get nomorRekeningInput() {
                    return this._nomorRekeningInput;
                }
                set nomorRekeningInput(value) {
                    this._nomorRekeningInput = value;
                }
                get namaRekeningInput() {
                    return this._namaRekeningInput;
                }
                set namaRekeningInput(value) {
                    this._namaRekeningInput = value;
                }

                nomorRekening() {
                    const nomorRekening = this.nomorRekeningInput.value;
                    const xhr = new XMLHttpRequest();
                    const token = document.querySelector('[name=_token]').value;
                    xhr.open('POST', `/ajaxtf`);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = () => {
                        if (xhr.status === 200) {
                            const data = JSON.parse(xhr.responseText);
                            const namaRekening = data.name !== undefined ? data.name : "";
                            this.namaRekeningInput.value = namaRekening;
                        } else {
                            console.error('Gagal memuat data');
                        }
                    };
                    xhr.send(`account_number=${nomorRekening}&_token=${token}`);

                    this.namaRekeningInput.value = ""; // Mengosongkan nilai input nama pemilik rekening
                }




                // fungsi list dan algoritma keamanan form transfer bank--------------------------------------------------------
                bankList() {
                    const listBankCodeMap = {
                        BJB: "098",
                        BRI: "099",
                        MANDIRI: "000",
                    };
                    const bank = this.choseBank.value;
                    const bankCode = listBankCodeMap[bank];
                    if (bankCode) {
                        this.rekeningNumber.value = bankCode;
                        this.rekeningNumber.disabled = false;
                        this.warning.innerHTML = "";
                    } else {
                        this.rekeningNumber.value = "";
                        this.rekeningNumber.disabled = true;
                        this.warning.innerHTML = "Mohon pilih Bank untuk melanjutkan";
                    }

                    this.namaRekeningInput.value =
                        ""; // Mengosongkan nilai input nama pemilik rekening saat memilih bank lain
                }


                minRekening() {
                    const minLength = 6;
                    const rekeningNumber = this.rekeningNumber.value;
                    const bank = this.choseBank.value;
                    const listBankCodeMap = {
                        BJB: "098",
                        BRI: "099",
                        MANDIRI: "000",
                    };
                    const bankCode = listBankCodeMap[bank];
                    if (rekeningNumber.length < minLength) {
                        this.warning.innerHTML = `Nomor rekening minimal ${minLength} digit`;
                        this.submitButton.disabled = true;
                    } else if (rekeningNumber.substr(0, 3) !== bankCode) {
                        this.rekeningNumber.value = bankCode + rekeningNumber.substr(3);
                    } else {
                        this.warning.innerHTML = "";
                        this.submitButton.disabled = false;
                    }
                }



                // kebutuhan fungsi untuk modal form transfer bank--------------------------------------------------------
                openModal() {
                    this.modal.style.display = "block";
                }
                closeModal() {
                    this.modal.style.display = "none";
                }
                init() {
                    this.link.addEventListener("click", this.openModal.bind(this));
                    this.closeButton.addEventListener("click", this.closeModal.bind(this));
                    window.addEventListener("click", (event) => {
                        if (event.target === this.modal) {
                            this.closeModal();
                        }
                    });
                }
            } // end class TransferBank

            // pemanggilan objek TransferBank modal form Transfer Bank --------------------------------------------------------
            const transferbank = new TransferBank();
            transferbank.init();
        </script>



        <!-- cek nama rekening kosong -->
        <script>
            function validateForm() {
                const nameInput = document.getElementById("nama-rekening");
                if (nameInput.value == "") {
                    alert("Pemilik rekening tidak ditemukan");
                    return false;
                }
                return true;
            }
        </script>

        <!-- =========== JS =========  -->
        <script src="js/hamburger.js"></script>
        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

        <!-- ====== sweetalert ======= -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    </body>

    </html>
@else
    <h1>Untuk akses dashboard, silahkan login terlebih dahulu</h1>
    <form action="/logout" method="post">
        @csrf
        <button type="submit">Login</button>
    </form>
@endauth
