<?php
/**
 * An extension for the Connections plugin which adds a metabox for education levels.
 *
 * @package   Connections Business Directory Extension - Education Level
 * @category  Extension
 * @author    Steven A. Zahm
 * @license   GPL-2.0+
 * @link      https://connections-pro.com
 * @copyright 2023 Steven A. Zahm
 *
 * @wordpress-plugin
 * Plugin Name:       Connections Business Directory Extension - Education Level
 * Plugin URI:        https://connections-pro.com/add-on/education-level/
 * Description:       An extension for the Connections plugin which adds a metabox for education levels.
 * Version:           3.0.2
 * Author:            Steven A. Zahm
 * Author URI:        https://connections-pro.com
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       connections_education_levels
 * Domain Path:       /languages
 */

use Connections_Directory\Extension\Education_Level\Content_Blocks;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists('Connections_Education_Levels') ) {

	class Connections_Education_Levels {

		const VERSION = '3.0.2';

		/**
		 * @var Connections_Education_Levels Stores the instance of this class.
		 *
		 * @access private
		 * @since 1.1
		 */
		private static $instance;

		/**
		 * @var string The absolute path this file.
		 *
		 * @access private
		 * @since 1.1
		 */
		private static $file = '';

		/**
		 * @var string The URL to the plugin's folder.
		 *
		 * @access private
		 * @since 1.1
		 */
		private static $url = '';

		/**
		 * @var string The absolute path to this plugin's folder.
		 *
		 * @access private
		 * @since 1.1
		 */
		private static $path = '';

		/**
		 * @var string The basename of the plugin.
		 *
		 * @access private
		 * @since 1.0
		 */
		private static $basename = '';

		public function __construct() { /* Do nothing here */ }

		/**
		 * @access public
		 * @since  1.1
		 *
		 * @return Connections_Education_Levels
		 */
		public static function instance() {

			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Connections_Education_Levels ) ) {

				self::$instance = $self = new self;

				self::$file       = __FILE__;
				self::$url        = plugin_dir_url( self::$file );
				self::$path       = plugin_dir_path( self::$file );
				self::$basename   = plugin_basename( self::$file );

				self::loadDependencies();
				self::hooks();

				/**
				 * This should run on the `plugins_loaded` action hook. Since the extension loads on the
				 * `plugins_loaded` action hook, load immediately.
				 */
				cnText_Domain::register(
					'connections_education_levels',
					self::$basename,
					'load'
				);

				// register_activation_hook( CNIL_BASE_NAME . '/connections_education_levels.php', array( __CLASS__, 'activate' ) );
				// register_deactivation_hook( CNIL_BASE_NAME . '/connections_education_levels.php', array( __CLASS__, 'deactivate' ) );
			}

			return self::$instance;
		}

		/**
		 * Gets the basename of a plugin.
		 *
		 * @access public
		 * @since  1.1
		 *
		 * @return string
		 */
		public function pluginBasename() {

			return self::$basename;
		}

		/**
		 * Get the absolute directory path (with trailing slash) for the plugin.
		 *
		 * @access public
		 * @since  1.1
		 *
		 * @return string
		 */
		public function pluginPath() {

			return self::$path;
		}

		/**
		 * Get the URL directory path (with trailing slash) for the plugin.
		 *
		 * @access public
		 * @since  1.1
		 *
		 * @return string
		 */
		public function pluginURL() {

			return self::$url;
		}

		/**
		 * Register all the hooks that makes this thing run.
		 *
		 * @access private
		 * @since  1.1
		 */
		private static function hooks() {

			// Register the metabox and fields.
			add_action( 'cn_metabox', array( __CLASS__, 'registerMetabox') );

			// Register the custom fields CSV Export attributes and processing callback.
			add_filter( 'cn_csv_export_fields_config', array( __CLASS__, 'registerCustomFieldCSVExportConfig' ) );
			add_filter( 'cn_export_header-education_level', array( __CLASS__, 'registerCSVExportFieldHeader' ), 10, 3 );
			add_filter( 'cn_export_field-education_level', array( __CLASS__, 'registerCustomFieldExportAction' ), 10, 4 );

			// Register the custom fields CSV Import mapping options and processing callback.
			add_filter( 'cncsv_map_import_fields', array( __CLASS__, 'registerCSVImportFieldHeader' ) );
			add_action( 'cncsv_import_fields', array( __CLASS__, 'registerCustomFieldImportAction' ), 10, 3 );

			/*
			 * Register the content block.
			 *
			 * Call `\Connections_Directory\Content_Blocks::instance()->renderBlock( 'education_level', $entry );` to render in a template.
			 */
			Content_Blocks\Entry\Education_Level::add();

			// Add the business hours option to the admin settings page.
			// This is also required, so it'll be rendered by $entry->getContentBlock( 'education_level' ).
			add_filter( 'cn_content_blocks', array( __CLASS__, 'settingsOption') );

			// Add the action that'll be run when calling $entry->getContentBlock( 'education_level' ) from within a template.
			// add_action( 'cn_output_meta_field-education_level', array( __CLASS__, 'block' ), 10, 4 );

			// Register the widget.
			add_action( 'widgets_init', array( 'CN_Education_Levels_Widget', 'register' ) );
		}

		/**
		 * The widget.
		 *
		 * @access private
		 * @since  1.0
		 * @static
		 * @return void
		 */
		private static function loadDependencies() {

			$path = Connections_Education_Levels()->pluginPath();

			require_once "{$path}includes/class.widgets.php";
			require_once "{$path}includes/Content_Blocks/Education_Level.php";
		}

		public static function activate() {}

		public static function deactivate() {}

		/**
		 * Defines the education level options.
		 *
		 * @access private
		 * @since  1.0
		 * @static
		 * @uses   apply_filters()
		 * @return array An indexed array containing the education levels.
		 */
		private static function levels() {

			$options = array(
				'-1' => __( 'Choose...', 'connections_education_levels'),
				'1'  => __( '1st - 4th Grade', 'connections_education_levels'),
				'5'  => __( '5th - 6th Grade', 'connections_education_levels'),
				'7'  => __( '7th - 8th Grade', 'connections_education_levels'),
				'9'  => __( '9th Grade', 'connections_education_levels'),
				'10' => __( '10th Grade', 'connections_education_levels'),
				'11' => __( '11th Grade', 'connections_education_levels'),
				'12' => __( '12th Grade No Diploma', 'connections_education_levels'),
				'13' => __( 'High School Graduate', 'connections_education_levels'),
				'15' => __( 'Some College No Degree', 'connections_education_levels'),
				'20' => __( 'Associate\'s Degree, occupational', 'connections_education_levels'),
				'25' => __( 'Associate\'s Degree, academic', 'connections_education_levels'),
				'30' => __( 'Bachelor\'s Degree', 'connections_education_levels'),
				'35' => __( 'Master\'s Degree', 'connections_education_levels'),
				'40' => __( 'Professional Degree', 'connections_education_levels'),
				'45' => __( 'Doctoral Degree', 'connections_education_levels'),
			);

			$options = apply_filters_deprecated(
				'cn_education_level_options',
				array( $options ),
				'3.0.2',
				'Connections_Directory/Education_Level/Options'
			);

			return apply_filters( 'Connections_Directory/Education_Level/Options', $options );
		}

		/**
		 * Return the education level based on the supplied key.
		 *
		 * @since 1.0
		 * @since 3.0 Make method public.
		 *
		 * @param string $level The key of the education level to return.
		 *
		 * @return false|string	The education level if found, if not, false.
		 */
		public static function education( $level = '' ) {

			if ( ! is_string( $level ) || empty( $level ) || $level === '-1' ) {

				return false;
			}

			$levels    = self::levels();
			$education = isset( $levels[ $level ] ) ? $levels[ $level ] : false;

			return $education;
		}

		/**
		 * Callback for the `cn_csv_export_fields_config` filter.
		 *
		 * @access private
		 * @since  2.0
		 *
		 * @param array $fields
		 *
		 * @return array
		 */
		public static function registerCustomFieldCSVExportConfig( $fields ) {

			$fields[] = array(
				'field'  => 'education_level',
				'type'   => 'education_level',
				'fields' => '',
				'table'  => CN_ENTRY_TABLE_META,
				'types'  => NULL,
			);

			return $fields;
		}

		/**
		 * Callback for the `cn_export_header-education_level` action.
		 *
		 * @access private
		 *
		 * @param string                 $header
		 * @param array                  $field
		 * @param cnCSV_Batch_Export_All $export
		 *
		 * @return string
		 * @since  2.0
		 *
		 */
		public static function registerCSVExportFieldHeader( $header, $field, $export ) {

			$header = __( 'Education Level', 'connections_education_levels' );

			return $header;
		}

		/**
		 * Callback for the `cn_export_field-education_level` filter.
		 *
		 * @access private
		 * @since  2.0
		 *
		 * @param string                 $value
		 * @param object                 $entry
		 * @param array                  $field The field config array.
		 * @param cnCSV_Batch_Export_All $export
		 *
		 * @return string
		 */
		public static function registerCustomFieldExportAction( $value, $entry, $field, $export ) {

			if ( 'education_level' !== $field['field'] ) return $value;

			$value = '';
			$meta  = cnMeta::get( 'entry', $entry->id, $field['field'], TRUE );

			if ( ! empty( $meta ) ) {

				$data  = Connections_Directory\Utility\_::maybeJSONencode( $meta );
				$level = self::education( (string) $data );

				if ( false !== $level ) {

					$value = $export->escapeAndQuote( $level );
				}
			}

			return $value;
		}

		/**
		 * Callback for the `cncsv_map_import_fields` filter.
		 *
		 * @access private
		 * @since  2.0
		 *
		 * @param array $fields
		 *
		 * @return array
		 */
		public static function registerCSVImportFieldHeader( $fields ) {

			$fields['education_level'] = __( 'Education Level', 'connections_education_levels' );

			return $fields;
		}

		/**
		 * Callback for the `cncsv_import_fields` action.
		 *
		 * @access private
		 * @since  2.0
		 *
		 * @param int         $id
		 * @param array       $row
		 * @param cnCSV_Entry $entry
		 */
		public static function registerCustomFieldImportAction( $id, $row, $entry ) {

			$meta  = array();
			$level = $entry->arrayPull( $row, 'education_level' );

			if ( ! is_null( $level ) ) {

				$result = array_search( $level, self::levels() );

				if ( false !== $result ) {

					$meta[] = array(
						'key'   => 'education_level',
						'value' => $result,
					);

					cnEntry_Action::meta( 'update', $id, $meta );
				}
			}
		}

		/**
		 * Registered the custom metabox.
		 *
		 * @access private
		 * @since  1.0
		 * @static
		 * @uses   levels()
		 * @uses   cnMetaboxAPI::add()
		 * @return void
		 */
		public static function registerMetabox() {

			$atts = array(
				'name'     => __( 'Education Level', 'connections_education_levels' ),
				'id'       => 'education-level',
				'title'    => __( 'Education Level', 'connections_education_levels' ),
				'context'  => 'side',
				'priority' => 'core',
				'fields'   => array(
					array(
						'id'      => 'education_level',
						'type'    => 'select',
						'options' => self::levels(),
						'default' => '-1',
						),
					),
				);

			cnMetaboxAPI::add( $atts );
		}

		/**
		 * Add the custom meta as an option in the content block settings in the admin.
		 * This is required for the output to be rendered by $entry->getContentBlock().
		 *
		 * @access private
		 * @since  1.0
		 * @param  array  $blocks An associative array containing the registered content block settings options.
		 * @return array
		 */
		public static function settingsOption( $blocks ) {

			$blocks['education_level'] = __( 'Education Level', 'connections_education_levels' );

			return $blocks;
		}

		/**
		 * Callback for the `cn_output_meta_field-education_level` action.
		 * Renders the Education Levels content block.
		 *
		 * @internal
		 * @since 1.0
		 * @deprecated Since 3.0
		 *
		 * @param string       $id     The field id.
		 * @param string       $value  The education level ID.
		 * @param cnEntry_HTML $object An instance of the cnEntry object.
		 * @param array        $atts   The shortcode atts array passed from the calling action.
		 */
		public static function block( $id, $value, $object, $atts ) {

			if ( $education = self::education( (string) $value ) ) {

				printf( '<div class="cn-education-level">%1$s</div>', esc_attr( $education ) );
			}

		}

	}

	/**
	 * Start up the extension.
	 *
	 * @access public
	 * @since 1.0
	 *
	 * @return Connections_Education_Levels|false
	 */
	function Connections_Education_Levels() {

		if ( class_exists( 'connectionsLoad' ) ) {

			return Connections_Education_Levels::instance();

		} else {

			add_action(
				'admin_notices',
				function() {
					echo '<div id="message" class="error"><p><strong>ERROR:</strong> Connections must be installed and active in order use Connections Education Level.</p></div>';
				}
			);

			return false;
		}
	}

	/**
	 * Since Connections loads at default priority 10, and this extension is dependent on Connections,
	 * we'll load with priority 11, so we know Connections will be loaded and ready first.
	 */
	add_action( 'plugins_loaded', 'Connections_Education_Levels', 11 );

}
