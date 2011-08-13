<?php
class Mailer
{
	private $to = array();
	private $from;
	private $carbonCopy = array();
	private $blindCarbonCopy = array();
	private $subject = "";
	private $body = "";
	private $mime_version;
	private $content_type;
	private $x_mailer;
	private $x_priority;
	private $reply_to;
	private $return_path;
	private $attachments = array();
	
	public function __construct()
	{
		//DEFAULTS
		$this->mime_version = "MIME-Version: 1.0\r\n";
		$this->x_mailer = "X-Mailer: PHP/" . phpversion() . "\r\n";
		$this->content_type = "Content-type: text/plain; charset=utf-8\r\n";
		$this->x_priority = "X-Priority: 3\r\n"; //normal priority
	}
	
	public function addTo($email)
	{
		$this->to[] = $email;
	}
	
	public function setFrom($email)
	{
		$this->from = "From: " . $email . "\r\n";
	}
	
	public function setReplyTo($email)
	{
		$this->reply_to = "Reply-To: " . $email . "\r\n";
	}
	
	public function setReturnPath($email)
	{
		$this->reply_to = "Return-Path: " . $email . "\r\n";
	}
	
	public function setSubject($text)
	{
		$this->subject = $text;
	}
	
	public function setBody($text)
	{
		$this->body = $text;
	}
	
	public function addCC($email)
	{
		$this->carbonCopy[] = $email;
	}
	
	public function addBCC($email)
	{
		$this->blindCarbonCopy[] = $email;
	}
	
	public function addAttachment($path)
	{
		$this->attachments[] = $path;
	}
	
	public function isHTML($bool=true)
	{
		if($bool)
			$this->content_type = "Content-type: text/html; charset=iso-8859-1\r\n";
		else
			$this->content_type = "Content-type: text/plain; charset=utf-8\r\n";
	}
	
	private function getHeaders()
	{
		//minimum
		$headers = $this->mime_version . 
					$this->x_mailer .
					$this->x_priority;

		if(isset($this->from))
			$headers .= $this->from;
		if(isset($this->reply_to))
			$headers .= $this->reply_to;
		if(isset($this->return_path))
			$headers .= $this->return_path;
		if(count($this->carbonCopy))
			$headers .= "CC: " . implode(',',$this->carbonCopy) . "\r\n";
		if(count($this->blindCarbonCopy))
			$headers .= "BCC: " . implode(',',$this->blindCarbonCopy) . "\r\n";
			
		if(count($this->attachments)<1)//need more examples but i think they go into message not headers
			$headers .= $this->content_type;
			
		return $headers;
	}
	
	private function get_mime_content_type($path)
	{
		$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
    	$mime = finfo_file($finfo, $path);
		finfo_close($finfo);
		return $mime;
	}
	
	public function sendMail()
	{
		$headers = $this->getHeaders();
		if(count($this->attachments))
		{
			$hash = md5(time());
			$buffer = "Content-Type: multipart/mixed; boundary=\"".$hash."\"\r\n";
			$buffer .= "This is a multi-part message in MIME format.\r\n\r\n";
			$buffer .= "--".$hash."\r\n";
			$buffer .= $this->content_type;
			$buffer .= "Content-Transfer-Encoding: quoted-printable\r\n\r\n";
			$buffer .= $this->body."\r\n\r\n";
			foreach($this->attachments as $path)
			{
				$content = chunk_split(base64_encode(file_get_contents($path)));
				$filename = basename($path);
				$content_type = $this->get_mime_content_type($path);
				$buffer .= "--".$hash."\r\n";
				$buffer .= "Content-Type: ".$content_type."; name=\"".$filename."\"\r\n";
				$buffer .= "Content-Transfer-Encoding: base64\r\n";
			    $buffer .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
			    $buffer .= $content."\r\n";
			}
			$this->body = $buffer . "--".$hash."--";
			return mail(implode(',',$this->to),$this->subject,"",$headers.$this->body);
		}
		return mail(implode(',',$this->to),$this->subject,$this->body,$headers);
	}
}
?>