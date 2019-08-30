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
<h2><a href="<?php echo BASEURL; ?>" class="" title="">Home</a> > CRUD via PARÂMETRO</h2>
<hr />
<table class="display" id="tbUsuarios">
    <thead>
        <td class="header_treat">Código:</td>
        <td class="header_treat">Img:</td>
        <td class="header_treat">Email:</td>
        <td class="header_treat">Nome:</td>
        <td class="header_treat">Idade:</td>
        <td class="header_treat">Ativo:</td>
        <td class="header_treat" style="text-align:right">Opções</td>
    </thead>
    <tbody>
        <?php foreach($users as $usu): ?>
            <tr>
                <td><?php echo $usu['cod_usu']; ?></td>
                <?php if($usu['image'] != ''): ?>
                  <td align="center"><img src="<?php echo BASEURL; ?>media/user/<?php echo $usu['id_usu']; ?>/<?php echo $usu['image']; ?>" class="img-thumbail" style="height:3rem;width:3rem;" /> </td>
                <?php else: ?>
                  <td title="Sem imagem disponível" align="center"><span class="glyphicon glyphicon-picture"></span> </td>
                <?php endif; ?>
                <td><?php echo $usu['email']; ?></td>
                <td><?php echo $usu['name']; ?></td>
                <td><?php echo $usu['age']; ?></td>
                <?php if($usu['active'] == "Y"): ?>
                  <td>Sim</td>
                <?php else: ?>
                  <td>Não</td>
                <?php endif; ?>
                <td style="text-align:right">
                    <a href="<?php echo BASEURL; ?>parameter/image/?id=<?php echo $usu['id_usu']; ?>" class="btn btn-dark" title="Editar imagem"><span class="glyphicon glyphicon-user"></span></a>
                    <a href="<?php echo BASEURL; ?>parameter/edit/?id=<?php echo $usu['id_usu']; ?>" class="btn btn-dark" title="Editar registro"><span class="glyphicon glyphicon-edit"></span></a>
                    <a href="<?php echo BASEURL; ?>parameter/pass/?id=<?php echo $usu['id_usu']; ?>" class="btn btn-dark" title="Editar senha"><span class="glyphicon glyphicon-check"></span></a>
                    <a href="<?php echo BASEURL; ?>parameter/delete/?id=<?php echo $usu['id_usu']; ?>" class="btn btn-white" title="Excluir registro"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<hr />
<a href="<?php echo BASEURL; ?>parameter/new" class="btn btn-primary" title="Novo registro">
    <span class="glyphicon glyphicon-tag"></span>
    Novo resgistro
</a>

<script>
    $(document).ready(function() {
        $('#tbUsuarios').DataTable({
            "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)"
            }
        });
    });
    $('#tbUsuarios')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
</script>
