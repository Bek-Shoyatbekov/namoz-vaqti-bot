<?php

namespace App\Http\Controllers\Admin\Maintime;

use App\Models\Maintime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Maintime\MaintimeCreateManyRequest;
use App\Http\Requests\Maintime\MaintimeUpdateOneRequest;

class MaintimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintimes = Maintime::orderByDesc('greg_date')->paginate(31);
        return view('admin.maintime.index', compact('maintimes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.maintime.create');
    }


    /**
     * Show proccessed time from create view
     *
     * @param  \App\Http\Requests\Maintime\MaintimeCreateManyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function generate(MaintimeCreateManyRequest $request) {
                
        $times = explode("\r\n", $request->validated()["data"]);
        
        foreach ($times as $time){
            $exploded = explode("\t", $time);
            $formatted[] = [
                "greg_date" => date('d-m-Y', strtotime($exploded[3])),
                "qamar_date" => date('d-m-Y', strtotime($exploded[2])),
                "tong" => $exploded[5],
                "quyosh" => $exploded[6],
                "peshin" => $exploded[7],
                "asr" => $exploded[8],
                "shom" => $exploded[9],
                "hufton" => $exploded[10],                
            ];

        }

        return view('admin.maintime.generate', compact('formatted'))->with("success_message", "Количество введенных строк: " . count($formatted));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            $maintime = Maintime::firstOrNew(
                ["greg_date" => date_create_from_format('d-m-Y', $validated["greg_date"][$i])],
                [
                    "qamar_date" => date_create_from_format('d-m-Y', $validated["qamar_date"][$i]), 
                    "tong" => $validated["tong"][$i], 
                    "quyosh" => $validated["quyosh"][$i], 
                    "peshin" => $validated["peshin"][$i], 
                    "asr" => $validated["asr"][$i], 
                    "shom" => $validated["shom"][$i], 
                    "hufton" => $validated["hufton"][$i]
                ]
            );
            $maintime->id === null ? $created++ : $updated++;
            $maintime->save();
        }

        return redirect()->route("admin.maintimes.index")->with("success_message", "Добавлено: $created. Обновлено: $updated");       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maintime  $maintime
     * @return \Illuminate\Http\Response
     */
    public function edit(Maintime $maintime)
    {
        return view('admin.maintime.edit', compact('maintime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Maintime\MaintimeUpdateOneRequest  $request
     * @param  \App\Models\Maintime  $maintime
     * @return \Illuminate\Http\Response
     */
    public function update(MaintimeUpdateOneRequest $request, Maintime $maintime)
    {
        if(!$maintime->update($request->validated()))
            return redirect()->back()->with("danger_message", "Не удалось обновить время");

        return redirect()->route('admin.maintimes.index')->with("success_message", "Время на $maintime->greg_date обновлено");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maintime  $maintime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maintime $maintime)
    {
        if(!$maintime->delete())
            return redirect()->back()->with("danger_message", "Не удалось удалить время: $maintime->greg_date");

        return redirect()->route('admin.maintimes.index')->with("success_message", "Время на $maintime->greg_date удалено");
    }
}
