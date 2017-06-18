<?php
class ShoutService {
  public static function getShoutTimeLine($dbh) {
    $shout = new ShoutModel($dbh);
    $form = $shout->createForm();

    $session = Session::get();
    $auth = $session['Auth'];

    $user_friend = new UserFriendModel($dbh);
    $user_friend_ids = $user_friend->getFriendIds($auth);
    $user_friend_ids[] = $auth['User']['id'];

    $shouts = $shout->where('Shout.user_id', 'IN', $user_friend_ids)->offset(0)->limit(10)->find('all');

    $user_ids = $shout->getUserIds($shouts);
    $user = new UserModel($dbh);
    if (count($user_ids) > 0) {
        $users = $user->where('User.id', 'IN', $user_ids)->find('all');
        $shouts = self::setUserInfoToShout($shouts, $users);
    }
    return $shouts;
  }


  public static function setUserInfoToShout($shouts, $users) {
    $shout_arr = [];
    foreach ($shouts as $key => $shout) {
      if (isset($users[$shout['User']['id']]['User']['UserInfo'])){
        $shout['Shout']['UserInfo'] = $users[$shout['User']['id']]['User']['UserInfo'][0]['UserInfo'];
      }
      else {
        $debug =new Logger('DEBUG');
        $conf = Config::get('user_info');
        $debug->log("ShoutService::setUserInfoToShout() conf(1):".print_r($conf, true));
        $user_info = $conf['user_info'];
        $h = $user_info['profile_photo_default']; // リサイズしたい大きさを指定
        $w = $user_info['profile_photo_width'];
        $user_info = [
          'profile_photo' => $user_info['profile_photo_default'],
          'name' => $users[$shout['User']['id']]['User']['username'],
          'user_id' => 'default',
        ];
        $shout['Shout']['UserInfo'] = $user_info;
        $shout['Shout'] = str_replace("\r", '', $shout['Shout']);
        $shout['Shout'] = str_replace("\n", '<br />', $shout['Shout']);
      }
      $shout_arr[] = $shout;
    }
    return $shout_arr;
  }
}