<?php
class Migrate20170617222445CreateTableUserInfo extends BaseMigrate{
  private $dbh = null;
  public function __construct($default_database) {
    parent::__construct($default_database);
  }

  public function up() {
    $sql = <<<EOM
CREATE TABLE user_infos (
  id int(9) NOT NULL AUTO_INCREMENT,
  user_id int(8) NOT NULL,
  profile_photo varchar(64) NOT NULL,
  name varchar(64) NOT NULL,
  zip_code varchar(7) ,
  address varchar(255) ,
  telephone varchar(32) ,
  fax varchar(32) ,
  mobile_phone varchar(32) ,
  sites text ,
  detail varchar(32) ,
  created_at datetime NOT NULL,
  modified_at datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY index_user_infos_id (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
EOM;
    parent::up($sql);
  }

  public function down(){
    $sql = <<<EOM
DROP TABLE user_infos;
EOM;
    parent::down($sql);
  } 
}