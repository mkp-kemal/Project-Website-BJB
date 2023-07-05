<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;

class WebServiceController extends Controller
{
    //TABLE USER
    public function index(){
        $user = User::all();
        $data = [];
        $data["user"] = $user;

        return view('webService.index', $data);
    }


    public function updateData($id_user){
        $data = User::find($id_user);

        dd($data);

    }

    //TABLE HISTORY=============================================================================================
    public function history(){
        $history = History::all();
        $data = [];
        $data["history"] = $history;

        return view('webService.history', $data);
    }

    public function updateHistory(Request $request, $id_history){
        $data = History::find($id_history);
        // $data_status = $data->status;
        $data->status = $request->input('status');
        $data->save();
        // dd($data_status);
        $this->updateStatus($data, $data->status);

        return redirect()->route('history')->with('Success', 'Data berhasil diubah');
    }

    public function updateStatus (History $created_history_destination, $status_trf){

        // $created_history_destination->status = $status_trf;
        // $created_history_destination->save();

        if ($created_history_destination->status == 'sukses') {
            $get_user_destination   = User::where("account_number",$created_history_destination->account_number)->first();

            $get_balance_destination = Balance::where("id_user", $get_user_destination->id_user)->first();
            $get_balance_destination->Balance = $get_balance_destination->balance + $created_history_destination->nominal;
            $get_balance_destination->in = $get_balance_destination->in + $created_history_destination->nominal;
            $get_balance_destination->save();

            $data_history_destination = [
                "id_user" => $get_user_destination->id_user,
                "type_bank" => $created_history_destination->type_bank,
                "account_number" => $created_history_destination->account_number,
                "name" => $created_history_destination->name,
                "nominal" => $created_history_destination->nominal,
                "date" => $created_history_destination->date,
                "status" => 'transfer',
            ]; // create history rekening tujuan

            History::create($data_history_destination);
        }else{
            $get_user_destination   = User::where("id_user", $created_history_destination->id_user)->first();

            $get_balance_destination = Balance::where("id_user", $get_user_destination->id_user)->first();
            $get_balance_destination->Balance = $get_balance_destination->balance + $created_history_destination->nominal;
            $get_balance_destination->out = $get_balance_destination->out - $created_history_destination->nominal;
            $get_balance_destination->save();

        }
    }

    //TABLE BALANCE=============================================================================================
    public function balance(){
        $balance = Balance::all();
        $data = [];
        $data["balance"] = $balance;

        return view('webService.balance', $data);
    }

    public function updateBalance($id_balance){
        $data = Balance::find($id_balance);

        dd($data);
    }
}
