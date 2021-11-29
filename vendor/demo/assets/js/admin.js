(function($) {
    "use strict";

    $(document).ready(function() {

        var import_running = false;
        $('.btn-import-xml').click(function(){
          if (import_running) return false;
            var el = $(this);
            var demo_name   = el.data('id');
            var frontpage   = el.data('front');
            var directory   = el.data('dir');
            var demo_holder = el.parent().parent();
            var importqueue = [],
            processqueue = function(){
              if (importqueue.length != 0){
                var importaction = importqueue.shift();
                $.ajax({
                  type: 'POST',
                  url: janelove.ajax_url,
                  data: {
                    action: importaction,
                    name: demo_name,
                    frontpage: frontpage,
                    directory: directory,
                  },
                  success: processqueue
                });
              } 
              else {
                demo_holder.removeClass('running');
                 setTimeout(function(){ window.location = janelove.site_url; }, 2000);
                import_running = false;
              }
            };

          importqueue.push('niobis_clean_data');  
          importqueue.push('niobis_import_data');
          importqueue.push('niobis_import_options');

          if (importqueue.length == 0) return false;

          import_running = true;
          demo_holder.addClass('running');          
          processqueue();

          return false;
        });

    });

})(jQuery);