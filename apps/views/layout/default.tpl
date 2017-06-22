<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><!----value:Title----></title>
<link rel="stylesheet" href="<!----value:document_root---->css/default.css">
<link rel="stylesheet" href="<!----value:document_root---->css/dropmenu.css">
<link rel="stylesheet" href="<!----value:document_root---->css/timeline.css">
<script src="<!----value:document_root---->js/jquery-3.2.0.js"></script>
<script src="<!----value:document_root---->js/timeline.js"></script>
<script src="<!----value:document_root---->js/user_list.js"></script>
<script type="text/javascript">
var document_root = '<!----value:document_root---->';
var friend_ids = <!----value:friend_ids---->;
var my_id = <!----value:my_id---->;
$(document).ready(function() {
  var tl_top = null;
  $('#tl_top').on('click', function(event) {
    getTimeline(this, 'future');
  });
  $('#post_shout').on('click', function(event) {
    postShout();
  });
  if($('#tl_top')[0]) getTimeline(null, 'future');
  if($('#user_list_top')[0]) getUserList(null);

  $('#line_bottom').on('mouseover', function(event) {
    if($('#tl_top')[0]) getTimeline(this, 'past');
    if($('#user_list_top')[0]) getUserList(null);
  });
});
</script>
</head>
<body>
<div class="root">
  <!----renderpartial:common/top_menu:top_menu---->
  <!----renderpartial:common/side_menu:side_menu---->
  <div class="contents">
  <!----renderpartial:CONTROLLER/ACTION:datas---->
  </div>
  <!----renderpartial:common/footer:footer---->
</div>
</body>
</html>