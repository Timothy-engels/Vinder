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
            #swipeCard { 
                width: 450px;
                height: 300px; 
                padding: 0.5em; 
                background-color: red;
            }
        </style>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $( function() {
                $( "#swipeCard" ).draggable();
            } );
        </script>
    </head> 
    <body>
        <div id="swipeCard">
            <h1>TEST</h1>
        </div>
    </body>
</html>
    