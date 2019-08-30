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
        <p>Editar senha do registro:</p>
        <?php if(!empty($return)): ?>
            <div class="alert alert-success" id="return_message">
        <?php echo $return . " "; ?> <button id="return_message_btn" class="btn btn-primary">Ok</button>
            </div>
        <?php endif; ?>
        <form method="POST" name="passEdit" onsubmit="return submitLock();">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" readonly value="<?php echo $usu['name']; ?>" />
                <label for="pass">Nova senha:</label>
                <input type="password" id="pass" name="pass" class="form-control" required="required" />
                <input type="hidden" id="id_usu" name="id_usu" class="form-control" value="<?php echo $usu['id_usu']; ?>" />
            </div>
            <input type="submit" value="Atualizar" id="passEditDone" name="passEditDone" class="btn btn-primary" />
        </form>
    </div>
<?php endforeach; ?>
