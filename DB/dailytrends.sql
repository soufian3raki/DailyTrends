CREATE TABLE `noticias` (
  `id` int(3) NOT NULL,
  `image` varchar(250),
  `title` varchar(100),
  `publisher` varchar(50),
  `source` varchar(100,
  `text` text
);

ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;