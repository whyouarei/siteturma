/** Função para criar um objeto XMLHTTPRequest
*/

function CriaRequest() {
	try{
		request = new XMLHttpRequest();        
	}
	catch (IEAtual){
		try{
			request = new ActiveXObject("Msxml2.XMLHTTP");       
		}
		catch(IEAntigo){
			try{
				request = new ActiveXObject("Microsoft.XMLHTTP");          
			}
			catch(falha){
				request = false;
			}
		}
	}
	
	if (!request){ 
		alert("Seu Navegador não suporta Ajax!");
	}
	else{
		return request;
	}
}

$(document).ready(function(){
	$('#txtCEP').mask('00000-000');
	$('#numTele').mask('(00)00000-0000');
    $('#btnListar').click(function(){
        // alert ("Teste");
        ContatosConsultar();
    });
	$('#btnEnviar').click(function(){
		ContatosIncluir();
	});
	$('#link_cep').click(function(){
		BuscarCep();
	});
});

$(function(){

    //Dialog

    $('#dialogo').dialog({
        autoOpen: false,
        width: 600,
        buttons:{
            "OK":function(){
                $(this).dialog("close");
            }
        }
    });
});


function ContatosConsultar(){
// alert ("Teste Método");
var strnome = $('input[id=txtNome]').val();
var url ="../controllers/ControleContatos.php";
// var url ="../controllers/ControleContatos.php?page_key=Consultar"+"&txtNome="+strnome+"&HTTP_ACCEPT=application/json";

var xmlreq = CriaRequest();
xmlreq.open('POST', url, true);
xmlreq.setRequestHeader ("Content-type","application/x-www-form-urlencoded");
// Verifica se a conexão foi concluída com sucesso
// Se a conexão nao foi fechada (readyState = 4)
xmlreq.onreadystatechange = function(){
	// Verifica se o arquivo foi encontrado com sucesso
	if (xmlreq.readyState == 4){
		if (xmlreq.status == 200){
			// alert(xmlreq.responseText);
			MostrarContatos(JSON.parse(xmlreq.responseText));
		}
	}
};

// Envio dos Parâmetros
xmlreq.send("page_key=Consultar"+"&txtNome="+strnome+"&HTTP_ACCEPT=application/json");
}

function ContatosIncluir(){
var controle = 0;

	var itensform = document.forms['frmContatos'];
	var qtditens = itensform.elements.length;

	for (var i = 0; i < qtditens; i++) {
		if ((itensform.elements[i].type == 'email' || itensform.elements[i].type == 'text') && itensform.elements[i].value == "") {
			controle += 1;
			itensform.elements[i].style.background = 'yellow';
		}
		else {
			itensform.elements[i].style.background = 'white';
		}
	}

	if (controle > 0) {
		msgHtml = "Favor preencher os campos em destaque";
		$('#dialog').dialog('open');
		$('#Mensagem').html(msgHtml);
	}
	else {



		var strnome = $('input[id=txtNome]').val();
	var strcep = $('input[id=txtCEP]').val().replace(/[^\d]+/g,'');
	var strendereco = $('input[id=txtEnd]').val();
	var strbairro = $('input[id=txtBairro]').val();
	var strcidade = $('input[id=txtCidade]').val();
	var struf = $('input[id=txtUf]').val();
	var stremail = $('input[id=txtEmail]').val();
	var strtele = $('input[id=numTele]').val().replace(/[^\d]+/g,'');
	var url ="../controllers/ControleContatos.php";
	// var url ="../controllers/ControleContatos.php?page_key=Consultar"+"&txtNome="+strnome+"&HTTP_ACCEPT=application/json";
	
	var xmlreq = CriaRequest();
	xmlreq.open('POST', url, true);
	xmlreq.setRequestHeader ("Content-type","application/x-www-form-urlencoded");
	// Verifica se a conexão foi concluída com sucesso
	// Se a conexão nao foi fechada (readyState = 4)
	xmlreq.onreadystatechange = function(){
		// Verifica se o arquivo foi encontrado com sucesso
		if (xmlreq.readyState == 4){
			if (xmlreq.status == 200){
				// alert(xmlreq.responseText);
				ConfirmaCadastro(JSON.parse(xmlreq.responseText));
			}
		}
	};
	
	xmlreq.send("page_key=Incluir"+"&txtNome="+strnome+"&txtCEP="+strcep+"&txtEnd="+strendereco+"&txtBairro="+strbairro+"&txtCidade="+strcidade+"&txtUf="+struf+"&txtEmail="+stremail+"&numTele="+strtele+"&HTTP_ACCEPT=application/json");
	
	$('#frmContatos').each(function(){
		this.reset();
		
	});
}
}

