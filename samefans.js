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
function percentage(n){
  return (n*100).toFixed(2)+"%";
} 
function calcIntersection(){
    var user0Ids = JSON.parse($('#user-0-name').attr('data-fans')).ids;
    var user1Ids = JSON.parse($('#user-1-name').attr('data-fans')).ids;
    var intersection = _.intersection(user0Ids, user1Ids);
    $('#user-0-fans').text(user0Ids.length);
    $('#user-1-fans').text(user1Ids.length);
    $('#common-fans').text(intersection.length);
    $('#common-fans-user-0-percentage').text(percentage(intersection.length/user0Ids.length));
    $('#common-fans-user-1-percentage').text(percentage(intersection.length/user1Ids.length));
    $('#content').css('display','block');
}
$(function (){
  $('#user-0-name').watermark('在此填入用户名');
  $('#user-1-name').watermark('在此填入用户名');
  _.after(1, calcIntersection);
  $('#load').click(function(e){
    $('.user-0-name').text($('#user-0-name').val());
    $('.user-1-name').text($('#user-1-name').val());
    loadFans('#user-0-name');
    loadFans('#user-1-name');
    e.preventDefault();
    e.stopPropagation();
  });
});
