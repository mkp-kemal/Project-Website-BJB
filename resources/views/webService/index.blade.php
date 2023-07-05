<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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

    .button-blokir{
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

    .button-blokir:hover{
        background-color: rgb(171, 0, 23);
    }

    .button:hover {
        color: white;
        background-color: rgb(0, 4, 133);
    }

    .search-form{
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

    .table .a{
        text-decoration: none;
    }

    .hijau{
        background: green;
    }
</style>

<body class="bg-secondary">
    <h5 style="margin: 20px 0 0 20px;">Today : <?= date('D, M Y'); ?> <span id="time"></span></h5>

    <form action="" method="post" class="search-form ">
        <input type="text" name="keyword" id="input-field" autofocus autocomplete="off" placeholder="Search data in table Users...">
    </form>

    <div class="mx-auto">
        <table border="3" cellspacing="0" cellpadding="10" class="table table-sm table-hover table-dark">
            <tr class="bg-primary" >
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                {{-- <th scope="col">Password</th> --}}
                <th scope="col">Address</th>
                <th scope="col">Contact</th>
                <th scope="col">Credit Number</th>
                <th scope="col">Account Number</th>
                <th scope="col">Type Account</th>
                <th scope="col">Action</th>
            </tr>

            <?php $i=1 ?>
            @foreach ($user as $us )
            <tr align="center">
                <th scope="row">
                    <?= $i++ ?>
                </th>
                <td>
                    {{ $us->name }}
                </td>
                <td>
                    {{ $us->username }}
                </td>
                <td>
                    {{ $us->email }}
                </td>
                {{-- <td>
                    {{ $us->password }}
                </td> --}}
                <td>
                    {{ $us->address }}
                </td>
                <td>
                    {{ $us->contact }}
                </td>
                <td>
                    {{ $us->credit_number }}
                </td>
                <td>
                    {{ $us->account_number }}
                </td>
                <td>
                    {{ $us->type_account }}
                </td>
                <td>
                    <button class="button" type="button" onclick="document.location.href='/service/updatedata/{{ $us->id_user }}' ">Update</button>
                    <button class="button-blokir" type="button" onclick="return confirm('Yakin ingin blokir {{ $us->name }}, ID: {{ $us->id_user }} ?')">Blokir</button>

                </td>
            </tr>
            @endforeach

        </table>
    </div>

    <button class="button hijau" type="button">Add Client</button>
    <button class="button" type="button" onclick="document.location.href='/service/balance'">Table Balance</button>
    <button class="button" type="button" onclick="document.location.href='/service/history'">Table History</button>


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
