<?php
class Migrate20170617222446CreateTableShout extends BaseMigrate{
  private $dbh = null;
  public function __construct($default_database) {
    parent::__construct($default_database);
  }

  public function up() {
    $sql = <<<EOM
CREATE TABLE shouts (
  id int(9) NOT NULL AUTO_INCREMENT,
  user_id int(8) NOT NULL,
  outline varchar(254) NOT NULL,
  detail text ,
  created_at datetime NOT NULL,
  modified_at datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY index_shouts_id (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
EOM;
    parent::up($sql);
  }

  public function down(){
    $sql = <<<EOM
DROP TABLE shouts;
EOM;
    parent::down($sql);
  } 
}