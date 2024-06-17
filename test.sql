START TRANSACTION;
SET time_zone = "+00:00";


DROP DATABASE IF EXISTS `bank`;
CREATE DATABASE bank;

CREATE TABLE `individuals`
(
    `id`                   int(8)                          NOT NULL,
    `first_name`           varchar(30) CHARACTER SET utf8  NOT NULL,
    `last_name`            varchar(30) CHARACTER SET utf8  NOT NULL,
    `patronymic_name`      varchar(30) CHARACTER SET utf8  NOT NULL,
    `passport`             varchar(10) CHARACTER SET utf8  NOT NULL,
    `inn`                  varchar(12) CHARACTER SET utf8  NOT NULL,
    `driving_license`      varchar(10) CHARACTER SET utf8  NOT NULL,
    `additional_documents` text CHARACTER SET utf8         NOT NULL,
    `comment`              varchar(255) CHARACTER SET utf8 NOT NULL
);

ALTER TABLE `individuals`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `individuals`
    MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;


INSERT INTO `individuals` (`first_name`, `last_name`, `patronymic_name`, `passport`, `inn`, `driving_license`,
                           `additional_documents`, `comment`)
VALUES ('Александр', 'Виниченко', 'Михайлович', '1111222222', '121212121212', '1010101010',
        'Свидетельство о рождении', 'Просто текст'),
       ('Вася', 'Пупкин', 'Дмитриевич', '1234567890', '123456789012', '1234567890',
        '[\"Трудовой договор\", \"Снилс\", \"Полис Медицинского страхования\"]', 'Ещё один комментарий'),
       ('Константин', 'Щербаков', 'Александрович', '7744883322', '111888555777', '7463728173',
        'Согласие на обработку персональных данных', 'Очередной комментарий'),
       ('Денис', 'Шишкин', 'Алексеевич', '0987654321', '210987654321', '0987654321',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
        'Просто какой-то комментарий'),
       ('Кот', 'Матроскин', 'Федорович', '5748391756', '165936593718', '4739573658', 'Усы, лапы, хвост',
        'ПРИМЕЧАНИЕ');

COMMIT;