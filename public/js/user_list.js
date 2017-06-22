function generateInsertUserInfo(json) {
  var insert_html = ''
  var follow = null;
  for (var i = 0; i < (json.length - 1); i++) {
    follow = followOrNotUserList(friend_ids, json[i]['User']['id']);
    insert_html += "  <div class='shout'>"
     + "    <hr>"
     + "    <div class='user_profile_area'>"
     + "      <div class='user_prfile_photo'>"
     + "        <img src='" + document_root + "images/profile_photos/" + json[i]['User']['UserInfo']['user_id'] + "/" + json[i]['User']['UserInfo']['profile_photo'] + "'>"
     + "      </div>"
     + follow
     + "    </div>"
     + "    <div class='user_info_area'>"
     + "      <div class='user_info_header'>"
     + "        <div class='nickname'>"
     + "          " + json[i]['User']['UserInfo']['name'] + " (" + json[i]['User']['username'] + ")"
     + "        </div>"
     + "      </div>"
     + "      <div class='user_info_detail'>"
     + "        " + json[i]['User']['UserInfo']['detail'] + "<br />"
     + "      </div>"
     + "    </div>"
     + "  </div>";
    
    //  timeline_fromの書き換え
    $("#last_user_id").val(json[i]['User']['id']);
  }
  
  return insert_html;
}

function followOrNotUserList(friend_ids, user_id) {
  insert_html = "";
  if (my_id == user_id) return insert_html;
  if (friend_ids.length > 0 && friend_ids.indexOf(user_id)) {
    insert_html = "<div class='already_folloed_user_list' onclick='followUser(this, " + user_id + ");'>following</div>"
  } else {
    insert_html = "<div class='will_follow_user_list' onclick='followUser(this, " + user_id + ");'>follow</div>"
  }
  return insert_html;
}

function getUserList(obj) {
  var last_user_id = $('#last_user_id').val();
  var post_data = [];
  post_data = {'last_user_id':last_user_id};
  if (obj == null) {obj = $('#line_bottom');}

  var url = document_root + 'User/userlist/';
  $.ajax({
    url: url,
    type: 'GET',
    scriptCharset: 'utf-8',
    data: post_data,
    dataType: 'json',
    success: function(json) {
      var insert_html = generateInsertUserInfo(json);
      $(insert_html).insertBefore(obj);
    },
    error: function(json) {
      window.alert('正しい結果を得られませんでした。');
    }
  });
}

// function postShout(){
//   var timeline_from = $('#timeline_from').val();
//   var target = $('#target').val();
//   var form = $('#shout_from');
//   form['target'] = target;
//   $.ajax({
//     url: form.attr('action'),
//     type: form.attr('method'),
//     data: form.serialize(),
//     scriptCharset: 'utf-8',
//     dataType: 'json',
//     beforeSend: function() {
//         // ボタンを無効化し、二重送信を防止
//         $("#post_shout").attr('disabled', true);
//     },
//     // 応答後
//     complete: function() {
//         // ボタンを有効化し、再送信を許可
//         $("#post_shout").attr('disabled', false);
//         $("#shout_from").find("textarea, :text, select").val("").end().find(":checked").prop("checked", false);
//     },
//     success: function(json) {
//       var insert_html = generateInsertShoutsHtml(json);
//       $(insert_html).insertAfter("#tl_top");
//     },
//     error: function(json) {
//       window.alert('正しい結果を得られませんでした。');
//     }
//   });
// }

function followUser(obj, user_id){
  var target = $('#target').val();
  var post_data = [];
  post_data['target'] = target;
  if (obj == null) {obj = $('#tl_top');}
  post_data = {'friend_id':user_id};
  var url = document_root + 'UserFriend/follow/';
  $.ajax({
    url: url,
    type: 'POST',
    scriptCharset: 'utf-8',
    data: post_data,
    dataType: 'json',
    success: function(json) {
      var follow = ($(obj).text() == 'following') ? 'follow' : 'following';
      $(obj).text(follow);
    },
    error: function(json) {
      window.alert('正しい結果を得られませんでした。');
    }
  });
}
