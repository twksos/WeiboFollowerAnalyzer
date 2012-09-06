function loadFans(userNameInput){
  $.ajax({
    url: "http://weiboapp.twksos.com/followers_ids.php?name=" + $(userNameInput).val()
  }).done(function(data) {
    fans = JSON.parse(data);
    if(fans.error){
      alert('错误：'+fans.error);
    } else {
      if(fans.next_cursor == 0){
        $(userNameInput).attr('data-fans',data);
        calcIntersection();
      }else {
        alert('暂不支持5000粉丝以上的用户。');
      }
    }
  });
}