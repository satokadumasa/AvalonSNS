<?php
class DefaultController extends BaseController {
  public function __construct($uri, $url = null) {
    $conf = Config::get('database.config');
    $database = $conf['default_database'];
    parent::__construct($database, $uri, $url);
    $this->controller_class_name = str_replace('Controller', '', get_class($this));
    $this->default = Config::get('acc/default');
  }

  public function index() {
    // $this->debug->log("DefaultController::index() auth:" . print_r($this->auth, true));
    $shouts = [];
    $friend_ids = [];
    
    $shout = new ShoutModel($dbh);
    $form = $shout->createForm();
    $form['Shout']['user_id'] = $this->auth['User']['id'];
    $this->set('Shout', $form['Shout']);

    $timeline_latest = '19700101000000';
    $timeline_oldest = '19700101000000';
    // if ($this->auth) {
    //   foreach ($this->auth['User']['UserFriend'] as $key => $user_friend) {
    //     $friend_ids[] = $user_friend['UserFriend']['friend_id'];
    //   }
    //   $friend_ids_str = "[" . implode(',', $friend_ids) . "]";
    //   $my_id = $this->auth['User']['id'];
    // }
    // else {
    //   $friend_ids_str = "[0]";
    //   $my_id = 1;
    // }
    $friend_ids = UserService::getFriendIds($this->auth, $friend_ids_str, $my_id);

    $this->set('document_root', DOCUMENT_ROOT);
    $this->set('action_name', 'Home');
    $this->set('timeline_latest', $timeline_latest);
    $this->set('timeline_oldest', $timeline_oldest);
    $this->set('Title', 'Home');
    $this->set('Shouts', $shouts);
    $this->set('friend_ids', $friend_ids_str);
    $this->set('my_id', $my_id);
  }

  public function error() {
    $this->set('action_name', 'Error');
    $this->set('Title', 'Home');
    $this->set('datas', null);
  }
}