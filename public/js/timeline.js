function generateInsertShoutsHtml(json) {
  var insert_html = ''
  for (var i = json.length - 1; i >= 0; i--) {
    console.log(json[i]['Shout']);
    console.log(json[i]['User']);
    insert_html += "  <div class='shout'>"
     + "    <div class='profile_area'>"
     + "      <div class='prfile_photo'>"
     + "        <img src='/images/profile_photos/" + json[i]['Shout']['UserInfo']['user_id'] + "/" + json[i]['Shout']['UserInfo']['profile_photo'] + "'>"
     + "      </div>"
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
     + "      <div class='shout_footer'>"
     + "        <div class='fav_area'>"
     + "          Fav[]"
     + "        </div>"
     + "        <div class='res_area'>"
     + "          Res[]"
     + "        </div>"
     + "        <div class='scat_area'>"
     + "          Scat[]"
     + "        </div>"
     + "      </div>"
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

function getTimeline(obj) {
  alert("getTimeline!");
  var timeline_from = $('#timeline_from').val();
  var target = $('#target').val();
  var post_data = [];
  post_data['target'] = target;
  alert("getTimeline timeline_from:" + timeline_from);

  var url = '/Shouts/getShoutsWithJson/'+timeline_from+'/';
  // var url = '/Shouts/getShoutsWithJson/';
  // .phpファイルへのアクセス
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


  console.log(timeline_from);
}
