jQuery(document).ready(function ($) {
            function sliderInitPageSpecifc(){
                var _SlideshowTransitions = [
                //Fade
                { $Duration: 1200, $Opacity: 2 }
                ];

                var options = {

                    $ArrowNavigatorOptions: {
                        $Class: $JssorArrowNavigator$,         //[Requried] Class to create arrow navigator instance
                        $ChanceToShow: 2,                      //[Required] 0 Never, 1 Mouse Over, 2 Always
                        $Steps: 1                              //[Optional] Steps to go for each navigation request, default value is 1
                    }
                };
                var jssor_slider1 = new $JssorSlider$("slider1_container", options);

                //responsive code begin
                //you can remove responsive code if you don't want the slider scales while window resizes
                function ScaleSlider() {
                    var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                    if (parentWidth)
                        jssor_slider1.$ScaleWidth(Math.min(parentWidth, 600));
                    else
                        window.setTimeout(ScaleSlider, 30);
                }

                ScaleSlider();

                if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                    $(window).bind('resize', ScaleSlider);
                }
            }
            if($("#slider1_container").length > 0){
                sliderInitPageSpecifc();
            }

            if($( ".datepicker" ).length > 0){
                $( ".datepicker" ).datepicker({
                    showOn: "button",
                    buttonImage: "/wizspeak/img/calendar.gif",
                    buttonImageOnly: true,
                    changeYear: true,
                    yearRange: "-70:+0",
                    buttonText: "Select date"
                });
            }
        
        if($(".custom-scroll").length > 0){
            Wizspeak.scrollBar.blindscrollBar(".custom-scroll");
        }
        // enable click ambition for desktop
        Wizspeak.breakpoints.unbindClickAmbition();
        // usage breakepoints
        Wizspeak.jRes.addFunc({
            breakpoint: 'handheld-above',
            enter: function() {
                Wizspeak.breakpoints.blindClickAmbition();
                Wizspeak.scrollBar.unBlindscrollBar(".custom-scroll");
            },
            exit: function() {
                Wizspeak.breakpoints.unbindClickAmbition();
                Wizspeak.scrollBar.blindscrollBar(".custom-scroll");
            }
        });
            
});