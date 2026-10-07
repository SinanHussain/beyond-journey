<?php
/**
 * Elementor widget classes. Loaded only when Elementor registers widgets.
 *
 * @package Beyond_Journey
 */

defined( 'ABSPATH' ) || exit;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

/**
 * A theme section as an Elementor widget. Panel controls come from bj_widget_schemas(),
 * defaults from bj_section_defaults(), and the output from the section template.
 */
abstract class BJ_Elementor_Widget extends Widget_Base {

	/**
	 * Section name (template-parts/sections/{name}.php).
	 *
	 * @var string
	 */
	protected $bj_section = '';

	/** Schema of this widget. */
	protected function bj_schema() {
		$schemas = bj_widget_schemas();
		return $schemas[ $this->bj_section ];
	}

	/** Widget name. */
	public function get_name() {
		return 'bj-' . $this->bj_section;
	}

	/** Widget title. */
	public function get_title() {
		$schema = $this->bj_schema();
		return $schema['title'];
	}

	/** Widget icon. */
	public function get_icon() {
		$schema = $this->bj_schema();
		return $schema['icon'];
	}

	/** Widget category. */
	public function get_categories() {
		return array( 'beyond-journey' );
	}

	/** Search keywords. */
	public function get_keywords() {
		return array( 'beyond journey', 'travel', str_replace( '-', ' ', $this->bj_section ) );
	}

	/** The section markup needs no extra wrapper. */
	public function has_widget_inner_wrapper(): bool {
		return false;
	}

	/**
	 * Value for a field in a newly added list item.
	 *
	 * @param array $field Field definition.
	 * @return mixed
	 */
	protected function bj_new_item_value( $field ) {
		if ( 'media' === $field['type'] ) {
			return array(
				'url' => Utils::get_placeholder_image_src(),
				'id'  => '',
			);
		}
		if ( 'select' === $field['type'] ) {
			return (string) key( $field['options'] );
		}
		return '';
	}

	/**
	 * Elementor control arguments for a field.
	 *
	 * @param array $field Field definition.
	 * @param mixed $value Default value.
	 * @return array
	 */
	protected function bj_control( $field, $value ) {
		$args = array(
			'label'   => $field['label'],
			'default' => bj_elementor_value( $field, $value ),
		);
		if ( ! empty( $field['description'] ) ) {
			$args['description'] = $field['description'];
		}

		switch ( $field['type'] ) {
			case 'text':
				$args += array(
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
				);
				break;
			case 'textarea':
				$args += array(
					'type' => Controls_Manager::TEXTAREA,
					'rows' => 4,
				);
				break;
			case 'lines':
				$args += array(
					'type' => Controls_Manager::TEXTAREA,
					'rows' => 7,
				);
				break;
			case 'url':
				$args += array(
					'type'        => Controls_Manager::URL,
					'label_block' => true,
					'options'     => array( 'url', 'is_external', 'nofollow' ),
				);
				break;
			case 'media':
				$args += array( 'type' => Controls_Manager::MEDIA );
				break;
			case 'switcher':
				$args += array(
					'type'         => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
				);
				break;
			case 'select':
				$args += array(
					'type'    => Controls_Manager::SELECT,
					'options' => $field['options'],
				);
				break;
			case 'repeater':
				$repeater = new Repeater();
				foreach ( $field['fields'] as $key => $sub ) {
					$repeater->add_control( $key, $this->bj_control( $sub, $this->bj_new_item_value( $sub ) ) );
				}
				$args += array(
					'type'          => Controls_Manager::REPEATER,
					'fields'        => $repeater->get_controls(),
					'title_field'   => '{{{ ' . $field['title'] . ' }}}',
					'prevent_empty' => false,
				);
				break;
		}
		return $args;
	}

	/** Panel controls, one panel section per schema group. */
	protected function register_controls() {
		$defaults = apply_filters( 'bj_widget_defaults', bj_section_defaults( $this->bj_section ), $this->bj_section );
		$schema   = $this->bj_schema();
		$index    = 0;
		foreach ( $schema['groups'] as $label => $fields ) {
			$this->start_controls_section(
				'bj_group_' . $index++,
				array(
					'label' => $label,
					'tab'   => Controls_Manager::TAB_CONTENT,
				)
			);
			foreach ( $fields as $key => $field ) {
				$this->add_control( $key, $this->bj_control( $field, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' ) );
			}
			$this->end_controls_section();
		}
	}

	/** Output: the theme's section template with the widget settings. */
	protected function render() {
		bj_section( $this->bj_section, $this->get_settings_for_display() );
	}
}

// phpcs:disable Generic.Files.OneObjectStructurePerFile.MultipleFound, Squiz.Commenting.ClassComment.Missing
class BJ_Widget_Hero extends BJ_Elementor_Widget {
	protected $bj_section = 'hero';
}
class BJ_Widget_Page_Hero extends BJ_Elementor_Widget {
	protected $bj_section = 'page-hero';
}
class BJ_Widget_About_Intro extends BJ_Elementor_Widget {
	protected $bj_section = 'about-intro';
}
class BJ_Widget_Inbound extends BJ_Elementor_Widget {
	protected $bj_section = 'inbound';
}
class BJ_Widget_Services extends BJ_Elementor_Widget {
	protected $bj_section = 'services';
}
class BJ_Widget_Why_Us extends BJ_Elementor_Widget {
	protected $bj_section = 'why-us';
}
class BJ_Widget_Dmc extends BJ_Elementor_Widget {
	protected $bj_section = 'dmc';
}
class BJ_Widget_Destinations extends BJ_Elementor_Widget {
	protected $bj_section = 'destinations';
}
class BJ_Widget_Hotels extends BJ_Elementor_Widget {
	protected $bj_section = 'hotels';
}
class BJ_Widget_Process extends BJ_Elementor_Widget {
	protected $bj_section = 'process';
}
class BJ_Widget_Vision_Mission extends BJ_Elementor_Widget {
	protected $bj_section = 'vision-mission';
}
class BJ_Widget_Core_Values extends BJ_Elementor_Widget {
	protected $bj_section = 'core-values';
}
class BJ_Widget_Team extends BJ_Elementor_Widget {
	protected $bj_section = 'team';
}
class BJ_Widget_Growth extends BJ_Elementor_Widget {
	protected $bj_section = 'growth';
}
class BJ_Widget_Commitment extends BJ_Elementor_Widget {
	protected $bj_section = 'commitment';
}
class BJ_Widget_Stats extends BJ_Elementor_Widget {
	protected $bj_section = 'stats';
}
class BJ_Widget_Final_Cta extends BJ_Elementor_Widget {
	protected $bj_section = 'final-cta';
}
class BJ_Widget_Contact extends BJ_Elementor_Widget {
	protected $bj_section = 'contact';
}
class BJ_Widget_Destinations_Directory extends BJ_Elementor_Widget {
	protected $bj_section = 'destinations-directory';
}
class BJ_Widget_Dmc_Groups extends BJ_Elementor_Widget {
	protected $bj_section = 'dmc-groups';
}
class BJ_Widget_Dmc_Partners extends BJ_Elementor_Widget {
	protected $bj_section = 'dmc-partners';
}
class BJ_Widget_Site_Footer extends BJ_Elementor_Widget {
	protected $bj_section = 'site-footer';
}
class BJ_Widget_Packages extends BJ_Elementor_Widget {
	protected $bj_section = 'packages';
}
class BJ_Widget_Packages_Showcase extends BJ_Elementor_Widget {
	protected $bj_section = 'packages-showcase';
}
// phpcs:enable
