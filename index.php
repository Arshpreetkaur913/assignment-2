<?php
    include("dbconnect.php")

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
    <div id="form">
        <h1>Login form</h1>
        <form name="form" method="post"  action="admin_page.php">
            <label>Username:</label>
            <input type="text" id="user" name="user"><br><br>
            <label> Password</label>
            <input type="password" id="pass" name="pass"><br><br>
            <input type="submit" id="sub" value="Login" name="submit"/>
        </form>
    </div>

    
</body>
</html>