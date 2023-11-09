<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Feedback Form</title>
    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Add a custom style for the button */
        #SubmitButton {
            background-color: #74f342;
            color: #fff; /* Set text color to white for better contrast */
        }
        .card {
            border: 8px solid #001f3f; /* Dark blue color */
        }
    </style>
</head>

<?php
$posted_payloads = array();
if(isset($_POST['SubmitButton'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $message = $_POST['message'];
   
    $subject = $_POST['subject'];  // Added subject field

    $error = false;
    $alert_msg = "";

    // Form validation
    if (empty($fname) || empty($lname) || empty($email) || empty($message)|| empty($subject)) {
        $error = true;
        $alert_msg = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $alert_msg = 'Invalid email address.';
    } elseif (strlen($message) > 500) {
        $error = true;
        $alert_msg = 'Message is too long (max 500 characters).';
    } elseif (strlen($subject) > 50 || !ctype_alnum($subject)) {
        $error = true;
        $alert_msg = 'Invalid subject (max 50 alphanumeric characters).';
    }

    if (!$error) {
        $to = "rs7171507@gmail.com";
        $headers = "From: phpflow.com";

        if (mail($to, 'Feedback', $message, $headers)) {
            $alert_msg = 'Thanks for contacting us! We will be in touch with you shortly.';
        } else {
            $error = true;
            $alert_msg = "Oops! Error sending mail.";
        }
    }
}
?>

<body>
<main class="container">
  <div class="bg-light p-5 rounded mt-3">
    <div class="card">
        <?php if(isset($_POST['SubmitButton'])) { 
            $cls = $error == false ? "alert-success" : "alert-danger";
            ?>
        <div class="card-header">
            <div class="alert <?php echo $cls;?>" >
                <?php echo $alert_msg;?>
            </div>
        </div>
        <?php } ?>
        <div class="card-body">
            <h5 class="card-title">Submit Feedback</h5>
            <div>
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <div class="col-lg-7">
                            <div class="p-5">
                                <form class="user" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
                                    <div class="form-group row mb-3">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control form-control-user" id="subject" name="subject" placeholder="Subject" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <textarea class="form-control form-control-user" id="message" name="message" placeholder="Enter Feedback Message" required></textarea>
                                    </div>
                                    <button type="submit" id="SubmitButton" name="SubmitButton" class="btn btn-primary btn-user btn-block">
                                        Submit Feedback
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</main>
</body>

</html>
