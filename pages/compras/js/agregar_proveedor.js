$(document).ready(function () {
	$('#Ventana_Proveedor'). click(function (){
var codigo=$('input[name=codigo]');
var nombre=$('input[name=nombre]');
var rtn=$('input[name=rtn]');
var direccion=$('input[name=direccion]');
var telefono=$('input[name=telefono]');
var correo=$('input[name=correo]');
var estado=$('input[name=estado]');


if (codigo.val()==''){
	$("#codigo").attr('required',true);
	document.getElementById("codigo").style.border="2px solid red";
	document.getElementById("codigo").focus();
	return false;
}else{
	$("#codigo").attr('required',false);
	document.getElementById("codigo").style.border="";
}	
if (nombre.val()==''){
	$("#nombre").attr('required',true);
	document.getElementById("nombre").style.border="2px solid red";
	document.getElementById("nombre").focus();
	return false;
}else{
	$("#nombre").attr('required',false);
	document.getElementById("nombre").style.border="";
}

if (rtn.val()==''){
	$("#rtn").attr('required',true);
	document.getElementById("rtn").style.border="2px solid red";
	document.getElementById("rtn").focus();
	return false;
}else{
	$("#rtn").attr('required',false);
	document.getElementById("rtn").style.border="";
}

if (direccion.val()==''){
	$("#direccion").attr('required',true);
	document.getElementById("direccion").style.border="2px solid red";
	document.getElementById("direccion").focus();
	return false;
}else{
	$("#direccion").attr('required',false);
	document.getElementById("direccion").style.border="";
}


if (telefono.val()==''){
	$("#telefono").attr('required',true);
	document.getElementById("telefono").style.border="2px solid red";
	document.getElementById("telefono").focus();
	return false;
}else{
	$("#telefono").attr('required',false);
	document.getElementById("telefono").style.border="";
}

if (correo.val()==''){
	$("#correo").attr('required',true);
	document.getElementById("correo").style.border="2px solid red";
	document.getElementById("correo").focus();
	return false;
}else{
	$("#correo").attr('required',false);
	document.getElementById("correo").style.border="";
}
if (estado.val()==''){
	$("#estado").attr('required',true);
	document.getElementById("estado").style.border="2px solid red";
	document.getElementById("estado").focus();
	return false;
}else{
	$("#estado").attr('required',false);
	document.getElementById("estado").style.border="";
}

var data = '&codigo=' + codigo.val()+'&nombre=' + nombre.val() + '&rtn=' + rtn.val() + '&direccion=' + direccion.val()  + '&telefono=' + telefono.val()+ '&correo=' + correo.val() + '&estado=' + estado.val();

$.ajax({
	
	type: "POST",
	
	url: "guardar_proveedor.php",
	
	data: data,

	dataType: "html",
	
	cache: false,

	success: function (data) {
		$('#comprobarId').fadeIn(1000);
	    $('#comprobarId').html(data);
			
	}
});
return false;
	});
}); 