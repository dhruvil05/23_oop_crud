/* Mouse effects */
var a_idx = 0; 
jQuery(document).ready(function($) { 

    var div = document.querySelector(".cursorPosition"); 
    var color;
    div.addEventListener( 
        "mousemove", function (e) { 
        x = e.offsetX; 
        y = e.offsetY; 
        color = `rgb(${x}, ${y}, ${x - y})`; 
    });

    $("body").click(function(e) { 
        // var str = "सर्वस्यापि भवेद्धेतुः।।";
        // var a = str.split(" ");
        var a = new Array("Free", "equality", "just", "rule of law" , "Civilization ", "Dedication", "Consistency", "Friendly" ,"Harmonious", "Patriotic", "Prosperous", "Democracy", "to be");


        var $i = $("<span/>").text(a[a_idx]); 
        a_idx = (a_idx + 1) % a.length; 
        var x = e.pageX, 
        y = e.pageY; 
        $i.css({ 
            "z-index": 999999999999999999999999999999999999999999999999999999999999999999999, 
            "top": y - 20, 
            "left": x, 
            "position": "absolute", 
            "font-weight": "bold", 
            "color": color ?? "#ff6651",
            "cursor":"default"
        }); 
        $("body").append($i); 
        $i.animate({ 
            "top": y - 180, 
            "opacity": 0 
        }, 
        1500, 
        function() { 
            $i.remove(); 
        }); 
    }) 
}); 
