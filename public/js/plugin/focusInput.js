define('jquery.focusInput',['jquery','jquery.easing'],function($){

  var $body = $(document.body);

  var focusInput = {
    options : {
      inited:false,
      disabled : false,
      ignore: "ignore-focus",
      fx : {
        duration : 600,
        easing : 'easeOutExpo',
        done : function(){
          $(this).remove();
        }
      }
    },
    init : function(param){
      var _this = this;
      if(this.options.inited) return;
      this.options.inited = true;
      $.extend(true,this.options,param);
      $body.on('focus.focusInput','input[type=text],input[type=password],select,textarea',function(e){
        if(_this.options.disabled) return;
        var $tar,$pre,tar,pre;
        $tar = $(e.target);
        $pre = $(e.relatedTarget);
        if($tar.hasClass(_this.options.ignore)) return;
        setTimeout(function(){
          tar = _this.getCss($tar);
          if($pre.length>0){
            pre = _this.getCss($pre);
          }else{
            pre = _this.getCss($tar,1.6);
          }
          pre.opacity = 0;
          tar.opacity = 1;
          _this.animate(tar,pre);
        },0);
      });
    },
    animate : function(tar,pre,other){
      var $el = $('<div>').appendTo(document.body);
      pre.position = 'absolute';
      pre.cursor = 'text';
      pre.border = tar.border;
      $el.css(pre);
      $el.animate(tar,this.options.fx);
    },
    getCss : function($el,times){
      times = times || 1;
      var offset,size,borderWidth;
      offset = $el.offset();
      borderWidth = parseInt($el.css('borderTopWidth'));
      size = {
        width:$el.outerWidth()-borderWidth*2,
        height:$el.outerHeight()-borderWidth*2
      }
      return {
        zIndex:100000,
        width:size.width*times,
        height:size.height*times,
        left:offset.left-size.width*(times-1)/2,
        top:offset.top-size.height*(times-1)/2,
        border:$el.css('borderTopWidth')+" "+$el.css('borderTopStyle')+" "+$el.css('borderTopColor'),
        borderRadius:$el.css('borderTopLeftRadius')
      }
    },
    enable : function(){
      this.options.disabled = false;
    },
    disabled : function(){
      this.options.disabled = false;
    }
  }

  $.extend({
    focusInput : function(param){
      param = param || {};
      if($.type(param) == "object"){
        focusInput.init(param);
      }
      if($.type(param) == "string"){
        $.type(focusInput[param] == "function") && focusInput[param]();
      }
    }
  });
  return $;

});
