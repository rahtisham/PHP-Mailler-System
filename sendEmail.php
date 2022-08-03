<?php
    use PHPMailer\PHPMailer\PHPMailer;

    if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "ahtisham@amzonestep.com"; //enter you email address
        $mail->Password = 'Redapple12@'; //enter you email password
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        $mail->addAddress("ahtisham@amzonestep.com"); //enter you email address
        $mail->Subject = ("$email ($subject)");
        $mail->Name = $_POST['name'];
        $mail->Email = $email;
        $mail->Subject = $_POST['subject'];
        $message = "<!DOCTYPE html>
                <html>
                <head>
                    <title></title>
                </head>
                <body>
                    <table>
                        <tr>
                            <th>Name</th>
                            <td>".$name."</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>".$email."</td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td>".$subject."</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>".$body."</td>
                        </tr>
                    </table>
                </body>
                </html>";
        $mail->Body = $message;

        if ($mail->send()) {
            $status = "success";
            $response = "Email is sent!";
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }

        exit(json_encode(array("status" => $status, "response" => $response)));
    }
?>


