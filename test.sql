START TRANSACTION;
SET time_zone = "+00:00";


DROP DATABASE IF EXISTS `space`;
CREATE DATABASE space;
USE space;

CREATE TABLE `objects`
(
    `id`      int(8)       NOT NULL,
    `type`    varchar(63)  NOT NULL,
    `count`   int(63)      NOT NULL,
    `time`    time         NOT NULL,
    `date`    date         NOT NULL,
    `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `objects`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `objects`
    MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;


INSERT INTO `objects` (`type`, `count`, `time`, `date`, `comment`)
VALUES ('star', 1024, '12:17:33', '2024-06-18', 'Комментарий'),
       ('planet', 100, '02:24:12', '2023-02-13', 'примечание'),
       ('comet', 12, '23:19:22', '2006-01-01', 'какой-то текст'),
       ('planet', 1, '13:30:20', '2023-07-12', 'Марс'),
       ('meteor', 40234, '10:55:03', '2014-08-10', 'какой-то текст');

COMMIT;