function Login() {
    var done=0;
    var email = document.getElementsByName('email')[0].value;
    email=email.toLowerCase();
    var senha= document.getElementsByName('senha')[0].value;
    seha=senha.toLowerCase();
    if (email=="money@gmail.com" && senha=="money") {
      window.location="./transacoes";
      done=1;
    }
    if (done==0) { alert("Dados incorretos, tente novamente"); }
  }