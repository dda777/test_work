<pre>
-- 1. запросы на создание всех таблиц в вашей базе данных

-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'Users'
-- пользователи системы
-- ---

DROP TABLE IF EXISTS `Users`;

CREATE TABLE `Users` (
`User_ID` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'код пользователя',
`User_Login` VARCHAR(20) NOT NULL COMMENT 'логин',
`User_PSW` VARCHAR(20) NOT NULL COMMENT 'пароль',
`User_DateCreate` DATETIME NOT NULL COMMENT 'дата/время создания',
`User_Name` VARCHAR(50) NOT NULL COMMENT 'имя пользователя',
PRIMARY KEY (`User_ID`),
KEY (`User_Login`)
) COMMENT 'пользователи системы';

-- ---
-- Table 'Messages'
--
-- ---

DROP TABLE IF EXISTS `Messages`;

CREATE TABLE `Messages` (
`Message_ID` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'код сообщения',
`Chat_ID` INTEGER NOT NULL COMMENT 'код чата',
`User_ID` INTEGER NOT NULL COMMENT 'ID пользователя создавшего сообщение',
`Message_Text` VARCHAR(500) NOT NULL COMMENT 'текст сообщения',
`Message_DateCreate` DATETIME NOT NULL COMMENT 'дата/время создания сообщения',
PRIMARY KEY (`Message_ID`),
KEY (`Message_Text`)
);

-- ---
-- Table 'Chats'
-- чаты
-- ---

DROP TABLE IF EXISTS `Chats`;

CREATE TABLE `Chats` (
`Chat_ID` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'код чата',
`User_ID` INTEGER NOT NULL COMMENT 'код пользователя создавшего чат',
`Chat_DateCreate` DATETIME NOT NULL COMMENT 'дата/время создания',
`Chat_Name` VARCHAR(100) NOT NULL COMMENT 'название чата',
PRIMARY KEY (`Chat_ID`),
KEY (`Chat_Name`)
) COMMENT 'чаты';

-- ---
-- Table 'ChatUser'
-- связь чата с пользователями
-- ---

DROP TABLE IF EXISTS `ChatUser`;

CREATE TABLE `ChatUser` (
`ChatUser_ID` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'код',
`Chat_ID` INTEGER NOT NULL COMMENT 'код чата',
`User_ID` INTEGER NOT NULL COMMENT 'код пользователя',
PRIMARY KEY (`ChatUser_ID`),
UNIQUE KEY (`Chat_ID`, `User_ID`)
) COMMENT 'связь чата с пользователями';

-- ---
-- Table 'ChatStatus'
-- статус сообщения
-- ---

DROP TABLE IF EXISTS `ChatStatus`;

CREATE TABLE `ChatStatus` (
`ChatStatus_ID` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'код',
`Message_ID` INTEGER NOT NULL COMMENT 'код сообщения',
`User_ID` INTEGER NOT NULL COMMENT 'код пользователя',
`ChatStatus_Status` SMALLINT(1) NOT NULL DEFAULT 0 COMMENT 'статус 0=не прочитано/1=прочитано',
PRIMARY KEY (`ChatStatus_ID`),
KEY (`ChatStatus_Status`),
UNIQUE KEY (`Message_ID`, `User_ID`)
) COMMENT 'статус сообщения';

-- ---
-- Foreign Keys
-- ---

