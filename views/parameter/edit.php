<?php
# This file is part of Prymarya 2.

# Prymarya 2 is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

# Prymarya 2 is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.

# You should have received a copy of the GNU General Public License along with Prymarya 2.  If not, see <https://www.gnu.org/licenses/>.

# ---------------------------------------------

# Este arquivo é parte do programa Prymarya 2

# Prymarya 2 é um software livre; você pode redistribuí-lo e/ou
# modificá-lo dentro dos termos da Licença Pública Geral GNU como
# publicada pela Fundação do Software Livre (FSF); na versão 3 da
# Licença, ou (a seu critério) qualquer versão posterior.

# Este programa é distribuído na esperança de que possa ser útil,
# mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO
# a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
# Licença Pública Geral GNU para maiores detalhes.

# Você deve ter recebido uma cópia da Licença Pública Geral GNU junto
# com este programa, Se não, veja <http://www.gnu.org/licenses/>.
?>
<a href="<?php echo BASEURL; ?>parameter" class="" title="">Voltar</a> <br />
<?php foreach($user_selected as $usu): ?>
    <div class="form_design_one">
        <form method="POST" name="newUser" onsubmit="return submitLock();">
            <div class="form-group">
                <p>Editar registro de usuário com ID: <?php echo $usu['id_usu']; ?></p>
                <?php if(!empty($return)): ?>
                    <div class="alert alert-success" id="return_message">
                <?php echo $return . " "; ?> <button id="return_messager_btn" class="btn btn-primary">Ok</button>
                    </div>
                <?php endif; ?>
                <label for="active">Ativo:</label>
                <input type="radio" id="active" name="active" value="Y" <?php echo ($usu['active'] == "Y"?'checked="checked"':''); ?>> Sim
                <input type="radio" id="active" name="active" value="N"<?php echo ($usu['active'] == "N"?'checked="checked"':''); ?>> Não
                <br />
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $usu['name']; ?>" required="required" />
                <label for="username">Email:</label>
                <input type="email" id="username" name="username" class="form-control" value="<?php echo $usu['email']; ?>" required="required" />
                <label for="age">Idade:</label>
                <input type="text" id="age" name="age" class="form-control" value="<?php echo $usu['age']; ?>" required="required" />
                <input type="hidden" id="id_usu" name="id_usu" class="form-control" value="<?php echo $usu['id_usu']; ?>" />
            </div>
            <input type="submit" value="Confirmar" id="editUserDone" name="editUserDone" class="btn btn-success" />
        </form>
    </div>
<?php endforeach; ?>
