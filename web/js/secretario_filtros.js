$(document).ready(function(){
	$("#turma").inputmask("9999", {"placeholder": ""});	
	$("#ano").inputmask("9999", {"placeholder": ""});
	$("#cpf").inputmask("9999.999.999-99", {"placeholder": "0"});
	$("#celular").inputmask("(99) 99999-9999", {"placeholder": "0"});				
	$("#matricula").inputmask("999999.99.999999", {"placeholder": "0"});
	$("#aiserj").inputmask("\\A-" + "999.999.999", {"placeholder": "0"});
	$("#piserj").inputmask("\\P-" + "999.999.999", {"placeholder": "0"});
	$("#butt_aluno").css({"background-color": "#201453", "color": "white"});
	$("#form_prof,#form_turma").hide();
	$("#butt_aluno").click(function(){
		$("#butt_aluno").css({"background-color": "#201453", "color": "white"});
		$("#butt_prof,#butt_turma").css({"background-color": "#72E4D5", "color": "black"});
		$("#form_aluno").show();
		$("#form_prof").hide();
		$("#form_turma").hide();
	});
	$("#butt_prof").click(function(){
		$("#butt_prof").css({"background-color": "#201453", "color": "white"});
		$("#butt_turma,#butt_aluno").css({"background-color": "#72E4D5", "color": "black"});
		$("#form_prof").show();
		$("#form_turma").hide();
		$("#form_aluno").hide();                    
	});
	
	$("#butt_turma").click(function(){
		$("#butt_turma").css({"background-color": "#201453", "color": "white"});
		$("#butt_prof,#butt_aluno").css({"background-color": "#72E4D5", "color": "black"});
             	$("#form_turma").show();
		$("#form_prof").hide();
		$("#form_aluno").hide();                    
	});
});