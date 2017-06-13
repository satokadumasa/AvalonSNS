<h1><!----value:action_name----></h1>
<form action="<!----value:document_root---->Shout/save/" method="post">
  Shout user_id<input type="text" name="Shout[user_id]" length="8" value="<!----value:Shout:user_id---->"><br>
  Shout outline<input type="text" name="Shout[outline]" length="254" value="<!----value:Shout:outline---->"><br>
  Shout detail<input type="text" name="Shout[detail]" length="2000" value="<!----value:Shout:detail---->"><br>
  <input type="submit" name="bottom">
</form>
#Write contents here#<br>
StrangerPHP デフォルトホームページ<br>
ここにコンテンツを追記していってください。<br>
<div class="details">
  <h1>User List</h1>
  <!----iteratior:Shouts:start---->
<div class="detail">
  <div class='detail_rows'>
    <div class='label_clumn'>
      Outline
    </div>
    <div class='input_clumn'>
      <!----value:Shout:outline---->
    </div>
  </div>
  <div class='detail_rows'>
    <div class='label_clumn'>
      Detail
    </div>
    <div class='input_clumn'>
      <!----value:Shout:detail---->
    </div>
  </div>
  <div class='detail_rows'>
    <div class='label_clumn'>
      email
    </div>
    <div class='input_clumn'>
      <!----value:Shouts:email---->
    </div>
  </div>
</div>
<div class="detail_menu">

