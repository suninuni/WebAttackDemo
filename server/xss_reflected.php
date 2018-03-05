<?php
session_start();

setcookie('user', 'user');
?>
<!doctype html>
<html>
    <head>
        <title>XSS demo</title>
    </head>
    <body>
    <form>
    <input style="width:300px;" type="text" name="address1" value="<?php echo $_GET["address1"]; ?>" />
            <input type="submit" value="Submit" />
        </form>
    </body>
</html>
