var etcGetOnlineCount = function(){
	jQuery('#online_count').removeClass("bounce");
	jQuery('#etc_total_count').removeClass("bounce");
		jQuery.ajax({
		type   : 'POST',
		data   : {	'option' : 'com_ajax',
					'module' : 'whosonline',
					'format' : 'ajax',
					'method' : 'getOnlineCount'
		},
		url : 'index.php',
		dataType: 'json',
		success: function (response) {
			if(response.online_count != jQuery('#online_count').html())
				jQuery('#online_count').addClass("bounce");
			jQuery('#online_count').html(response.online_count);	//更新線上人數
			if(response.total_count != jQuery('#etc_total_count').html())
				jQuery('#etc_total_count').addClass("bounce");			
			jQuery('#etc_total_count').html(response.total_count);	//更新總人數
		}
	});
}
setInterval(etcGetOnlineCount, 30000);	//1000為1秒