<?php
/**!
 * Plugin Name: Shapla WordPress Developer
 * Plugin URI: https://github.com/sayful1/shapla-wordpress-developer
 * Description: A WordPress plugin, which helps WordPress developers develop.
 * Version: 1.0.0
 * Author: Sayful Islam
 * Author URI: https://sayfulislam.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Shapla_WordPress_Developer' ) ) {

	class Shapla_WordPress_Developer {

		/**
		 * @var self
		 */
		protected static $instance;

		/**
		 * @var array
		 */
		protected $config = array();

		/**
		 * Only one instance of the class can be loaded
		 *
		 * @return self
		 */
		public static function init() {

			if ( is_null( self::$instance ) ) {
				self::$instance = new self();

				self::$instance->config = include 'config.php';

				self::$instance->includes();
				self::$instance->init_classes();
			}

			return self::$instance;
		}

		/**
		 * Includes required files
		 */
		private function includes() {
			include 'includes/MailTrap.php';
			include 'includes/MonsterWidget.php';
			include 'includes/JsonBasicAuth.php';
		}

		/**
		 * Initiate classes
		 */
		private function init_classes() {
			// Send all to mailtrap.io
			\Shapla\Developer\Core\MailTrap::init( $this->config );

			add_action( 'widgets_init', array( \Shapla\Developer\Core\MonsterWidget::class, 'register' ) );
		}
	}
}

Shapla_WordPress_Developer::init();
