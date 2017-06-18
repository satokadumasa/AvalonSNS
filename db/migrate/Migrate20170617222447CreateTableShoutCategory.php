<?php
class Migrate20170617222447CreateTableShoutCategory extends BaseMigrate{
  private $dbh = null;
  public function __construct($default_database) {
    parent::__construct($default_database);
  }

  public function up() {
    $sql = <<<EOM
CREATE TABLE shout_categories (
  id int(9) NOT NULL AUTO_INCREMENT,
  name varchar(254) ,
  created_at datetime NOT NULL,
  modified_at datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY index_shout_categories_id (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
EOM;
    parent::up($sql);
  }

  public function down(){
    $sql = <<<EOM
DROP TABLE shout_categories;
EOM;
    parent::down($sql);
  } 
}