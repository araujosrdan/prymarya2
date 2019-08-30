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
<?php
  session_start();
  if (empty($_SESSION['master_owner'])) {
    $_SESSION['master_owner'] = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
  }

  $token_id = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

  if ($_SESSION['master_owner'] == $token_id) {
    setlocale(LC_TIME, 'pt_BR\ ', 'pt_BR.utf-8\ ', 'pt_BR.utf-8\ ', 'portuguese\ ');
    date_default_timezone_set('America/Sao_Paulo');
    require 'config.php';
    spl_autoload_register(function($class){
      if (file_exists('controllers/' . $class . '.php')) {
        require 'controllers/' . $class . '.php';
      } elseif (file_exists('models/' . $class . '.php')) {
        require 'models/' . $class . '.php';
      } elseif (file_exists('core/' . $class . '.php')) {
        require 'core/' . $class . '.php';
      }
    });
    $core = new core();
    $core->run();
  } else {
    echo "Muitas tentativas por sessão! Acesso bloqueado.";
    exit;
  }

 ?>
