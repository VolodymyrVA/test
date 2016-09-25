<?php
require_once('./global.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="css/main.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.min.js"></script>

    <script src="js/dataJSON.js"></script>
    <script src="js/main.js"></script>
</head>
<body>

<script id="contentItemTemplate" type="text/x-handlebars-template">
    <img class="img" alt="#" src={{img}}>
    <ul class="ul-item">
        <li name="name"><b>Name:&ensp;{{name}}</b></li>
        <li name="surname"><b>Surname:&ensp;{{surname}}</b></li>
        <li name="age"><b>Age:&ensp;{{age}}</b></li>
        <li name="country"><b>Country:&ensp;{{country}}</b></li>
        <li name="job"><b>Job:&ensp;{{job}}</b></li>
</script>



<div class="wrapper">

    <header>
        <div class="wrapper-content ">
            <a href="#" class="logo"></a>
            <a href="#" class="title"></a>
            <p class="contact-name-number">
                Vysotskyi Vladymyr
                <br>
                <b>(097) 337 46 97</b>
            </p>
            <nav class="menu">
                <ul class="menu-ul">
                    <li><a  class="menuEnter" href="#">Enter the site</a></li>
                    <li><a  class="menuReg" href="#">Registration</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main">
        <div class="wrapper-content">
            <div id="content" class="hidden">

            </div>
        </div>
    </main>

    <aside class="aside">
        <div class="wrapper-content">
            <div class="wrapper-singIn hidden">
                <h1>Enter the site</h1>
                <form class="singIn">
                    <table>
                        <tr>
                            <td class="name-input"><b>Login</b></td>
                            <td><input class="input log" type="text" name="nickname" placeholder="Login"></td>
                        </tr>
                        <tr>
                            <td class="name-input"><b>Password</b></td>
                            <td><input class="input pass" type="password" name="email" placeholder="Password"></td>
                        </tr>
                        <tr>
                            <td>
                                <button id="logButton" class="logButton" type="submit">Entry</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div id="editForm" class="hidden">
                <form class="edit">
                    <table class="edit-table">
                        <tr>
                            <td class="name-input"><b>img</b></td>
                            <td><input id="imgs" class="input imgs" type="text" name="img" placeholder="img"></td>
                        </tr>
                        <tr>
                            <td class="name-input"><b>Name</b></td>
                            <td><input id="name" class="input name" type="text" name="name" placeholder="Name"></td>
                        </tr>
                        <tr>
                            <td class="name-input"><b>Surname</b></td>
                            <td><input id="surname" class="input surname" type="text" name="surname" placeholder="Surname"></td>
                        </tr>
                        <tr>
                            <td class="name-input"><b>Age</b></td>
                            <td><input id="age" class="input age" type="text" name="age" placeholder="Age"></td>
                        </tr>
                        <tr>
                            <td class="name-input"><b>Country</b></td>
                            <td><input id="country" class="input country" type="text" name="Country" placeholder="Country"></td>
                        </tr>
                        <tr>
                            <td class="name-input"><b>Job</b></td>
                            <td><input id="job" class="input job" type="text" name="job" placeholder="Job"></td>
                        </tr>
                        <tr>
                            <td>
                                <button id="change" class="logButton" type="button">Change</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="Registration hidden">
                <form id="form-registration" class="singIn">
                    <h1 class="regist-h1">Registration</h1>
                    <table>
                        <tr>
                            <td class="name-input"><b>Email</b></td>
                            <td><input class="input email" type="text" name="nickname" placeholder="Email"></td>
                        </tr>
                        <tr>
                            <td class="name-input"><b>Password</b></td>
                            <td><input class="input password" type="password" name="email" placeholder="Enter the numbers"></td>
                        </tr>
                        <tr>
                            <td>
                                <button id="submit-regist" class="logButton " type="submit">Registration</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </aside>

    <footer class="footer">
        <div class="wrapper-content">

        </div>
    </footer>

</div>

</body>
</html>