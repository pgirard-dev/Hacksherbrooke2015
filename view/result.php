<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Find anything you want near Sherbrooke!">
        <meta name="viewport" content="width=device-width">
		<title>GIMME</title>
        <link rel="shortcut icon" href="images/fav_icon.png?v=1">

        <link rel="stylesheet" type="text/css" href="styles/result.css">

        <script src="http://use.edgefonts.net/abel:n4:all.js"></script>
	</head>
    <body>
    <div id="message"></div>
        <div id='gimme_container'>
            <div id='outer_circle'>
                <div id='circle'>
                    <div id='formContainer'>
                        <img id='gimme' src='images/logo.png'>
                        <input id='query' autocomplete="off" type="text">
                    </div>
                </div>
            </div>
        </div>

        
        <div id="accordion">
            <!-- Will be filled by the ajax call in getResults.js -->

        </div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script src="javascript/iconic.min.js"></script>

        <script src="javascript/Result.js"></script>
        <script src="javascript/events_result.js"></script>
        <script src="javascript/getResults.js"></script>

        <script>
            "use strict";

            var query = '<?=$_GET['query']?>';

            //Initialize Iconic
            var iconic = IconicJS();
            var id = 0; //used to give a unique id to all icons

            var results = [];
            getResults(query); //The array of all the results
            

            $('#query').val(query);
/*
            results.push(new Result("allo1", "allo", "allo", 1, "fork", "allo"));
            results.push(new Result("allo2", "allo", "allo", 1, "fork", "allo"));
            results.push(new Result("allo3", "allo", "allo", 1, "fork", "allo"));
            results.push(new Result("allo4", "allo", "allo", 1, "fork", "allo"));
            results.push(new Result("allo5", "allo", "allo", 1, "fork", "allo"));
            */
        </script>
    </body>
</html>
