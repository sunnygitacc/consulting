/* 
 * doc will have functions that commenly used all along the pgm
 * Auther sandeep
 */

        /*
         * define global js variables
         */
    
        //var baseUrl = document.location.origin+"/wizspeakv3";
        ///var baseUrl = "http://192.168.1.6/wizspeakv3";
        var app_name = 'wizspeakv254';
        var baseUrl = 'http://localhost/wizspeakv254/'
        
        var $supported_VIdeo_Filetype = ['video/mp4', 'video/MP4', 'video/x-flv', 'video/FLV', 'video/avi', 'video/AVI', 'video/mov',
        'video/MOV', 'video/mpeg', 'video/MPEG', 'video/MPG', 'video/x-ms-asf', 'video/mpg', 'video/x-ms-wmv',
        'video/X-MS-WMV', 'video/3gpp', 'video/3GPP', 'video/wpl', 'video/WPL', 'video/quicktime', 'video/QUICKTIME', 'video/WPL', 'video/x-matroska'];
        var $supported_Image_Filetype = ['image/png', 'image/PNG', 'image/jpeg', 'image/JPEG', 'image/jpg', 'image/JPG', 'image/gif', 'image/JIF', 'image/bmp', 'image/BMP'];

        $supported_Audio_Filetype = ['audio/aiff','audio/AIFF','audio/au','audio/AU','audio/mid','audio/MID','audio/midi','audio/midi',
        'audio/mp3','audio/MP3','audio/WAV','audio/wav','audio/wma','audio/WMA','audio/mpeg','audio/MPEG'];

        $supported_Doc_Filetype = ['application/pdf','text/plain','application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-powerpoint','application/vnd.ms-excel'];
    
        
        //var baseUrl = "http://192.168.1.6/wizspeakv3/";
        var url = window.location.pathname;
        
        var user_id = 0;
        
        //ajax call with feed back call 
        var callAjax = function (data,url,nextFun) {
	  this.data = data;
	  this.url = url;
	  this.nextFun = nextFun;
	};
	
	callAjax.prototype.fire = function() {
           var callback = this.nextFun;
	   $.ajax({
                        type: "POST",
                        url: baseUrl + this.url,
                        data: this.data,
                        dataType: "JSON",
                        complete : function(response){
                          
                            window[callback](response.responseText);
                        }

	   });
	   
	};
        

        
        
    //infinate scroll commen fun
    //new callAjax(data,'/userprofiles/update_about_me','NewCallFun').fire();
    //new InfinateScrollFun('id','class','NewCallFun').fire();
    	var InfinateScrollFun = function (container,repeator,callBack) {
	  this.container = container;
	  this.repeator = repeator;
	  this.callBack = callBack;
	};
	
	InfinateScrollFun.prototype.fire = function() { 
                var callback = this.callBack;
                var $container = $('#'+this.container+'');
                $container.infinitescroll({
                navSelector: '.next', // selector for the paged navigation 
                nextSelector: '.next a', // selector for the NEXT link (to page 2)
                itemSelector: '.'+this.repeator+'', // selector for all items you'll retrieve
                debug: true,
                dataType: 'html',
                loading: {
                    finishedMsg: 'No more posts to load. All Hail Star Wars God!',
                    img: '/wizspeakv254/img/ajax-loader.gif'
                        }

                }, function(arrayOfNewElems) {
                    if(callback.length > 0){
                       window[callback](arrayOfNewElems); 
                    }
                    
                    
                });
        };
        
         //live filter

        $.fn.liveFilter = function($filter,$repeator) {
            return this.each(function() {
                
                var count = 0;

                $filter.on('keyup',function(){
                    var filter = $(this).val(), count = 0;
                    $repeator.each(function(){

                       // If the list item does not contain the text phrase fade it out
                       if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                           $(this).fadeOut();

                       // Show the list item if the phrase matches and increase the count by 1
                       } else {
                           $(this).show();
                           count++;
                       }
                   });
                })
            });
        };
        