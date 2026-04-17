<?php

namespace App\Services;

use App\Models\Notifications;
use GuzzleHttp\Client;
use Kreait\Firebase\Messaging\CloudMessage;


class customBlock
{
    public static function getSDKData($endPoint, $method, $locales = 'en')
    {
        $array = [];

        try {
            $clientID = env('COGNIFIT_API_KEY');

            $baseURL = env('API_BASE_URL').'/'.$endPoint.'?client_id='.$clientID;

            $new = new Client;

            $response = $new->request($method, $baseURL);

            $responseBody = json_decode($response->getBody()->getContents());

            $array = collect($responseBody);

            return $array;
        } catch (\Throwable $th) {
            return collect($array);
        }
    }

    public static function getFireBaseData($path, $database)
    {

        $array = [];

        try {
            $list = $database->getReference($path)->getValue();

            $array = collect($list);
        } catch (\Throwable $th) {
            $array = collect([]);
        }

        return $array;
    }

    public static function pushFireBaseData($path, $database, $value)
    {
        $database->getReference($path)->push($value);
    }

    public static function storeFireBaseData($path, $database, $value)
    {
        $database->getReference($path)->set($value);
    }

    public static function updateFireBaseData($path, $database, $value)
    {
        $database->getReference($path)->update($value);
    }

    public static function getSpecificData($path, $database)
    {
        $item = null;

        try {
            $list = $database->getReference($path)->getValue();

            $item = $list;
        } catch (\Throwable $th) {
            $item = null;
        }

        return $item;
    }

    public static function printData($data, $element)
    {

        $printData = '-';

        // Check if the element exists and is not empty
        if (isset($data[$element]) && ! empty($data[$element])) {

            $printData = $data[$element];

            return $printData;
        }

        // Return '-' if the element doesn't exist or is empty
        return $printData;
    }

    public static function getBrainGamesData($endPoint, $method)
    {
        $array = [];

        try {
            $clientID = env('COGNIFIT_API_KEY');
            $baseURL = env('API_BASE_URL').'/'.$endPoint.'?client_id='.$clientID.'&locales[]=en&locales[]=es';

            $client = new Client;
            $response = $client->request($method, $baseURL);

            $responseBody = json_decode($response->getBody()->getContents());

            $array = collect($responseBody);

            return $array;
        } catch (\Throwable $th) {
            return collect($array);
        }
    }

    public static function processStringNames(string $string)
    {
        $string = str_replace('_', ' ', $string);

        return $string;
    }

    public static function deleteFirebaseData($path, $database)
    {
        try {
            $database->getReference($path)->remove();
        } catch (\Throwable $th) {
            throw new \Exception('Failed to delete data: '.$th->getMessage());
        }
    }

    public static function generateNotificaions($userID, $title, $description)
    {
        try {
    
            $messaging = app('firebase.messaging');
    
            $message = CloudMessage::fromArray([
                'notification' => [
                    'title' => $title,
                    'body' => $description,
                ],
                'topic' => ('00'.$userID) ?? 'problem',
            ]);
    
            $messaging->send($message);
    
        } catch (\Throwable $e) {
    
            throw new \Exception('Failed to send notification: '.$e->getMessage());
        }
    
        // Save DB notification
        $new = new Notifications();
        $new->user_id = $userID;
        $new->title = $title;
        $new->description = $description;
        $new->is_read = 0;
        $new->save();
    }
    public static function deleteRecord($path, $database)
    {
        $database->getReference($path)->remove();
    }
}
