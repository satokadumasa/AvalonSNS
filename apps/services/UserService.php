<?php
class UserService{
  public static function setUserInfoToUser($users) {
    $debug = new Logger('DEBUG');
    $users_arr = [];
    $debug->log("UserService::setUserInfoToUser() CH-00:");
    $debug->log("UserService::setUserInfoToUser() users:".print_r($users, true));
    foreach ($users as $key => $user) {
      $debug->log("UserService::setUserInfoToUser() CH-01:");

      if (!isset($user['User']['UserInfo'])) {
        $debug->log("UserService::setUserInfoToUser() CH-02:");
        $conf = Config::get('user_info');
        $debug->log("UserService::setUserInfoToUser() CH-03:");
        $user_info = $conf['user_info'];
        $user_info = [
          'profile_photo' => $user_info['profile_photo_default'],
          'name' => $user['User']['username'],
          'user_id' => 'default',
        ];
        $user['User']['UserInfo'] = $user_info;
        $debug->log("UserService::setUserInfoToUser() CH-04:");
        $user['User']['UserInfo']['detail'] = (
                                                isset($user['User']['UserInfo']) && 
                                                isset($user['User']['UserInfo']['detail'])
                                              ) ? 
                                                $user['User']['UserInfo']['detail'] :
                                                '';
        $debug->log("UserService::setUserInfoToUser() CH-05:");
        // $user['User']['UserInfo']['detail'] = str_replace("\r", '', $user['User']['detail']);
        $debug->log("UserService::setUserInfoToUser() CH-06:");
        // $user['User']['UserInfo']['detail'] = str_replace("\n", '<br />', $user['User']['detail']);
      }
      $debug->log("UserService::setUserInfoToUser() CH-07:");
      unset($user['User']['password']);
      unset($user['User']['role_id']);
      unset($user['User']['email']);
      unset($user['User']['authentication_key']);
      $debug->log("UserService::setUserInfoToUser() CH-08:");

      $users_arr[] = $user;
    }
    $debug->log("UserService::setUserInfoToShout() users_arr(1):".print_r($users_arr, true));
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