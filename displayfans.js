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
    $('#loading').css('display','none');
}

$(function (){
  $('#user-0-name').watermark('在此填入用户名');
  $('#user-1-name').watermark('在此填入用户名');
  $('#load').click(function(e){
    _.after(1, calcIntersection);
    $('#loading').css('display','block');
    $('#content').css('display','none');
    $('.user-0-name').text($('#user-0-name').val());
    $('.user-1-name').text($('#user-1-name').val());
    loadFans('#user-0-name');
    loadFans('#user-1-name');
    e.preventDefault();
    e.stopPropagation();
  });
});
