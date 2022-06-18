function upload(upload) {

	//animação do botão
	$('.upload').hide( "clip", {direction: 'horizontal'}, 400).show( "clip", {direction: "horizontal"}, 400);
	setTimeout(function(){
	$('.upload')
		.empty()
		.append('Planilha Upada: '+upload.files[0].name)
   		.removeClass('upload');
   	}, 400);

	// prepara as variaveis para transformação
	var planilha = upload.files[0];
	var FR = new FileReader();
	FR.readAsArrayBuffer(planilha);

	// transformar planilha em array
	FR.onload = function(e) {
		//pega as informações da planilha
		var data = new Uint8Array(e.target.result);
		//aplica as informações em um array
		var workbook = XLSX.read(data, {type: 'array'});

		//adiciona a aba 1 da planilha em um array
		var sheet = workbook.Sheets[workbook.SheetNames[0]];
		//formata o array da aba 1 como um json
		var sheet_json = XLSX.utils.sheet_to_json(sheet, { header: 1 });

		console.log(sheet_json);
	};

}