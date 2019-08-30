-- This file is part of Prymarya 2.

-- Prymarya 2 is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

-- Prymarya 2 is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.

-- You should have received a copy of the GNU General Public License along with Prymarya 2.  If not, see <https://www.gnu.org/licenses/>.

-- ---------------------------------------------

-- Este arquivo é parte do programa Prymarya 2

-- Prymarya 2 é um software livre; você pode redistribuí-lo e/ou
-- modificá-lo dentro dos termos da Licença Pública Geral GNU como
-- publicada pela Fundação do Software Livre (FSF); na versão 3 da
-- Licença, ou (a seu critério) qualquer versão posterior.

-- Este programa é distribuído na esperança de que possa ser útil,
-- mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO
-- a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
-- Licença Pública Geral GNU para maiores detalhes.

-- Você deve ter recebido uma cópia da Licença Pública Geral GNU junto
-- com este programa, Se não, veja <http://www.gnu.org/licenses/>.
--
-- Database: `Prymarya 2db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id_usu` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `pass` varchar(150) NOT NULL,
  `age` varchar(3) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `blocked` char(1) NOT NULL DEFAULT 'N',
  `active` char(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_usu`);

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  --
  -- Estrutura da tabela `images`
  --

  CREATE TABLE `images` (
    `id_img` int(11) NOT NULL,
    `name` varchar(200) DEFAULT NULL,
    `description` text DEFAULT NULL,
    `addr` varchar(200) NOT NULL,
    `fid_usu` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_img`);

  --
  -- AUTO_INCREMENT for table `images`
  --
  ALTER TABLE `images`
    MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
