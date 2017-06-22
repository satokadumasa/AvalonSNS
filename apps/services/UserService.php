<?php
class UserService{
  public static function setUserInfoToUser($users) {
    $debug = new Logger('DEBUG');
    $users_arr = [];
    foreach ($users as $key => $user) {

      if (!isset($user['User']['UserInfo'])) {
        $conf = Config::get('user_info');
        $user_info = $conf['user_info'];
        $user_info = [
          'profile_photo' => $user_info['profile_photo_default'],
          'name' => $user['User']['username'],
          'user_id' => 'default',
        ];
        $user['User']['UserInfo'] = $user_info;
        $user['User']['UserInfo']['detail'] = (
                                                isset($user['User']['UserInfo']) && 
                                                isset($user['User']['UserInfo']['detail'])
                                              ) ? 
                                                $user['User']['UserInfo']['detail'] :
                                                '';
        // $user['User']['UserInfo']['detail'] = str_replace("\r", '', $user['User']['detail']);
        // $user['User']['UserInfo']['detail'] = str_replace("\n", '<br />', $user['User']['detail']);
      }
      unset($user['User']['password']);
      unset($user['User']['role_id']);
      unset($user['User']['email']);
      unset($user['User']['authentication_key']);

      $users_arr[] = $user;
    }
    return $users_arr;
  }

  public static function getFriendIds($user, &$friend_ids_str, &$my_id) {
    $friend_ids_str = "[0]";
    $my_id = 1;
    if ($user && isset($user['User']['UserFriend'])) {
      foreach ($user['User']['UserFriend'] as $key => $user_friend) {
        $friend_ids[] = $user_friend['UserFriend']['friend_id'];
      }
      $friend_ids_str = "[" . implode(',', $friend_ids) . "]";
      $my_id = $user['User']['id'];
    }
    else {
      $friend_ids_str = "[0]";
      $my_id = 1;
    }
  }
}