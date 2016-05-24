function dateOption(selected , debut , fin){
	$(function(){
		var s = '';
		for(var i = debut ; i <= fin ; i++){
			
			s+='<option>'+i+'</option>';
		}
		selected.html(s);
	});
}