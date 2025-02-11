<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration | PHP</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
    <div>
        <?php
        if (isset($_POST['create'])) {
            $firstname = htmlspecialchars($_POST['firstname']);
            $lastname = htmlspecialchars($_POST['lastname']);
            $email = htmlspecialchars($_POST['email']);
            $phonenumber = htmlspecialchars($_POST['phonenumber']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing

            if (isset($db)) {
                $sql = "INSERT INTO users (firstname, lastname, email, phonenumber, password) VALUES (?, ?, ?, ?, ?)";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([$firstname, $lastname, $email, $phonenumber, $password]);
                if ($result) {
                    echo 'Successfully saved.';
                } else {
                    echo 'There were errors while saving the data.';
                }
            } else {
                echo 'Database connection not established.';
            }

            echo $firstname . " " . $lastname . " " . $email . " " . $phonenumber;
        }
        ?>
    </div>
    <div>
        <form action="registration.php" method="post" id="registrationForm">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <h1>Registration</h1>
                        <p>Fill up the form with correct values.</p>
                        <hr class="mb-3">

                        <label for="firstname"><b>First Name</b></label>
                        <input class="form-control" type="text" id="firstname" name="firstname" required>

                        <label for="lastname"><b>Last Name</b></label>
                        <input class="form-control" type="text" id="lastname" name="lastname" required>

                        <label for="email"><b>Email Address</b></label>
                        <input class="form-control" type="email" id="email" name="email" required>

                        <label for="phonenumber"><b>Phone Number</b></label>
                        <input class="form-control" type="text" id="phonenumber" name="phonenumber" required>

                        <label for="password"><b>Password</b></label>
                        <input class="form-control" type="password" id="password" name="password" required>

                        <hr class="mb-3">
                        <input class="btn btn-primary" type="submit" name="create" id="register" value="Sign Up">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(function() {
            $('#registrationForm').on('submit', function(e) {
                e.preventDefault();

                var valid = this.checkValidity();
                if (valid) {
                    var firstname = $('#firstname').val();
                    var lastname = $('#lastname').val();
                    var email = $('#email').val();
                    var phonenumber = $('#phonenumber').val();
                    var password = $('#password').val();

                    $.ajax({
                        type: 'POST',
                        url: 'process.php',
                        data: {
                            firstname: firstname,
                            lastname: lastname,
                            email: email,
                            phonenumber: phonenumber,
                            password: password
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Successful',
                                text: 'Successfully registered.',
                                icon: 'success'
                            });
                        },
                        error: function(data) {
                            Swal.fire({
                                title: 'Errors',
                                text: 'There were errors while saving the data.',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>