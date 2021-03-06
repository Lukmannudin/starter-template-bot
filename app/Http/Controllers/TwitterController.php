<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twitter;

class TwitterController extends Controller
{
    public function getTwitterTimeline() {
      try
      {
      	$rumahcemara = Twitter::getUserTimeline(['screen_name' => 'rumahcemara', 'count' => 5, 'format' => 'array']);
        $graha = Twitter::getUserTimeline(['screen_name' => 'grahapitamerah', 'count' => 5, 'format' => 'array']);

        $arrayMerge = array_merge($rumahcemara,$graha);
        $result=[];

        foreach ($arrayMerge as $value) {
          array_push($result,[
            'created_at' => $value['created_at'],
            'text' => substr($value['text'],0,59),
            'user' => $value['user']['screen_name'],
            'foto' => $value['user']['profile_image_url_https'],
            'bg_color' => $value['user']['profile_background_color']
          ]);
        }
      }
      catch (Exception $e)
      {
      	// dd(Twitter::error());
      	dd(Twitter::logs());
      }

      return $result;
    }

    public function getTweet() {
      $data = Twitter::getOembed('735727067937918978');

      return response()->json($data);
    }
}
