<?php
	require_once('PHPMailerAutoload.php');
	class sendEmail
	{
		public $email;
		public $password;
		public $from;
		public $mail;
		function __construct($email,$password,$from)
		{

			$this->mail = new PHPMailer;
			$this->email=$email;
			$this->password=$password;
			$this->from=$from;
			$this->mail->isSMTP();
			$this->mail->Host = 'smtp.gmail.com';  
			$this->mail->SMTPAuth = true;          
			$this->mail->Username = $email;
			$this->mail->Password = $password;           
			$this->mail->SMTPSecure = 'tls';           
			$this->mail->Port = 587;                     

		}
		function sendEmail($to,$subject,$body)
		{
			$this->mail->setFrom($this->email, $this->from);
			$this->mail->addAddress($to);
			$this->mail->addReplyTo($this->email);
			$this->mail->isHTML(true);                                
			$this->mail->Subject = $subject;
			$this->mail->Body    = $body;
			if(!$this->mail->send()) 
			{
			    return false;

			} 
			else 
			{
			    return true;
			}


		}
	}




?>