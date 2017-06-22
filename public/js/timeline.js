function generateInsertShoutsHtml(json) {
  var insert_html = ''
  var follow = null;
  for (var i = 0; i < (json.length - 1); i++) {
    follow = followOrNot(friend_ids, json[i]['Shout']['user_id']);
    insert_html += "  <div class='shout'>"
     + "    <hr>"
     + "    <div class='profile_area'>"
     + "      <div class='prfile_photo'>"
     + "        <img src='" + document_root + "images/profile_photos/" + json[i]['Shout']['UserInfo']['user_id'] + "/" + json[i]['Shout']['UserInfo']['profile_photo'] + "'>"
     + "      </div>"
     + follow
     + "    </div>"
     + "    <div class='shout_area'>"
     + "      <div class='shout_header'>"
     + "        <div class='nickname'>"
     + "          " + json[i]['Shout']['UserInfo']['name'] + " (" + json[i]['User']['username'] + ")"
     + "        </div>"
     + "        <div class='created_at'>"
     + "          " + json[i]['Shout']['created_at'] + " "
     + "        </div>"
     + "      </div>"
     + "      <div class='shout_body'>"
     + "        " + json[i]['Shout']['outline'] + "<br />"
     + "        " + json[i]['Shout']['detail'] + "<br />"
     + "      </div>"
     // + "      <div class='shout_footer'>"
     // + "        <div class='fav_area'>"
     // + "          Fav[]"
     // + "        </div>"
     // + "        <div class='res_area'>"
     // + "          Res[]"
     // + "        </div>"
     // + "        <div class='scat_area'>"
     // + "          Scat[]"
     // + "        </div>"
     // + "      </div>"
     + "    </div>"
     + "  </div>";
    
    //  timeline_fromの書き換え
    var modified_at = json[i]['Shout']['created_at'].replace(" ", "");
    modified_at = modified_at.replace("-", "");
    modified_at = modified_at.replace("-", "");
    modified_at = modified_at.replace(":", "");
    modified_at = modified_at.replace(":", "");
    $("#timeline_from").val(modified_at);
  }
  
  return insert_html;
}

function followOrNot(friend_ids, user_id) {
  insert_html = "";
  if (my_id == user_id) return insert_html;
  if (friend_ids.length > 0 && friend_ids.indexOf(user_id)) {
    insert_html = "<div class='aleady_followed' onclick='follow(this, " + user_id + ");'>following</div>"
  } else {
    insert_html = "<div class='will_follow' onclick='follow(this, " + user_id + ");'>follow</div>"
  }
  return insert_html;
}

function getTimeline(obj) {
  var timeline_from = $('#timeline_from').val();
  var target = $('#target').val();
  var post_data = [];
  post_data['target'] = target;
  if (obj == null) {obj = $('#tl_top');}

  var url = document_root + 'Shouts/getShoutsWithJson/'+timeline_from+'/';
  $.ajax({
    url: url,
    type: 'GET',
    scriptCharset: 'utf-8',
    data: post_data,
    dataType: 'json',
    success: function(json) {
      var insert_html = generateInsertShoutsHtml(json);
      $(insert_html).insertAfter(obj);
    },
    error: function(json) {
      window.alert('正しい結果を得られませんでした。');
    }
  });
}

function postShout(){
  var timeline_from = $('#timeline_from').val();
  var target = $('#target').val();
  var form = $('#shout_from');
  form['target'] = target;
  $.ajax({
    url: form.attr('action'),
    type: form.attr('method'),
    data: form.serialize(),
    scriptCharset: 'utf-8',
    dataType: 'json',
    beforeSend: function() {
        // ボタンを無効化し、二重送信を防止
        $("#post_shout").attr('disabled', true);
    },
    // 応答後
    complete: function() {
        // ボタンを有効化し、再送信を許可
        $("#post_shout").attr('disabled', false);
        $("#shout_from").find("textarea, :text, select").val("").end().find(":checked").prop("checked", false);
    },
    success: function(json) {
      var insert_html = generateInsertShoutsHtml(json);
      $(insert_html).insertAfter("#tl_top");
    },
    error: function(json) {
      window.alert('正しい結果を得られませんでした。');
    }
  });
}

function follow(obj, user_id){
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
