<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./src/js/validator.js"></script>
    <script type="module" src="./src/js/ShoppingCart.js"></script>
</head>
<body>
    <main>
        <div class="container">
            <div class="formContainer">
                <h2>Register</h2>
                <form action="index.php?controller=User&action=register" method="post">
                    <div class="formColumn">
                        <div class="formRow">
                            <label for="dni">Dni:</label>
                            <input type="text" id="dni" name="dni" maxlength="9" pattern="[0-9]{8}[a-zA-Z]" autocomplete="false" required>
                        </div>
                    
                        <div class="formRow">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" autocomplete="false" required>
                        </div>
    
                        <div class="formRow">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" autocomplete="false" required></input>
                        </div>

                        <div class="formRow">
                            <label for="confirmPassword">Confirm Password:</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" required></input>
                        </div>

                        <div class="formRow">
                            <span id="errorMessage"></span>
                        </div>
    
                    </div>
                    <div class="formColumn">

                        <div class="formRow">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="formRow">
                            <label for="surname">Surname:</label>
                            <input type="text" id="surname" name="surname" required>
                        </div>

                        <div class="formRow">
                            <label for="phoneNumber">Phone number:</label>
                            <input type="tel" id="phoneNumber" name="phoneNumber" pattern="[0-9]{9,15}" minlength="9" maxlength="15" required>
                        </div>

                        <div class="formRow">
                            <label for="direction">Direction:</label>
                            <input type="text" id="direction" name="direction" required>
                        </div>

                    </div>
                    <input type="submit" id="signup" value="Sign up" class="addBtn">
                </form>
            </div>
        </div>
    </main>
</body>
</html>