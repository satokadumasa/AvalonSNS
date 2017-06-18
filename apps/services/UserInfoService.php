<?php
class UserInfoService {
  public static function RecvProfilePhoto(&$user_info) {
    // echo "_FILES:".print_r($_FILES, true)."<br>";

    if (is_uploaded_file($_FILES['UserInfo']['tmp_name']['profile_photo'])) {
      $photo_dir_name = PROJECT_ROOT.'/public/images/profile_photos/'.$user_info['UserInfo']['user_id'];
      if(!file_exists($photo_dir_name)) {
        mkdir($photo_dir_name, 0755);
      }
      $photo_file_name = $photo_dir_name . '/' . $_FILES['UserInfo']['name']['profile_photo'];
      if (move_uploaded_file($_FILES['UserInfo']['tmp_name']['profile_photo'], $photo_file_name)) {
        chmod($photo_file_name, 0644);

        //$user_info['UserInfo']['profile_photo'] = $_FILES['UserInfo']['name']['profile_photo'];
        $user_info['UserInfo']['profile_photo'] = self::resize($photo_file_name);
      }
    }
  }

  public static function resize($file) {
    $conf = Config::get('user_info');
    $user_info = $conf['user_info'];

    $h = $user_info['profile_photo_height']; // リサイズしたい大きさを指定
    $w = $user_info['profile_photo_width'];

    $file = $file; // 加工したいファイルを指定

    // 加工前の画像の情報を取得
    list($original_w, $original_h, $type) = getimagesize($file);

    if ($original_w > $original_h) {
      $ratio = $w / $original_w;
      $w = $original_h * $ratio;
    }
    else {
      $ratio = $h / $original_h;
      $h = $original_w * $ratio;
    }

    // 加工前のファイルをフォーマット別に読み出す（この他にも対応可能なフォーマット有り）
    switch ($type) {
      case IMAGETYPE_JPEG:
        $original_image = imagecreatefromjpeg($file);
        break;
      case IMAGETYPE_PNG:
        $original_image = imagecreatefrompng($file);
        break;
      case IMAGETYPE_GIF:
        $original_image = imagecreatefromgif($file);
        break;
      default:
        throw new RuntimeException('対応していないファイル形式です。: ', $type);
    }

    // 新しく描画するキャンバスを作成
    $canvas = imagecreatetruecolor($w, $h);
    imagecopyresampled($canvas, $original_image, 0,0,0,0, $w, $h, $original_w, $original_h);
    $arr = explode('.', $file);

    $resize_path = $arr[0] . '_prof.' .$arr[1] ; // 保存先を指定

    switch ($type) {
      case IMAGETYPE_JPEG:
        imagejpeg($canvas, $resize_path);
        break;
      case IMAGETYPE_PNG:
        imagepng($canvas, $resize_path, 9);
        break;
      case IMAGETYPE_GIF:
        imagegif($canvas, $resize_path);
        break;
    }

    $arr = explode('/', $resize_path);
    return $arr[count($arr) - 1];

    // 読み出したファイルは消去
    // imagedestroy($original_image);
    // imagedestroy($canvas);
  }

  // public static function resetProfile(&$user_info) {

  // }
}