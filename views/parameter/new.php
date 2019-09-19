<div class="form_design_one">
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
        <a href="<?php echo BASEURL; ?>parameter" class="btn btn-secondary" title="">Voltar</a>
    </form>
</div>
<script type="text/javascript">
    function setNewUser(){
        var new_user_name = $('input[name="new_user_name"]').val();
        var new_user_email = $('input[name="new_user_email"]').val();
        var new_user_age = $('input[name="new_user_age"]').val();
        var new_user_pass = $('input[name="new_user_pass"]').val();

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
            url: "setNewUser",
            data: items
        }).then(res => {
            var data_return = JSON.stringify(res.data);
				response = JSON.parse(data_return);
            
            if (response.code == "02") {
                Swal.fire({
                    type: "success",
                    text: response.message
                }).then(() => {
                    window.location.href = "../parameter";
                });                             
            } else if (response.code == "01") {
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