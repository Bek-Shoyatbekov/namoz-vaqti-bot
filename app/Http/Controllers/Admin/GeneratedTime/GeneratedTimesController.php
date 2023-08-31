<?php

namespace App\Http\Controllers\Admin\GeneratedTime;

use App\Models\City;
use App\Models\Maintime;
use Illuminate\Http\Request;
use App\Models\GeneratedTime;
use App\Http\Controllers\Controller;
use App\Http\Services\TimeDifferenceCalculator;
use DateTime;

class GeneratedTimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate(City $city, Request $request)
    {
        $times = explode("\r\n", $request->data);

        $formatted = [];

        // dd($times[0]);
        
        foreach($times as $time){
            $exploded = explode("\t", $time);
            $formatted[] = [
                "date" => DateTime::createFromFormat("m/d/Y", $exploded[0])->format("Y-m-d"),
                "tong" => $exploded[1],
                "quyosh" => $exploded[2],
                "peshin" => $exploded[3],
                "asr" => $exploded[4],
                "shom" => $exploded[5],
                "hufton" => $exploded[6],
            ];
        }
        $betweenDates = [ 
            $formatted[0]["date"],  // mindate given
            "2100-12-31"
        ];
        $maintimes = Maintime::whereBetween("greg_date", $betweenDates)->get();
        
        $i = 0;
        foreach($maintimes as $m) {
            if($m->greg_date >= $formatted[$i > count($formatted) - 1 ? --$i : $i ]["date"]) $i++;
            $calculated[] = [
                "greg_date" => $m->greg_date, 
                "qamar_date" => $m->qamar_date, 
                "from" => $formatted[$i - 1 > 0 ? $i - 1 : 0]["date"],
                "tong" => TimeDifferenceCalculator::calculate($m->tong, $formatted[$i - 1]["tong"]),
                "quyosh" => TimeDifferenceCalculator::calculate($m->quyosh, $formatted[$i - 1]["quyosh"]),
                "peshin" => TimeDifferenceCalculator::calculate($m->peshin, $formatted[$i - 1]["peshin"]),
                "asr" => TimeDifferenceCalculator::calculate($m->asr, $formatted[$i - 1]["asr"]),
                "shom" => TimeDifferenceCalculator::calculate($m->shom, $formatted[$i - 1]["shom"]),
                "hufton" => TimeDifferenceCalculator::calculate($m->hufton, $formatted[$i - 1]["hufton"]),
            ];
        }
        return view("admin.generated_time.generate", compact('city', 'calculated') );
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\City
     * @return \Illuminate\Http\Response
     */
    public function create(City $city)
    {
        return view('admin.generated_time.create', compact('city'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(City $city, Request $request)
    {
        $created = 0;
        $updated = 0;
        $validated = $request->validate([
            "greg_date" => "required",
            "qamar_date" => "required",
            "tong" => "required",
            "quyosh" => "required",
            "peshin" => "required",
            "asr" => "required",
            "shom" => "required",
            "hufton" => "required"
        ]);

    
        for($i = 0; $i < count($validated["greg_date"]); $i++){
            $time = GeneratedTime::firstOrNew(["gregorian_date" => $validated["greg_date"][$i], "city_id" => $city->id]);
         
            $time->qamar_date = $validated["qamar_date"][$i];
            $time->tong = $validated["tong"][$i];
            $time->quyosh = $validated["quyosh"][$i];
            $time->peshin = $validated["peshin"][$i];
            $time->asr = $validated["asr"][$i];
            $time->shom = $validated["shom"][$i];
            $time->hufton = $validated["hufton"][$i];

            $time->id === null ? $created++ : $updated++;
            $time->save();
        }

        return redirect()->route("admin.shahars.show", $city)->with("success_message", "Добавлено: $created. Обновлено: $updated");       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GeneratedTime  $generatedTime
     * @return \Illuminate\Http\Response
     */
    public function show(GeneratedTime $generatedTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GeneratedTime  $generatedTime
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city, GeneratedTime $generatedTime)
    {
        return view("admin.generated_time.edit", ["city" => $city, "time" => $generatedTime]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GeneratedTime  $generatedTime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city, GeneratedTime $generatedTime)
    {
        $validated = $request->validate([
            "qamar_date" => "required",
            "tong" => "required",
            "quyosh" => "required",
            "peshin" => "required",
            "asr" => "required",
            "shom" => "required",
            "hufton" => "required"
        ]);
        if($generatedTime->update([
            "qamar_date" => $validated["qamar_date"],
            "tong" => $validated["tong"],
            "quyosh" => $validated["quyosh"],
            "peshin" => $validated["peshin"],
            "asr" => $validated["asr"],
            "shom" => $validated["shom"],
            "hufton" => $validated["hufton"],
        ])){
            return redirect()->route("admin.shahars.show", $city)->with("success_message", "Время на " . $generatedTime->gregorian_date . " изменено");
        };
        return redirect()->back()->with("danger_message", "Не удалось изменить время");

    }

}