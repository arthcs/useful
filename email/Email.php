<?php 

	include "class.phpmailer.php";
	include "class.smtp.php";

class Email {

	//declaração de atributos
	private $host;
	private $username;
	private $senha;
	private $nome;
	private $corpo;
	private $email;
	private $assunto;

	//ao instanciar a classe, já atribui os dados
	function __construct($nome = "Salutaris Tickets", $email = "", $assunto = "", $corpo = "") {
		//dados default
		$this->host 	= "######";
		$this->username = "####@#####.com.br";
		$this->senha 	= "######";
		//dados enviados
		$this->nome = $nome;
		$this->email = $email;
		$this->assunto = $assunto;
		$this->corpo = $corpo;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function setAssunto($assunto) {
		$this->assunto = $assunto;
	}

	public function setCorpo($corpo) {
		$this->corpo = $corpo;
	}

	public function enviar() {
		$mail = new PHPMailer();

        $mes = date('M');
        $dia = date('d');
        $ano = date('Y');

        $semana = array(
            'Sun' => 'Domingo',
            'Mon' => 'Segunda-Feira',
            'Tue' => 'Terca-Feira',
            'Wed' => 'Quarta-Feira',
            'Thu' => 'Quinta-Feira',
            'Fri' => 'Sexta-Feira',
            'Sat' => 'Sábado'
        );

        $mes_extenso = array(
            'Jan' => 'Janeiro',
            'Feb' => 'Fevereiro',
            'Mar' => 'Marco',
            'Apr' => 'Abril',
            'May' => 'Maio',
            'Jun' => 'Junho',
            'Jul' => 'Julho',
            'Aug' => 'Agosto',
            'Nov' => 'Novembro',
            'Sep' => 'Setembro',
            'Oct' => 'Outubro',
            'Dec' => 'Dezembro'
        );

		$cabecalhoCorpo = '';

		$rodapeCorpo = '';		

		// Define os dados do servidor e tipo de conexão
		$mail->IsSMTP();
		$mail->Host = $this->host; 					//mail.dominio.com.br
		//$mail->SMTPSecure = "TLS"; 
		//$mail->SMTPSecure = 'ssl';	            // SSL REQUERIDO pelo GMail
		$mail->SMTPAuth = true;                     // Usa autenticação SMTP? (opcional)
		$mail->Username = $this->username; 	 		// Usuário do servidor SMTP       
		$mail->Password = $this->senha;             // Senha do servidor SMTP
		//$mail->SMTPSecure = 'tls';				// para integração com e-mails do google
		$mail->Port = 587;

		$mail->SMTPOptions = array(
    		'ssl' => array(
	        	'verify_peer'		=> false,
	        	'verify_peer_name' 	=> false,
	        	'allow_self_signed' => true
    		)
		);

		// Define o remetente.
		$mail->From     = $this->username; 			// Seu e-mail
		$mail->FromName = $this->nome;      		// Seu nome

		// Define os destinatário(s)
		$mail->AddAddress($this->email, "");		// Define o e-mail do remetente
		$mail->IsHTML(true); 						// Define que o e-mail será enviado como HTML

		$mail->Subject = $this->assunto; 			// Assunto da mensagem
		$mail->Timeout = 20;

		$mail->Body 	= $cabecalhoCorpo.$this->corpo.$rodapeCorpo; 
		$mail->MsgHTML 	= $cabecalhoCorpo.$this->corpo.$rodapeCorpo;

		$enviado = $mail->Send();
		$mail->ClearAllRecipients();
		$mail->ClearAttachments();

		if ($enviado) {
			return true;
		}
		return false;
	}
}
?>