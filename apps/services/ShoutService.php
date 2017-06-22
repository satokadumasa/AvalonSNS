<?php
class ShoutService {
  public static function getShoutTimeLine($dbh, $options = null) {
    $debug =new Logger('DEBUG');
    $debug->log("ShoutService::getShoutTimeLine() options:".print_r($options, true));
    $shout = new ShoutModel($dbh);

    $session = Session::get();
    $auth = $session['Auth'];

    $user_friend = new UserFriendModel($dbh);
    $user_friend_ids = $auth ? $user_friend->getFriendIds($auth) : null;
    $user_friend_ids[] = 1;
    if (isset($auth['User']['id'])) $user_friend_ids[] = $auth['User']['id'];
    $shout->where('Shout.user_id', 'IN', $user_friend_ids)->offset(0)->limit(10)->desc('modified_at');
    if (isset($options['Shout']['created_at'])){
      $modified_at = substr($options['Shout']['created_at'], 0, 4) . '-'  //  年
                   . substr($options['Shout']['created_at'], 4, 2) . '-'  //  月
                   . substr($options['Shout']['created_at'], 6, 2) . ' '  //  日
                   . substr($options['Shout']['created_at'], 8, 2) . ':'  //  時
                   . substr($options['Shout']['created_at'], 10, 2) . ':'  //　分
                   . substr($options['Shout']['created_at'], 12, 2);       // 病
      $operator = (isset($options['Shout']['direction']) && $options['Shout']['direction'] == 'past') ? '<' : '>';
      $shout->where('Shout.modified_at', $operator, $modified_at);
    }
    $shouts = $shout->find('all');

    $user_ids = $shout->getUserIds($shouts);
    $user = new UserModel($dbh);
    if (count($user_ids) > 0) {
        $users = $user->where('User.id', 'IN', $user_ids)->find('all');
        $shouts = self::setUserInfoToShout($shouts, $users);
    }
    return $shouts;
  }

  public static function setUserInfoToShout($shouts, $users) {
    $debug =new Logger('DEBUG');
    $shout_arr = [];
    foreach ($shouts as $key => $shout) {
      if (isset($users[$shout['User']['id']]['User']['UserInfo'])){
        $shout['Shout']['UserInfo'] = $users[$shout['User']['id']]['User']['UserInfo'][0]['UserInfo'];
      }
      else {
        $conf = Config::get('user_info');
        $user_info = $conf['user_info'];
        $user_info = [
          'profile_photo' => $user_info['profile_photo_default'],
          'name' => $users[$shout['User']['id']]['User']['username'],
          'user_id' => 'default',
        ];
        $shout['Shout']['UserInfo'] = $user_info;
        $shout['Shout'] = str_replace("\r", '', $shout['Shout']);
        $shout['Shout'] = str_replace("\n", '<br />', $shout['Shout']);
      }
      unset($shout['User']['password']);
      unset($shout['User']['role_id']);
      unset($shout['User']['email']);
      unset($shout['User']['authentication_key']);

      $shout_arr[] = $shout;
    }
    return $shout_arr;
  }
}