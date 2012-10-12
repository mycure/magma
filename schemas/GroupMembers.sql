CREATE TABLE GroupMembers
(
  `id` BIGINT(64) UNSIGNED NOT NULL,
  `member` BIGINT(64) UNSIGNED NOT NULL,
  `type` INT NOT NULL,

  KEY(`id`),
  KEY(`member`)
) ENGINE = MyISAM;
