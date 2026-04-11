<?php

namespace Database\Seeders;

use App\Models\Management;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {

        $baseURL = 'https://mobile-phone-specs-database.p.rapidapi.com/gsm/';
        $endPoint = 'all-brands';

        $getBrand = $baseURL.$endPoint;

        $new = new Client;

        $response = $new->request('GET', $getBrand, [
            'headers' => [
                'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
                'X-RapidAPI-Host' => env('RAPIDAPI_HOST'),
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        foreach ($data as $item) {
            $newBrand = new Management;
            $newBrand->role = 'Brand';
            $newBrand->name = $item['brandValue'];
            $newBrand->save();

            $brandID = $newBrand->id;

            $endPoint = $baseURL.'get-models-by-brandname/'.$item['brandValue'];

            $response = $new->request('GET', $endPoint, [
                'headers' => [
                    'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
                    'X-RapidAPI-Host' => env('RAPIDAPI_HOST'),
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            foreach ($data as $item) {
                $newModel = new Management;
                $newModel->parent_id = $brandID;
                $newModel->role = 'Model';
                $newModel->name = $item['modelValue'];
                $newModel->save();
            }
        }
    }
}
