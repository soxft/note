-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `type` mediumtext NOT NULL,
  `content` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `config` (`type`, `content`) VALUES
('admin_passwd',	'Xcsoft');

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `cid` mediumtext NOT NULL COMMENT '唯一标识',
  `content` mediumtext NOT NULL COMMENT '内容',
  `title` mediumtext NOT NULL COMMENT '标题',
  `time` mediumtext NOT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2020-08-14 08:43:41
