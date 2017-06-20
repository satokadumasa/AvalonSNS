<?php
class SubscriptionController extends BaseController{
  public function __construct($uri, $url = null) {
    $conf = Config::get('database.config');
    $database = $conf['default_database'];
    parent::__construct($database, $uri, $url);
    $this->controller_class_name = str_replace('Controller', '', get_class($this));;
    //$this->role_ids = Config::get('acc/subscriptions');
  }

  public function index() {
    $subscriptions = new SubscriptionModel($this->dbh);
    $limit = 10 * (isset($this->request['page']) ? $this->request['page'] : 1);
    $offset = 10 * (isset($this->request['page']) ? $this->request['page'] - 1 : 0);

    $datas = $subscriptions->where('Subscription.id', '>', 0)->limit($limit)->offset($offset)->find('all');

    $ref = isset($this->request['page']) ? $this->request['page'] : 0;
    $next = isset($this->request['page']) ? $this->request['page'] + 1 : 2;

    $this->set('Title', 'Subscription List');
    $this->set('datas', $datas);
    $this->set('Subscription', $datas);
    $this->set('ref', $ref);
    $this->set('next', $next);
  }

  public function show() {
    $datas = null;
    $id = $this->request['id'];

    $subscriptions = new SubscriptionModel($this->dbh);
    $datas = $subscriptions->where('Subscription.id', '=', $id)->find('first');
    $this->set('Title', 'Subscription Ditail');
    $this->set('Subscription', $datas['Subscription']);
    $this->set('datas', $datas);
  }

  public function create() {
    $subscriptions = new SubscriptionModel($this->dbh);
    $form = $subscriptions->createForm();
    $this->set('Title', 'Subscription Create');
    $this->set('Subscription', $form['Subscription']);
  }

  public function save(){
    try {
      $this->dbh->beginTransaction();
      $subscriptions = new SubscriptionModel($this->dbh);
      $subscriptions->save($this->request);
      $this->dbh->commit();
      $url = BASE_URL . 'Subscription' . '/show/' . $subscriptions->primary_key_value . '/';
      $this->redirect($url);
    } catch (Exception $e) {
      $this->debug->log("SubscriptionController::create() error:" . $e->getMessage());
      $this->set('Title', 'Subscription Save Error');
      $this->set('error_message', '保存ができませんでした。');
    }
  }

  public function edit() {
    try {
      $datas = null;
      $id = $this->request['id'];

      $subscriptions = new SubscriptionModel($this->dbh);
      $datas = $subscriptions->where('Subscription.id', '=', $id)->find('first');
      $this->set('Title', 'Subscription Edit');
      $this->set('Subscription', $datas['Subscription']);
      $this->set('datas', $datas);
    } catch (Exception $e) {
      $this->debug->log("SubscriptionController::edit() error:" . $e->getMessage());
    }
  }

  public function delete() {
    try {
      $this->dbh->beginTransaction();
      $subscriptions = new SubscriptionModel($this->dbh);
      $subscriptions->delete($this->request['id']);
      $this->dbh->commit();
      $url = BASE_URL . 'Subscription' . '/index/';
    } catch (Exception $e) {
      $this->debug->log("UsersController::delete() error:" . $e->getMessage());
    }
  }


}