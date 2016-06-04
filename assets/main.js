$( document ).ready(function() {
    console.log( "ready!" );

    $(".date-field").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
    $('.cpf-field').mask("999.999.999-99");
    $('.cep-field').mask("99.999-999");
    $('.phone-field').focusout(function(){
      var phone, element;
      element = $(this);
      element.unmask();
      phone = element.val().replace(/\D/g, '');
      if(phone.length > 10) {
          element.mask("(99) 99999-999?9");
      } else {
          element.mask("(99) 9999-9999?9");
      }
    }).trigger('focusout');

    


});
jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();
