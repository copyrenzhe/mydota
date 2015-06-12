define('browser',function(){
  var arr = navigator.userAgent.match(/msie.(\d+)/i);
  return !arr ? 100 : arr[1];
});
