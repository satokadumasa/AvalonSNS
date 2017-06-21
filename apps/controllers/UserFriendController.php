<?php
class UserFriendController extends BaseController{
  public function __construct($uri, $url = null) {
    $conf = Config::get('database.config');
    $database = $conf['default_database'];
    parent::__construct($database, $uri, $url);
    $this->controller_class_name = str_replace('Controller', '', get_class($this));;
    //$this->role_ids = Config::get('acc/user_friends');
  }

  public function index() {
    $user_friends = new UserFriendModel($this->dbh);
    $limit = 10 * (isset($this->request['page']) ? $this->request['page'] : 1);
    $offset = 10 * (isset($this->request['page']) ? $this->request['page'] - 1 : 0);

    $datas = $user_friends->where('UserFriend.id', '>', 0)->limit($limit)->offset($offset)->find('all');

    $ref = isset($this->request['page']) ? $this->request['page'] : 0;
    $next = isset($this->request['page']) ? $this->request['page'] + 1 : 2;

    $this->set('Title', 'UserFriend List');
    $this->set('datas', $datas);
    $this->set('UserFriend', $datas);
    $this->set('ref', $ref);
    $this->set('next', $next);
  }

  public function show() {
    $datas = null;
    $id = $this->request['id'];

    $user_friends = new UserFriendModel($this->dbh);
    $datas = $user_friends->where('UserFriend.id', '=', $id)->find('first');
    $this->set('Title', 'UserFriend Ditail');
    $this->set('UserFriend', $datas['UserFriend']);
    $this->set('datas', $datas);
  }

  public function create() {
    $user_friends = new UserFriendModel($this->dbh);
    $form = $user_friends->createForm();
    $this->set('Title', 'UserFriend Create');
    $this->set('UserFriend', $form['UserFriend']);
  }

  public function save(){
    try {
      $this->dbh->beginTransaction();
      $user_friends = new UserFriendModel($this->dbh);
      $user_friends->save($this->request);
      $this->dbh->commit();
      $url = BASE_URL . 'UserFriend' . '/show/' . $user_friends->primary_key_value . '/';
      $this->redirect($url);
    } catch (Exception $e) {
      $this->debug->log("UserFriendController::create() error:" . $e->getMessage());
      $this->set('Title', 'UserFriend Save Error');
      $this->set('error_message', '保存ができませんでした。');
    }
  }

  public function edit() {
    try {
      $datas = null;
      $id = $this->request['id'];

      $user_friends = new UserFriendModel($this->dbh);
      $datas = $user_friends->where('UserFriend.id', '=', $id)->find('first');
      $this->set('Title', 'UserFriend Edit');
      $this->set('UserFriend', $datas['UserFriend']);
      $this->set('datas', $datas);
    } catch (Exception $e) {
      $this->debug->log("UserFriendController::edit() error:" . $e->getMessage());
    }
  }

  public function delete() {
    try {
      $this->dbh->beginTransaction();
      $user_friends = new UserFriendModel($this->dbh);
      $user_friends->delete($this->request['id']);
      $this->dbh->commit();
      $url = BASE_URL . 'UserFriend' . '/index/';
    } catch (Exception $e) {
      $this->debug->log("UsersController::delete() error:" . $e->getMessage());
    }
  }

  public function follow(){
    $now_date = date('Y-m-d H:i:s');
    $this->debug->log("form:".print_r($this->request, true));
    $datas = null;
    $friend_id = $this->request['friend_id'];
    $user_id = $this->auth['User']['id'];

    $user_friends = new UserFriendModel($this->dbh);
    $datum = $user_friends
             ->where('UserFriend.friend_id', '=', $friend_id)
             ->where('UserFriend.user_id', '=', $user_id)
             ->find('first');
    $this->debug->log("UserFriend::follow() datum:".print_r($datum, true));
    $this->dbh->beginTransaction();
    if ($datum) {
      $this->debug->log("UserFriend::follow() CH-01");
      $user_friends->delete($datum['UserFriend']['id']);
    }
    else{
      $this->debug->log("UserFriend::follow() CH-02");
      $form['UserFriend']['id'] = null;
      $form['UserFriend']['user_id'] = $user_id;
      $form['UserFriend']['friend_id'] = $friend_id;
      $this->debug->log("UserFriend::follow() form:" . print_r($form, true));
      $user_friends->save($form);
      $this->debug->log("UserFriend::follow() CH-03");
    }

    $this->dbh->commit();
    $user_friends = [1];

    echo json_encode($user_friends);
    exit();
  }
}