var socketio = io.connect("http://147.83.72.228:2014");

socketio.on("message_to_client", function(data) {
	
	// add message to chat container
	var d = new Date();

  	var id_artigo = jQuery('#main_article').attr('data-id');

	jQuery('#chat_container_'+ data.art + ' #chatlog').prepend('<li><span class="usuario">'+data.user+'</span><span class="fecha">'+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds()+'H</span><p>'+data.message+'</p></li>');
	jQuery('.chat_container textarea').val('');
	jQuery('.chat_container .messages_container').perfectScrollbar('update');
	
	// save some variables (post id and chat text)
	var contido = jQuery('#chatlog').html();
	console.log(contido);

  	jQuery.post(
  		PT_Ajax.ajaxurl,{
		  	action : 'ajax-inputtitleSubmit',
		  	post : id_artigo,
		  	texto: contido,
		  	nextNonce : PT_Ajax.nextNonce
		},
		function( response ) {
			console.log( response );
		}
	);			
});

function sendMessage() {
  	var id_artigo = jQuery('#main_article').attr('data-id');
	var usuario = jQuery('.chat_controls input').val();
	if(usuario != ''){
	}else{
		usuario = 'anónimx';
	}
	
	var msg = document.getElementById("message_input").value;
	socketio.emit("message_to_server", { message : msg, user : usuario, art : id_artigo});
}

jQuery(function() {
	jQuery('.chat').tabs();
	if(jQuery('.ps-scrollbar-x-rail').length){
		
	}else{
		jQuery('.chat_container .messages_container').perfectScrollbar({suppressScrollX:true});
	}
});
