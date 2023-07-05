<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Web Service Bjb</title>
</head>

<style>
    .button {
        border-radius: 20px;
        display: inline-block;
        border: none;
        color: white;
        background-color: rgb(0, 8, 255);
        padding: 5px 15px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
        transition: all 0.8s;
    }

    .button-blokir {
        background-color: rgb(255, 0, 34);
        border-radius: 20px;
        display: inline-block;
        border: none;
        color: white;
        padding: 5px 15px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
        transition: all 0.8s;
    }

    .button-blokir:hover {
        background-color: rgb(171, 0, 23);
    }

    .button:hover {
        color: white;
        background-color: rgb(0, 4, 133);
    }

    .search-form {
        flex-direction: row;
        margin-bottom: 20px;
    }

    .search-form input {
        width: 30%;
        height: 10px;
        padding: 12px 20px;
        box-sizing: border-box;
        margin: 20px 0 0 20px;
        border: 2px solid #ccc;
        border-radius: 4px;
    }

    .table .a {
        text-decoration: none;
    }

    .hijau {
        background: green;
    }
</style>

<body class="bg-secondary">
    <h5 style="margin: 20px 0 0 20px;">Today : <?= date('D, M Y') ?> <span id="time"></span></h5>

    <form action="" method="post" class="search-form ">
        <input type="text" name="keyword" id="input-field" autofocus autocomplete="off"
            placeholder="Search data in table History...">
    </form>

    <div class="mx-auto">
        <table border="3" cellspacing="0" cellpadding="10" class="table table-sm table-hover table-dark">
            <tr class="bg-primary">
                <th scope="col">ID</th>
                <th scope="col">ID User</th>
                <th scope="col">Balance</th>
                <th scope="col">In</th>
                <th scope="col">Out</th>
                <th scope="col">Action</th>
            </tr>

            <?php $i = 1; ?>
            @foreach ($balance as $bl)
                <?php
                    $amount = $bl->balance;
                    $formattedBalance = 'Rp ' . number_format($amount, 0, ',', '.');

                    $in = $bl->in;
                    $formattedIn = 'Rp ' . number_format($in, 0, ',', '.');

                    $out = $bl->out;
                    $formattedOut = 'Rp ' . number_format($out, 0, ',', '.');
                ?>
                <tr align="center">
                    <th scope="row">
                        <?= $i++ ?>
                    </th>
                    <td>
                        {{ $bl->id_user }}
                    </td>
                    <td>
                        {{ $formattedBalance }}
                    </td>
                    <td>
                        {{ $formattedIn }}
                    </td>
                    <td>
                        {{ $formattedOut }}
                    </td>
                    <td>
                        <button class="button" type="button"
                            onclick="document.location.href='/service/updatebalance/{{ $bl->id_balance }}' ">Update</button>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>

    <button class="button" type="button" onclick="document.location.href='/service/history'">Table History</button>
    <button class="button" type="button" onclick="document.location.href='/service'">Table User</button>


</body>

<!-- jam dan tanggal -->
<script>
    function updateTime() {
        var time = new Date();
        var hours = time.getHours();
        var minutes = time.getMinutes();
        var seconds = time.getSeconds();
        document.getElementById("time").innerHTML = hours + ":" + minutes + ":" + seconds;
    }

    setInterval(updateTime, 1000);
</script>

<script>
    function checkInput() {
        var input = document.getElementById('input-field').value;
        if (input == "") {
            alert("Input cari tidak boleh kosong!");
            return false;
        }
    }
</script>

</html>
