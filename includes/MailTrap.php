<?php

namespace Shapla\Developer\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class MailTrap {

	/**
	 * @var array
	 */
	private $config = array();

	/**
	 * @var self
	 */
	private static $instance;

	/**
	 * Only one instance of the class can be loaded
	 *
	 * @param array $config
	 *
	 * @return self
	 */
	public static function init( $config ) {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self( $config );

			add_action( 'phpmailer_init', array( self::$instance, 'send_mail_in_trap' ) );
		}

		return self::$instance;
	}

	/**
	 * MailTrap constructor.
	 *
	 * @param array $config
	 */
	public function __construct( $config ) {
		$this->config = $config;
	}

	/**
	 * @param \PHPMailer $mailer
	 */
	public function send_mail_in_trap( $mailer ) {
		$mailer->isSMTP();
		$mailer->SMTPAuth = true;
		$mailer->Host     = $this->config['mail']['host'];
		$mailer->Port     = $this->config['mail']['port'];
		$mailer->Username = $this->config['mail']['username'];
		$mailer->Password = $this->config['mail']['password'];
	}
}