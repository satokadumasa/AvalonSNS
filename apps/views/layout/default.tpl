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
<script type="text/javascript">
$(document).ready(function() {
  $('#tl_top').on('click', function(event) {
    getTimeline(this);
  });
  $('#post_shout').on('click', function(event) {
    alert("postShout");
    postShout();
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