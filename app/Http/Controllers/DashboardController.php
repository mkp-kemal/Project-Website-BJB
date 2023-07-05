<?php

namespace App\Http\Controllers;
use App\Models\Balance;
use App\Models\User;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = History::where('id_user', Auth::user()->id_user);

        // Filter berdasarkan kata kunci pencarian
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('account_number', 'LIKE', "%$searchTerm%")
                    ->orWhere('type_bank', 'LIKE', "%$searchTerm%")
                    ->orWhere('name', 'LIKE', "%$searchTerm%")
                    ->orWhere('nominal', 'LIKE', "%$searchTerm%")
                    ->orWhere('date', 'LIKE', "%$searchTerm%")
                    ->orWhere('status', 'LIKE', "%$searchTerm%");
            });
        }

        $history = $query->paginate(10);
        $balance = Balance::where('Users.id_user', Auth::user()->id_user)
            ->join('Users', function (JoinClause $join) {
                $join->on('Users.id_user', '=', 'balance.id_user');
            })->get();

        $data = [
            'history' => $history,
            'balance' => $balance,
            'searchTerm' => $request->input('search')
        ];

        return view('dashboard.index', $data);
    }


    public function sameBankTransfers(Request $request)
    {
        $id_user = Auth::user()->id_user;
        $get_user = User::where("id_user", $id_user)->first();

        // cek pin
        if (!password_verify($request->pin, $get_user->password)) {
            return redirect()->route('dashboard')->with('Failed', 'Transfer gagal, pin salah!');
        }

        // cek saldo tidak boleh kurang dari nominal
        $get_balance = Balance::where("id_user", $id_user)->first();
        if ($get_balance->balance <= $request->nominal) {
            return redirect()->route('dashboard')->with('Failed', 'Transfer gagal, saldo kurang!');
        }

        // cek transfer dimana nomor rekening tidak boleh mentransfer ke dirinya sendiri
        if ($get_user->account_number == $request->account_number) {
            return redirect()->route('dashboard')->with('Failed', 'Transfer gagal, rekening tidak valid!');
        }


        //Aritmatika saldo dan pengeluaran
        $get_balance->balance = $get_balance->balance - $request->nominal;
        $get_balance->out = $get_balance->out + $request->nominal;
        $get_balance->save();

        // create history transfer
        $data_history = [
            "id_user" => $id_user,
            "type_bank" => $request->type_bank,
            "account_number" => $request->account_number,
            "name" => $request->name,
            "nominal" => $request->nominal,
            "date" => $request->date,
            "status" => 'pending',
        ];

        // $created_history_destination  = History::create($data_history);
        // dd($created_history_destination);

        // $this->updateStatus($created_history_destination, "sukses");

        return redirect()->route('dashboard')->with('Success', 'Transfer Berhasil dilakukan');
    }

    //penyamaan nama rekening pada fitur transfer bank
    public function ajaxTransfer(Request $request)
    {
        $account_number = $request->input("account_number");
        $get_user = User::where("account_number", $account_number)->first();
        return response()->json($get_user);
    }
}
