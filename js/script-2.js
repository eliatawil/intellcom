(function($) {

  $.fn.menumaker = function(options) {
      
      var menu_mobile = $(this), settings = $.extend({
        title: "Menu",
        format: "dropdown",
        sticky: false
      }, options);

      return this.each(function() {
        menu_mobile.prepend('<div id="menu-button">' + settings.title + '</div>');
        $(this).find("#menu-button").on('click', function(){
          $(this).toggleClass('menu-opened');
          var mainmenu = $(this).next('ul');
          if (mainmenu.hasClass('open')) { 
            mainmenu.hide().removeClass('open');
          }
          else {
            mainmenu.show().addClass('open');
            if (settings.format === "dropdown") {
              mainmenu.find('ul').show();
            }
          }
        });

        menu_mobile.find('li ul').parent().addClass('has-sub');

        multiTg = function() {
          menu_mobile.find(".has-sub").prepend('<span class="submenu-button"></span>');
          menu_mobile.find('.submenu-button').on('click', function() {
            $(this).toggleClass('submenu-opened');
            if ($(this).siblings('ul').hasClass('open')) {
              $(this).siblings('ul').removeClass('open').hide();
            }
            else {
              $(this).siblings('ul').addClass('open').show();
            }
          });
        };

        if (settings.format === 'multitoggle') multiTg();
        else menu_mobile.addClass('dropdown');

        if (settings.sticky === true) menu_mobile.css('position', 'fixed');

        resizeFix = function() {
          if ($( window ).width() > 768) {
            menu_mobile.find('ul').show();
          }

          if ($(window).width() <= 768) {
            menu_mobile.find('ul').hide().removeClass('open');
          }
        };
        resizeFix();
        return $(window).on('resize', resizeFix);

      });
  };
})(jQuery);

(function($){
$(document).ready(function(){

$("#menu_mobile").menumaker({
   title: "Menu",
   format: "multitoggle"
});

});
})(jQuery);
