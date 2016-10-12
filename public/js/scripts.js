jQuery(document).ready(function($) {

  "use strict";

  // Form validation
  function validateName(data) {
    var reg = /^[_a-zA-Z0-9абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ ]+$/;
    return reg.test(data);
  }
  function validateEmail(data) {
    var reg = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
    return reg.test(data);
  }
  function validateUrl(data) {
    var reg = /(https?:\/\/)?(www\.)?([-а-яa-zёЁцушщхъфырэчстью0-9_\.]{2,}\.)(рф|[a-z]{2,6})((\/[-а-яёЁцушщхъфырэчстьюa-z0-9_]{1,})?\/?([a-z0-9_-]{2,}\.[a-z]{2,6})?(\?[a-z0-9_]{2,}=[-0-9]{1,})?((\&[a-z0-9_]{2,}=[-0-9]{1,}){1,})?)/i;
    return reg.test(data);
  }
  $("#send-form").submit(function () {
    var inputName = $("#inputName"),
      inputEmail = $("#inputEmail"),
      inputUrl = $("#inputUrl"),
      inputMsg = $("#inputMsg"),
      inputCaptcha = $("#inputCaptcha");
    var status1 = false,
      status2 = false,
      status3 = true,
      status4 = false;
    if(validateName(inputName.val())){
      inputName.removeClass("invalid");
      inputName.addClass("valid");
      status1 = true;
    } else {
      inputName.removeClass("valid");
      inputName.addClass("invalid");
      status1 = false;
    }
    if(validateEmail(inputEmail.val())){
      inputEmail.removeClass("invalid");
      inputEmail.addClass("valid");
      status2 = true;
    } else {
      inputEmail.removeClass("valid");
      inputEmail.addClass("invalid");
      status2 = false;
    }
    if(inputUrl.val() != ""){
      if(validateUrl(inputUrl.val())){
        inputUrl.removeClass("invalid");
        inputUrl.addClass("valid");
      } else {
        inputUrl.removeClass("valid");
        inputUrl.addClass("invalid");
        status3 = false;
      }
    }
    if(inputCaptcha.val() == ""){
      inputCaptcha.removeClass("valid");
      inputCaptcha.addClass("invalid");
      status4 = false;
    } else {
      inputCaptcha.removeClass("invalid");
      inputMsg.addClass("valid");
      status4 = true;
    }
    if(!status1 || !status2 || !status3 || !status4){
      return false;
    }
  });

  // Captcha
  $('#refresh').on('click',function(){
    var captcha = $('img.captcha-img');
    var config = captcha.data('refresh-config');
    $.ajax({
      method: 'GET',
      url: '/get_captcha/' + config,
    }).done(function (response) {
      captcha.prop('src', response);
    });
    return false;
  });

  // Editor
  var editor = CKEDITOR.replace( 'inputMsg',{
    filebrowserBrowseUrl : '/elfinder/ckeditor'
  } );

  // Tabs
  $(".nav-tabs a").click(function(e){
    e.preventDefault();
    $(this).tab('show');
  });

});