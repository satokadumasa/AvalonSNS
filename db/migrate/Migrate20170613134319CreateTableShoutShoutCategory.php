<?php
class Migrate20170613134319CreateTableShoutShoutCategory extends BaseMigrate{
  private $dbh = null;
  public function __construct($default_database) {
    parent::__construct($default_database);
  }

  public function up() {
    $sql = <<<EOM
CREATE TABLE shout_shout_categories (
  id int(9) NOT NULL AUTO_INCREMENT,
  shout_id int(8) NOT NULL,
  shout_category_id int(8) NOT NULL,
  created_at datetime NOT NULL,
  modified_at datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY index_shout_shout_categories_id (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
EOM;
    parent::up($sql);
  }

  public function down(){
    $sql = <<<EOM
DROP TABLE shout_shout_categories;
EOM;
    parent::down($sql);
  } 
}