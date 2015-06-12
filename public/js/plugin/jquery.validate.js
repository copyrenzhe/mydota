/*!
 * jQuery Validation Plugin v1.13.2-pre
 *
 * http://jqueryvalidation.org/
 *
 * Copyright (c) 2015 Jörn Zaefferer
 * Released under the MIT license
 */
(function( factory ) {
    if ( typeof define === "function" && define.amd ) {
        define("jquery.validate",["jquery", "jquery.validate.core"], factory );
    } else {
        factory( jQuery );
    }
}(function( $ ) {

  /**
   * 英文和空格
   */
  $.validator.addMethod('enCode',function(value,element,param){
    return this.optional(element) || !/[^a-zA-Z\s]/.test(value);
  },$.validator.format("请输入英文字符"));

  /**
   * 中文和空格
   */

  $.validator.addMethod('zhCode',function(value,element,param){
    return this.optional(element) || /^[\u2E80-\u9FFF\s]+$/.test(value);
  },$.validator.format("请输入中文字符"));

  /**
   * 手机号码
   */
  $.validator.addMethod('mobile',function(value,element,param){
    return this.optional(element) || /^\+?(86)?-?1\d{10}$/.test(value);
  },$.validator.format("请输入正确的手机号码"));

  /**
   * 固定电话(加区号)
   */
  $.validator.addMethod('phone',function(value,element,param){
    return this.optional(element) || /^(\d{3,4}-?)?\d{8}$/.test(value);
  },$.validator.format("请输入固定电话号码"));

  /**
   * 手机或固话
   */
  $.validator.addMethod('mobilePhone',function(value,element,param){
    return this.optional(element) || /^\+?(86)?-?1\d{10}$/.test(value) || /^(\d{3,4}-?)?\d{8}$/.test(value);
  },$.validator.format("请输入手机或固定电话号码"));

  /**
   * CSA编号
   */
  $.validator.addMethod('casCode',function(value,element,param){
    return this.optional(element) || /^\d+\-\d+\-\d+$/.test(value);
  },$.validator.format("请输入正确的CSA编号"));


  /* 中文 
   * Translated default messages for the jQuery validation plugin.
   * Locale: ZH (Chinese, 中文 (Zhōngwén), 汉语, 漢語)
   */
  $.extend($.validator.messages, {
    required: "这是必填字段",
    remote: "请修正此字段",
    email: "请输入有效的电子邮件地址",
    url: "请输入有效的网址",
    date: "请输入有效的日期",
    dateISO: "请输入有效的日期 (YYYY-MM-DD)",
    number: "请输入有效的数字",
    digits: "只能输入数字",
    creditcard: "请输入有效的信用卡号码",
    equalTo: "你的输入不相同",
    extension: "请输入有效的后缀",
    maxlength: $.validator.format("最多可以输入 {0} 个字符"),
    minlength: $.validator.format("最少要输入 {0} 个字符"),
    rangelength: $.validator.format("请输入长度在 {0} 到 {1} 之间的字符串"),
    range: $.validator.format("请输入范围在 {0} 到 {1} 之间的数值"),
    max: $.validator.format("请输入不大于 {0} 的数值"),
    min: $.validator.format("请输入不小于 {0} 的数值")
  });

  /**
   * 设置默认值
   */
  var defaultsHighlight = $.validator.defaults.highlight;
  $.validator.setDefaults({
    ignore : ".ignore",
    errorClass : "validate-error",
    success : function(label){
      //验证成功设置class并添加fa-check图标
      label.addClass('validate-success');
    },
    errorPlacement : function(error,element){
      element.parent().append(error);
    },
    highlight : function(el,errorClass){
      var $el = $(el);
      $el.siblings("."+errorClass).removeClass('validate-success');
      defaultsHighlight.apply(this,arguments);
    }
  });
  return $;
}));