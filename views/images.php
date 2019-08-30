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
<?php if(count($my_images) > 0): ?>
    <div class="row">
        <h3>Imagens no sistema:</h3>
        <div class="col-sm-4">
            <form method="POST" enctype="multipart/form-data" onsubmit="return submitLock();">
                <div class="form-group">
                    <label for="images">Escolha sua(s) imagem(ns):</label>
                    <input type="file" accept="image/*" name="images[]" id="images[]" multiple class="form-control" />
                </div>
                <input type="submit" value="Enviar" id="img_new" name="img_new" class="btn btn-primary" />
            </form>
        </div>
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">Imagens atuais</div>
                <div class="panel-body">
                    <?php foreach($my_images as $var): ?>
                        <div class="img_tweaks">
                            <?php if($var['name'] != ""): ?>
                              <h4 class=""><?php echo $var['name']; ?></h4>
                            <?php else: ?>
                              <h4>Título da imagem</h4>
                            <?php endif; ?>
                            <div class="">
                              <a href="#" data-toggle="modal" data-target="#image_edit<?php echo $var['id_img']; ?>" class="btn btn-dark" title="Editar imagem"><img src="<?php echo BASEURL; ?>media/images/<?php echo $var['fid_usu']; ?>/<?php echo $var['addr']; ?>" class="img-thumbnail" /></a>
                            </div>
                            <?php if($var['description'] != ""): ?>
                              <p class=""><?php echo $var['description']; ?></p>
                            <?php else: ?>
                              <p>Descrição da imagem</p>
                            <?php endif; ?>
                            <div class="">
                                <a href="#" data-toggle="modal" data-target="#image_edit<?php echo $var['id_img']; ?>" class="btn btn-dark" title="Editar imagem">Editar</a> -
                                <a href="#" data-toggle="modal" data-target="#image_delete<?php echo $var['id_img']; ?>" class="btn btn-dark" title="Excluir imagem">Excluir</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php foreach($my_images as $var): ?>
            <!-- MODAL EDITAR INICIO -->
            <div class="modal fade" id="image_edit<?php echo $var['id_img']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditarRegistro">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form method="POST" name="editUser" onsubmit="return submitLock();">
                                <div class="form-group">
                                    <p>Editar imagem</p>
                                    <label for="name">Nome:</label>
                                    <input type="text" id="name" name="name" class="form-control" required="required" value="<?php echo $var['name']; ?>" placeholder="Título de sua foto" />
                                    <img src="<?php echo BASEURL; ?>media/images/<?php echo $var['fid_usu']; ?>/<?php echo $var['addr']; ?>" class="" />
                                    <label for="description">Desrição:</label>
                                    <input type="text" id="description" name="description" class="form-control" required="required" value="<?php echo $var['description']; ?>" placeholder="Descrição de sua foto." />
                                    <input type="hidden" name="id_img" id="id_img" value="<?php echo $var['id_img']; ?>" />
                                </div>
                                <input type="submit" value="Atualizar" id="img_edit" name="img_edit" class="btn btn-primary" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MODAL EDITAR FIM -->
            <!-- MODAL DELETAR INICIO -->
            <div class="modal fade" id="image_delete<?php echo $var['id_img']; ?>" tabindex="-1" role="dialog" aria-labelledby="image_delete">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form method="POST" name="editUser" onsubmit="return submitLock();">
                                <div class="form-group">
                                    <p>Deletar imagem</p>
                                    <img src="<?php echo BASEURL; ?>media/images/<?php echo $var['fid_usu']; ?>/<?php echo $var['addr']; ?>" class="" />
                                    <input type="hidden" name="id_img" id="id_img" value="<?php echo $var['id_img']; ?>" />
                                </div>
                                <input type="submit" value="Excluir" id="deleteImageDone" name="deleteImageDone" class="btn btn-danger" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MODAL DELETAR FIM -->
            <?php endforeach; ?>
        </div>
    </div>
    <?php if(!empty($return)): ?>
        <div class="alert alert-danger return_message" id="return_message">
            <?php echo $return . " "; ?>
        </div>
    <?php endif; ?>
<?php else: ?>
    <div class="row">
    <h3>Imagens no sistema:</h3>
    <h1>Ops! Você ainda não postou nenhuma imagem!</h1>
        <div class="col-sm-4">
            <form method="POST" enctype="multipart/form-data" onsubmit="return submitLock();">
                <div class="form-group">
                    <label for="images">Escolha sua(s) imagem(ns):</label>
                    <input type="file" accept="image/*" name="images[]" id="images[]" multiple class="form-control" />
                </div>
                <input type="submit" value="Enviar" id="img_new" name="img_new" class="btn btn-primary" />
            </form>
        </div>
    </div>
    <?php if(!empty($return)): ?>
        <div class="alert alert-danger return_message" id="return_message">
            <?php echo $return . " "; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
