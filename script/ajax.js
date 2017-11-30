
function check_placa(event){
	event.value = event.value.toUpperCase(); 
}

function load_main($uri, $id_element,$query){
	if($query != null & $query != "")
		uri = "view/"+$uri+".php"+encodeURI($query);
	else
		uri = "view/"+$uri+".php";
	$.ajax({
		async: true,
		type: "GET",
		dataType: "html",
		url: uri,
		beforeSend: img_load($id_element),
		success:function (e){
			div = $($id_element);
			div.html(e); 
		},
		error: function (e){
			div = $($id_element);
			div.text("Ha ocurrido un  problema con el servidor...");
		}
	});
}

function img_load(e){
	$(e).html("<center><img src='img/blue-loading.gif'><br>cargando...</center>");
}

function send_data($d, $value){
	switch($d){
		case 'AUTO':
			var x = "placa="+document.getElementById("placa").value;
			x = x + "&type_car="+document.getElementById("type_car").value;
			x = x + "&models="+document.getElementById("models").value;
			x = x + "&km="+document.getElementById("km").value;
			x = x + "&cilimdros="+document.getElementById("cilimdros").value; 
			x = x + "&color="+document.getElementById("color").value;
			x = x + "&tank_car="+document.getElementById("tank_car").value;
		break;
		case 'PEOPLE':
			var x = "placa="+document.getElementById("placa").value;
			x = x +"&id="+document.getElementById("id_user").value;
			x = x +"&name="+document.getElementById("name").value;
			x = x +"&type_id="+document.getElementById("type_id").value;
			x = x +"&type_user="+document.getElementById("type_user").value;
		break;
		case 'CILIMDROS':
			var x = "c="+document.getElementById('cilimdros').value;
			x = x +"&km="+document.getElementById('km').value;
			x = x+"&lt="+document.getElementById('diesel').value;
		break;
		case 'DIESEL':
			var x = "u="+document.getElementById('user').value;
			x = x + "&p="+document.getElementById('placa').value;
			x = x + "&km="+document.getElementById('km').value;
			x = x + "&l="+document.getElementById('diesel').value;
		break;
		case 'DELETE':
			var x = "x="+$value;
		break;
		case 'USER_CREATE':
			var x = "user="  + document.getElementById("user_dma").value;
			x = x + "&name=" + document.getElementById("name_user").value;
			x = x + "&id=" + document.getElementById("id_user").value;
			x = x + "&password=" + document.getElementById("password_user").value;
			x = x + "&type_user=" + document.getElementById("type_user").value;   
		break;
	}
	$.ajax({
		async: true,
		type: "POST",
		dataType: "html",
		url: "send_data.php?type="+$d,
		data: encodeURI(x),
		beforeSend: img_load("#alert"),
		success: function(datos){
			show_alert();
			$("#alert").html("<center>"+datos);
			if($d == 'USER_CREATE')
				load_main('config-user-root','#view-config');
		},
		error: function(){
			$("#alert").text("Ha ocurrido un error en la conexi&oacute;n");
		}
	})
}

function show_alert(){
	$("#alert").css("display","block");
}

function clear_alert(){
	$("#alert").css("display","none");
	$("#user-content").html("");
	$("#car-content").html("");
}



function replace_id($id){

	var main = document.getElementById("main-config").childNodes[1];
	li = main.getElementsByTagName('li');


	for(var i=0; i < li.lenght ; i++){
		if($id == i)
		{
			console.log(li[i]);
			li[i].style = "background-color: #fff;border: 1px solid #ddd;border-bottom: 0px;padding: 10px 5px;color: #666;";
		}
		else
		{
			console.log("Este estara inactivo "+li[i]);
			li[i].style = "";
		}
	}
}