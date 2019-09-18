<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE-edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Prymarya 2 framework | login</title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASEURL; ?>assets/img/icon.png">
        <link href="<?php echo BASEURL; ?>assets/lib/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo BASEURL; ?>assets/lib/iziToast/dist/css/iziToast.min.css" rel="stylesheet" />
        <link href="<?php echo BASEURL; ?>assets/lib/fontawesome-free-5.10.2/css/all.css" rel="stylesheet" />
        <link href="<?php echo BASEURL; ?>assets/css/style.css" rel="stylesheet" />
    </head>
    <body oncontextmenu="return false">
        <div class="container">
            <div class="login_design">
                <p>Company login:</p>
                <form method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="login_email" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="pass">Senha:</label>
                        <input type="password" name="login_pass" class="form-control" />
                    </div>
                    <button type="button" class="btn btn-success" onclick="logIn()">Entrar</button>
                    <a href="<?php echo BASEURL; ?>" class="btn btn-secondary">Voltar</a>
                </form>
                <a href="#" data-toggle="modal" data-target="#new_pass" class="btn btn-dark" title="Esqueceu a senha" style="margin-top:30px;">Esqueceu a senha?</a>
                <a href="#" data-toggle="modal" data-target="#new_user" class="btn btn-white" title="Novo usuário?">Novo usuário?</a>
            </div>
            <div class="login_links">
                <a href="https://github.com/danerscode" target="_blank" title="Github"><i class="fab fa-github"></i> Github</a>
                <a href="https://danerscode.com" target="_blank" title="Site oficial"><i class="fas fa-globe"></i> Site oficial</a>
            </div>
        </div>
        <!-- MODAL NOVO USUARIO INICIO -->
        <div class="modal fade" id="new_user" tabindex="-1" role="dialog" aria-labelledby="NovoRegistro" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" name="newUser">
                            <div class="form-group">
                                <p>Novo registro de usuário</p>
                                <label for="name">Nome:</label>
                                <input type="text" name="new_user_name" class="form-control" />
                                <label for="username">Email:</label>
                                <input type="email" name="new_user_email" class="form-control" />
                                <label for="age">Idade:</label>
                                <input type="text" name="new_user_age" class="form-control" />
                                <label for="pass">Senha:</label>
                                <input type="password" name="new_user_pass" class="form-control" />
                            </div>
                            <button type="button" class="btn btn-success" onclick="setNewUser()">Confirmar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL NOVO USUARIO FIM -->
        <!-- MODAL ESQUECEU A SENHA INICIO -->
        <div class="modal fade" id="new_pass" tabindex="-1" role="dialog" aria-labelledby="new_pass" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" name="new_password">
                            <div class="form-group">
                                <p>Esqueceu sua senha?</p>
                                <label for="username">Email:</label>
                                <input type="email" name="newpass_email" class="form-control" />
                                <label for="pass">Nova senha:</label>
                                <input type="password" name="newpass_pass" class="form-control" />
                            </div>
                            <button type="button" class="btn btn-warning" onclick="setNewUserPass()">Alterar senha</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL ESQUECEU A SENHA FIM -->
        <script type="text/javascript" src="<?php echo BASEURL; ?>assets/lib/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="<?php echo BASEURL; ?>assets/lib/axios/dist/axios.js"></script>
        <script type="text/javascript" src="<?php echo BASEURL; ?>assets/lib/iziToast/dist/js/iziToast.min.js"></script>
        <script type="text/javascript" src="<?php echo BASEURL; ?>assets/lib/sweetalert2@8.js"></script>
        <script type="text/javascript" src="<?php echo BASEURL; ?>assets/lib/bootstrap-4.3.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo BASEURL; ?>assets/lib/fontawesome-free-5.10.2/js/all.js"></script>
        <script type="text/javascript" src="<?php echo BASEURL; ?>assets/js/script.js"></script>
        <script type="text/javascript">
            function logIn(){
                var login_email = $('input[name="login_email"]').val();
                var login_pass_set = $('input[name="login_pass"]').val();
                var login_pass = window.btoa(login_pass_set);
                
                if (login_email == "" || typeof(login_email) == "undefined") {
                    $('input[name="login_email"]').focus();
                    iziToast.error({
                        title: 'Ops',
                        message: "Campo obrigatório!"
                    });
                    return false;
                }

                if (login_pass_set == "" || typeof(login_pass_set) == "undefined") {
                    $('input[name="login_pass"]').focus();
                    iziToast.error({
                        title: 'Ops',
                        message: "Campo obrigatório!"
                    });
                    return false;
                }

                let items = new URLSearchParams();
                items.append("login_email", login_email);
                items.append("login_pass", login_pass);

                axios({
                    method: "POST",
                    url: "login/logIn",
                    data: items
                }).then(res => {
                    var data_return = JSON.stringify(res.data);
                        response = JSON.parse(data_return);
                    
                    if (response.code == "08") {
                        console.log(response.message);
                        window.location.href = "home";                           
                    } else if (response.code == "09") {
                        iziToast.error({
                                title: 'Ops... ',
                                message: response.message
                        });
                        return false;
                    } else if(response.code == "10"){
                        iziToast.error({
                                title: 'Ops... ',
                                message: response.message
                        });
                        return false;
                    } else if(response.code == "11"){
                        iziToast.error({
                                title: 'Ops... ',
                                message: response.message
                        });
                        return false;
                    } else {
                        iziToast.error({
                                title: 'Ops... ',
                                message: "Ocorreu algum problema!"
                        });
                        return false;
                    }

                }).catch(function(error){
                    console.log(error);
                });

            }

            function setNewUser(){
                var new_user_name = $("#new_user_name").val();
                var new_user_email = $("#new_user_email").val();
                var new_user_age = $("#new_user_age").val();
                var new_user_pass = $("#new_user_pass").val();

                if (new_user_name == "" || typeof(new_user_name) == "undefined") {
                    $('input[name="new_user_name"]').focus();
                    iziToast.error({
                        title: 'Ops',
                        message: "Campo obrigatório!"
                    });
                    return false;
                }

                if (new_user_email == "" || typeof(new_user_email) == "undefined") {
                    $('input[name="new_user_email"]').focus();
                    iziToast.error({
                        title: 'Ops',
                        message: "Campo obrigatório!"
                    });
                    return false;
                }

                if (new_user_age == "" || typeof(new_user_age) == "undefined") {
                    $('input[name="new_user_age"]').focus();
                    iziToast.error({
                        title: 'Ops',
                        message: "Campo obrigatório!"
                    });
                    return false;
                }

                if (new_user_pass == "" || typeof(new_user_pass) == "undefined") {
                    $('input[name="new_user_pass"]').focus();
                    iziToast.error({
                        title: 'Ops',
                        message: "Campo obrigatório!"
                    });
                    return false;
                }

                let items = new URLSearchParams();
                items.append("new_user_name", new_user_name);
                items.append("new_user_email", new_user_email);
                items.append("new_user_age", new_user_age);
                items.append("new_user_pass", new_user_pass);

                axios({
                    method: "POST",
                    url: "login/setNewUser",
                    data: items
                }).then(res => {
                    var data_return = JSON.stringify(res.data);
                        response = JSON.parse(data_return);
                    
                    if (response.code == "04") {
                        $("#new_user").modal("hide");
                        Swal.fire({
                            type: "success",
                            text: response.message
                        }).then(() => {
                            location.reload();
                        });                             
                    } else if (response.code == "03") {
                        iziToast.error({
                                title: 'Ops... ',
                                message: response.message
                        });
                        return false;
                    } else {
                        iziToast.error({
                                title: 'Ops... ',
                                message: "Ocorreu algum problema!"
                        });
                        return false;
                    }

                }).catch(function(error){
                    console.log(error);
                });

            }

            function setNewUserPass(){
                var newpass_email = $('input[name="newpass_email"]').val();
                var newpass_pass_set = $('input[name="newpass_pass"]').val();
                var newpass_pass = window.btoa(newpass_pass_set);
                
                if (newpass_email == "" || typeof(newpass_email) == "undefined") {
                    $('input[name="newpass_email"]').focus();
                    iziToast.error({
                        title: 'Ops',
                        message: "Campo obrigatório!"
                    });
                    return false;
                }

                if (newpass_pass_set == "" || typeof(newpass_pass_set) == "undefined") {
                    $('input[name="newpass_pass"]').focus();
                    iziToast.error({
                        title: 'Ops',
                        message: "Campo obrigatório!"
                    });
                    return false;
                }

                let items = new URLSearchParams();
                items.append("newpass_email", newpass_email);
                items.append("newpass_pass", newpass_pass);

                axios({
                    method: "POST",
                    url: "login/setNewUserPass",
                    data: items
                }).then(res => {
                    var data_return = JSON.stringify(res.data);
                        response = JSON.parse(data_return);
                    
                    if (response.code == "06") {
                        $("#new_pass").modal("hide");
                        Swal.fire({
                            type: "success",
                            text: response.message
                        }).then(() => {
                            location.reload();
                        });                             
                    } else if (response.code == "07") {
                        iziToast.error({
                                title: 'Ops... ',
                                message: response.message
                        });
                        return false;
                    } else {
                        iziToast.error({
                                title: 'Ops... ',
                                message: "Ocorreu algum problema!"
                        });
                        return false;
                    }

                }).catch(function(error){
                    console.log(error);
                });

            }
        </script>
    </body>
</html>
