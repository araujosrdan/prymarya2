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
