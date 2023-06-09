<?php
/**
 * The Education Level Content Block.
 *
 * @since 3.0
 *
 * @category   WordPress\Plugin
 * @package    Connections Business Directory
 * @subpackage Connections_Directory\Extension\Education_Level\Content_Blocks
 * @author     Steven A. Zahm
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2023, Steven A. Zahm
 * @link       https://connections-pro.com/
 */

namespace Connections_Directory\Extension\Education_Level\Content_Blocks\Entry;

use cnEntry;
use Connections_Directory\Content_Block;
use Connections_Education_Levels;

final class Education_Level extends Content_Block {

	/**
	 * @since 3.0
	 * @var string
	 */
	const ID = 'education_level';

	/**
	 * Constructor.
	 *
	 * @since 3.0
	 *
	 * @param string $id The Content Block ID.
	 */
	public function __construct( $id ) {

		$atts = array(
			'name'                => __( 'Education Level', 'connections_education_levels' ),
			'register_option'     => false,
			'permission_callback' => array( $this, 'permission' ),
			'heading'             => __( 'Education Level', 'connections_education_levels' ),
		);

		parent::__construct( $id, $atts );
	}

	/**
	 * Callback for the `permission_callback` parameter.
	 *
	 * @since 3.0
	 *
	 * @return bool
	 */
	public function permission(): bool {

		return true;
	}

	/**
	 * Renders the Education Level Content Block.
	 *
	 * @since 3.0
	 */
	public function content() {

		$entry = $this->getObject();

		if ( ! $entry instanceof cnEntry ) {

			return;
		}

		$value = $entry->getMeta(
			array(
				'key'    => self::ID,
				'single' => true,
			)
		);

		if ( $education = Connections_Education_Levels::education( (string) $value ) ) {

			printf( '<div class="cn-education-level">%1$s</div>', esc_attr( $education ) );
		}
	}
}
