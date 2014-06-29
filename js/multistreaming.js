var multistreaming = multistreaming || (function(){
    var _args = {};
	/*
	arg 0 -> hashtag
	arg 1 -> twitter API path
	arg 2 -> post id 
	arg 3 -> base url
	*/
	
    return {
        init : function(Args) {
            _args = Args;

			jQuery(function() {
				setInterval(collerTweets, 10000);
				collerTweets();
				
				function collerTweets(){
					
					jQuery.getJSON( _args[1]+"/api/chios/?hash="+_args[0], function( data ) {
					
					if(data.errors){
						//console.log(data);
					}else{
						
						jQuery('.lsitado_tweets').empty();
						
						jQuery.each(data.statuses, function(entryIndex, entry){
							
							jQuery.each(entry.entities.urls, function(entryIndexUrl, url){
								
								if(url.expanded_url.indexOf('http://adtlantida.tv/streams') !== -1){
									
									/*
									update post streamings
									post function located in hacks.php
									post function name: myajax_multistreaming_func()
									*/
								  	jQuery.post(
								  		PT_Ajax.ajaxurl,{
										  	action: 'ajax-multistreaming',
										  	post: _args[2],
										  	streaming_url: url.expanded_url,
										  	nextNonce: PT_Ajax.nextNonce
										},
										function( response ) {
											if(response.streamingids != 'none'){
												console.log(response.streamingids);
											
												var contido_stream = '<div class="span4"><div class="iframe_contenedor"><iframe src="'+_args[3]+'/splayer/?id='+response.streamingids+'" width="460" height="320" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
												
												jQuery('#contenedor_twitter_streamings').append(contido_stream);
											}
										}
									);			
								}
							});

							/*
							append tweet text to list of tweets
							*/							
							var contido = '<li>';
							contido += '<span class="usuario"><a href="https://twitter.com/'+entry.user.screen_name+'" target="_blank">' + entry.user.screen_name + ' </a></span>';
							contido += ify.clean(entry.text);
							contido += '<span class="fecha">'+formateaFechaTwitter(entry.created_at)+'</span>';
							contido += '</li>';
							jQuery('.lsitado_tweets').append(contido);
						});
						
						jQuery('.lsitado_tweets').perfectScrollbar({suppressScrollX:true});
					}
					
					});
				}
			
			});
        }
    };
}());