$(document).off('click', '.metrika_string');
$(document).on('click', '.metrika_string', function(){
	var type = $(this).data('type');
	var url = $('input[name="domain_url"]').val();
	console.log(url);
	//$.post('')]
	$.ajax({
		url: 'cite/service/metrica',
		type: 'POST',
		dataType: 'JSON',
		data: ({
			'url': url,
			'type': type
		}),
		success: function(data){
			switch(data.status){
				case 'success':
					console.log(data.content);
					break;
			}
		}
	});
});