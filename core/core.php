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
  /**
   * BASE DO SISTEMA PARA ACESSOS. NUNCA É NECESSÁRIO ALTERAR ESTE ARQUIVO.
   */
  class core
  {

    public function run(){
      $url = '/';
      if (isset($_GET['url'])) {
        $url .= $_GET['url'];
        //echo $url;
      }
      $params = array();
      if (!empty($url) && $url != '/') {
        $url = explode('/', $url);
        array_shift($url);
        $currentController = $url[0] . 'Controller';
        array_shift($url);
        if (isset($url[0]) && !empty($url[0])) {
          $currentAction = $url[0];
          array_shift($url);
        } else {
          $currentAction 	 = 'index';
        }
        if (count($url) > 0) {
          $params = $url;
        }
      } else {
        $currentController = 'homeController';
        $currentAction 	 = 'index';
      }
      if (!file_exists('controllers/' . $currentController . '.php') || !method_exists($currentController, $currentAction)) {
        $currentController = 'notfoundController';
        $currentAction = 'index';
      }
      $c = new $currentController();
      call_user_func_array(array($c, $currentAction), $params);
    }

  }

?>
