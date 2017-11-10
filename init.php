<?php
/**
 * Plugin Name: Shapla WordPress Developer
 * Plugin URI: https://github.com/sayful1/shapla-wordpress-developer
 * Description: A WordPress plugin, which helps WordPress developers develop.
 * Version: 1.0.0
 * Author: Sayful Islam
 * Author URI: https://sayfulislam.com
 * Requires at least: 4.4
 * Tested up to: 4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Shapla_WordPress_Developer' ) ) {

	class Shapla_WordPress_Developer {

		protected static $instance;
		protected $config = array();

		/**
		 * @return Shapla_WordPress_Developer
		 */
		public static function init() {

			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Shapla_WordPress_Developer constructor.
		 */
		public function __construct() {
			$this->config = include 'config.php';

			$this->includes();
			$this->init_classes();
		}

		/**
		 * Includes required files
		 */
		private function includes() {
			include 'includes/MailTrap.php';
			include 'includes/MonsterWidget.php';
		}

		/**
		 * Initiate classes
		 */
		private function init_classes() {
			// Send all to mailtrap.io
			new \Shapla\Developer\Core\MailTrap( $this->config );
		}
	}
}

Shapla_WordPress_Developer::init();
