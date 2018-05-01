// $(document).ready(function(){
// myMap();
// });

var ioTurnChecks = setInterval(checkForNewData, 1000);
var dbCheck = setInterval(inserttoDb, 1000);
// var freqCheck = setInterval(countDb,1000);
var prevFeeds = 0;



function playAudio(){ //play alert audio
	var x = document.getElementById("alertAudio");
		x.play();
		x.loop = false;
}

function stopAudio(){ 
	var x = document.getElementById("alertAudio");
		x.pause();
        x.currentTime = 0;
}

function inserttoDb(){
    $.ajax({
        type : "post",  //type of method
        url  : "process/dataLog.php",  //your page
        cache: false,
        success: function(res){  
                console.log("done");    //do what you want here...
           }    
    });
} 

function countDb(){
    $.ajax({
        type : "post",  //type of method
        url  : "process/frequency.php",  //your page
        cache: false,
        success: function(res){  
                console.log("done");    //do what you want here...
           }    
    });
}
 
function checkForNewData(){
	$.ajax({
		url: 'https://api.thingspeak.com/channels/344468/feeds.json',
		method: 'get',
		dataType: 'json',
		success: function(data){
			var feeds = data['feeds'];
			checkLastData(feeds[feeds.length-1]);
				prevFeeds = feeds.length;		
		}
	});
}


function checkLastData(data){

	var dateData = data['created_at'];
	var newData = data['field3'];
	var force = data['field1'];

	var data = moment(dateData);
	var localTime = moment.utc(data).toDate();
	localTime = moment(localTime).format('YYYY-MM-DD HH:mm');

	console.log(localTime);
	console.log(force);
	console.log(newData);
	
			if(newData == 'true'){
				$(".display-warning").removeClass('d-md-none');
				$(".display-info").addClass('d-md-none');
				icons(google.maps.Animation.BOUNCE, "img/close.png");
				playAudio();
			}
			else if (newData == 'camel'){
				$(".display-activate").removeClass('d-md-none');
				$(".display-info").addClass('d-md-none');  
				icons(google.maps.Animation.BOUNCE, 'img/close.png');
				playAudio();	 			
			}
			else if (newData == 'dog'){
				$(".display-info").addClass('d-md-none');
				$(".display-reset").removeClass('d-md-none');
	   			$(".display-activate").addClass('d-md-none');
	   			$(".display-warning").addClass('d-md-none');	
			}
			else if (newData == 'false'){
				$(".display-warning").addClass('d-md-none');
				$(".display-info").removeClass('d-md-none');
				$(".display-activate").addClass('d-md-none');
				$(".display-reset").addClass('d-md-none');
				icons();
				stopAudio(); 
			} 
}


function overRide(val){ //admin deactivate //dog
	$.post("https://api.thingspeak.com/update.json",{
    api_key: "QSWRP52P95YFEAI0",
    field3: val.value
    },
    function(event){
	    	$(this).remove();
	   		$(".display-reset").removeClass('d-md-none');
	   		$(".display-warning").addClass('d-md-none');
	  	 	icons();	
	  	 	stopAudio(); 
    });
}

function adminOverride(val){ //dog 
	$.post("https://api.thingspeak.com/update.json",{
		api_key: "QSWRP52P95YFEAI0",
		field3: val.value
	},
	function(event){
		$(this).remove();
		$(".display-reset").removeClass('d-md-none');
	   	$(".display-activate").addClass('d-md-none');
	 	icons();	
	  	stopAudio(); 		
	});
}

function overrideActivate(val){ //admin activate //camel
	$.post("https://api.thingspeak.com/update.json",{
    api_key: "QSWRP52P95YFEAI0",
    field3: val.value
    },
    function(event){
  		$(this).remove();
   		$(".display-activate").removeClass('d-md-none');
   		$(".display-info").addClass('d-md-none');
  	 	icons(google.maps.Animation.BOUNCE, 'img/close.png');
		playAudio();
    });
}

function reset(){ //reset
	$.post("https://api.thingspeak.com/update.json",{
    api_key: "QSWRP52P95YFEAI0",
    field3: false
    },
    function(event){
  	 $(".display-reset").addClass('d-md-none');
  	 $(".display-info").removeClass('d-md-none');
  	 icons();
 });
}


