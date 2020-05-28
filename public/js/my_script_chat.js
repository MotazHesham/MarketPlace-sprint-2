$(document).ready(function(){


	/* First when user click start chat we make a chat box for him and the other user*/
	$(document).on('click','.start_chat',function(){
		var to_user_id = $(this).data('touserid');
		var to_user_name = $(this).data('tousername');
		var to_user_img = $(this).data('touserimg');
		var to_user_status = $(this).data('touserstatus');
		if(to_user_status == 0 ){to_user_status = "offline"}else{to_user_status = " "}
		make_chat_box(to_user_id, to_user_name,to_user_img,to_user_status);
		$('#chating').css('display','block');

		setInterval(function(){
			update_chat_history_data();
			count_messages();
		}, 4000);

	});

	/* this is chat box that create when user start chating with some one*/
	function make_chat_box(to_user_id, to_user_name,to_user_img,to_user_status){

	var chat_box = 		'<div class="card" >';

	chat_box +=				    '<div class="card-header" id="header-move" style="cursor: move;height: 95px;">';
	chat_box +=					    '<div class="d-flex bd-highlight">';
	chat_box +=							'<div class="img_cont">';
	chat_box +=								'<img src="/storage/uploads/' + to_user_img + '" class="rounded-circle user_img" style="cursor:pointer">';
	chat_box +=								'<span class="online_icon ' + to_user_status + '"></span>';
	chat_box +=							'</div>';
	chat_box +=							'<div class="user_info">';
	chat_box +=								'<span><a href="/accounts/' + to_user_id + '" style="color:white">' + to_user_name + '</a></span>';
	chat_box +=								'<p class="count_messages" id="' + to_user_id + '"></p>';
	chat_box +=							'</div>';
	chat_box +=							'<div class="video_cam">';
	chat_box +=								'<span><i class="fas fa-video"></i></span>';
	chat_box +=								'<span><i class="fas fa-phone"></i></span>';
	chat_box +=								'<span><i class="far fa-times-circle" id="close-chat-box"></i></span>';
	chat_box +=							'</div>';
	chat_box +=						'</div>';
	chat_box +=				    '</div>';

	chat_box +=				    '<div class="card-body msg_card_body" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '">';

	chat_box +=					    fetch_user_chat_history(to_user_id);

	chat_box +=				    '</div>';

	chat_box +=				    '<div class="card-footer">';
	chat_box +=				  		'<div class="input-group">';
	chat_box +=							'<div class="input-group-append">';
	chat_box +=								'<span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>';
	chat_box +=							'</div>';
	chat_box +=							'<textarea name="chat_message_' + to_user_id + '" id="chat_message_' + to_user_id + '" class="form-control type_msg chat_message" placeholder="Type your message..."></textarea>';
	chat_box +=							'<div class="input-group-append">';
	chat_box +=								'<button type="button" name="send_chat" id="' + to_user_id + '" class="btn btn-info send_chat"><i class="fas fa-location-arrow"></i></button>';
	chat_box +=							'</div>';
	chat_box +=						'</div>';
	chat_box +=				    '</div>';

	chat_box +=				'</div>';

		$('#chating').html(chat_box);
	}

	// sending a message
	$(document).on('click', '.send_chat', function(){
		var to_user_id = $(this).attr('id');
		var chat_message = $('#chat_message_'+to_user_id).val();
		$.ajax({
			url:"/insert_chat/" + to_user_id + "/" + chat_message,
			method:"GET",
			success:function(data){
				$('#chat_message_'+to_user_id).val('');
			    /*var element = $('#chat_message_'+to_user_id).emojioneArea();
			    element[0].emojioneArea.setText('');*/
			    $('#chat_history_'+to_user_id).html(data);
			}
		})
	});

	$(document).on('click','#close-chat-box',function(){
		$('#chating').css('display','none');
	})


	function fetch_user_chat_history(to_user_id){
		$.ajax({
			url:"/fetch_user_chat_history/" + to_user_id,
			method:"GET",
			success:function(data){
				$('#chat_history_'+to_user_id).html(data);
			}
		})
	}


	function update_chat_history_data(){
		$('.msg_card_body').each(function(){
			var to_user_id = $(this).data('touserid');
			fetch_user_chat_history(to_user_id);
		});
	}


	function count_messages(){
		var to_user_id = $('.count_messages').attr('id');
		$.ajax({
			url:"/count_messages/" + to_user_id,
			method:"GET",
			success:function(data){
				$('.count_messages').html(data);
			}
		})
	}

	/* ##################################################################### */
	/* ############### Contanct ###########################*/
	/* ##################################################################### */


	$('#open_contacts').on('click',function(){
		var user_id = $(this).data('userid');
		if($('.contacts_card').css('right') == '-400px'){
			$('.contacts_card').animate({right:'30px'},400).animate({right:'0'},600);
		}else{
			$('.contacts_card').animate({right:'-400px'},400);
		}
		fetch_contacts(user_id);
		setInterval(function(){
			fetch_contacts(user_id);
		}, 8000);
	})

	function fetch_contacts(user_id){
		$.ajax({
			url:"/fetch_contacts/"+ user_id,
			method:"GET",
			success:function(data){
				$('.contacts_body .contacts').html(data);
			}
		})
	}


})


/*// Make the DIV element draggable:
dragElement(document.getElementById("card-move"));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById("header-move")) {
    // if present, the header is where you move the DIV from:
    document.getElementById("header-move").onmousedown = dragMouseDown;
  } else {
    // otherwise, move the DIV from anywhere inside the DIV:
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    // stop moving when mouse button is released:
    document.onmouseup = null;
    document.onmousemove = null;
  }
}*/




			
