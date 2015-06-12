define('ie6',['jquery','DD_belatedPNG'],function($,DD_belatedPNG){
  //ie6兼容
  $(function(){
    //png透明
    DD_belatedPNG.fix('img,.png');
    //背景不缓存
    try{
      document.execCommand("BackgroundImageCache", false, true);
    }catch(e){}
    //开启ie6 全局hover功能
    $(document.body).on('mouseenter','.ie-hover',function(){
      $(this).addClass('hover')
    }).on('mouseleave','.ie-hover',function(){
      $(this).removeClass('hover')
    });
    //兼容ie6 label下的radio,checkbox失效bug
    $(document.body).on('click','label',function(e){
      var $target = $(e.target);
      if($target.prop('tagName') == "INPUT"){
        e.stopPropagation();
        return;
      };
      var $this = $(this);
      var $input = $this.children('input');
      if($input.length){
        $input.trigger('click');
      }
    });

  });
});