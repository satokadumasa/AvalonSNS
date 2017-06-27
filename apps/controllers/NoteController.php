<?php
class NoteController extends BaseController{
  public function __construct($uri, $url = null) {
    $conf = Config::get('database.config');
    $database = $conf['default_database'];
    parent::__construct($database, $uri, $url);
    $this->controller_class_name = str_replace('Controller', '', get_class($this));;
    //$this->role_ids = Config::get('acc/notes');
  }

  public function index() {
    $notes = new NoteModel($this->dbh);
    $limit = 10 * (isset($this->request['page']) ? $this->request['page'] : 1);
    $offset = 10 * (isset($this->request['page']) ? $this->request['page'] - 1 : 0);

    $datas = $notes->where('Note.id', '>', 0)->limit($limit)->offset($offset)->find('all');

    $ref = isset($this->request['page']) ? $this->request['page'] : 0;
    $next = isset($this->request['page']) ? $this->request['page'] + 1 : 2;

    $this->set('Title', 'Note List');
    $this->set('datas', $datas);
    $this->set('Note', $datas);
    $this->set('ref', $ref);
    $this->set('next', $next);
  }

  public function show() {
    $datas = null;
    $id = $this->request['id'];

    $notes = new NoteModel($this->dbh);
    $datas = $notes->where('Note.id', '=', $id)->find('first');
    $this->set('Title', 'Note Ditail');
    $this->set('Note', $datas['Note']);
    $this->set('datas', $datas);
  }

  public function create() {
    $this->debug->log("NoteController::create()");
    $notes = new NoteModel($this->dbh);
    $form = $notes->createForm();
    $this->set('Title', 'Note Create');
    $this->set('Note', $form['Note']);
  }

  public function save(){
    $this->debug->log("NoteController::save()");
    try {
      $this->dbh->beginTransaction();
      $notes = new NoteModel($this->dbh);
      $notes->save($this->request);
      $this->dbh->commit();
      $url = BASE_URL . 'Note' . '/show/' . $notes->primary_key_value . '/';
      $this->redirect($url);
    } catch (Exception $e) {
      $this->debug->log("NoteController::create() error:" . $e->getMessage());
      $this->set('Title', 'Note Save Error');
      $this->set('error_message', '保存ができませんでした。');
    }
  }

  public function edit() {
    $this->debug->log("NoteController::edit()");
    try {
      $datas = null;
      $id = $this->request['id'];

      $notes = new NoteModel($this->dbh);
      $datas = $notes->where('Note.id', '=', $id)->find('first');
      $this->set('Title', 'Note Edit');
      $this->set('Note', $datas['Note']);
      $this->set('datas', $datas);
    } catch (Exception $e) {
      $this->debug->log("NoteController::edit() error:" . $e->getMessage());
    }
  }

  public function delete() {
    try {
      $this->dbh->beginTransaction();
      $notes = new NoteModel($this->dbh);
      $notes->delete($this->request['id']);
      $this->dbh->commit();
      $url = BASE_URL . 'Note' . '/index/';
    } catch (Exception $e) {
      $this->debug->log("UsersController::delete() error:" . $e->getMessage());
    }
  }


}