<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once(ROOT . '/phpmailer/PHPMailer.php');
require_once(ROOT . '/phpmailer/Exception.php');
require_once(ROOT . '/phpmailer/SMTP.php');


class CheckoutController
{
	public function actionIndex() 
	{
		$userOrder = json_decode($_POST['order']) ?? null;
		$mail = new PHPMailer(true); 
		$mail->CharSet = 'utf-8';

		$name = $_POST['name'] ?? null;
		$surname = $_POST['surname'] ?? null;
		$address = $_POST['address'] ?? null;
		$phone = $_POST['phone'] ?? null;
		
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  																							// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 't.mail82.smtp@gmail.com'; // Ваш логин от почты с которой будут отправляться письма
		$mail->Password = '&$fndk#&$'; // Ваш пароль от почты с которой будут отправляться письма
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

		$mail->setFrom('t.mail82.smtp@gmail.com'); // от кого будет уходить письмо?
		$mail->addAddress('victorbiletskiy82@gmail.com');     // Кому будет уходить письмо 
		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Заявка с моего сайта';
		$mail->Body    = $name . " " . $surname . ' оставил заявку'."<br/>".'Его телефон: '.$phone."<br/>".' Адресс доставки:' . $address;
		$total = 0;
		foreach ($userOrder as $order) {
			$total += $order->price;
			$mail->Body .= "<tr style='background-color: #f8f8f8; width=100%;'>" 
			. 
			'<td style="padding: 10px; border: #e9e9e9 1px solid;">' . $order->title . '|Цена:' . $order->price . 'грн'. '|' . 'кол-во:'. $order->count .'</td>' 
			. 
			"</tr>";
		}
		$mail->Body .= 'Общая стоимость:' . $total;
		$mail->AltBody = '';

		if(!$mail->send()) {
			return false;
		} else {
			return true;
		}
	}
}