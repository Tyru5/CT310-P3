    <?php
      // fixed this - need to ALWAYS call session_name() before session_start()
      session_name($session_name);
      session_start();
    ?>
    <!-- Default encoding for our html page -->
    <meta charset="utf-8">
    <!-- Setting the title for the current page in this case - Welcome Page -->
    <?php echo "<title> $title </title>\n"; ?>
    <meta name="author" content="Tyrus Malmstrom, Ian Bertolacci">
    <meta name="description" content="Current webpage for our project1 - CT310">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript,PHP,CT310,CSU,Project1">
    <!-- This is for mobile responsiveness - essentially allows it to look good on a mobile device -->
    <meta name="viewport" content="width=600">
    <!-- Importing the Google Playfair font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
    <!-- Linking the page to the css file -->
    <link href="style.css" rel="stylesheet" type="text/css">
    <!-- I will NOT include the end </head> tag or the start of the <body> tag in here. I want that to be on the specific page itself -->
    <!--Loading JQuery library and the JQuery UI library-->
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
