<?php
class ShoutService {
  public static function setUserInfoToShout($shouts, $users) {
    $shout_arr = [];
    foreach ($shouts as $key => $shout) {
      if (isset($users[$shout['User']['id']]['User']['UserInfo'])){
        $shout['Shout']['UserInfo'] = $users[$shout['User']['id']]['User']['UserInfo'][0]['UserInfo'];
      }
      else {
        $conf = Config::get('user_info');
        $user_info = $conf['user_info'];

        $h = $user_info['profile_photo_default']; // リサイズしたい大きさを指定
        $w = $user_info['profile_photo_width'];
        $user_info = [
          'profile_photo' => $user_info['profile_photo_default'],
          'name' => $users[$shout['User']['id']]['User']['username'],
          'user_id' => 'default',
        ];
        $shout['Shout']['UserInfo'] = $user_info;
      }
      $shout_arr[] = $shout;
    }
    return $shout_arr;
  }
}