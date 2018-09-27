<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>
        <title>Swipen</title>
        <style>
            body {
                margin: 0px auto;
                text-align: center;
                background-color: blue;
            }
            .swipingArea {
                
            }
            #swipeCard { 
                width: 350px;
                height: 512px; 
                background-color: white;
                display: inline-block;
            }
            #no, #yes {
                width: 512px;
                height: 512px;
                background-color: blue;
                display: inline-block;
            }
        </style>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
        <script>
            $(document).ready( function() {
                if (window.XMLHttpRequest) {
                    // code for modern browsers
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for old IE browsers
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                /*       hoofdpijngenerator
                
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("swipeCard").innerHTML =
                            this.responseText;
                    }
                };
                xhttp.open("GET", "swipe.php", true);
                xhttp.send();
                */
             
                $("#swipeCard").html();
                $("#swipeCard").draggable();
                $("#no").droppable( { drop: function( event, ui ) {
                    alert("no");
                } } );
                $("#yes").droppable( { drop: function( event, ui ) { 
                    alert("yes");
                } } );
            });
        </script>
    </head> 
    <body>
        <div class="swipingArea">
            <div id="no" style="background-image: url('images/swipe_left.png');">
            </div>
            <div id="swipeCard">
                <?= $swipeCardHtml; ?>
            </div>
            <div id="yes" style="background-image: url('images/swipe_right.png');">
            </div>
        </div>
    </body>
</html>
    