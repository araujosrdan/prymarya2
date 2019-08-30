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
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="imagetoolbar" content="no" />
    <title>Prymarya 2 framework</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASEURL; ?>assets/img/icon.png">
    <link href="<?php echo BASEURL; ?>assets/lib/dataTables/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="<?php echo BASEURL; ?>assets/lib/dataTables/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo BASEURL; ?>assets/lib/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo BASEURL; ?>assets/lib/iziToast/dist/css/iziToast.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets/dist/styles.css?cb=1567140344076">
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/lib/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/lib/axios/dist/axios.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/lib/iziToast/dist/js/iziToast.min.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/lib/sweetalert2@8.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/lib/dataTables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/lib/dataTables/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/lib/bootstrap-4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL; ?>assets/dist/all.js?cb=1567140344076"></script>
  </head>
  <body oncontextmenu="return false">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div id="navbar">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                         <a href="<?php echo BASEURL; ?>">
                            Prymarya 2 framework | by dancodeweb
                         </a>
                     </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <div class="dropdown">
                        <button class="dropbtn">
                            Opções
                            <span class="caret"></span>
                        </button>
                        <div class="dropdown-content">
                            <a href="<?php echo BASEURL; ?>images">Upload de imagem</a>
                            <a href="#" data-toggle="modal" data-target="#users" name="print_users" title="Relação de usuários">Relatório de usuários</a>
                            <a href="<?php echo BASEURL; ?>home/logout">Sair do sistema</a>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
    <!-- MODAL IMPRIMIR HISTÓRICO LIGAÇÕES INICIO -->
    <div class="modal fade" id="users" tabindex="-1" role="dialog" aria-labelledby="users">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title text-left">Relatório de usuários cadastrados</h4>
                </div>
                <div class="modal-body">
                    <form method="GET" name="usersPrint" id="usersPrint" action="<?php echo BASEURL; ?>rel/users.php" target="_blank">
                        <div class="form-group col-sm-12">
                            <label for="active">Ativo:</label>
                            <input type="radio" id="active" name="active" value="Y" /> Sim
                            <input type="radio" id="active" name="active" value="N" /> Não
                            <input type="radio" id="active" name="active" value="A" checked="checked" /> Todos
                        </div>
                        <hr />
                        <input type="submit" name="print_ligacoes_enter" id="print_ligacoes_enter" value="Gerar relatório" class="btn btn-primary"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
		<!-- MODAL IMPRIMIR HISTÓRICO LIGAÇÕES FIM -->
    <div class="container">
      <?php $this->loadViewer($viewName, $viewData_set); ?>
    </div>
  </body>
</html>
