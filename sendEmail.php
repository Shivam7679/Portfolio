<?php




use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['name']) && isset($_POST['email'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $body= $_POST['message'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();

    //smtp settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "shivamresponse@gmail.com";
    $mail->Password = 'tixropvitdhkbwzp';
    $mail->Port = 587;
    $mail->SMTPSecure = "tls";

    //email settings
    $mail->isHTML(true);
    $mail->setFrom($email, $name);
    $mail->addAddress("shivamresponse@gmail.com");
    $mail->Subject = ("$email ($subject)");
    $mail->Body = $body;

/*  if($mail->send()){
      echo "message is send sucessfully";
    }
    else
    {
        $status = "failed";
        $response = "Something is wrong: <br>" . $mail->ErrorInfo;
    }
    */

     if ($mail->send()) {
        // Email sent successfully
        $status = "success";
        $response = "Your message has been sent. Thank you!";
    } else {
        // Email sending failed
        $status = "error";
        $response = "Something is wrong: " . $mail->ErrorInfo;
    }

    // Prepare the response
    $result = array("status" => $status, "response" => $response);

    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($result);

   
}


?>