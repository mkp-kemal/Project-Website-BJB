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

    .radio-row {
    display: none;
    color: black
  }

  .radio-row.show {
    display: table-row;
  }

  .radio-container {
    padding: 10px;
    background-color: #f5f5f5;
    text-align: right;
  }

  .radio-container label {
    margin-right: 10px;
  }

  .radio-container button {
    padding: 5px 10px;
    background-color: #4caf50;
    color: #fff;
    border: none;
    cursor: pointer;
  }

  .green-text {
  color: green;
}

.red-text {
  color: red;
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
                <th scope="col">Name</th>
                <th scope="col">Account Number</th>
                <th scope="col">Type Account</th>
                <th scope="col">Nominal</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>

            <?php $i = 1; ?>
            @foreach ($history as $hs)
                <tr align="center">
                    <th scope="row">
                        <?= $i++ ?>
                    </th>
                    <td>
                        {{ $hs->id_user }}
                    </td>
                    <td>
                        {{ $hs->name }}
                    </td>
                    <td>
                        {{ $hs->account_number }}
                    </td>
                    <td>
                        {{ $hs->type_bank }}
                    </td>
                    <td class="{{ $hs->status === 'transfer' ? 'green-text' : 'red-text' }}">
                        {{ $hs->nominal }}
                    </td>
                    <td>
                        {{ $hs->date }}
                    </td>
                    <td>
                        {{ $hs->status }}
                    </td>
                    <td>
                        <button class="button"  type="button" onclick="showRadio({{ $hs->id_history }})">Update</button>

                    </td>
                </tr>
                <tr id="radioRow_{{ $hs->id_history }}" class="radio-row">
                    <td colspan="8" class="radio-container bg-dark">
                      <form action="{{ route('updateHistory', $hs->id_history) }}" method="POST">
                        @csrf
                        {{-- <input type="hidden" name="id_history" value="{{ $hs->id_history }}"> --}}
                        <label>
                          <input type="radio" name="status" value="sukses"> Sukses
                        </label>
                        <label>
                          <input type="radio" name="status" value="gagal"> Gagal
                        </label>
                        <button type="submit">Save</button>
                      </form>
                    </td>
                  </tr>

            @endforeach

        </table>
    </div>

    <button class="button" type="button" onclick="document.location.href='/service/balance'">Table Balance</button>
    <button class="button" type="button" onclick="document.location.href='/service'">Table User</button>


</body>

<script>
    function showRadio(id) {
      const row = document.getElementById('radioRow_' + id);
      row.classList.toggle('radio-row');
    }
  </script>

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
