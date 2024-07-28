(function($){
    $(document).ready(function() {
        $('.post-type-page .acf_postbox').hide(0);
        $('#acf_acf_page-header').show(0);
        $('#acf_acf_contact').show(0);
        $('#acf_acf_portfolio').show(0);
        $('.button-zone.button-primary').each(function(a,b) {
            $("#acf_"+$(b).data('zone')).show(0);
        });
        
        $('.button-zone').mouseover(function(evt) {
                var pos = $(this).position();
                var width = $(this).width();
                $('.preview-zone').stop().fadeIn("slow");
                $('.preview-zone').css('top',pos.top-100);
                //$('.preview-zone').css('left',pos.left+width);
                $('.preview-zone').css('left',pos.left-width);
                //IMAGE
                var image_load = $(evt.currentTarget).data('zone');
                var image_dir = $('.preview-zone').data('dir');
                $('.preview-img').css('background-image','url('+image_dir+'/inc/custom-zones/image-zones/'+image_load+'.jpg)');                
        });
        $('.button-zone').mouseout(function(evt) {
                $('.preview-zone').stop().hide(0);
        });
        
        $('.button-zone').click(function(evt) {
            evt.preventDefault();

            var
                btn = $(evt.currentTarget).toggleClass('button-primary'),
                zone = btn.data('zone'),
                actives = $("#custom-zones-actives").val().split("|");
            
            if (btn.hasClass('button-primary')) {
                $("#acf_"+zone).slideDown();
                actives = actives.concat(zone);
            } else {
                $("#acf_"+zone).slideUp();    
                actives.splice(actives.lastIndexOf(zone),1);
            }
            
            $("#custom-zones-actives").val(actives.join("|"));
            return false;
        })
        
    });

})(jQuery);