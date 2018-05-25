<?php
/**
 * Custom WP Customizer functionality
 *
 * @package Cryout Framework
 */

///////// SANITIZERS /////////
function cryout_customizer_sanitize_blank(){
	// dummy function that does nothing, since the sanitized add_section
	// calling it does not add any user-editable field
} // cryout_customizer_sanitize_blank()

function cryout_customizer_sanitize_number($input){
	return ( is_numeric( $input ) ) ? $input : intval( $input );
} // cryout_customizer_sanitize_number()

function cryout_customizer_sanitize_checkbox($input){
    if ( intval( $input ) == 1 ) return 1;
    return 0;
} // cryout_customizer_sanitize_checkbox()

function cryout_customizer_sanitize_url($input){
	return esc_url_raw( $input );
} // cryout_customizer_sanitize_url()

function cryout_customizer_sanitize_googlefont($input){
	return preg_replace( '/\+/', ' ', wp_kses_post($input) );
} // cryout_customizer_sanitize_url()

function cryout_customizer_sanitize_color($input){
	return sanitize_hex_color($input);
} // cryout_customizer_sanitize_color()

function cryout_customizer_sanitize_text($input){
	// return wp_filter_nohtml_kses( $input );
	return wp_kses_post( $input );
} // cryout_customizer_sanitize_text()

function cryout_customizer_sanitize_generic($input){
	return wp_kses_post( $input );
} // cryout_customizer_sanitize_generic()


