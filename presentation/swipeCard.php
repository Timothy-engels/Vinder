<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>
        <title>Swipen</title>
        <style>
            body {
                margin: 0px auto;
                text-align: center;
            }
            .swipingArea {
                
            }
            #swipeCard { 
                width: 350px;
                height: 200px; 
                background-color: red;
                display: inline-block;
            }
            #no, #yes {
                width: 400px;
                height: 250px;
                background-color: blue;
                display: inline-block;
            }
        </style>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
        <script>
            $( function() { 
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
            <div id="no">
            </div>
            <div id="swipeCard">
            </div>
            <div id="yes">
            </div>
        </div>
    </body>
</html>
    