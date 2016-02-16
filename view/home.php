<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Find anything you want near Sherbrooke!">
        <meta name='viewport' content='width=device-width' />
		<title>GIMME</title>
        <link rel="shortcut icon" href="images/fav_icon.png?v=1">

        <link rel="stylesheet" type="text/css" href="styles/home.css">

        <script src="http://use.edgefonts.net/abel:n4:all.js"></script>
	</head>
    <body>

        <div id='outer_circle'>
            <div id='circle'>
                <form id='formContainer' method='get', action="result.php">
                    <img id='gimme' src='images/logo.png'>
                    <input id='query' name='query' autocomplete="off" type="text">
                    <input style='display: none;' type='submit'>
                </form>
            </div>
        </div>

        <!--<form method="get" action="result.php" >
            <input name="query" type="text">
            <input value="Go" type="submit">
        </form>-->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script>
            $(function() {
                "use strict";


                //===== WORD SUGGESTIONS ======//
                var pos = 0; //the character position in the word
                var index = 0; //the word index in the following array
                var mots = <?=$rdmWords?>; //TODO, add more words, or even do a php script to get truly random words

                setInterval(function() {
                    if(pos <= mots[index].length + 5) { // "+ 4" to wait a bit before erasing word
                        $('#query').attr('placeholder', mots[index].substring(0, pos));
                        pos++;
                    }
                    else {
                        index++;
                        pos = -4; //put it less than 0 to wait a bit before writing a new word
                        if(index >= mots.length) //Go back to the first word if reached end of list
                            index = 0;
                    }
                }, 120); //Will repeat every 120 milliseconds
            });
        </script>
    </body>
</html>
