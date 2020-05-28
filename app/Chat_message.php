<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;
use Auth;
use DateTime;
use DB;

class Chat_message extends Model
{
  public function fetch_user_chat_history($from_user_id, $to_user_id){

      	$fetch_chat = DB::select("SELECT
  										*
  									FROM
  										chat_messages
  									WHERE
  										(from_user_id = '" . $from_user_id . "'
  									AND to_user_id = '" . $to_user_id . "')
  									OR (from_user_id = '" . $to_user_id . "'
  									AND to_user_id = '" . $from_user_id . "')
  									ORDER BY created_at DESC
  									");
  		$output = ' ';
  		foreach($fetch_chat as $row){
  			if($row->from_user_id == $from_user_id){
  				$user = User::find($from_user_id);
  				$output .='<div class="d-flex justify-content-end mb-4">
  							<div class="msg_cotainer_send" data-toggle="tooltip" data-placement="top" title="' . $this->calculate_diff_date($row->created_at) . '">
  								' . $row->message . '
  							</div>
  							<div class="img_cont_msg">
  								<img src="/storage/uploads/' . $user->img . '" class="rounded-circle user_img_msg">
  							</div>
  						</div>';
  			}else{
  				$user = User::find($to_user_id);
  				$output .= '<div class="d-flex justify-content-start mb-4">
  							<div class="img_cont_msg">
  								<img src="/storage/uploads/' . $user->img . '" class="rounded-circle user_img_msg">
  							</div>
  							<div class="msg_cotainer" data-toggle="tooltip" data-placement="top" title="' . $this->calculate_diff_date($row->created_at) . '">
  								' . $row->message . '
  							</div>
  						</div>';
  			}

  		}

  		return $output;
  	}

  	public function count_messages_of_chat($from_user_id, $to_user_id){

  		$fetch_chat = DB::select("SELECT
  										COUNT(*)
  									AS
  									 	count_messages
  									FROM
  										chat_messages
  									WHERE
  										(from_user_id = '" . $from_user_id . "'
  									AND to_user_id = '" . $to_user_id . "')
  									OR (from_user_id = '" . $to_user_id . "'
  									AND to_user_id = '" . $from_user_id . "')
  									");


  		return $fetch_chat[0]->count_messages . ' Messages' ;
  	}

  	public function fetch_user_contacts($user_id){

  		$fetch_contacts = DB::select("SELECT DISTINCT from_user_id , to_user_id FROM chat_messages WHERE from_user_id = '" . $user_id . "' OR to_user_id = '" . $user_id . "'");

  		$output = ' ';
  		$ids = array();

  		foreach($fetch_contacts as $contact){

  			if( !in_array($contact->from_user_id, $ids) && $contact->from_user_id != $user_id ){
  				array_push($ids, $contact->from_user_id);
  			}

  			if(!in_array($contact->to_user_id, $ids) && $contact->to_user_id != $user_id ){
  				array_push($ids, $contact->to_user_id);
  			}

  		}

  		foreach($ids as $id){
  			$user = User::find( $id );
  			$status = '';
  			$active = 'Online';
  			if($user->login_status == 0){$status="offline";$active="Offline";}
  			$output .= '<li class="active start_chat" data-touserid="' . $id . '" data-tousername="' . $user->name . '" data-touserimg="' . $user->img . '" data-touserstatus="' . $user->login_status . '" style="cursor:pointer">
  							<div class="d-flex bd-highlight">
  								<div class="img_cont">
  									<img src="/storage/uploads/' . $user->img . '" class="rounded-circle user_img">
  									<span class="online_icon ' . $status . '"></span>
  								</div>
  								<div class="user_info">
  									<span>' . $user->name . '</span>
  									<p>' . $active . '</p>
  								</div>
  							</div>
  						</li>';
  		}


  		return $output;

  	}

    /* ############################################################################################# */
    /* ############################################################################################# */

    /* this function calculate diffrence between
      the date i parse and the current date -> version 1.0
     */
    	  function calculate_diff_date($date){

    		date_default_timezone_set('Africa/Cairo');

    		$added_date = explode(" ", $date);
    		$added_date_1 = explode("-", $added_date[0]);
    		$added_date_2 = explode(":", $added_date[1]);
    		$change_timeformat = date('h:i a ', strtotime($added_date[1]));//change time from 24h to 12h (am) or (pm)

    		$strStart = ($date);
    		$strEnd = (date("Y-m-d H:i")); //current date
    		$dteStart = new DateTime($strStart);
    		$dteEnd   = new DateTime($strEnd);

    		  $dteDiff  = $dteStart->diff($dteEnd);

    		  $diffrence = explode(" ", $dteDiff->format("%Y-%M-%d %h:%i"));
    		  $diffrence_1 =explode("-", $diffrence[0]);
    		  $diffrence_2 =explode(":", $diffrence[1]);

    		  $ago = '';

    		  if($diffrence_1[0] != 0){
    		  	$ago = $this->getmonth_name($added_date_1[1]) . " " . $added_date_1[2] . "," . $added_date_1[0];
    		  	return $ago;
    		  }
    		  if($diffrence_1[1] != 0){
    		  	$ago = $this->getmonth_name($added_date_1[1]) . " " . $added_date_1[2] . " at " .  $change_timeformat;
    		  	return $ago;
    		  }
    		  if($diffrence_1[2] > 1){
    		  	$ago = $this->getmonth_name($added_date_1[1]) . " " . $added_date_1[2] . " at " .  $change_timeformat;
    		  	return $ago;
    		  }
    		  if($diffrence_1[2] == 1){
    		  	$ago = "Yesterday at " . $change_timeformat ;
    		  	return $ago;
    		  }
    		  if($diffrence_1[2] == 0){
    		  	if($diffrence_2[0] == 0){
    		  		if($diffrence_2[1]==0){
    		  			$ago = "1mins";
    			  		return $ago . " ago";
    		  		}else{
    			  		$ago = $diffrence_2[1] . "mins";
    			  		return $ago . " ago";
    		  		}
    		  	}else{
    		  		$ago = $diffrence_2[0] . "hrs";
    		  		return $ago . " ago";
    		  	}
    		  }

    	  }

    	  /* this function called by calculate_diff_date()
    	  		to get the month name
    	  */
    	  function getmonth_name($monthNum){
    		$dateObj   = DateTime::createFromFormat('!m', $monthNum);
    		$monthName = $dateObj->format('F');
    		return $monthName;
    	  }

}
