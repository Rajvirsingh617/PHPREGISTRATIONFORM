<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Add Font Awesome CDN -->
<!-- Add Font Awesome 6.7.1 CDN -->


    <style>
    body {
        background-image: url('VIKRAM.jpeg');
        /* Replace with the actual image path */
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        /* Keeps the image fixed while scrolling */
    }

    form {
        background-color: #ffffff;
        /* Solid white background */
        padding: 20px;
        border-radius: 10px;
        /* Smooth corner edges */
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        /* Adds a soft shadow around the form */
        margin-top: 5px;
    }
    ul{
      list-style-type:disc;
      padding-left: -20px;
    }
    </style>


</head>


<body>
<?php
   echo "<div class='offset-2'>
   
   <h3>
   <u><b>WELCOME MY FRIEND </b></u></h3>
   </div>";
   echo "<div class='offset-1'>
   
   <h2>
   <u><b> FILL THIS REGISTRATION FORM </b></u></h2>
   </div>";
     
$conn = mysqli_connect('localhost', 'root', '', 'my_database');

if (!$conn) {
    die("<p class='text-danger'>Database connection failed: " . mysqli_connect_error() . "</p>");
}

if (isset($_POST['submitregistration'])) {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name'] ?? '');
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $password = mysqli_real_escape_string($conn, $_POST['password'] ?? '');
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password'] ?? '');
    $dob = mysqli_real_escape_string($conn, $_POST['dob'] ?? '');
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number'] ?? '');
    $gender = mysqli_real_escape_string($conn, $_POST['gender'] ?? '');
    
    if ($password == $confirm_password) {
        $password = md5($password);  // Encrypt password

        $query = "INSERT INTO users_tbl (`full_name`, `email`, `password`, `dob`, `mobile_number`, `gender`) 
                  VALUES ('$full_name', '$email', '$password', '$dob', '$mobile_number', '$gender')";
        
        if (mysqli_query($conn, $query)) {
            // Avoid redirection if the success flag is already set
            if (!isset($_GET['success'])) {
              header('Location: ' . $_SERVER['PHP_SELF'] . '?success=true');
                exit;  // Make sure no further code is executed after the redirect
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . mysqli_error($conn) . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Password and Confirm Password do not match!</div>';
    }
}
if (isset($_GET['success'])): ?>
    <div id="successMessage" class="alert alert-success" role="alert">
        Registration successful!
    </div>
    <?php endif;


mysqli_close($conn);
?>



    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="w-50 offset-0">
      <ul>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label"> Full Name</label>
            <input type="text" name="full_name" class="form-control" id="full_name" aria-describedby="emailHelp"
                required>
            <div id="full_name" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label for="exampleInputemail" class="form-label"> Email</label>
            <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputconfirmPassword" class="form-label">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" id=confirm_password required>
        </div>
        <div class="mb-3">
            <label for="exampleInputd" class="form-label">DOB</label>
            <input type="date" name="dob" class="form-control" id="dob" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputd" class="form-label">Mobile Number</label>
            <input type="text" maxlength="10" name="mobile_number" class="form-control" id="mobile_number" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Gender</label>
            <div>
                <input type="radio" id="male" name="gender" value="Male" required required>
                <label for="male">Male</label>
            </div>
            <div>
                <input type="radio" id="female" name="gender" value="Female" required>
                <label for="female">Female</label>
            </div>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
       <div  class='offset-4'>
        <button type="submit" name="submitregistration" value="submitregistration" class="btn btn-primary" >
                <i class="fa-solid fa-paper-plane"></i> Submit
            </button>
</div>

</ul>
    </form>
    <script>
    window.onload = function() {
        // Check if the success message is in the URL
        const urlParams = new URLSearchParams(window.location.search);
        const success = urlParams.get('success');

        if (success === 'true') {
            // Show success message
            document.getElementById('successMessage').style.display = 'block';

            // Reset the form fields after 3 seconds (to allow user to see the success message)
            setTimeout(function() {
                document.getElementById('registrationForm').reset();
                document.getElementById('successMessage').style.display =
                'none'; // Hide success message after form reset
            }, 3000); // 3 seconds delay for user to see the success message
        }
    };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>