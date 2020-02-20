(function ($) {
 "use strict";
 
	// Datepickers
		$('#start').datepicker({
			dateFormat: 'yy-mm-dd',
			prevText: '<i class="fa fa-chevron-left"></i>',
			nextText: '<i class="fa fa-chevron-right"></i>',
			onSelect: function( selectedDate )
			{
				$('#finish').datepicker('option', 'minDate', selectedDate);
			}
		});
		$('#finish').datepicker({
			dateFormat: 'yy-mm-dd',
			prevText: '<i class="fa fa-chevron-left"></i>',
			nextText: '<i class="fa fa-chevron-right"></i>',
			onSelect: function( selectedDate )
			{
				$('#start').datepicker('option', 'maxDate', selectedDate);
			}
		});

    $('#dated').datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });
    $('#dated1').datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });
    $('#dated2').datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });


    $('#dated3').datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });


    $('#dated4').datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });

    $('#dated5').datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });
    $('#dated6').datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });
    $('#dated7').datepicker({
        dateFormat: 'yy',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });
    $('#dated8').datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });
    $('#dated9').datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>'
    });


})(jQuery); 
