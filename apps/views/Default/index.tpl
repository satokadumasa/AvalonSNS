<h1><!----value:action_name----></h1>
<form action="<!----value:document_root---->Shout/save/" method="post">
  <input type="hidden" name="Shout[user_id]" size="8" length="8" value="<!----value:Shout:user_id---->"><br>
  ■概要<br />
  <textarea name="Shout[outline]" cols="80" rows="1"><!----value:Shout:outline----></textarea><br />
  ■詳細<br />
  <textarea name="Shout[detail]" cols="80" rows="10"><!----value:Shout:detail----></textarea><br />
  <input type="submit" name="bottom">
</form>
<div class="details">
  <h1>タイムライン</h1>
  <!----iteratior:Shouts:start---->
  <div class="detail">
    <div class='detail_rows'>
      <div class='label_clumn'>
        Name
      </div>
      <div class='input_clumn'>
        <!----value:Shout:UserInfo:name---->
      </div>
      <div class='label_clumn'>
        Photo
      </div>
      <div class='input_clumn'>
        <img src="/images/profile_photos/<!----value:Shout:UserInfo:user_id---->/<!----value:Shout:UserInfo:profile_photo---->">
      </div>
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
  <!----iteratior:Shout:end---->
</div>

