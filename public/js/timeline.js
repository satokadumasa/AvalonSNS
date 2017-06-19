function getTimeline() {
  alert("getTimeline!");
  var timeline_from = $('#timeline_from').val();
  var target = $('#target').val();
  var post_data = [];
  post_data['target'] = target;
  alert("getTimeline timeline_from:" + timeline_from);

  var url = '/Shouts/getShoutsWithJson/'+timeline_from+'/';
  alert("url:" + url);
  // var url = '/Shouts/getShoutsWithJson/';
  // .phpファイルへのアクセス
  $.ajax({
    url: url,
    type: 'GET',
    scriptCharset: 'utf-8',
    data: post_data,
    dataType: 'json',
    success: function(json) {
      alert("OK!");
      for (var i = json.length - 1; i >= 0; i--) {
        console.log(json[i]['Shout']);
        console.log(json[i]['User']);
        alert("username:" + json[i]['User']['username']);
        
      }
    },
    error: function(json) {
      window.alert('正しい結果を得られませんでした。');
    }
  });

  console.log(timeline_from);
}

