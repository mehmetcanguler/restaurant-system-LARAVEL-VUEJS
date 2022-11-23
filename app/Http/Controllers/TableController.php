<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableRequest;
use App\Models\Table;
use App\Models\TableLocation;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['heads'] = [
            "Masa Lokasyon",
            'Masa NO',
            'Oluşturulma Tarihi',
        ];

        $data['tables'] = Table::with('table_location')->get();
        return view('admin.table.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['table_locations'] = TableLocation::get();
        return view('admin.table.create', $data);
    }
    public function tableLocation(Request $request)
    {
        $table_location = TableLocation::create([
            'title' => $request->title
        ]);
        return response()->json($table_location);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TableRequest $request)
    {
        $table_location = TableLocation::find($request->table_location_id);
        for ($i = $table_location->table->count() + 1; $i <= $request->qty + $table_location->table->count(); $i++) {
            Table::create([
                'table_location_id' => $table_location->id,
                'table_no' => $i
            ]);
        }
        return redirect()->route('admin.table.index')->withStatus('Başarıyla Masalar Oluşturuldu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
    public function deleteTableShow()
    {
        $data['heads'] = [
            "Masa Lokasyon",
            'Masa Adeti',
            ['label' => 'Sil', 'no-export' => true, 'width' => 5],
        ];
        $data['table_locations'] = TableLocation::get();
        return view('admin.table.delete', $data);
    }
    public function deleteTable($id)
    {
        $table_location = TableLocation::with('table.order')->find($id);
        foreach ($table_location->table as $table)
        {
          
            foreach($table->order as $order)
            {
                $order->table_id = null;
                $order->save();
            }
            $table->delete();
        }
        $table_location->delete();
        return redirect()->route('admin.table.index')->withStatus('Başarıyla Masalar Silindi');



    }
}
