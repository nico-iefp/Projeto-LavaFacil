function criarconta() {

    let dados = new FormData();

    dados.append("op", 1);
    dados.append("nome", $("#nome").val());
    dados.append("email", $("#email").val());
    dados.append("pass", $("#pass").val());
    dados.append("cpass", $("#cpass").val());

    $.ajax({
        url: "assets/controller/controllerCriar.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function(msg){

        let obj = JSON.parse(msg);
         console.log(msg);

        if(obj.flag){

            alerta("Sucesso", obj.msg, "success");

            setTimeout(function(){
                window.location.href = "login.html";
            },2000);

        }else{

            alerta("Erro", obj.msg, "error");

        }

    })

    .fail(function(){

        alerta("Erro","Erro na comunicação com o servidor.","error");

    });

}

function alerta(titulo,msg,icon){

    Swal.fire({
        icon: icon,
        title: titulo,
        text: msg
    });

}

// LOGIN / LOGOUT

function login(){

    let dados = new FormData();

    dados.append("op",1);
    dados.append("email",$("#email").val());
    dados.append("pass",$("#pass").val());

    $.ajax({

        url:"assets/controller/controllerLogin.php",
        method:"POST",
        data:dados,
        dataType:"html",
        cache:false,
        contentType:false,
        processData:false

    })

    .done(function(msg){

        let obj = JSON.parse(msg);

        if(obj.flag){

            alerta("Sucesso",obj.msg,"success");

            setTimeout(function(){

                window.location.href="index.php";

            },2000);

        }else{

            alerta("Erro",obj.msg,"error");

        }

    })

    .fail(function(){

        alerta("Erro","Erro na comunicação com o servidor.","error");

    });

}

function logout(){

    let dados = new FormData();

    dados.append("op",2);

    $.ajax({

        url:"assets/controller/controllerLogin.php",
        method:"POST",
        data:dados,
        dataType:"html",
        cache:false,
        contentType:false,
        processData:false

    })
.done(function(msg){

        let obj = JSON.parse(msg);
         console.log(msg);

        if(obj.flag){

            alerta("Sucesso", obj.msg, "success");

            setTimeout(function(){
                window.location.href = "index.html";
            },2000);

        }else{

            alerta("Erro", obj.msg, "error");

        }

    })
}

function alerta(titulo,msg,icon){

    Swal.fire({

        icon:icon,
        title:titulo,
        text:msg

    });

}