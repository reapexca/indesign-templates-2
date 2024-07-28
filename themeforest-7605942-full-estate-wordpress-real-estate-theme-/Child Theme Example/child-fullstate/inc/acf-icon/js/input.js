/*
*  Icon
*
*  @description: 
*  @since: 3.5.8
*  @created: 17/01/13
*/

(function($){
	
    jQuery(document).ready(function($) {
      // Code using $ as usual goes here.
      jQuery('.acf-icon-wrap .slide-right').live('click',function(evt){
            evt.stopPropagation();
            var slide = $('#'+$(this).data('attach'));
            
            slide.scrollLeft(slide.scrollLeft()+145);            
        });
        
        jQuery('.acf-icon-wrap .slide-left').live('click',function(evt){
            evt.stopPropagation();
            var slide = $('#'+$(this).data('attach'));
            
            slide.scrollLeft(slide.scrollLeft()-145);            
        });
        
        jQuery('.icon-cloude').live('click',function(evt){                    
                var icon = $(this),
                    input = $('#'+icon.data('input')),
                    select = $('#'+icon.data('input')+'-sel i');
                
                icon.parent().find('.icon-cloude').removeClass('icon-selected');
                icon.addClass('icon-selected');                    
                input.val(icon.children('i').attr('class'));
                select.removeClass().addClass(icon.children('i').attr('class'))           ;               
            });
    });
})(jQuery);
