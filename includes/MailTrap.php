<?php

namespace Shapla\Developer\Core;


class MailTrap {

	protected $config;

	/**
	 * MailTrap constructor.
	 *
	 * @param $config
	 */
	public function __construct( $config ) {
		$this->config = $config;

		add_action( 'phpmailer_init', array( $this, 'send_mail_in_trap' ) );
	}

	/**
	 * @param \PHPMailer $mailer
	 */
	public function send_mail_in_trap( $mailer ) {
		$mailer->isSMTP();
		$mailer->SMTPAuth = true;
		$mailer->Host     = $this->config->mail->host;
		$mailer->Port     = $this->config->mail->port;
		$mailer->Username = $this->config->mail->username;
		$mailer->Password = $this->config->mail->password;
	}

}