ALTER TABLE `Message` ADD FOREIGN KEY (Chat_ID) REFERENCES `Chat` (`Chat_ID`);
ALTER TABLE `Message` ADD FOREIGN KEY (User_ID) REFERENCES `User` (`User_ID`);
ALTER TABLE `Chat` ADD FOREIGN KEY (User_ID) REFERENCES `User` (`User_ID`);
ALTER TABLE `ChatUser` ADD FOREIGN KEY (Chat_ID) REFERENCES `Chat` (`Chat_ID`);
ALTER TABLE `ChatUser` ADD FOREIGN KEY (User_ID) REFERENCES `User` (`User_ID`);
ALTER TABLE `ChatStatus` ADD FOREIGN KEY (Message_ID) REFERENCES `Message` (`Message_ID`);
ALTER TABLE `ChatStatus` ADD FOREIGN KEY (User_ID) REFERENCES `User` (`Users_ID`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `Users` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Messages` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Chat` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `ChatUsers` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `ChatStatus` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- подготовка данных:
-- добавление 2-х пользователей
INSERT INTO `Users` (`User_ID`,`User_Login`,`User_PSW`,`User_DateCreate`, User_Name) VALUES
('1','user1','user1','2021-03-22 10:00:00', 'Sasha');
INSERT INTO `Users` (`User_ID`,`User_Login`,`User_PSW`,`User_DateCreate`, User_Name) VALUES
('2','user2','user2','2021-03-22 10:01:00', 'Denis');

-- добавление чата
INSERT INTO `Chats` (`Chat_ID`,`User_ID`,`Chat_DateCreate`,`Chat_Name`) VALUES
('1','1','2021-03-22 10:10:00','first chat');

-- добавление связи чата с двумя пользователями
INSERT INTO `ChatUser` (`ChatUser_ID`,`Chat_ID`,`User_ID`) VALUES
('1','1','1');
INSERT INTO `ChatUser` (`ChatUser_ID`,`Chat_ID`,`User_ID`) VALUES
('2','1','2');

-- 2. запрос при отправке сообщения от Человека 1 Человеку 2
-- добавление сообщений в чат
INSERT INTO `Messages` (`Message_ID`,`Chat_ID`,`User_ID`,`Message_Text`,`Message_DateCreate`) VALUES
('1','1','1','hello','2021-03-22 10:11:00');
INSERT INTO `Messages` (`Message_ID`,`Chat_ID`,`User_ID`,`Message_Text`,`Message_DateCreate`) VALUES
('2','1','2','hello good job','2021-03-22 10:12:00');

-- добавление статуса прочитанного сообщения
INSERT INTO `ChatStatus` (`ChatStatus_ID`,`Message_ID`,`User_ID`,`ChatStatus_Status`) VALUES
('1','1','2','1');
INSERT INTO `ChatStatus` (`ChatStatus_ID`,`Message_ID`,`User_ID`,`ChatStatus_Status`) VALUES
('2','2','1','0');

-- 3. запрос на получение истории переписки между Ч1 и Ч2 (в первом чате)
SELECT m.Message_Text, u.User_Name, CASE WHEN s.ChatStatus_Status=0 THEN 'не прочитано' ELSE 'прочитано' END AS StatusName
FROM Messages m
JOIN Users u ON u.User_ID=m.User_ID
JOIN ChatUser a ON a.User_ID=u.User_ID
JOIN Chats c ON c.Chat_ID=m.Chat_ID
JOIN ChatStatus s ON s.Message_ID=m.Message_ID
WHERE c.Chat_ID = 1;
-- запрос избыточный/максимальный, чтобы показать все связи
-- можно упростить, если не нужно выводить имя пользователя и статус прочитанного сообщения:
SELECT m.Message_Text
FROM Messages m
WHERE m.Chat_ID = 1;

-- 4. запрос на получение списка всех диалогов, в которых участвует Ч1, в таком виде, как выводится список чатов в любом популярном мессенджере.
SELECT m.Message_Text, u.User_Name, CASE WHEN s.ChatStatus_Status=0 THEN 'не прочитано' ELSE 'прочитано' END AS StatusName
FROM Messages m
JOIN Users u ON u.User_ID=m.User_ID
JOIN ChatUser a ON a.User_ID=u.User_ID
JOIN Chats c ON c.Chat_ID=m.Chat_ID
JOIN ChatStatus s ON s.Message_ID=m.Message_ID
WHERE c.Chat_ID = 1
AND u.User_ID = 1
ORDER BY m.Message_DateCreate DESC;

-- 5. запрос на удаление одного сообщения в истории переписки
DELETE FROM Messages
WHERE Message_ID=1;

-- 6. запрос на удаление всей истории переписки с пользователем №1
DELETE FROM Messages
WHERE User_ID=1;
</pre>
