$(document).ready(function () {
         $('#games').hide();
      });

      $('.standingslistlink').click(function() {
         $('#games').hide('slow', function() {
         });
         $('#standings').show('slow', function() {
         });
      });
      $('.gameslistlink').click(function() {
         $('#standings').hide('slow', function() {
         });
         $('#games').show('slow', function() {
         });
      });
      
      $(document).ready(function () {
         $('.selectround').change(function () {
            //hide all possible values
            // first get the elements into a list
            var domelts = $('.selectround option');
            // next translate that into an array of just the values
            var posValues = $.map(domelts, function(elt, i) { return $(elt).val();});
            for(var j=0; j < posValues.length; j++)
            {   
               var round = ".gameround" + posValues[j];
               $(round).hide();
            }

            var str = "";
            var roundStr = "";
            $('.selectround option:selected').each(function () {
                str += $(this).text() + "";
            });
            roundStr = ".gameround" + str;
            //display selected round
            $(roundStr).show();
         })
            .change();
      })