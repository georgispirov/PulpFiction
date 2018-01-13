<html>
    <head>
        <meta charset="UTF-8">
        <title>Create User</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="/js/user.js"></script>
    </head>
    <body>
        <form action="/security/register" id="create-user-form" method="POST">
            <label for="username">Username: </label>
            <input type="text" name="username" id="username"> <br/>

            <label for="first_name">First Name: </label>
            <input type="text" name="first_name" id="first_name"> <br/>

            <label for="password">Password: </label>
            <input type="password" name="password" id="password"> <br/>

            <label for="re_password">Confirm Password: </label>
            <input type="password" name="re_password" id="re_password"> <br/>

            <input type="submit" name="create-user-button" value="Register">
        </form>
    </body>
</html>