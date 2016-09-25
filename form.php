<?php
		$to = 'stjamlb@gmail.com';
        $email;$subject;$captcha;$text;
        if(isset($_POST['name'])){
          $email=$_POST['name'];
        }if(isset($_POST['subject'])){
          $subject=$_POST['subject'];
        }if(isset($_POST['text'])){
          $text=$_POST['text'];
        }
		if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '<h2>Please check the the captcha form.</h2>';
          exit;
        }
	$secretKey = '6LdHiAcUAAAAAPTz7FV7zp9dsl31TuQXqR5Xgq52';
	$ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
	$responseKeys = json_decode($response,true);
        if(intval($responseKeys["success"]) !== 1) {			
          echo '<h2>You are spammer ! Get the @$%K out</h2>';
        } else {
			$message = '
                <html>
                    <head>
                        <title>'.$_POST['subject'].'</title>
                    </head>
                    <body>
                        <p>Имя: '.$_POST['name'].'</p>
                        <p>Контакт: '.$_POST['contact'].'</p>                        
						<p>Сообщение: '.$_POST['txt'].'</p>                        
                    </body>
                </html>'; //Текст нащего сообщения можно использовать HTML теги
        $headers  = "Content-type: text/html; charset=utf-8 \r\n"; //Кодировка письма
        $headers .= "From: Отправитель <stjamlb@gmail.com>\r\n"; //Наименование и почта отправителя
        mail($to, $subject, $message, $headers);		//Отправка письма с помощью функции mail
		header("Location: weworkfast.html");
		die();
        }
?>