<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>

    <?php
    $filename = "Records.txt";
    $message = '';
    $message_class = '';


    if (isset($_POST['clear_records'])) {

        $myfile = @fopen($filename, "w"); 
        
        if ($myfile) {
            fclose($myfile);
            $message = "All records have been successfully cleared from $filename.";
            $message_class = 'warning';
        } else {
            $message = "Error: Unable to open or clear the file '$filename'. Check file permissions.";
            $message_class = 'error';
        }
    }


    if (isset($_POST['register_user'])) {

        $txtName = isset($_POST['name']) ? trim($_POST['name']) : 'N/A';
        $txtEmail = isset($_POST['email']) ? trim($_POST['email']) : 'N/A';
        $txtGender = isset($_POST['gender']) ? $_POST['gender'] : 'N/A';


        $record = "Name: $txtName, E-mail: $txtEmail, Gender: $txtGender\n";


        $myfile = @fopen($filename, "a");

        if ($myfile) {
            if (fwrite($myfile, $record)) {
                $message = "Registration successful! Record saved to $filename.";
                $message_class = 'success';
            } else {
                $message = "Error: Could not write to the file.";
                $message_class = 'error';
            }
            fclose($myfile);
        } else {
            $message = "Error: Unable to open or create the file '$filename'. Check file permissions.";
            $message_class = 'error';
        }
    }


    if ($message) {
        echo "<div class='message $message_class'>$message</div>";
    }
    ?>

    <h1>Studen Registration</h1>
    <form method="POST">
        <input type="hidden" name="register_user" value="1">

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>

        <p>Gender:</p>
        <input type="radio" id="female" name="gender" value="Female">
        <label for="female">Female</label>
        
        <input type="radio" id="male" name="gender" value="Male">
        <label for="male">Male</label>
        
        <input type="radio" id="other" name="gender" value="Other" checked>
        <label for="other">Other</label><br><br>

        <input type="submit" value="Register User">
    </form>

    <hr>

    <h2>Clear Records</h2>
    <form method="POST">
        <input type="hidden" name="clear_records" value="1">
        <input type="submit" value="Clear All Records">
    </form>
    
</body>
</html>