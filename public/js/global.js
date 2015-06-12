//直接加载browser模块,实现快速的pace
require(['browser'],function(browser){
  //ie9以上开启进度条
  if(browser>9){
    require(['pace'],function(Pace){Pace.start();});
  }
  if(browser<7){
    //开启ie6兼容
    require(['ie6'],function(){});
  }
  if(browser>7){
    //开启input focus追踪
    require(['jquery.focusInput'],function($){$.focusInput();});
  }
});