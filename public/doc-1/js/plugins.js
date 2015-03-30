// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.

(function($){
    
        $.callBack =  function(options) {
        
            if(options!=null){
                if(options.message!=null)alert(options.message);
                if(options.fonction!=null && options.redirection==null)eval(options.fonction);
                
                if(options.redirection!=null){
                $.ajax({
                      url: options.redirection,
                      type:"GET",
                      success: function(response) {
                          $((options.section==null?'#content':options.section)).html(response);
                          if(options.fonction!=null)eval(options.fonction);
                      }
                    });
                }
                
            }
        }
        
        $.method =  function(options) {
                var defaults = {
                    url: function(){},
                    success: $.callBack
                    
                }
                    
                var options = $.extend(defaults, options);
            
                    var o = options;
                   
                    $.ajax({
                      url: o.url,
                      type:"POST",
                      contentType: 'application/json',
                      dataType: 'json',
                      data:$.toJSON(o),
                      success: function(response) {
                          o.success(eval(response.d));
                      }
                    });
            
        }
    
    
    
    $.fn.extend({     
       enter: function (option){
            return this.each(function() {
                var obj = $(this);
                obj.keydown(function(event){
                if(event.keyCode == 13){
                    option();
                    return false;
                }
                });
            });
       }
       
        });
        
    })(jQuery);