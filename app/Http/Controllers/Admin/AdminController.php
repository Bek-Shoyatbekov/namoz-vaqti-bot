<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Region;
use App\Models\Maintime;
use Illuminate\Http\Request;
use App\Models\GeneratedTime;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function index(){
        $regions = Region::all();
        $cities = City::all();
        $maintimes = Maintime::all();
        return view('admin.index', compact('regions', 'cities', 'maintimes'));
    }

    public function viewForServer(){
        $cities = City::all();
        return view("admin.server", compact('cities'));
    }

    public function generatedForServer(Request $request){
        $city = City::findOrFail($request->city_id);
        $query_string = ["INSERT INTO namozvaqti (region_id, message, date)", "VALUES"];
        $times = $city->generated_times()->whereBetween("gregorian_date", [$request->date_started, $request->date_end])->get();
        foreach($times as $t) {
            $query_string[] = $this->generateMessage($request, $t, $city);
        }
        $query_string[count($query_string) - 1] = rtrim($query_string[count($query_string) - 1], ", ") . ";";
        return view("admin.server", ["cities" => City::all(), "result" => implode("<br />", $query_string)]);            
    }


    private function generateMessage(Request $request, GeneratedTime $time, City $city) {
        $date = $time->gregorian_date->format('Y-m-d');
        $remote_db_id = $request->in_remote_server_id;
        $message = "$date ga namoz vaqti(".$city->getTranslation("title", "uz").") Bomdod $time->tong Quyosh $time->quyosh Peshin $time->peshin Asr $time->asr Shom $time->shom Xufton $time->hufton";
        $message =  str_replace("'", "''", $message);
        return "($remote_db_id, '$message', '$date'),";
    }
    
}
