// var ourRequest = new XMLHttpRequest();
// 	ourRequest.open('GET', 'https://api.thingspeak.com/channels/344468/feeds.json');
// 	ourRequest.onload = function(){
// 	var ourData = JSON.parse(ourRequest.responseText);
// 	console.log(ourData);
// 	};

// 	ourRequest.send();

$(document).ready(function(){
	reload();

});

$.ajax({
	url: 'js/_dataAlert.js',
	dataType: 'script',
	success: 'success'
});

function reload(){
	setTimeout( function () { 
	destroyTable();
	newTable();
	}, 1000);
}

function destroyTable(){
	table = $('#dataTable').DataTable( {
    retrieve: true,
    paging: false
	} );
	table.destroy();
}


function newTable(){
    $("#dataTable").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "process/historyLog.php",
        "order": [[0, "desc"]]
    });

    // setInterval(function(){
    //     table.ajax.reload(true,false);
    // },1000);
}

// function newTable(){		
// 	var table = $('#dataTable').DataTable( { //start
//     ajax: {
//         url: 'https://api.thingspeak.com/channels/344468/feeds.json',
//         dataSrc: 'feeds'
//     },
// 		columns: [
// 			{data: 'created_at',
// 				"render":
// 					function( data, type, row, meta){
// 						var ThisDate = moment(data).format("MMMM D, YYYY h:mm A");
// 						return ThisDate; //format ISO 8601
// 				}
// 			},
//             {data: 'field1'},
// 			{data: 'field3'}
// 	],
// 	"order": [[0, "desc"]], //order to desc
// 	}); //end

// 	$.fn.dataTableExt.afnFiltering.push(
// 		function(oSettings, aData, iDataIndex){
// 			var data = aData[2].indexOf('true')>-1; //filter data with true value on column 1
// 			return data;
// 			}
// 		)
// 	setInterval (function(){ //loads data without refresh
// 		table.ajax.reload(null,false);
// 	}, 1000);

// }



(function( factory ) {
    "use strict";
    if ( typeof define === 'function' && define.amd ) {
        // AMD
        define( ['jquery'], function ( $ ) {
            return factory( $, window, document );
        } );
    }
    else if ( typeof exports === 'object' ) {
        // CommonJS
        module.exports = function (root, $) {
            if ( ! root ) {
                root = window;
            }
            if ( ! $ ) {
                $ = typeof window !== 'undefined' ?
                    require('jquery') :
                    require('jquery')( root );
            }
            return factory( $, root, root.document );
        };
    }
    else {
        // Browser
        factory( jQuery, window, document );
    }
}

(function( $, window, document ) {
 
 
$.fn.dataTable.render.moment = function ( from, to, locale ) {
    // Argument shifting
    if ( arguments.length === 1 ) {
        locale = 'en';
        to = from;
        from = 'YYYY-MM-DD';
    }
    else if ( arguments.length === 2 ) {
        locale = 'en';
    }
 
    return function ( d, type, row ) {
        var m = window.moment( d, from, locale, true );
 
        // Order and type get a number value from Moment, everything else
        // sees the rendered value
        return m.format( type === 'sort' || type === 'type' ? 'x' : to );
    };
};
 
 
}));