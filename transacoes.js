//JAVASCRIPT

//quando a pagina carregar
//puxa do id do form o submit
window.onload=function(){
	listar();
	document.getElementById('frmCadastro').addEventListener('submit', adicionarOuAlterar);
	document.getElementById('frmCadastro').addEventListener('submit', listar);
}

//variavel global
var idAlterar = null;

//Evento do botao cadastrar/salvar (verificação)
function adicionarOuAlterar(e){
    var cpf = document.getElementById('txtCpf').value;
    var conta = document.getElementById('txtConta').value;
    var valor = document.getElementById('txtValor').value;
	var p = {
        cpf : !cpf ? "sem cpf": cpf, //mesmo que if(cpf = ""){ cpf = "sem cpf";}
        conta : !conta ? "sem conta": conta,
        valor : !valor ? "sem valor": valor,
		tipo : document.getElementById('rdoDoc').checked ? 'D' : 'T',
		data : new Date()
	}

	if(idAlterar == null)	
		adicionar(p);
	else if(idAlterar > 0)
		alterar(p);
	else
		alert("Ação desconhecida");	
	
	//bloqueia a ação de atualização do browser
	e.preventDefault();
}

function adicionar(p){	
	var pessoas = [];	
	var idValido = 1;	
	//se já possuir o localStorage, adiciono no array	
	if(localStorage.getItem('value') !== null ){
		pessoas = JSON.parse(localStorage.getItem('value')); //captura o array de objetos(JSON);
				
		if(pessoas.length > 0)
			idValido = 	(function obterIdValido() {	//Função Auto-executável
                    //percorre verificando se tiver "buraco" entre os numeros
                for(var i = 0; i < pessoas.length; i++)
                    if(pessoas[i].Id != i+1)
                        return i + 1;							
                //se nao achar, retorna o id posterior da ultima pessoa
                return pessoas[pessoas.length - 1].Id + 1;
            })();
	}	
	
	var pessoa = {
		Id: idValido,
		cpf: p.cpf,
        conta: p.conta,
        valor: p.valor,
        tipo: p.tipo,
		DataTransacao : p.data.toLocaleString("pt-BR")
	};
	
	//Adiciona o objeto ao ultimo indice do array
	pessoas.push(pessoa);	
	//Ordeno o array pelo ID do objeto
	pessoas.sort(function(a,b) {
		return a.Id - b.Id;
	});			
	//armazena no Localstorage
	localStorage.setItem('value', JSON.stringify(pessoas));	
	//reseta os campos do formulario
	document.getElementById('frmCadastro').reset();	
}

function alterar(p){
	var btn = document.getElementById('btnCadastrarSalvar');	

	pessoas = JSON.parse(localStorage.getItem('value'));
	//substituir as informaçoes
	for(var i = 0; i < pessoas.length; i++){
		if(pessoas[i].Id == idAlterar){
            pessoas[i].Cpf = p.cpf;
            pessoas[i].Conta = p.conta;
            pessoas[i].Valor = p.valor;
			pessoas[i].Tipo = p.tipo;
			pessoas[i].DataTransacao = p.data.toLocaleString("pt-BR");
			
			btn.value = "Cadastrar";
			idAlterar = null;

			localStorage.setItem('value', JSON.stringify(pessoas));	
			document.getElementById('frmCadastro').reset();			
			break;
		}
	}
}

//função do botao Alterar
function prepararAlterar(idRow){	
	document.getElementById('btnCadastrarSalvar').value = "Salvar";
	
    var txtCpf = document.getElementById('txtCpf'),
        txtConta = document.getElementById('txtConta');
        txtValor = document.getElementById('txtValor');
        rdoDoc = document.getElementById('rdoDoc'),
        rdoTed = document.getElementById('rdoTed');

	var pessoas = JSON.parse(localStorage.getItem('value'));
	for(var i = 0; i < pessoas.length; i++){
		if(pessoas[i].Id == idRow){			
			//popular os campos
            txtCpf.value = pessoas[i].Cpf;
            txtConta.value = pessoas[i].Conta;
            txtValor.value = pessoas[i].Valor;
			rdoDoc.checked = !(rdoTed.checked = (pessoas[i].Tipo == 'T'));
			
			//recarrega a lista para limpar o th com background alterado
			listar();
			//coloco ID null (caso clicar em varios botao alterar)
			idAlterar = null;
			if(idAlterar === null){
				//mudar o background da nova linha
				var th = document.getElementById("rowTable"+i);				
				th.className = "estadoAlteracao";				
			}

			//atribuir o Id a variavel global
			idAlterar = pessoas[i].Id;
			break;
		}
	}
}

function excluir(cod){
	var pessoas = JSON.parse(localStorage.getItem('value'));

	for(var i = 0; i < pessoas.length; i++)
		if(pessoas[i].Id == cod)
			pessoas.splice(i, 1);
				
	
	localStorage.setItem('value', JSON.stringify(pessoas));
	listar();
	
	//se nao possuir mais nenhum registro, limpar o storage
	if(pessoas.length == 0)
		window.localStorage.removeItem("value");
}

function listar(){
	//se nao possuir nenhum local storage, nao fazer nada
	if(localStorage.getItem('value') === null)
		return;
	
	//captura os objetos de volta
	var pessoas = JSON.parse(localStorage.getItem('value'));
	var tbody = document.getElementById("tbodyResultados");

	//limpar o body toda vez que atualizar
	tbody.innerHTML = '';
	
	for(var i = 0; i < pessoas.length; i++){
		var	id = pessoas[i].Id,
            cpf = pessoas[i].Cpf,
            conta = pessoas[i].Conta,
            valor = pessoas[i].Valor,
			tipo = pessoas[i].Tipo
			       
		tbody.innerHTML += '<tr id="rowTable'+i+'">'+
								'<td>'+id+'</td>'+
								'<td>'+cpf+'</td>'+
								'<td>'+conta+'</td>'+
                                '<td>'+tipo+'</td>'+
                                '<td>'+valor+'</td>'+
								'<td>'+tipo+'</td>'+
								'<td><button onclick="excluir(\'' + id + '\')">Excluir</button></td>'+
								'<td><button onclick="prepararAlterar(\'' + id + '\')">Alterar</button></td>'+
						   '</tr>';		
	}
}
//'<td class="celTable'+i+'">'+id+'</td>'+