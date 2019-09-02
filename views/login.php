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
                        <input type="email" name="username" id="username" class="form-control" required="required" />
                    </div>
                    <div class="form-group">
                        <label for="pass">Senha:</label>
                        <input type="password" name="pass" id="pass" class="form-control" required="required" />
                    </div>
                    <button type="submit" id="login_form" name="login_form" class="btn btn-success">Entrar</button>
                </form>
                <a href="#" data-toggle="modal" data-target="#new_pass" class="btn btn-dark" title="Esqueceu a senha" style="margin-top:30px;">Esqueceu a senha?</a>
                <a href="#" data-toggle="modal" data-target="#new_user" class="btn btn-white" title="Novo usuário?">Novo usuário?</a>
            </div>
            <div class="login_links">
                <a href="https://github.com/danerscode" target="_blank" title="Github"><i class="fab fa-github"></i> Github</a>
                <a href="https://danerscode.com" target="_blank" title="Site oficial"><i class="fas fa-globe"></i> Site oficial</a>
            </div>
        </div>
        <?php if(!empty($return)): ?>
            <div class="alert alert-danger return_message" id="return_message">
                <?php echo $return . " "; ?>
            </div>
        <?php endif; ?>
        <!-- MODAL NOVO USUARIO INICIO -->
        <div class="modal fade" id="new_user" tabindex="-1" role="dialog" aria-labelledby="NovoRegistro">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" name="newUser">
                            <div class="form-group">
                                <p>Novo registro de usuário</p>
                                <label for="name">Nome:</label>
                                <input type="text" id="name" name="name" class="form-control" required="required" />
                                <label for="username">Email:</label>
                                <input type="email" id="username" name="username" class="form-control" required="required" />
                                <label for="age">Idade:</label>
                                <input type="text" id="age" name="age" class="form-control" required="required" />
                                <label for="pass">Senha:</label>
                                <input type="password" id="pass" name="pass" class="form-control" required="required" />
                            </div>
                            <input type="submit" value="Confirmar" id="newUserDone" name="newUserDone" class="btn btn-success" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL NOVO USUARIO FIM -->
        <!-- MODAL ESQUECEU A SENHA INICIO -->
        <div class="modal fade" id="new_pass" tabindex="-1" role="dialog" aria-labelledby="new_pass">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" name="new_password">
                            <div class="form-group">
                                <p>Esqueceu sua senha?</p>
                                <label for="username">Email:</label>
                                <input type="email" id="username" name="username" class="form-control" required="required" />
                                <label for="pass">Nova senha:</label>
                                <input type="password" id="pass" name="pass" class="form-control" required="required" />
                            </div>
                            <input type="submit" value="Alterar senha" id="newPass" name="newPass" class="btn btn-warning" />
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
    </body>
</html>