///////// CUSTOM CUSTOMIZERS /////////
function cryout_customizer_extras($wp_customize){


	class Cryout_Customize_Link_Control extends WP_Customize_Control {
			public $type = 'link';
			public function render_content() {
				if ( !empty( $this->description ) ) { ?>
					<li class="customize-section-description-container">
						<div class="description customize-section-description">
						    <?php echo esc_attr( $this->description ); ?>
						</div>
					</li>
				<?php
				}
				echo '<a href="' . esc_url( $this->value() ) . '" target="_blank">' . esc_attr( $this->label ) .'</a>';
			}
	} // class Cryout_Customize_Link_Control

	class Cryout_Customize_About_Section extends WP_Customize_Section {
		public $type = 'about';
		public $button = FALSE;
		public $button_label = '';
		public function json() {
			$json = parent::json();
			$json['button'] = absint( $this->button );
			$json['button_label']  = esc_attr( $this->button_label );
			return $json;
		}
		protected function render_template() { ?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section customize-cryoutspecial-about-section control-section-{{ data.type }}">
			<h3 class="accordion-section-title" tabindex="0">
				{{ data.title }}

				<# if ( data.button && data.button_label ) { #>
					<a class="button alignright">{{ data.button_label }}</a>
				<# } #>
			</h3>
			<ul class="accordion-section-content">
				<li class="customize-section-description-container section-meta <# if ( data.description_hidden ) { #>customize-info<# } #>">
					<div class="customize-section-title">
						<button class="customize-section-back" tabindex="-1"></button>
						<h3>
							<span class="customize-action">
								{{{ data.customizeAction }}}
							</span>
							{{ data.title }}
						</h3>
						<# if ( data.description && data.description_hidden ) { #>
							<button type="button" class="customize-help-toggle dashicons dashicons-editor-help" aria-expanded="false"></button>
							<div class="description customize-section-description">
								{{{ data.description }}}
							</div>
						<# } #>

						<div class="customize-control-notifications-container"></div>
					</div>

					<# if ( data.description && ! data.description_hidden ) { #>
						<div class="description customize-section-description">
							{{{ data.description }}}
						</div>
					<# } #>
				</li>
			</ul>
		</li>
		<?php }
	} // Cryout_Customize_About_Section()

	class Cryout_Customize_About_Control extends WP_Customize_Control {
			public $type = 'about';
			public function render_content() {
					if ( ! empty( $this->label ) ) { ?>
                        <span class="customize-control-title"><?php echo esc_attr( $this->label ) ?></span>
					<?php }
					if ( ! empty( $this->description ) ) { ?>
                        <span class="description customize-control-description cryout-nomove"><?php echo wp_kses_post( $this->description ) ?></span>
                    <?php } ?>
					<span class="customize-control-content customize-cryoutspecial-about-link"><?php echo wp_kses_post( $this->value() ) ?></span>
			<?php
			}
	} // class Cryout_Customize_About_Control

	class Cryout_Customize_Hint_Control extends WP_Customize_Control {
			public $type = 'hint';
			public function render_content() {
					if ( ! empty( $this->label ) ) { ?>
                        <span class="customize-control-title customize-cryoutcontrol-hint"><?php echo esc_attr( $this->label ) ?></span>
					<?php }
					if ( ! empty( $this->description ) ) { ?>
                        <span class="description customize-control-description cryout-nomove customize-cryoutcontrol-hint-desc"><?php echo $this->description ?></span>
                    <?php } ?>
					<span class="customize-control-content customize-cryoutcontrol-hint-value"><?php echo wp_kses_post( $this->value() ) ?></span>
			<?php
			}
	} // class Cryout_Customize_Hint_Control

	class Cryout_Customize_Notice_Control extends WP_Customize_Control {
			public $type = 'notice';
			public function render_content() {
					if ( ! empty( $this->label ) ) { ?>
                        <span class="customize-control-title customize-cryoutcontrol-notice customize-cryoutcontrol-notice-<?php echo $this->input_attrs['class'] ?>"><?php echo esc_attr( $this->label ) ?></span>
					<?php }
					if ( ! empty( $this->description ) ) { ?>
                        <span class="description customize-control-description cryout-nomove customize-cryoutcontrol-notice-desc customize-cryoutcontrol-notice-<?php echo $this->input_attrs['class'] ?>-desc"><?php echo $this->description ?></span>
                    <?php } ?>
					<span class="customize-control-content customize-cryoutcontrol-notice-value customize-cryoutcontrol-notice-<?php echo $this->input_attrs['class'] ?>-value"><?php echo wp_kses_post( $this->value() ) ?></span>
			<?php
			}
	} // class Cryout_Customize_Notice_Control

	class Cryout_Customize_Blank_Control extends WP_Customize_Control {
			public $type = 'blank';
			public function render_content() {
				echo '&nbsp;';
			}
	} // class Cryout_Customize_Blank_Control

	class Cryout_Customize_Null_Control extends WP_Customize_Control {
			public $type = NULL;
			public function render_content() {
				return;
			}
	} // class Cryout_Customize_Null_Control


	class Cryout_Customize_Font_Control extends WP_Customize_Control {
			public $type = 'font';
			private $fonts = array();
			public function render_content() {
				$this->fonts = cryout_get_theme_structure('fonts');
				?>
				<label>
					<?php if ( ! empty( $this->label ) ) : ?>
						<span class="customize-control-title"><?php echo esc_attr( $this->label ); ?></span>
					<?php endif;
					if ( ! empty( $this->description ) ) : ?>
						<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ) ?></span>
					<?php endif; ?>

					<select <?php $this->link(); ?>>
						<?php
						foreach ( $this->fonts as $fgroup => $fsubs ): ?>
							<optgroup label='<?php echo $fgroup; ?>'>
							<?php foreach($fsubs as $item):
								$item_show = explode(',',$item); ?>
								<option style='font-family:<?php echo cryout_clean_gfont($item); ?>;' value='<?php echo $item; ?>' <?php selected( $this->value(), $item ); ?>>
									<?php echo cryout_clean_gfont( $item_show[0] ); ?>
								</option>
							<?php endforeach; // fsubs ?>
							</optgroup>
						<?php endforeach; // $this->fonts ?>
					</select>
				</label>
				<?php
			} // render_content()

			public function enqueue() {
				// google fonts enqueues for the font selectors preview
				$gfonts = array();
				$cryout_theme_structure = cryout_get_theme_structure();
				$cryout_theme_options = cryout_get_option();
				foreach ($cryout_theme_structure['google-font-enabled-fields'] as $item) {
					if ( preg_match('/^(.*)\/gfont$/i', $cryout_theme_options[$item], $bits) ) $gfonts[] = $bits[1];
				};
				if ( count($gfonts) ):
					wp_enqueue_style( 'cryout-googlefonts', '//fonts.googleapis.com/css?family=' . implode( "|" , array_unique($gfonts) ), null, _CRYOUT_THEME_VERSION );
				endif;
			} // enqueue()

	} // class Cryout_Customize_Font_Control


	class Cryout_Customize_Slider_Control extends WP_Customize_Control {

	public $type = 'slider';
			public function __construct($manager, $id, $args = array(), $options = array()) {
				parent::__construct( $manager, $id, $args );
			} // __construct()

			public function render_content() { ?>
				<label>
					<span class="customize-control-title"><?php echo esc_attr( $this->label ); ?>:
						<strong class="value"><?php echo esc_attr( $this->value() ) ?></strong><?php echo $this->input_attrs['um']; ?>
					</span>
				</label>
				<input name="<?php echo $this->id; ?>" type="number" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ) ?>" class="slider"
					step="<?php echo $this->input_attrs['step'] ?>" min="<?php echo $this->input_attrs['min'] ?>" max="<?php echo $this->input_attrs['max'] ?>" />
				<div class="slider"></div>
				<?php if ( ! empty( $this->description ) ) : ?>
					 <span class="description cryout-nomove customize-control-description"><?php echo wp_kses_post( $this->description ) ?></span>
				<?php endif; ?>
			<?php
			} // render_content()

			public function enqueue() {
				wp_enqueue_script( 'jquery-ui-core' );
				wp_enqueue_script( 'jquery-ui-slider' );
				wp_enqueue_script( 'cryout-customizer-controls-js', get_template_directory_uri() . '/cryout/js/customizer-controls.js', array('jquery'), _CRYOUT_THEME_VERSION );
				wp_enqueue_style( 'jquery-ui-slider', get_template_directory_uri() . '/cryout/css/jquery-ui.structure.css', NULL, _CRYOUT_THEME_VERSION );
				wp_enqueue_style( 'jquery-ui-slider-theme', get_template_directory_uri() . '/cryout/css//jquery-ui.theme.css', NULL, _CRYOUT_THEME_VERSION );
			} // enqueue()

	} // class Cryout_Customize_Slider_Control


	class Cryout_Customize_SliderTwo_Control extends WP_Customize_Control {
			public $type = 'slidertwo';
			public function __construct($manager, $id, $args = array(), $options = array()) {
				parent::__construct( $manager, $id, $args );
			} // __construct()

			public function render_content() { ?>
				<label><span class="customize-control-title"><?php echo esc_attr( $this->label ); ?>:
					<strong class="value"><?php echo esc_attr( $this->value() ) ?></strong><?php echo $this->input_attrs['um']; ?> /
					<strong class="value2"><?php echo ( intval($this->input_attrs['total']) - intval($this->value()) ); ?></strong><?php echo $this->input_attrs['um']; ?>
				</span></label>
				<input name="<?php echo $this->id; ?>" type="number" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ) ?>" class="slidertwo"
					step="<?php echo $this->input_attrs['step'] ?>" min="<?php echo $this->input_attrs['min'] ?>"
					max="<?php echo $this->input_attrs['max'] ?>" size="<?php echo $this->input_attrs['total'] ?>"/>
				<div class="slidertwo"></div>
				<?php if ( ! empty( $this->description ) ) : ?>
					 <span class="description cryout-nomove customize-control-description"><?php echo wp_kses_post( $this->description ) ?></span>
				<?php endif; ?>
			<?php
			} // render_content()

			public function enqueue() {
				wp_enqueue_script( 'jquery-ui-core' );
				wp_enqueue_script( 'jquery-ui-slider' );
				wp_enqueue_script( 'cryout-customizer-controls-js', get_template_directory_uri() . '/cryout/js/customizer-controls.js', array('jquery'), _CRYOUT_THEME_VERSION );
				wp_enqueue_style( 'jquery-ui-slider', get_template_directory_uri() . '/cryout/css/jquery-ui.structure.css' );
				wp_enqueue_style( 'jquery-ui-slider-theme', get_template_directory_uri() . '/cryout/css//jquery-ui.theme.css' );
			} // enqueue()

	} // class Cryout_Customize_Slider_Control


	class Cryout_Customize_RadioImage_Control extends WP_Customize_Control {
			public $type = 'radioimage';
			public function __construct($manager, $id, $args = array(), $options = array()) {
				parent::__construct( $manager, $id, $args );
			} // __construct()

			public function render_content() {

				if ( empty( $this->choices ) ) return;

				$name = '_customize-imageradio-' . $this->id;  ?>

				<?php if ( ! empty( $this->label ) ) { ?> <span class="customize-control-title"><?php echo esc_attr( $this->label ) ?></span> <?php } ?>

				<div class="buttonset"> <?php
					foreach ( $this->choices as $value => $data ) :

							$data['url'] = esc_url( sprintf( $data['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) );
							?>
							<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ) . "-" . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
							<label for="<?php echo esc_attr( $name ) . "-" . $value; ?>">
									<img src="<?php echo $data['url'] ?>" alt="<?php echo esc_html( $data['label'] ) ?>" title="<?php echo esc_html( $data['label'] ) ?>"/>
									<span class="screen-reader-text"><?php echo esc_html( $data['label'] ); ?></span>
							</label>
							<?php
					endforeach; ?>
				</div><!-- .buttonset -->

				<?php if ( ! empty( $this->description ) ) { ?> <span class="description cryout-nomove customize-control-description"><?php echo wp_kses_post( $this->description ) ?></span><?php } ?>
			<?php
			} // render_content()

			public function enqueue() {
				wp_enqueue_script( 'jquery-ui-core' );
				wp_enqueue_script( 'jquery-ui-button' );
				wp_enqueue_script( 'cryout-customizer-controls-js', get_template_directory_uri() . '/cryout/js/customizer-controls.js', array('jquery'), _CRYOUT_THEME_VERSION );
			}

	} // class Cryout_Customize_RadioImage_Control

	class Cryout_Customize_OptSelect_Control extends WP_Customize_Control {
			public $type = 'optselect';
			public function render_content() {
				if ( empty( $this->choices ) )
					return;
				?>
				<label>
					<?php if ( ! empty( $this->label ) ) : ?>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php endif;
					if ( ! empty( $this->description ) ) : ?>
						<span class="description customize-control-description"><?php echo $this->description; ?></span>
					<?php endif; ?>

					<select <?php $this->link(); ?>>
					<?php if (!empty($this->input_attrs['disabled'])) { ?><option value="-1"><?php echo esc_attr($this->input_attrs['disabled']); ?></option><?php } ?>
						<?php
						foreach ( $this->choices as $optgroup_id => $optgroup ) {
							echo '<optgroup label="' . $optgroup_id . '">';
							foreach ( $optgroup as $value => $label )
								echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
							echo '</optgroup>';
						} ?>
					</select>
				</label>
				<?php
			} // render_content
	} // Cryout_Customize_OptSelect_Control

	class Cryout_Customize_IconSelect_Control extends WP_Customize_Control {
			public $type = 'iconselect';
			public function render_content() {
				$this->icons = cryout_get_theme_structure('block-icons');
				?>
				<label>
					<?php if ( ! empty( $this->label ) ) : ?>
						<span class="customize-control-title"><?php echo esc_attr( $this->label ); ?></span>
					<?php endif;
					if ( ! empty( $this->description ) ) : ?>
						<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ) ?></span>
					<?php endif; ?>

					<select <?php $this->link(); ?>>
						<?php
						foreach ( $this->icons as $id => $icon ): ?>
							<option value='<?php echo $id; ?>' <?php selected( $this->value(), $id ); ?> class="blicon-<?php echo $id ?>"> <?php echo ( $id!='no-icon' ? "&#x$icon;" : '&nbsp;' ) ?> <?php echo $id ?> </option>
						<?php endforeach; // $this->icons ?>
					</select>
				</label>
				<?php
			} // render_content()

			public function enqueue() {
				// theme icons font enqueue for the icon selector preview
				wp_enqueue_style( 'cryout-theme-fontfaces', get_template_directory_uri() . '/resources/fonts/fontfaces.css', null, _CRYOUT_THEME_VERSION );
			} // enqueue()

	} // class Cryout_Customize_IconSelect_Control

} // cryout_customizer_extras()


