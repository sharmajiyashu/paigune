<?php

namespace App\Http\Controllers;

use App\Models\Airpot;
use Illuminate\Http\Request;

class AirpotCsvController extends Controller
{
    public function export()
    {
        $fileName = 'airpots.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [
            'id',
            'name',
            'city_code',
            'code',
            'status',
            'airport_code',
            'alternate_ident',
            'code_icao',
            'code_iata',
            'code_lid',
            'type',
            'elevation',
            'city',
            'state',
            'longitude',
            'latitude',
            'timezone',
            'country_code',
            'wiki_url',
            'airport_flights_url',
            'alternatives',
            'created_at',
            'updated_at'
        ];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            Airpot::chunk(100, function ($airpots) use ($file, $columns) {
                foreach ($airpots as $airpot) {
                    $row = [];
                    foreach ($columns as $column) {
                        $row[] = $airpot->$column;
                    }
                    fputcsv($file, $row);
                }
            });

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), "r");

        $header = fgetcsv($handle); // Get header row

        while (($row = fgetcsv($handle, 10000, ",")) !== FALSE) {

            $data = array_combine($header, $row);

            // print_r($data);die;

            Airpot::updateOrCreate(
                ['code' => $data['code']], // unique key
                [
                    'name' => $data['name'] ?? null,
                    'city_code' => $data['city_code'] ?? null,
                    'status' => $data['status'] ?? 1,
                    'airport_code' => $data['airport_code'] ?? null,
                    'alternatives' => !empty($data['alternatives'])
                        ? json_decode($data['alternatives'], true) ?? []
                        : [],
                    'code_icao' => $data['code_icao'] ?? null,
                    'code_iata' => $data['code_iata'] ?? null,
                    'code_lid' => $data['code_lid'] ?? null,
                    'type' => $data['type'] ?? null,
                    'elevation' => $data['elevation'] ?? null,
                    'city' => $data['city'] ?? null,
                    'state' => $data['state'] ?? null,
                    'longitude' => $data['longitude'] ?? null,
                    'latitude' => $data['latitude'] ?? null,
                    'timezone' => $data['timezone'] ?? null,
                    'country_code' => $data['country_code'] ?? null,
                    'wiki_url' => $data['wiki_url'] ?? null,
                    'airport_flights_url' => $data['airport_flights_url'] ?? null,
                    'alternatives' => $data['alternatives'] ?? null,
                ]
            );
        }

        fclose($handle);

        return back()->with('success', 'CSV Imported Successfully');
    }
}
