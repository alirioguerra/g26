<?php 

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

class Mail
{   
  /**
   * Validate a request
   *
   * @param array $request
   * @return array
   */
  function validate(array $request): array
  {
    try {

      // Validate if email is not empty or less than 3 chars
      if(empty($request['email']) || strlen($request['email']) < 3)
        throw new \Exception('Email is invalid');
      
      // Validate if name is not empty or less than 3 chars
      if(empty($request['name']) || strlen($request['name']) < 3)
        throw new \Exception('Name is invalid');

      // Validate if message is not empty or less than 3 chars
      if(empty($request['message']) || strlen($request['message']) < 3)
        throw new \Exception('Message is invalid');

      // Validate if email is valid
      $emailValidator = new EmailValidator();
      if(!$emailValidator->isValid($request['email'], new RFCValidation()))
        throw new \Exception($emailValidator->getError());

    } catch (\Throwable $th) {

      return [
        'success' => false,
        'error' => true,
        'message' => $th->getMessage()
      ];

    }

    return [
      'success' => true,
      'error' => false,
      'message' => 'Valid request',
    ];
  }

  /**
   * Send the email
   *
   * @param array $request
   * @return array
   */
  function send(array $request): array
  {
    try {
      
      //Create an instance; passing `true` enables exceptions
      $mail = new PHPMailer(true);

      //Server settings
      $mail->SMTPDebug = false;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.g26talent.com.br';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'atendimento@g26talent.com.br';                     //SMTP username
      $mail->Password   = 'Vinteeseis@26';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('atendimento@g26talent.com.br', 'Contato do Site');
      $mail->addAddress('atendimento@g26talent.com.br', 'Contato do Site');
      $mail->addReplyTo($request['email'], $request['name']);

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = $request['subject'];
      $mail->Body    = $request['message'];
      $mail->AltBody = $request['message'];

      $mail->send();

    } catch (\Throwable $th) {

      return [
        'success' => false,
        'error' => true,
        'message' => $th->getMessage()
      ];

    }
    
    return [
      'success' => true,
      'error' => false,
      'message' => 'Mail sent',
    ];
  }
}