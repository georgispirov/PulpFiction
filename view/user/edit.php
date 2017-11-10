<?php

use softuni\model\User;

/* @var User $data */

/* @var User $user */
$user = $data['user'];
?>



<html>
    <head>
        <meta charset="UTF-8">
        <title>Update User</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="/js/user.js"></script>
    </head>
    <body>
        <h1>Update user: <?= $user->getUsername(); ?></h1>
        <form action="/users/edit/<?= $user->getId(); ?>" id="edit-user-form" method="POST">
            <label for="edit-password">Username: </label>
            <input type="text" name="username" id="edit-username" value="<?= $user->getUsername(); ?>"> <br/>

            <label for="edit-first_name">First Name: </label>
            <input type="text" name="first_name" id="edit-first_name" value="<?= $user->getFirstName(); ?>"> <br/>

            <label for="edit-password">Password: </label>
            <input type="text" name="password" id="edit-password"> <br/>

            <label for="edit-re_password">Confirm Password: </label>
            <input type="text" name="re_password" id="edit-re_password"> <br/>

            <input type="submit" id="edit-user-button" value="Update">
        </form>
    </body>
</html>
