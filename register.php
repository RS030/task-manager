<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>register</title>
</head>

<body>
    <a href="login.php" class="navi">← Return to login</a>

    <h1>register here: </h1>
    
    <form class="logform" action="regi.php" method="POST">
        <label>username: </label>
        <input class="logstl" type="text" name="username" id="username">

        <label>password: </label>
        <input class="logstl" type="password" name="password" id="password">

        <button type="submit">register</button>
    </form>
</body>

</html>