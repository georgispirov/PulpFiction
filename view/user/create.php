<html>
    <head>
        <meta charset="UTF-8">
        <title>Create User</title>
    </head>
    <body>
        <form action="/users/register" method="POST">
            <label for="username">Username: </label>
            <input type="text" name="username" id="username"> <br/>

            <label for="first_name">First Name: </label>
            <input type="text" name="first_name" id="first_name"> <br/>

            <label for="password">Password: </label>
            <input type="text" name="password" id="password"> <br/>

            <label for="re-password">Confirm Password: </label>
            <input type="text" name="re_password" id="re_password"> <br/>

            <input type="submit" value="Register">
        </form>
    </body>
</html>