function BuscarCep(){
	// alert ("Teste Método");
	var strcep = $('input[id=txtCEP]').val();
	var url ="http://viacep.com.br/ws/"+ strcep +"/json";
	
	var xmlreq = CriaRequest();
	xmlreq.open('GET', url, true);
	
	// Verifica se a conexão foi concluída com sucesso
	// Se a conexão nao foi fechada (readyState = 4)
	xmlreq.onreadystatechange = function(){
		// Verifica se o arquivo foi encontrado com sucesso
		if (xmlreq.readyState == 4){
			if (xmlreq.status == 200){
				// alert(xmlreq.responseText);
				PreencherCampos(JSON.parse(xmlreq.responseText));
			}
		}
	};
	
	
	
	// Envio dos Parâmetros
	xmlreq.send(null);
	}

function MostrarContatos(obj){
	var strTabela ="<table border=1><thead><tr><th>Nome</th><th>Endereço</th><th>Telefone</th><th>Bairro</th><th>Cidade</th><th>UF</th><th>CEP</th><th>E-mail</th></tr></thead>";
	result = document.getElementById('Resultado');
	
	if(obj.RetornoDados.length > 1){
		for (var i=0;i<obj.RetornoDados.length;i++){
			strTabela += "<tr><td>" +
			obj.RetornoDados[i].nomedoContato +'</td><td>'+
			obj.RetornoDados[i].enderecoContato +'</td><td>'+
			obj.RetornoDados[i].telefoneContato +'</td><td>'+
			obj.RetornoDados[i].bairro +'</td><td>'+
			obj.RetornoDados[i].cidade +'</td><td>'+
			obj.RetornoDados[i].uf +'</td><td>'+
			obj.RetornoDados[i].cep +'</td><td>'+
			obj.RetornoDados[i].emailContato +'</td></tr>'
			
		}
		strTabela +="</table>";
		result.innerHTML = strTabela;
		// $('#lista').modal();
	}
	else{
		$('form[id="frmContatos"] input[name=txtNome').val(obj.RetornoDados[0].nomedoContato);
		$('form[id="frmContatos"] input[name=txtEnd').val(obj.RetornoDados[0].enderecoContato);
		$('form[id="frmContatos"] input[name=numTele').val(obj.RetornoDados[0].telefoneContato);
		$('form[id="frmContatos"] input[name=txtBairro').val(obj.RetornoDados[0].bairro);
		$('form[id="frmContatos"] input[name=txtCidade').val(obj.RetornoDados[0].cidade);
		$('form[id="frmContatos"] input[name=txtUf').val(obj.RetornoDados[0].uf);
		$('form[id="frmContatos"] input[name=txtCEP').val(obj.RetornoDados[0].cep);
		$('form[id="frmContatos"] input[name=txtEmail').val(obj.RetornoDados[0].emailContato);
	}

}

function PreencherCampos(obj){
	
	if(obj.erro == "true"){
		$('#dialogo').dialog('open');
		msgHtml = "Cep Inválido"
		$('#Mensagem').html(msgHtml);
		$('input[id=txtCEP]').val('');
		}
		else{
		$('input[id=txtEnd]').val(obj.logradouro);
		$('input[id=txtBairro]').val(obj.bairro);
		$('input[id=txtCidade]').val(obj.localidade);
		$('input[id=txtUf]').val(obj.uf);
		}
}

function ConfirmaCadastro(obj){	
	if(obj.RetornoDados.sucesso == '1'){
		$('#dialogo').dialog('open');
		msgHtml = "Cadastro realizado com sucesso."
		$('#Mensagem').html(msgHtml);
		}
		else{
			$('#dialogo').dialog('open');
			msgHtml = "Houve um erro ao efetuar seu cadastro."
			$('#Mensagem').html(msgHtml);
		}
}


