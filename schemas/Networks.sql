CREATE TABLE Networks
(
  `relation` VARCHAR(32) NOT NULL,
  `user` BIGINT UNSIGNED NOT NULL,
  `access` BIGINT UNSIGNED NOT NULL,

  UNIQUE KEY(`relation`, `user`)
) ENGINE = MyISAM;
