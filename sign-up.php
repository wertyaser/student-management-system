<?php
session_start();

include("db_connect.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $fullname = $firstname . " " . $lastname;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $bday = $_POST['bday'];
    $course = $_POST['course'];

    if (!empty($fullname) && !empty($password) && !empty($email) && !empty($bday) && !empty($course)) {
        $query = "select * from users where email = '$email' limit 1";
        $result = mysqli_query($conn, $query);
        if ($result->num_rows > 0) {
            echo "Email already exists. Please use a different email.";
        } else {
            $query = "insert into users (name, birthday, course, email, password) 
                          values ('$fullname', '$bday', '$course', '$email', '$password')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                header("Location: index.php");
                die;
            } else {
                echo "Error inserting data into the database.";
            }
        }
    } else {
        echo "Please enter some valid information!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./pico-master/css/pico.css" /> -->
    <link rel="stylesheet" href="./css/output.css" />
    <!-- <link rel="stylesheet" href="./css/login.css" /> -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>Sign Up</title>
</head>

<body class="bg-violet min-h-screen flex">
    <article data-aos="flip-left"
        class="m-auto max-w-2xl w-11/12 border-2 border-pink rounded-2xl overflow-hidden flex">

        <div class="flex p-4 w-full">
            <form method="post" class="m-auto">
                <h1 class="mb-6 text-white text-2xl text-center">Sign Up</h1>
                <!-- / -->

                <input type="text" name="fname" placeholder="First name" required autocapitalize="on"
                    class="mb-2 block bg-violet border border-white px-4 py-2 rounded-lg text-white w-full">
                <input type="text" name="lname" placeholder="Last name" required autocapitalize="on"
                    class="mb-2 block bg-violet border border-white px-4 py-2 rounded-lg text-white w-full">
                <input type="text" name="email" placeholder="Email" required
                    class="mb-2 block bg-violet border border-white px-4 py-2 rounded-lg text-white w-full">
                <input type="text" name="course" placeholder="Course" required autocapitalize="on"
                    class="mb-2 block bg-violet border border-white px-4 py-2 rounded-lg text-white w-full">
                <input type="password" name="password" placeholder="Password" required
                    class="mb-2 block bg-violet border border-white px-4 py-2 rounded-lg text-white w-full">
                <!-- <label for="date">Birthday -->
                <input type="date" id="date" name="bday"
                    class="mb-2 block bg-violet border border-white px-4 py-2 rounded-lg text-white w-full w-full">
                <!-- </label> -->
                <!--  -->


                <div class="flex items-center gap-2 mb-2 flex-wrap">
                    <button class="border border-white rounded-lg text-white py-2 text-sm w-full">Back to
                        login</button>
                    <button type="submit" class="bg-pink text-white rounded-lg py-2 text-sm w-full">Create
                        Account</button>

                </div>
                <p class="text-white">Already have an account?<a href="./index.php"> Login</a></p>
            </form>
        </div>
        <div class="h-full w-[300px] shrink-0 relative hidden md:block">
            <img src="./images/auth-image.png" alt="a person attempting to smile but failed."
                class="h-full w-full object-cover">
        </div>




        <!-- <h1>Sign Up</h1>
        <form method="post">
            <input type="text" name="fname" placeholder="First name" required autocapitalize="on">
            <input type="text" name="lname" placeholder="Last name" required autocapitalize="on">
            <input type="text" name="email" placeholder="Email" required>
            <input type="text" name="course" placeholder="Course" required autocapitalize="on">
            <input type="password" name="password" placeholder="Password" required>
            <label for="date">Birthday
                <input type="date" id="date" name="bday">
            </label>
            <button type="submit" name="submit" value="submit">Create Account</button>
        </form>
        <p>Already have an account?<a href="./index.php"> Login</a></p> -->
    </article>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>



</html>