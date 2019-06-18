<script>
// Exemplo de requisição POST
/*var ajax = new XMLHttpRequest();*/

// Seta tipo de requisição: Post e a URL da API
/*ajax.open("POST", "/money-api/MoneyHUB/Functions/SQLiteFunctions.cs", true);
ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");*/

// Seta paramêtros da requisição e envia a requisição
/*ajax.send("email=michellicsf@gmail.com");*/

// Cria um evento para receber o retorno.
/*ajax.onreadystatechange = function() {
  // Caso o state seja 4 e o http.status for 200, é porque a requisiçõe deu certo.
	if (ajax.readyState == 4 && ajax.status == 200) {
		var data = ajax.responseText;
    // Retorno do Ajax
		console.log(data);
	}
}*/
</script>

<div class="login">
    <div class="container">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="login-box">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <img src="img/logo.png"/>
                <h1>BEM VINDO(A) A MONEY HUB</h1>
                <p>Fazendo de tudo para alcançar seus objetivos!!!</p>
                <form name="acesso" method="post" action="#">
                    <input type="text" placeholder="Email" name="email"><br>
                    <input type="password" placeholder="Senha" name="senha">
                    <div id="enviar">
                        <input type="button" onclick="Login()" class="botao" value="Login"><br>
                        <a href="cadastro">faça seu cadastro!!!</a>
                    </div>
                </form>
            </div>
            <div class="col-md-1"></div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
