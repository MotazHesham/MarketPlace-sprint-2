<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Chat_message;


class ChatController extends Controller
{
  public function insert_chat($to_user_id,$chat_message){

     $message = new Chat_message;
     $message->to_user_id = $to_user_id;
     $message->message = $chat_message;
     $message->from_user_id = auth()->user()->id;
     $message->save();

     echo $message->fetch_user_chat_history(auth()->user()->id, $to_user_id);

   }

   public function fetch_user_chat_history($to_user_id){
      $message = new Chat_message;
      echo $message->fetch_user_chat_history(auth()->user()->id, $to_user_id);
   }

   public function count_messages($to_user_id){
      $message = new Chat_message;
      echo $message->count_messages_of_chat(auth()->user()->id, $to_user_id);
   }

   public function fetch_contacts($user_id){
      $message = new Chat_message;
      echo $message->fetch_user_contacts($user_id);
   }
}
