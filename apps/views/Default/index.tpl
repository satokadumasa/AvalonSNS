<h1><!----value:action_name----></h1>
<form action="<!----value:document_root---->Shouts/getShoutsWithJson/" method="post" id="shout_from">
  <input type="hidden" name="Shout[user_id]" size="8" length="8" value="<!----value:Shout:user_id---->"><br>
  ■概要<br />
  <textarea name="Shout[outline]" cols="80" rows="1"><!----value:Shout:outline----></textarea><br />
  ■詳細<br />
  <textarea name="Shout[detail]" cols="80" rows="10"><!----value:Shout:detail----></textarea><br />
  <input type="button" name="bottom" id="post_shout" value="投稿">
</form>
<form name="get_timeline" id="get_timeline">
  <input type="hidden" name="from" id="timeline_from" value="<!----value:timeline_from---->">
  <input type="hidden" name="limit" id="timeline_limit">
  <input type="hidden" name="target" id="target" value="newer">
</form>
<form name="follow_change" id="follow_change">
  <input type="hidden" name="friend_id" id="friend_id">
</form>
<div class="shouts">
  <h1>タイムライン</h1>
  <div id="tl_top">
    新規発言読み込み
  </div>
  <div id="line_bottom">さらに読み込む</div>
</div>

