$( document ).ready(function() {
    console.log( "ready!" );

    $(".date-field").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
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
    $('.cpf-field').mask("999.999.999-99");
});
