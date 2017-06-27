<?php
class Migrate20170626115010CreateTableNote extends BaseMigrate{
  private $dbh = null;
  public function __construct($default_database) {
    parent::__construct($default_database);
  }

  public function up() {
    $sql = <<<EOM
CREATE TABLE notes (
  id int(9) NOT NULL AUTO_INCREMENT,
  user_id int(8) NOT NULL,
  title varchar(254) NOT NULL,
  detail varchar(2000) NOT NULL,
  delete_flag tinyint(1) NOT NULL,
  created_at datetime NOT NULL,
  modified_at datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY index_notes_id (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
EOM;
    parent::up($sql);
  }

  public function down(){
    $sql = <<<EOM
DROP TABLE notes;
EOM;
    parent::down($sql);
  } 
}