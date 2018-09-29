
jQuery(function($) {
  $('#register').on('submit', function(event) {
    if ( validateForm() ) { // если есть ошибки возвращает true
      event.preventDefault();
    }
  });
  
  function validateForm() {
    $(".text-error").remove();
    
    // Проверка имени    
    var el_l    = $("#login");
    if ( el_l.val().length < 4 ) {
      var v_login = true;
      el_l.after('<span class="text-error for-login">Имя должно быть больше 3 символов</span>');
      $(".for-login").css({top: el_l.position().top + el_l.outerHeight() + 2});
    } 
    $("#login").toggleClass('error', v_login );
    
    // Проверка e-mail
    
    var reg     = /^\w+([\.-]?\w+)*@(((([a-z0-9]{2,})|([a-z0-9][-][a-z0-9]+))[\.][a-z0-9])|([a-z0-9]+[-]?))+[a-z0-9]+\.([a-z]{2}|(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum))$/i;
    var el_e    = $("#email");
    var v_email = el_e.val()?false:true;
  
    if ( v_email ) {
      el_e.after('<span class="text-error for-email">Поле e-mail обязательно к заполнению</span>');
      $(".for-email").css({top: el_e.position().top + el_e.outerHeight() + 2});
    } else if ( !reg.test( el_e.val() ) ) {
      v_email = true;
      el_e.after('<span class="text-error for-email">Вы указали недопустимый e-mail</span>');
      $(".for-email").css({top: el_e.position().top + el_e.outerHeight() + 2});
    }
    $("#email").toggleClass('error', v_email );
    
   
    
    return ( v_login || v_email  );
  }
   
});
 