////////// THE CUSTOMIZER CLASS /////////
class Cryout_Customizer {

	public function __construct () {

	} // __construct()

	public static function register( $wp_customize ) {
		global $cryout_theme_settings;
		global $cryout_theme_defaults;

		$wp_customize->register_section_type( 'Cryout_Customize_About_Section' );

		////////// add about theme panel and sections //////////
		if (!empty($cryout_theme_settings['info_sections'])):
			$section_priority = 10;

			foreach ($cryout_theme_settings['info_sections'] as $iid=>$info):
				$wp_customize->add_section( new Cryout_Customize_About_Section( $wp_customize, $iid, array(
					'title'          => $info['title'],
					'description'    => $info['desc'],
					'priority'       => $section_priority++,
					'button'		 => $info['button'],
					'button_label'	 => $info['button_label'],
				) ) );
			endforeach;
		endif; //!empty

		foreach ($cryout_theme_settings['info_settings'] as $iid => $info):
			$wp_customize->add_setting( $iid, array(
				'default'        => $info['default'],
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'cryout_customizer_sanitize_blank'
			) );
			$wp_customize->add_control( new Cryout_Customize_About_Control( $wp_customize, $iid, array(
				'label'   	 => $info['label'],
				'description' => $info['desc'],
				'section' 	 => $info['section'],
				'default' 	 => $info['default'],
				'settings'   => $iid,
				'priority'   => 10,
			) ) );
		endforeach;
		////////// end about panel

		////////// add custom theme options panels //////////
		$priority = 45;
		foreach ($cryout_theme_settings['panels'] as $panel):

			$identifier = ( !empty($panel['identifier'])? $panel['identifier'] : 'cryout-' );
			$wp_customize->add_panel( $identifier . $panel['id'], array(
			  'title' => $panel['title'],
			  'description' => '',
			  'priority' => $priority+=5,
			) );

		endforeach;

		////////// add custom theme options sections, settings and empty placeholder control //////////
		$section_priority = 60;
		foreach ($cryout_theme_settings['sections'] as $section):

			// override section id to make it uniquely identifiable

			$wp_customize->add_section( 'cryout-' . $section['id'], array(
				'title'          => $section['title'],
				'description'    => '',
				'priority'       => ( isset($section['priority']) ? $section['priority'] : $section_priority+=5 ),
				'panel'  		 => ($section['sid']?'cryout-' . $section['sid']:''),
			) );

			/*$wp_customize->add_setting( 'placeholder_'.$section_priority, array(
				'default'        => '',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'cryout_customizer_sanitize_blank',
				'section' 		 => 'cryout-' . $section['id'],
			) );*/

			// override section id to make it uniquely identifiable
			/*$wp_customize->add_control( new Cryout_Customize_Blank_Control( $wp_customize, 'placeholder_'.$section_priority, array(
				'section' => 'cryout-' . $section['id'],
				'settings'   => 'placeholder_'.$section_priority,
				'priority'   => 10,
			) ) );*/

		endforeach;
		////////// end option panels/sections

		////////// override built-in wordpress customizer panels, if set //////////
		if (!empty($cryout_theme_settings['panel_overrides']))
		foreach ($cryout_theme_settings['panel_overrides'] as $poid => $pover):

			if (empty($pover['priority2'])) $pover['priority2'] = 60; // failsafe
			switch ($pover['type']):
				case 'remove': // remove bult-in setting/panel
					switch( $pover['section'] ):
						case 'panel':
							$wp_customize->remove_panel( $pover['replaces']);
							break;
						case 'section':
							$wp_customize->remove_section( $pover['replaces']);
							break;
						case 'setting':
						default:
							$wp_customize->remove_setting( $pover['replaces']);
							break;
					endswitch;
					break;
				case 'section': // move built-in setting to theme panel
					$wp_customize->get_section( $pover['replaces'] )->panel = $pover['section'];
					$wp_customize->get_section( $pover['replaces'] )->priority = $pover['priority2'];
					break;
				case 'panel':
				default: // add custom panel to replace built-in panel
					$wp_customize->add_panel( 'cryout-' . $poid, array(
						'priority'       => $pover['priority'],
						'title'          => $pover['title'],
						'description'    => $pover['desc'],
					) );
					$wp_customize->get_section( $pover['replaces'] )->panel = 'cryout-' . $poid;
					$wp_customize->get_section( $pover['replaces'] )->priority = $pover['priority2'];
					break;
			endswitch;

		endforeach;  // overrides

		// options priority start point
		$priority = 10;

		////////// add custom theme option controls, based on option type //////////
		foreach ($cryout_theme_settings['options'] as $opt):

			// check if option should be visible in this case
			if ( !empty( $opt['disable_if'] ) ) {
				if ( function_exists($opt['disable_if']) ) continue;
			}
			if ( !empty( $opt['require_fn'] ) ) {
				if ( ! function_exists($opt['require_fn']) ) continue;
			}

			// identify option clone count
			$clone_count = 1;
			if (preg_match('/#/',$opt['id'])) {
				$clone_section_id = str_replace( '#', '', $opt['section'] );

				if (!empty($cryout_theme_settings['clones'][$clone_section_id]))
					$clone_count = $cryout_theme_settings['clones'][$clone_section_id];

			}

			////////// sanitizer function callback select
			switch ($opt['type']):
				case 'number': case 'slider':
				case 'range':			$sanitize_callback = 'cryout_customizer_sanitize_number'; 		break;
				case 'checkbox':		$sanitize_callback = 'cryout_customizer_sanitize_checkbox';		break;
				case 'url': 			$sanitize_callback = 'cryout_customizer_sanitize_url';			break;
				case 'color':			$sanitize_callback = 'cryout_customizer_sanitize_color';		break;
				case 'googlefont':      $sanitize_callback = 'cryout_customizer_sanitize_googlefont';   break;
				case 'media': case 'media-image':
										$sanitize_callback = 'cryout_customizer_sanitize_number';		break;
				case 'hint': case 'blank':
										$sanitize_callback = 'cryout_customizer_sanitize_blank';		break;
				case 'text': case 'tel': case 'email': case 'search':  case 'radio':
				case 'time': case 'date': case 'datetime': case 'week':
				case 'textarea':		$sanitize_callback = 'cryout_customizer_sanitize_text';			break;
				default: 				$sanitize_callback = 'cryout_customizer_sanitize_generic';		break;
			endswitch;

			$sanitize_callback = apply_filters( 'cryout_customizer_custom_control_sanitize_callback', $sanitize_callback, $opt['id'] );

			// remember placeholder id and section for the cloning cycle below
			$_opt_id = $opt['id'];
			$_opt_section = $opt['section'];

			/////////// add all cloned options
			for ( $i=1; $i<=$clone_count; $i++ ) {

				// replace # placeholder with clone index when necessary; use placeholders saved above
				$opt['id'] = str_replace( '#', $i, $_opt_id );
				$opt['section'] = str_replace( '#', $i, $_opt_section );

				////////// guess theme options variable name
				if (function_exists('cryout_get_theme_options_name')) {
					$theme_options_array = cryout_get_theme_options_name();
				} else {
					$theme_options_array = _CRYOUT_THEME_NAME . '_settings';
				};
				$opid = $theme_options_array . '[' . $opt['id'] . ']';

				// override section id to make it uniquely identifiable
				$opt['section'] = 'cryout-' . $opt['section'];

				////////// add settings
				$wp_customize->add_setting( $opid, array(
					'type'			 => 'option',
					'default'        => ( isset( $cryout_theme_defaults[$opt['id']] ) ? $cryout_theme_defaults[$opt['id']] : '' ),
					'capability'     => 'edit_theme_options',
					'sanitize_callback' => $sanitize_callback,
				) );

				////////// cycle through and add appropriate control types
				switch ($opt['type']): // control selector
					case 'text':
					case 'number':
					case 'url': case 'tel': case 'email': case 'search:': case 'time': case 'date': case 'datetime': case 'week':
					case 'textarea':
					case 'checkbox':
						$wp_customize->add_control( $opid, array(
							'label'		=> $opt['label'],
							'description'	=> (isset($opt['desc'])?$opt['desc']:''),
							'section'	=> $opt['section'],
							'settings'	=> $opid,
							'input_attrs' => (!empty($opt['input_attrs'])?$opt['input_attrs']:array()),
							'type'		=> $opt['type'],
							'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
							'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
						) );
						break;
					case 'googlefont':
						$wp_customize->add_control( $opid, array(
							'label'		=> $opt['label'],
							'description'	=> (isset($opt['desc'])?$opt['desc']:''),
							'section'	=> $opt['section'],
							'settings'	=> $opid,
							'input_attrs' => (!empty($opt['input_attrs'])?$opt['input_attrs']:array()),
							'type'		=> 'text',
							'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
							'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
						) );
						break;
					case 'radio':
					case 'select':
						if (empty($opt['choices']) && empty($opt['labels'])) $opt['labels'] = $opt['values'];
						$wp_customize->add_control( $opid, array(
							'label'		=> $opt['label'],
							'description'	=> (isset($opt['desc'])?$opt['desc']:''),
							'section'	=> $opt['section'],
							'settings'	=> $opid,
							'type'		=> $opt['type'],
							'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
							'choices'	=> (isset($opt['choices'])?$opt['choices']:array_combine($opt['values'],$opt['labels'])),
							'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
						) );
						break;
					case 'optselect':
						$wp_customize->add_control( new Cryout_Customize_OptSelect_Control( $wp_customize, $opid, array(
							'label' 	=> $opt['label'],
							'description'	=> (isset($opt['desc'])?$opt['desc']:''),
							'section'	=> $opt['section'],
							'settings'	=> $opid,
							'input_attrs'	=> (isset($opt['disabled'])?array('disabled'=>$opt['disabled']):array('disabled'=>false)),
							'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
							'choices'	=> (isset($opt['choices'])?$opt['choices']:array_combine($opt['values'],$opt['labels'])),
							'disabled'	=> (isset($opt['disabled'])?$opt['disabled']:''),
							'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
						) ) );
						break;
					case 'range':
						$wp_customize->add_control( $opid, array(
							'label'		=> $opt['label'],
							'description'	=> (isset($opt['desc'])?$opt['desc']:''),
							'section'	=> $opt['section'],
							'settings'	=> $opid,
							'type'		=> $opt['type'],
							'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
							'input_attrs' => array( 'min' => $opt['min'], 'max' => $opt['max'], 'step' => (isset($opt['step'])?$opt['step']:10) ),
							'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
						) );
						break;
					case 'slider':
						$wp_customize->add_control(  new Cryout_Customize_Slider_Control( $wp_customize, $opid, array(
							'label'		=> $opt['label'],
							'description'	=> (isset($opt['desc'])?$opt['desc']:''),
							'section'	=> $opt['section'],
							'settings'	=> $opid,
							'type'		=> $opt['type'],
							'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
							'input_attrs' => array(
										'min' => $opt['min'],
										'max' => $opt['max'],
										'step' => (isset($opt['step'])?$opt['step']:10),
										'um' => (isset($opt['um'])?$opt['um']:'')
										),
							'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
						) ) );
						break;
					case 'slidertwo':
						$wp_customize->add_control(  new Cryout_Customize_SliderTwo_Control( $wp_customize, $opid, array(
							'label'		=> $opt['label'],
							'description'	=> (isset($opt['desc'])?$opt['desc']:''),
							'section'	=> $opt['section'],
							'settings'	=> $opid,
							'type'		=> $opt['type'],
							'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
							'input_attrs' => array(
										'min' => $opt['min'],
										'max' => $opt['max'],
										'step' => (isset($opt['step'])?$opt['step']:10),
										'total' => (isset($opt['total'])?$opt['total']:0),
										'um' => (isset($opt['um'])?$opt['um']:'')
										),
							'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
						) ) );
						break;
					case 'radioimage':
						$wp_customize->add_control( new Cryout_Customize_RadioImage_Control( $wp_customize, $opid, array(
							'label'		=> $opt['label'],
							'description'	=> (isset($opt['desc'])?$opt['desc']:''),
							'section'	=> $opt['section'],
							'settings'	=> $opid,
							'type'		=> $opt['type'],
							'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
							'choices' 	=> (isset($opt['choices'])?$opt['choices']:array_combine($opt['values'],$opt['labels'])),
							'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
						) ) );
						break;
					case 'sortable':
						if (class_exists('Cryout_Customize_Sortable_Control')) {
							$wp_customize->add_control( new Cryout_Customize_Sortable_Control( $wp_customize, $opid, array(
								'label'		=> $opt['label'],
								'description'	=> (isset($opt['desc'])?$opt['desc']:''),
								'section'	=> $opt['section'],
								'settings'	=> $opid,
								'type'		=> $opt['type'],
								'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
								'choices' 	=> (isset($opt['choices'])?$opt['choices']:array_combine($opt['values'],$opt['labels'])),
								'input_attrs' => (!empty($opt['input_attrs'])?$opt['input_attrs']:array()),
								'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
							) ) );
						}
						break;
					case 'color':
						$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $opid, array(
							'label' 	=> $opt['label'],
							'description'	=> (isset($opt['desc'])?$opt['desc']:''),
							'section'	=> $opt['section'],
							'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
							'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
						) ) );
						break;
					case 'font':
						$wp_customize->add_control( new Cryout_Customize_Font_Control( $wp_customize, $opid, array(
							'label' 	=> $opt['label'],
							'description'	=> (isset($opt['desc'])?$opt['desc']:''),
							'section'	=> $opt['section'],
							'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
							'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
						) ) );
						break;
					case 'iconselect':
						$wp_customize->add_control( new Cryout_Customize_IconSelect_Control( $wp_customize, $opid, array(
							'label' 	=> $opt['label'],
							'description'	=> (isset($opt['desc'])?$opt['desc']:''),
							'section'	=> $opt['section'],
							'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
							'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
						) ) );
						break;
					case 'media-image':
						$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $opid, array(
							'label' 	=> $opt['label'],
							'description'	=> (isset($opt['desc'])?$opt['desc']:''),
							'section'	=> $opt['section'],
							'mime_type'	=> 'image',
							'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
							'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
						) ) );
						break;
					case 'media':
						$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $opid, array(
							'label' 	=> $opt['label'],
							'description'	=> (isset($opt['desc'])?$opt['desc']:''),
							'section'	=> $opt['section'],
							'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
							'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
						) ) );
						break;
					case 'hint':
						$wp_customize->add_control( new Cryout_Customize_Hint_Control( $wp_customize, $opid, array(
							'label' 	=> $opt['label'],
							'description'	=> $opt['desc'],
							'section'	=> $opt['section'],
							'settings'	=> $opid,
							'input_attrs' => (!empty($opt['input_attrs'])?$opt['input_attrs']:array()),
							'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
							'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
						) ) );
						break;
					case 'notice':
						$wp_customize->add_control( new Cryout_Customize_Notice_Control( $wp_customize, $opid, array(
							'label' 	=> $opt['label'],
							'description'	=> $opt['desc'],
							'section'	=> $opt['section'],
							'settings'	=> $opid,
							'input_attrs' => (!empty($opt['input_attrs'])?$opt['input_attrs']:array()),
							'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
							'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
						) ) );
						break;
					case NULL:
						$wp_customize->add_control( new Cryout_Customize_Null_Control( $wp_customize, $opid ) );
						break;
					case 'blank':
					default:
						$wp_customize->add_control( new Cryout_Customize_Blank_Control( $wp_customize, $opid, array(
							'label' 	=> $opt['label'],
							'description'	=> (isset($opt['desc'])?$opt['desc']:''),
							'section'	=> $opt['section'],
							'settings'	=> $opid,
							'priority'	=> (isset($opt['priority'])?$opt['priority']:$priority),
							'active_callback' => ( (isset($opt['active_callback'])) ? $opt['active_callback'] : NULL),
						) ) );
						break;
				endswitch;

			// increase priority for each option (including clones)
			//$priority += 10;

			} // end cloning for cycle


		endforeach;
		////////// end options sections

	} // register()

} // class Cryout_Customizer

function conditional_visibility( $control ) {
	return false;

} // conditional_visibility()

	////////// external resources //////////
function cryout_customizer_enqueue_scripts() {
	wp_enqueue_style( 'cryout-customizer-css', get_template_directory_uri() . '/cryout/css/customizer.css', array(), _CRYOUT_FRAMEWORK_VERSION );
	wp_enqueue_script( 'cryout-customizer-js', get_template_directory_uri() . '/cryout/js/customizer.js', array( 'jquery' ), _CRYOUT_FRAMEWORK_VERSION, true );
}
add_action('customize_controls_enqueue_scripts', 'cryout_customizer_enqueue_scripts');


////////// FIN! //////////
