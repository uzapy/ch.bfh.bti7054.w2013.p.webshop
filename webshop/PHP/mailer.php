<?php
class Mailer {
	private $email;
	private $orderId;
	private $translator;
	private $database;
	private $customer;
	
	public function __construct($email, $orderId, $translator, $database) {
		$this->email = $email;
		$this->orderID = $orderId;
		$this->translator = $translator;
		$this->customer = $database->getKunde($this->email);
	}
	
	public function sendMailWithAttachment($fileName) {
		// Absender / E-Mail / Betreff / Nachricht erstellen
		$my_name = "Marko Bublic";
		$my_mail = "uzapy@hotmail.com";
		$my_replyto = "uzapy@hotmail.com";
		$my_subject = $this->translator->get("Bestellung Nr.") . " " . $this->orderID;
		$my_message = $this->translator->get("Hallo") . ", " . $this->customer->FirstName;
		$my_message .= ",\r\n" . $this->translator->get("Vielen Dank für deine Bestellung!");
		$my_message .= "\r\n\r\n" . $this->translator->get("Gruss") . ", Marko";
		
		// Neu erstellte PDF einlesen
		$file_size = filesize($fileName);
		$handle = fopen($fileName, "r");
		$content = fread($handle, $file_size);
		fclose($handle);
		$content = chunk_split(base64_encode($content));
		$uid = md5(uniqid(time()));
		$name = basename($fileName);
		
		// E-Mail zusammenstiefeln
		$header = "From: " . $my_name . " <" . $my_mail . ">\r\n";
		$header .= "Reply-To: " . $my_replyto . "\r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";
		$header .= "This is a multi-part message in MIME format.\r\n";
		$header .= "--" . $uid . "\r\n";
		$header .= "Content-type:text/plain; charset=utf-8\r\n";
		$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
		$header .= $my_message . "\r\n\r\n";
		$header .= "--" . $uid . "\r\n";
		$header .= "Content-Type: application/octet-stream; name=\"" . $name . "\"\r\n";
		$header .= "Content-Transfer-Encoding: base64\r\n";
		$header .= "Content-Disposition: attachment; filename=\"" . $name . "\"\r\n\r\n";
		$header .= $content . "\r\n\r\n";
		$header .= "--" . $uid . "--";
		
		// Absenden!
		if (mail($this->email, $my_subject, "", $header)) {
			return true;
		} else {
			return false;
		}
	}
}
?>