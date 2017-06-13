<?php
// require_once dirname(dirname(dirname(__FILE__))) . "/config/config.php";
class MenuHelper{
  public $error_log;
  public $info_log;
  public $debug;

  private $auth = null;
  public function __construct($auth) {
    $this->error_log = new Logger('ERROR');
    $this->info_log = new Logger('INFO');
    $this->debug = new Logger('DEBUG');
    $this->auth = $auth;
  }

  public function site_menu(){
    $this->debug->log("MenuHelper::site_menu()");
    $this->debug->log("MenuHelper::site_menu() DOCUMENT_ROOT:".DOCUMENT_ROOT);
    $log_out_str = "<a href='".DOCUMENT_ROOT."logout/'>Logout</a>";
    $user_edit = "<a href='".DOCUMENT_ROOT."User/edit/".$this->auth['User']['id']."/'>UserEdit</a>";
    $site_menu = <<<EOF
    <ul id="dropmenu">
      <li><a href="#">メニュー</a>
        <ul>
          <li>
            $log_out_str
          </li>
          <li>
            $user_edit
          </li>
        </ul>
      </li>
    </ul>
EOF;
    return $site_menu;
  }  
}