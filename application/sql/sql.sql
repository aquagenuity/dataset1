CREATE DATABASE IF NOT EXISTS `aq`;
USE `aq`;


DROP TABLE IF EXISTS `aq`.`toxin_average`;
CREATE TABLE `aq`.`toxin_average` (
  toxin_average_id int unsigned auto_increment not null,
  toxin_type_cd varchar(10),
  average_type_cd varchar(10),
  value decimal(13,7),
  creation_user_id varchar(36),
  creation_dtm datetime(6),
  last_update_user_id varchar(36),
  last_update_dtm datetime(6),
  primary key (`toxin_average_id`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

DELIMITER $$

DROP PROCEDURE IF EXISTS `aq`.`sp_toxin_average_get` $$
CREATE PROCEDURE `aq`.`sp_toxin_average_get`()
BEGIN

select
  a.toxin_average_id,
  a.toxin_type_cd,
  a.average_type_cd,
  a.value,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  toxin_average a;


END $$

DELIMITER ;


DELIMITER $$

DROP PROCEDURE IF EXISTS `aq`.`sp_toxin_average_get_by_id` $$
CREATE PROCEDURE `aq`.`sp_toxin_average_get_by_id`(
  p_toxin_average_id int
)
BEGIN

select
  a.toxin_average_id,
  a.toxin_type_cd,
  a.average_type_cd,
  a.value,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  toxin_average a
where
  a.toxin_average_id = p_toxin_average_id;


END $$

DELIMITER ;


DELIMITER $$

DROP PROCEDURE IF EXISTS `aq`.`sp_toxin_average_ins` $$
CREATE PROCEDURE `aq`.`sp_toxin_average_ins`(
  p_toxin_type_cd varchar(10),
  p_average_type_cd varchar(10),
  p_value decimal(13,7),
  p_creation_user_id varchar(36)
)
BEGIN

insert toxin_average
(
  toxin_type_cd,
  average_type_cd,
  value,
  creation_user_id,
  creation_dtm
)
values
(
  p_toxin_type_cd,
  p_average_type_cd,
  p_value,
  p_creation_user_id,
  utc_timestamp
);

select
  a.toxin_average_id,
  a.toxin_type_cd,
  a.average_type_cd,
  a.value,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  toxin_average a
where
  a.toxin_average_id = last_insert_id();


END $$

DELIMITER ;


DELIMITER $$

DROP PROCEDURE IF EXISTS `aq`.`sp_toxin_average_upd` $$
CREATE PROCEDURE `aq`.`sp_toxin_average_upd`(
  p_toxin_average_id int,
  p_toxin_type_cd varchar(10),
  p_average_type_cd varchar(10),
  p_value decimal(13,7),
  p_last_update_user_id varchar(36)
)
BEGIN

update
  toxin_average
set
  toxin_type_cd = p_toxin_type_cd,
  average_type_cd = p_average_type_cd,
  value = p_value,
  last_update_user_id = p_last_update_user_id,
  last_update_dtm = utc_timestamp
where
  toxin_average_id = p_toxin_average_id;

select
  a.toxin_average_id,
  a.toxin_type_cd,
  a.average_type_cd,
  a.value,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  toxin_average a
where
  a.toxin_average_id = p_toxin_average_id;


END $$

DELIMITER ;


DELIMITER $$

DROP PROCEDURE IF EXISTS `aq`.`sp_toxin_average_del` $$
CREATE PROCEDURE `aq`.`sp_toxin_average_del`(
  p_toxin_average_id int
)
BEGIN

delete from
  toxin_average
where
  toxin_average_id = p_toxin_average_id;


END $$

DELIMITER ;


DELIMITER $$

DROP PROCEDURE IF EXISTS `aq`.`sp_toxin_average_trn` $$
CREATE PROCEDURE `aq`.`sp_toxin_average_trn`()
BEGIN

truncate table toxin_average;


END $$

DELIMITER ;
