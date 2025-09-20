<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = htmlspecialchars($_POST["name"]);
  $email = htmlspecialchars($_POST["email"]);
  $course = htmlspecialchars($_POST["course"]);
  $age = htmlspecialchars($_POST["age"]);

  $entry = "Name: $name | Email: $email | Course: $course | Age: $age\n";

  file_put_contents("students.txt", $entry, FILE_APPEND | LOCK_EX);

  echo "Registration successful! <a href='index.html'>Go back</a>";
}
?>