<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\messages;
use App\Models\favorites;
use App\Models\blocks;
use App\Models\added_pics;


class ActionController extends Controller
{
   // send message function
    function sendmessage(Request $request, $sender_id,$receiver_id){
    $sender = User::find($sender_id);
    $receiver= User::find($receiver_id);
    if (!$sender||!$receiver ){
        return response()->json(['message' => 'Invalid sender or receiver ID']);
    }
    $message = new messages;
    $message->receiver_id = $receiver_id;
    $message->sender_id = $sender_id;
    $message->content = $request->content;
    $message->save();
    return response()->json(['message'=>'message sent succefully']);
  }  

  // Like and dislike function
  function likeuser(Request $request, $sender_id,$receiver_id){
    $sender = User::find($sender_id);
    $receiver= User::find($receiver_id);
    if (!$sender||!$receiver ){
        return response()->json(['message' => 'Invalid sender or receiver ID']);
    }
    $like= favorites::where('receiver_id', $receiver_id)->where('sender_id', $sender_id)->first();
    if ($like){
      $like->delete();
        return response()->json(['message'=>'user removed from favorites']);
    }
    else{
    $like = new favorites;
    $like->receiver_id = $receiver_id;
    $like->sender_id = $sender_id;
    $like->save();
    return response()->json(['message'=>'user added to favorites']);
  }

  }
   // block function
  function blockuser(Request $request, $sender_id,$receiver_id){
    $sender = User::find($sender_id);
    $receiver= User::find($receiver_id);
    if (!$sender||!$receiver ){
        return response()->json(['message' => 'Invalid sender or receiver ID']);
    }
    $block = new blocks;
    $block->receiver_id = $receiver_id;
    $block->sender_id = $sender_id;
    $block->save();
    return response()->json(['message'=>'user blocked']);
  }

  }




















  













