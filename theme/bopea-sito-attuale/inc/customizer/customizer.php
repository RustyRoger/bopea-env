<?php
if ( ! class_exists( 'bopea_customizer_default' ) ) {
	final class bopea_customizer_default {
		private static $instance = null;
		private $wp_customize;
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		private function __construct() {
			add_action( 'customize_controls_print_scripts', array( $this, 'bopea_customize_controls_print_scripts' ) );			
			add_action( 'customize_register', array( $this, 'bopea_customize_register' ) );
		}

		public function bopea_customize_controls_print_scripts() {
			wp_enqueue_style( 'css-for-customize', get_template_directory_uri() . '/inc/customizer/css/customizer-control.css' );
			wp_enqueue_style( 'alpha-color-picker', get_template_directory_uri() . '/inc/customizer/css/alpha-color-picker.css' );
			wp_enqueue_script( 'js-for-customize', get_template_directory_uri() . '/inc/customizer/js/customizer-control.js', array( 'jquery', 'customize-controls' ) );
			wp_enqueue_script( 'alpha-color-picker', get_template_directory_uri() . '/inc/customizer/js/alpha-color-picker.js', array( 'jquery', 'wp-color-picker' ) );

		}
		public function bopea_customize_register( $wp_customize ) {
			$this->wp_customize = $wp_customize;
		}
	}
}
bopea_customizer_default::get_instance();

function bopea_register_theme_customizer( $wp_customize ) {
	class bopea_control_image_select extends WP_Customize_Control {
	    public function render_content(){
	        if ( empty( $this->choices ) ){ return; }
	        if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif;
				if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html($this->description) ; ?></span>
			<?php endif;
	        $html = array();
			$tpl  = '<label class="jlc-image-select"><img src="%s"><input type="%s" class="hidden" name="%s" value="%s" %s%s></label>';
			$field = $this->input_attrs;
			foreach ( $this->choices as $value => $image )
			{
				$html[] = sprintf(
					$tpl,
					$image,
					$field['multiple'] ? 'checkbox' : 'radio',
					$this->id,
					esc_attr( $value ),
					$this->get_link(),
					checked( $this->value(), $value, false )
				);
			}
			echo implode(' ', $html);
	    }
	}
	// Header text
	class bopea_Customize_Control_Title extends WP_Customize_Control {
	    public function render_content(){
	        if ( empty( $this->label ) ){ return; }
	        if ( ! empty( $this->label ) ) : ?>
					<h2 class="jlc_headding"><?php echo esc_html( $this->label ); ?>
				<?php endif;
				if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html($this->description) ; ?></span>
			</h2><?php endif;
	    }
	}
	// Alpha color
	class bopea_alpha_color extends WP_Customize_Control {
		public $type = 'alpha-color';
		public $palette;
		public $show_opacity;	
		public function render_content() {
			if ( is_array( $this->palette ) ) {
				$palette = implode( '|', $this->palette );
			} else {
				$palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
			}
			$show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';
			?>
			<?php
				if ( isset( $this->label ) && '' !== $this->label ) {
					echo '<span class="customize-control-title">' . sanitize_text_field( $this->label ) . '</span>';
				}
				if ( isset( $this->description ) && '' !== $this->description ) {
					echo '<span class="description customize-control-description">' . sanitize_text_field( $this->description ) . '</span>';
				}?>
			<label>				
				<input class="alpha-color-control" type="text" data-show-opacity="<?php echo esc_attr($show_opacity); ?>" data-palette="<?php echo esc_attr( $palette ); ?>" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" <?php $this->link(); ?>  />
			</label>
			<?php
		}
	}

	$option_sidebar = array();
	$sidebars = get_option('sbg_sidebars');
	$option_sidebar['default']= esc_html__( 'Default Sidebar', 'bopea' );
	if(isset($sidebars)) {
		if(is_array($sidebars)) {
			foreach($sidebars as $sidebar) {
				$sidebar_lower = strtolower($sidebar);
				$sidebarid = str_replace(' ','-', $sidebar_lower);
				$option_sidebar[$sidebarid] = $sidebar;
			}
		}
	}

	//Layouts
	$args = array(
		'post_type'     => 'jl_layout',
		'post_status'   => array( 'publish' ),
		'numberposts'   => -1,
		'orderby'       => 'title',
		'order'         => 'ASC',
		'suppress_filters'   => false
   );
   $layouts = get_posts($args);
   $jl_layouts = array();
   $jl_layouts['default']= esc_html__( 'Default Layout', 'bopea' );
   
   if(!empty($layouts)){
	   foreach ($layouts as $layout){
		   $jl_layouts[$layout->ID] = $layout->post_title;
	   }
   }

	// Custom fonts
	$jl_custom_font = array();
		if ( class_exists( 'bopea_font_tax' ) ){
		$fonts = bopea_font_tax::bopea_get_fonts();
		if ( empty ($fonts)) {
			$jl_custom_font = array();
		}else{
			foreach ( $fonts as $font => $values ) {
				$jl_custom_font['jl_c_'.$font] = 'Custom font - '.$font;
			}
		}
	}else{
		$jl_custom_font = array();
	}

	// Font and Google Font
	$jl_google_font = array(
		'ABeeZee' => 'ABeeZee',
		'Abel' => 'Abel',
		'Abhaya Libre' => 'Abhaya Libre',
		'Aboreto' => 'Aboreto',
		'Abril Fatface' => 'Abril Fatface',
		'Abyssinica SIL' => 'Abyssinica SIL',
		'Aclonica' => 'Aclonica',
		'Acme' => 'Acme',
		'Actor' => 'Actor',
		'Adamina' => 'Adamina',
		'Advent Pro' => 'Advent Pro',
		'Aguafina Script' => 'Aguafina Script',
		'Akaya Kanadaka' => 'Akaya Kanadaka',
		'Akaya Telivigala' => 'Akaya Telivigala',
		'Akronim' => 'Akronim',
		'Akshar' => 'Akshar',
		'Aladin' => 'Aladin',
		'Alata' => 'Alata',
		'Alatsi' => 'Alatsi',
		'Albert Sans' => 'Albert Sans',
		'Aldrich' => 'Aldrich',
		'Alef' => 'Alef',
		'Alegreya' => 'Alegreya',
		'Alegreya SC' => 'Alegreya SC',
		'Alegreya Sans' => 'Alegreya Sans',
		'Alegreya Sans SC' => 'Alegreya Sans SC',
		'Aleo' => 'Aleo',
		'Alex Brush' => 'Alex Brush',
		'Alexandria' => 'Alexandria',
		'Alfa Slab One' => 'Alfa Slab One',
		'Alice' => 'Alice',
		'Alike' => 'Alike',
		'Alike Angular' => 'Alike Angular',
		'Alkalami' => 'Alkalami',
		'Alkatra' => 'Alkatra',
		'Allan' => 'Allan',
		'Allerta' => 'Allerta',
		'Allerta Stencil' => 'Allerta Stencil',
		'Allison' => 'Allison',
		'Allura' => 'Allura',
		'Almarai' => 'Almarai',
		'Almendra' => 'Almendra',
		'Almendra Display' => 'Almendra Display',
		'Almendra SC' => 'Almendra SC',
		'Alumni Sans' => 'Alumni Sans',
		'Alumni Sans Collegiate One' => 'Alumni Sans Collegiate One',
		'Alumni Sans Inline One' => 'Alumni Sans Inline One',
		'Alumni Sans Pinstripe' => 'Alumni Sans Pinstripe',
		'Amarante' => 'Amarante',
		'Amaranth' => 'Amaranth',
		'Amatic SC' => 'Amatic SC',
		'Amethysta' => 'Amethysta',
		'Amiko' => 'Amiko',
		'Amiri' => 'Amiri',
		'Amiri Quran' => 'Amiri Quran',
		'Amita' => 'Amita',
		'Anaheim' => 'Anaheim',
		'Andada Pro' => 'Andada Pro',
		'Andika' => 'Andika',
		'Anek Bangla' => 'Anek Bangla',
		'Anek Devanagari' => 'Anek Devanagari',
		'Anek Gujarati' => 'Anek Gujarati',
		'Anek Gurmukhi' => 'Anek Gurmukhi',
		'Anek Kannada' => 'Anek Kannada',
		'Anek Latin' => 'Anek Latin',
		'Anek Malayalam' => 'Anek Malayalam',
		'Anek Odia' => 'Anek Odia',
		'Anek Tamil' => 'Anek Tamil',
		'Anek Telugu' => 'Anek Telugu',
		'Angkor' => 'Angkor',
		'Annie Use Your Telescope' => 'Annie Use Your Telescope',
		'Anonymous Pro' => 'Anonymous Pro',
		'Antic' => 'Antic',
		'Antic Didone' => 'Antic Didone',
		'Antic Slab' => 'Antic Slab',
		'Anton' => 'Anton',
		'Antonio' => 'Antonio',
		'Anybody' => 'Anybody',
		'Arapey' => 'Arapey',
		'Arbutus' => 'Arbutus',
		'Arbutus Slab' => 'Arbutus Slab',
		'Architects Daughter' => 'Architects Daughter',
		'Archivo' => 'Archivo',
		'Archivo Black' => 'Archivo Black',
		'Archivo Narrow' => 'Archivo Narrow',
		'Are You Serious' => 'Are You Serious',
		'Aref Ruqaa' => 'Aref Ruqaa',
		'Aref Ruqaa Ink' => 'Aref Ruqaa Ink',
		'Arima' => 'Arima',
		'Arimo' => 'Arimo',
		'Arizonia' => 'Arizonia',
		'Armata' => 'Armata',
		'Arsenal' => 'Arsenal',
		'Artifika' => 'Artifika',
		'Arvo' => 'Arvo',
		'Arya' => 'Arya',
		'Asap' => 'Asap',
		'Asap Condensed' => 'Asap Condensed',
		'Asar' => 'Asar',
		'Asset' => 'Asset',
		'Assistant' => 'Assistant',
		'Astloch' => 'Astloch',
		'Asul' => 'Asul',
		'Athiti' => 'Athiti',
		'Atkinson Hyperlegible' => 'Atkinson Hyperlegible',
		'Atma' => 'Atma',
		'Atomic Age' => 'Atomic Age',
		'Aubrey' => 'Aubrey',
		'Audiowide' => 'Audiowide',
		'Autour One' => 'Autour One',
		'Average' => 'Average',
		'Average Sans' => 'Average Sans',
		'Averia Gruesa Libre' => 'Averia Gruesa Libre',
		'Averia Libre' => 'Averia Libre',
		'Averia Sans Libre' => 'Averia Sans Libre',
		'Averia Serif Libre' => 'Averia Serif Libre',
		'Azeret Mono' => 'Azeret Mono',
		'B612' => 'B612',
		'B612 Mono' => 'B612 Mono',
		'BIZ UDGothic' => 'BIZ UDGothic',
		'BIZ UDMincho' => 'BIZ UDMincho',
		'BIZ UDPGothic' => 'BIZ UDPGothic',
		'BIZ UDPMincho' => 'BIZ UDPMincho',
		'Babylonica' => 'Babylonica',
		'Bad Script' => 'Bad Script',
		'Bahiana' => 'Bahiana',
		'Bahianita' => 'Bahianita',
		'Bai Jamjuree' => 'Bai Jamjuree',
		'Bakbak One' => 'Bakbak One',
		'Ballet' => 'Ballet',
		'Baloo 2' => 'Baloo 2',
		'Baloo Bhai 2' => 'Baloo Bhai 2',
		'Baloo Bhaijaan 2' => 'Baloo Bhaijaan 2',
		'Baloo Bhaina 2' => 'Baloo Bhaina 2',
		'Baloo Chettan 2' => 'Baloo Chettan 2',
		'Baloo Da 2' => 'Baloo Da 2',
		'Baloo Paaji 2' => 'Baloo Paaji 2',
		'Baloo Tamma 2' => 'Baloo Tamma 2',
		'Baloo Tammudu 2' => 'Baloo Tammudu 2',
		'Baloo Thambi 2' => 'Baloo Thambi 2',
		'Balsamiq Sans' => 'Balsamiq Sans',
		'Balthazar' => 'Balthazar',
		'Bangers' => 'Bangers',
		'Barlow' => 'Barlow',
		'Barlow Condensed' => 'Barlow Condensed',
		'Barlow Semi Condensed' => 'Barlow Semi Condensed',
		'Barriecito' => 'Barriecito',
		'Barrio' => 'Barrio',
		'Basic' => 'Basic',
		'Baskervville' => 'Baskervville',
		'Battambang' => 'Battambang',
		'Baumans' => 'Baumans',
		'Bayon' => 'Bayon',
		'Be Vietnam Pro' => 'Be Vietnam Pro',
		'Beau Rivage' => 'Beau Rivage',
		'Bebas Neue' => 'Bebas Neue',
		'Belgrano' => 'Belgrano',
		'Bellefair' => 'Bellefair',
		'Belleza' => 'Belleza',
		'Bellota' => 'Bellota',
		'Bellota Text' => 'Bellota Text',
		'BenchNine' => 'BenchNine',
		'Benne' => 'Benne',
		'Bentham' => 'Bentham',
		'Berkshire Swash' => 'Berkshire Swash',
		'Besley' => 'Besley',
		'Beth Ellen' => 'Beth Ellen',
		'Bevan' => 'Bevan',
		'BhuTuka Expanded One' => 'BhuTuka Expanded One',
		'Big Shoulders Display' => 'Big Shoulders Display',
		'Big Shoulders Inline Display' => 'Big Shoulders Inline Display',
		'Big Shoulders Inline Text' => 'Big Shoulders Inline Text',
		'Big Shoulders Stencil Display' => 'Big Shoulders Stencil Display',
		'Big Shoulders Stencil Text' => 'Big Shoulders Stencil Text',
		'Big Shoulders Text' => 'Big Shoulders Text',
		'Bigelow Rules' => 'Bigelow Rules',
		'Bigshot One' => 'Bigshot One',
		'Bilbo' => 'Bilbo',
		'Bilbo Swash Caps' => 'Bilbo Swash Caps',
		'BioRhyme' => 'BioRhyme',
		'BioRhyme Expanded' => 'BioRhyme Expanded',
		'Birthstone' => 'Birthstone',
		'Birthstone Bounce' => 'Birthstone Bounce',
		'Biryani' => 'Biryani',
		'Bitter' => 'Bitter',
		'Black And White Picture' => 'Black And White Picture',
		'Black Han Sans' => 'Black Han Sans',
		'Black Ops One' => 'Black Ops One',
		'Blaka' => 'Blaka',
		'Blaka Hollow' => 'Blaka Hollow',
		'Blaka Ink' => 'Blaka Ink',
		'Blinker' => 'Blinker',
		'Bodoni Moda' => 'Bodoni Moda',
		'Bokor' => 'Bokor',
		'Bona Nova' => 'Bona Nova',
		'Bonbon' => 'Bonbon',
		'Bonheur Royale' => 'Bonheur Royale',
		'Boogaloo' => 'Boogaloo',
		'Bowlby One' => 'Bowlby One',
		'Bowlby One SC' => 'Bowlby One SC',
		'Brawler' => 'Brawler',
		'Bree Serif' => 'Bree Serif',
		'Brygada 1918' => 'Brygada 1918',
		'Bubblegum Sans' => 'Bubblegum Sans',
		'Bubbler One' => 'Bubbler One',
		'Buda' => 'Buda',
		'Buenard' => 'Buenard',
		'Bungee' => 'Bungee',
		'Bungee Hairline' => 'Bungee Hairline',
		'Bungee Inline' => 'Bungee Inline',
		'Bungee Outline' => 'Bungee Outline',
		'Bungee Shade' => 'Bungee Shade',
		'Bungee Spice' => 'Bungee Spice',
		'Butcherman' => 'Butcherman',
		'Butterfly Kids' => 'Butterfly Kids',
		'Cabin' => 'Cabin',
		'Cabin Condensed' => 'Cabin Condensed',
		'Cabin Sketch' => 'Cabin Sketch',
		'Caesar Dressing' => 'Caesar Dressing',
		'Cagliostro' => 'Cagliostro',
		'Cairo' => 'Cairo',
		'Cairo Play' => 'Cairo Play',
		'Caladea' => 'Caladea',
		'Calistoga' => 'Calistoga',
		'Calligraffitti' => 'Calligraffitti',
		'Cambay' => 'Cambay',
		'Cambo' => 'Cambo',
		'Candal' => 'Candal',
		'Cantarell' => 'Cantarell',
		'Cantata One' => 'Cantata One',
		'Cantora One' => 'Cantora One',
		'Capriola' => 'Capriola',
		'Caramel' => 'Caramel',
		'Carattere' => 'Carattere',
		'Cardo' => 'Cardo',
		'Carme' => 'Carme',
		'Carrois Gothic' => 'Carrois Gothic',
		'Carrois Gothic SC' => 'Carrois Gothic SC',
		'Carter One' => 'Carter One',
		'Castoro' => 'Castoro',
		'Catamaran' => 'Catamaran',
		'Caudex' => 'Caudex',
		'Caveat' => 'Caveat',
		'Caveat Brush' => 'Caveat Brush',
		'Cedarville Cursive' => 'Cedarville Cursive',
		'Ceviche One' => 'Ceviche One',
		'Chakra Petch' => 'Chakra Petch',
		'Changa' => 'Changa',
		'Changa One' => 'Changa One',
		'Chango' => 'Chango',
		'Charis SIL' => 'Charis SIL',
		'Charm' => 'Charm',
		'Charmonman' => 'Charmonman',
		'Chathura' => 'Chathura',
		'Chau Philomene One' => 'Chau Philomene One',
		'Chela One' => 'Chela One',
		'Chelsea Market' => 'Chelsea Market',
		'Chenla' => 'Chenla',
		'Cherish' => 'Cherish',
		'Cherry Cream Soda' => 'Cherry Cream Soda',
		'Cherry Swash' => 'Cherry Swash',
		'Chewy' => 'Chewy',
		'Chicle' => 'Chicle',
		'Chilanka' => 'Chilanka',
		'Chivo' => 'Chivo',
		'Chivo Mono' => 'Chivo Mono',
		'Chonburi' => 'Chonburi',
		'Cinzel' => 'Cinzel',
		'Cinzel Decorative' => 'Cinzel Decorative',
		'Clicker Script' => 'Clicker Script',
		'Climate Crisis' => 'Climate Crisis',
		'Coda' => 'Coda',
		'Coda Caption' => 'Coda Caption',
		'Codystar' => 'Codystar',
		'Coiny' => 'Coiny',
		'Combo' => 'Combo',
		'Comfortaa' => 'Comfortaa',
		'Comforter' => 'Comforter',
		'Comforter Brush' => 'Comforter Brush',
		'Comic Neue' => 'Comic Neue',
		'Coming Soon' => 'Coming Soon',
		'Commissioner' => 'Commissioner',
		'Concert One' => 'Concert One',
		'Condiment' => 'Condiment',
		'Content' => 'Content',
		'Contrail One' => 'Contrail One',
		'Convergence' => 'Convergence',
		'Cookie' => 'Cookie',
		'Copse' => 'Copse',
		'Corben' => 'Corben',
		'Corinthia' => 'Corinthia',
		'Cormorant' => 'Cormorant',
		'Cormorant Garamond' => 'Cormorant Garamond',
		'Cormorant Infant' => 'Cormorant Infant',
		'Cormorant SC' => 'Cormorant SC',
		'Cormorant Unicase' => 'Cormorant Unicase',
		'Cormorant Upright' => 'Cormorant Upright',
		'Courgette' => 'Courgette',
		'Courier Prime' => 'Courier Prime',
		'Cousine' => 'Cousine',
		'Coustard' => 'Coustard',
		'Covered By Your Grace' => 'Covered By Your Grace',
		'Crafty Girls' => 'Crafty Girls',
		'Creepster' => 'Creepster',
		'Crete Round' => 'Crete Round',
		'Crimson Pro' => 'Crimson Pro',
		'Crimson Text' => 'Crimson Text',
		'Croissant One' => 'Croissant One',
		'Crushed' => 'Crushed',
		'Cuprum' => 'Cuprum',
		'Cute Font' => 'Cute Font',
		'Cutive' => 'Cutive',
		'Cutive Mono' => 'Cutive Mono',
		'DM Mono' => 'DM Mono',
		'DM Sans' => 'DM Sans',
		'DM Serif Display' => 'DM Serif Display',
		'DM Serif Text' => 'DM Serif Text',
		'Damion' => 'Damion',
		'Dancing Script' => 'Dancing Script',
		'Dangrek' => 'Dangrek',
		'Darker Grotesque' => 'Darker Grotesque',
		'David Libre' => 'David Libre',
		'Dawning of a New Day' => 'Dawning of a New Day',
		'Days One' => 'Days One',
		'Dekko' => 'Dekko',
		'Dela Gothic One' => 'Dela Gothic One',
		'Delicious Handrawn' => 'Delicious Handrawn',
		'Delius' => 'Delius',
		'Delius Swash Caps' => 'Delius Swash Caps',
		'Delius Unicase' => 'Delius Unicase',
		'Della Respira' => 'Della Respira',
		'Denk One' => 'Denk One',
		'Devonshire' => 'Devonshire',
		'Dhurjati' => 'Dhurjati',
		'Didact Gothic' => 'Didact Gothic',
		'Diplomata' => 'Diplomata',
		'Diplomata SC' => 'Diplomata SC',
		'Do Hyeon' => 'Do Hyeon',
		'Dokdo' => 'Dokdo',
		'Domine' => 'Domine',
		'Donegal One' => 'Donegal One',
		'Dongle' => 'Dongle',
		'Doppio One' => 'Doppio One',
		'Dorsa' => 'Dorsa',
		'Dosis' => 'Dosis',
		'DotGothic16' => 'DotGothic16',
		'Dr Sugiyama' => 'Dr Sugiyama',
		'Duru Sans' => 'Duru Sans',
		'DynaPuff' => 'DynaPuff',
		'Dynalight' => 'Dynalight',
		'EB Garamond' => 'EB Garamond',
		'Eagle Lake' => 'Eagle Lake',
		'East Sea Dokdo' => 'East Sea Dokdo',
		'Eater' => 'Eater',
		'Economica' => 'Economica',
		'Eczar' => 'Eczar',
		'Edu NSW ACT Foundation' => 'Edu NSW ACT Foundation',
		'Edu QLD Beginner' => 'Edu QLD Beginner',
		'Edu SA Beginner' => 'Edu SA Beginner',
		'Edu TAS Beginner' => 'Edu TAS Beginner',
		'Edu VIC WA NT Beginner' => 'Edu VIC WA NT Beginner',
		'El Messiri' => 'El Messiri',
		'Electrolize' => 'Electrolize',
		'Elsie' => 'Elsie',
		'Elsie Swash Caps' => 'Elsie Swash Caps',
		'Emblema One' => 'Emblema One',
		'Emilys Candy' => 'Emilys Candy',
		'Encode Sans' => 'Encode Sans',
		'Encode Sans Condensed' => 'Encode Sans Condensed',
		'Encode Sans Expanded' => 'Encode Sans Expanded',
		'Encode Sans SC' => 'Encode Sans SC',
		'Encode Sans Semi Condensed' => 'Encode Sans Semi Condensed',
		'Encode Sans Semi Expanded' => 'Encode Sans Semi Expanded',
		'Engagement' => 'Engagement',
		'Englebert' => 'Englebert',
		'Enriqueta' => 'Enriqueta',
		'Ephesis' => 'Ephesis',
		'Epilogue' => 'Epilogue',
		'Erica One' => 'Erica One',
		'Esteban' => 'Esteban',
		'Estonia' => 'Estonia',
		'Euphoria Script' => 'Euphoria Script',
		'Ewert' => 'Ewert',
		'Exo' => 'Exo',
		'Exo 2' => 'Exo 2',
		'Expletus Sans' => 'Expletus Sans',
		'Explora' => 'Explora',
		'Fahkwang' => 'Fahkwang',
		'Familjen Grotesk' => 'Familjen Grotesk',
		'Fanwood Text' => 'Fanwood Text',
		'Farro' => 'Farro',
		'Farsan' => 'Farsan',
		'Fascinate' => 'Fascinate',
		'Fascinate Inline' => 'Fascinate Inline',
		'Faster One' => 'Faster One',
		'Fasthand' => 'Fasthand',
		'Fauna One' => 'Fauna One',
		'Faustina' => 'Faustina',
		'Federant' => 'Federant',
		'Federo' => 'Federo',
		'Felipa' => 'Felipa',
		'Fenix' => 'Fenix',
		'Festive' => 'Festive',
		'Figtree' => 'Figtree',
		'Finger Paint' => 'Finger Paint',
		'Finlandica' => 'Finlandica',
		'Fira Code' => 'Fira Code',
		'Fira Mono' => 'Fira Mono',
		'Fira Sans' => 'Fira Sans',
		'Fira Sans Condensed' => 'Fira Sans Condensed',
		'Fira Sans Extra Condensed' => 'Fira Sans Extra Condensed',
		'Fjalla One' => 'Fjalla One',
		'Fjord One' => 'Fjord One',
		'Flamenco' => 'Flamenco',
		'Flavors' => 'Flavors',
		'Fleur De Leah' => 'Fleur De Leah',
		'Flow Block' => 'Flow Block',
		'Flow Circular' => 'Flow Circular',
		'Flow Rounded' => 'Flow Rounded',
		'Fondamento' => 'Fondamento',
		'Fontdiner Swanky' => 'Fontdiner Swanky',
		'Forum' => 'Forum',
		'Fragment Mono' => 'Fragment Mono',
		'Francois One' => 'Francois One',
		'Frank Ruhl Libre' => 'Frank Ruhl Libre',
		'Fraunces' => 'Fraunces',
		'Freckle Face' => 'Freckle Face',
		'Fredericka the Great' => 'Fredericka the Great',
		'Fredoka' => 'Fredoka',
		'Freehand' => 'Freehand',
		'Fresca' => 'Fresca',
		'Frijole' => 'Frijole',
		'Fruktur' => 'Fruktur',
		'Fugaz One' => 'Fugaz One',
		'Fuggles' => 'Fuggles',
		'Fuzzy Bubbles' => 'Fuzzy Bubbles',
		'GFS Didot' => 'GFS Didot',
		'GFS Neohellenic' => 'GFS Neohellenic',
		'Gabriela' => 'Gabriela',
		'Gaegu' => 'Gaegu',
		'Gafata' => 'Gafata',
		'Gajraj One' => 'Gajraj One',
		'Galada' => 'Galada',
		'Galdeano' => 'Galdeano',
		'Galindo' => 'Galindo',
		'Gamja Flower' => 'Gamja Flower',
		'Gantari' => 'Gantari',
		'Gayathri' => 'Gayathri',
		'Gelasio' => 'Gelasio',
		'Gemunu Libre' => 'Gemunu Libre',
		'Genos' => 'Genos',
		'Gentium Book Plus' => 'Gentium Book Plus',
		'Gentium Plus' => 'Gentium Plus',
		'Geo' => 'Geo',
		'Georama' => 'Georama',
		'Geostar' => 'Geostar',
		'Geostar Fill' => 'Geostar Fill',
		'Germania One' => 'Germania One',
		'Gideon Roman' => 'Gideon Roman',
		'Gidugu' => 'Gidugu',
		'Gilda Display' => 'Gilda Display',
		'Girassol' => 'Girassol',
		'Give You Glory' => 'Give You Glory',
		'Glass Antiqua' => 'Glass Antiqua',
		'Glegoo' => 'Glegoo',
		'Gloock' => 'Gloock',
		'Gloria Hallelujah' => 'Gloria Hallelujah',
		'Glory' => 'Glory',
		'Gluten' => 'Gluten',
		'Goblin One' => 'Goblin One',
		'Gochi Hand' => 'Gochi Hand',
		'Goldman' => 'Goldman',
		'Golos Text' => 'Golos Text',
		'Gorditas' => 'Gorditas',
		'Gothic A1' => 'Gothic A1',
		'Gotu' => 'Gotu',
		'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
		'Gowun Batang' => 'Gowun Batang',
		'Gowun Dodum' => 'Gowun Dodum',
		'Graduate' => 'Graduate',
		'Grand Hotel' => 'Grand Hotel',
		'Grandstander' => 'Grandstander',
		'Grape Nuts' => 'Grape Nuts',
		'Gravitas One' => 'Gravitas One',
		'Great Vibes' => 'Great Vibes',
		'Grechen Fuemen' => 'Grechen Fuemen',
		'Grenze' => 'Grenze',
		'Grenze Gotisch' => 'Grenze Gotisch',
		'Grey Qo' => 'Grey Qo',
		'Griffy' => 'Griffy',
		'Gruppo' => 'Gruppo',
		'Gudea' => 'Gudea',
		'Gugi' => 'Gugi',
		'Gulzar' => 'Gulzar',
		'Gupter' => 'Gupter',
		'Gurajada' => 'Gurajada',
		'Gwendolyn' => 'Gwendolyn',
		'Habibi' => 'Habibi',
		'Hachi Maru Pop' => 'Hachi Maru Pop',
		'Hahmlet' => 'Hahmlet',
		'Halant' => 'Halant',
		'Hammersmith One' => 'Hammersmith One',
		'Hanalei' => 'Hanalei',
		'Hanalei Fill' => 'Hanalei Fill',
		'Handlee' => 'Handlee',
		'Hanken Grotesk' => 'Hanken Grotesk',
		'Hanuman' => 'Hanuman',
		'Happy Monkey' => 'Happy Monkey',
		'Harmattan' => 'Harmattan',
		'Headland One' => 'Headland One',
		'Heebo' => 'Heebo',
		'Henny Penny' => 'Henny Penny',
		'Hepta Slab' => 'Hepta Slab',
		'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
		'Hi Melody' => 'Hi Melody',
		'Hina Mincho' => 'Hina Mincho',
		'Hind' => 'Hind',
		'Hind Guntur' => 'Hind Guntur',
		'Hind Madurai' => 'Hind Madurai',
		'Hind Siliguri' => 'Hind Siliguri',
		'Hind Vadodara' => 'Hind Vadodara',
		'Holtwood One SC' => 'Holtwood One SC',
		'Homemade Apple' => 'Homemade Apple',
		'Homenaje' => 'Homenaje',
		'Hubballi' => 'Hubballi',
		'Hurricane' => 'Hurricane',
		'IBM Plex Mono' => 'IBM Plex Mono',
		'IBM Plex Sans' => 'IBM Plex Sans',
		'IBM Plex Sans Arabic' => 'IBM Plex Sans Arabic',
		'IBM Plex Sans Condensed' => 'IBM Plex Sans Condensed',
		'IBM Plex Sans Devanagari' => 'IBM Plex Sans Devanagari',
		'IBM Plex Sans Hebrew' => 'IBM Plex Sans Hebrew',
		'IBM Plex Sans JP' => 'IBM Plex Sans JP',
		'IBM Plex Sans KR' => 'IBM Plex Sans KR',
		'IBM Plex Sans Thai' => 'IBM Plex Sans Thai',
		'IBM Plex Sans Thai Looped' => 'IBM Plex Sans Thai Looped',
		'IBM Plex Serif' => 'IBM Plex Serif',
		'IM Fell DW Pica' => 'IM Fell DW Pica',
		'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
		'IM Fell Double Pica' => 'IM Fell Double Pica',
		'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
		'IM Fell English' => 'IM Fell English',
		'IM Fell English SC' => 'IM Fell English SC',
		'IM Fell French Canon' => 'IM Fell French Canon',
		'IM Fell French Canon SC' => 'IM Fell French Canon SC',
		'IM Fell Great Primer' => 'IM Fell Great Primer',
		'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
		'Ibarra Real Nova' => 'Ibarra Real Nova',
		'Iceberg' => 'Iceberg',
		'Iceland' => 'Iceland',
		'Imbue' => 'Imbue',
		'Imperial Script' => 'Imperial Script',
		'Imprima' => 'Imprima',
		'Inconsolata' => 'Inconsolata',
		'Inder' => 'Inder',
		'Indie Flower' => 'Indie Flower',
		'Ingrid Darling' => 'Ingrid Darling',
		'Inika' => 'Inika',
		'Inknut Antiqua' => 'Inknut Antiqua',
		'Inria Sans' => 'Inria Sans',
		'Inria Serif' => 'Inria Serif',
		'Inspiration' => 'Inspiration',
		'Inter' => 'Inter',
		'Inter Tight' => 'Inter Tight',
		'Irish Grover' => 'Irish Grover',
		'Island Moments' => 'Island Moments',
		'Istok Web' => 'Istok Web',
		'Italiana' => 'Italiana',
		'Italianno' => 'Italianno',
		'Itim' => 'Itim',
		'Jacques Francois' => 'Jacques Francois',
		'Jacques Francois Shadow' => 'Jacques Francois Shadow',
		'Jaldi' => 'Jaldi',
		'JetBrains Mono' => 'JetBrains Mono',
		'Jim Nightshade' => 'Jim Nightshade',
		'Joan' => 'Joan',
		'Jockey One' => 'Jockey One',
		'Jolly Lodger' => 'Jolly Lodger',
		'Jomhuria' => 'Jomhuria',
		'Jomolhari' => 'Jomolhari',
		'Josefin Sans' => 'Josefin Sans',
		'Josefin Slab' => 'Josefin Slab',
		'Jost' => 'Jost',
		'Joti One' => 'Joti One',
		'Jua' => 'Jua',
		'Judson' => 'Judson',
		'Julee' => 'Julee',
		'Julius Sans One' => 'Julius Sans One',
		'Junge' => 'Junge',
		'Jura' => 'Jura',
		'Just Another Hand' => 'Just Another Hand',
		'Just Me Again Down Here' => 'Just Me Again Down Here',
		'K2D' => 'K2D',
		'Kadwa' => 'Kadwa',
		'Kaisei Decol' => 'Kaisei Decol',
		'Kaisei HarunoUmi' => 'Kaisei HarunoUmi',
		'Kaisei Opti' => 'Kaisei Opti',
		'Kaisei Tokumin' => 'Kaisei Tokumin',
		'Kalam' => 'Kalam',
		'Kameron' => 'Kameron',
		'Kanit' => 'Kanit',
		'Kantumruy Pro' => 'Kantumruy Pro',
		'Karantina' => 'Karantina',
		'Karla' => 'Karla',
		'Karma' => 'Karma',
		'Katibeh' => 'Katibeh',
		'Kaushan Script' => 'Kaushan Script',
		'Kavivanar' => 'Kavivanar',
		'Kavoon' => 'Kavoon',
		'Kdam Thmor Pro' => 'Kdam Thmor Pro',
		'Keania One' => 'Keania One',
		'Kelly Slab' => 'Kelly Slab',
		'Kenia' => 'Kenia',
		'Khand' => 'Khand',
		'Khmer' => 'Khmer',
		'Khula' => 'Khula',
		'Kings' => 'Kings',
		'Kirang Haerang' => 'Kirang Haerang',
		'Kite One' => 'Kite One',
		'Kiwi Maru' => 'Kiwi Maru',
		'Klee One' => 'Klee One',
		'Knewave' => 'Knewave',
		'KoHo' => 'KoHo',
		'Kodchasan' => 'Kodchasan',
		'Koh Santepheap' => 'Koh Santepheap',
		'Kolker Brush' => 'Kolker Brush',
		'Kosugi' => 'Kosugi',
		'Kosugi Maru' => 'Kosugi Maru',
		'Kotta One' => 'Kotta One',
		'Koulen' => 'Koulen',
		'Kranky' => 'Kranky',
		'Kreon' => 'Kreon',
		'Kristi' => 'Kristi',
		'Krona One' => 'Krona One',
		'Krub' => 'Krub',
		'Kufam' => 'Kufam',
		'Kulim Park' => 'Kulim Park',
		'Kumar One' => 'Kumar One',
		'Kumar One Outline' => 'Kumar One Outline',
		'Kumbh Sans' => 'Kumbh Sans',
		'Kurale' => 'Kurale',
		'La Belle Aurore' => 'La Belle Aurore',
		'Labrada' => 'Labrada',
		'Lacquer' => 'Lacquer',
		'Laila' => 'Laila',
		'Lakki Reddy' => 'Lakki Reddy',
		'Lalezar' => 'Lalezar',
		'Lancelot' => 'Lancelot',
		'Langar' => 'Langar',
		'Lateef' => 'Lateef',
		'Lato' => 'Lato',
		'Lavishly Yours' => 'Lavishly Yours',
		'League Gothic' => 'League Gothic',
		'League Script' => 'League Script',
		'League Spartan' => 'League Spartan',
		'Leckerli One' => 'Leckerli One',
		'Ledger' => 'Ledger',
		'Lekton' => 'Lekton',
		'Lemon' => 'Lemon',
		'Lemonada' => 'Lemonada',
		'Lexend' => 'Lexend',
		'Lexend Deca' => 'Lexend Deca',
		'Lexend Exa' => 'Lexend Exa',
		'Lexend Giga' => 'Lexend Giga',
		'Lexend Mega' => 'Lexend Mega',
		'Lexend Peta' => 'Lexend Peta',
		'Lexend Tera' => 'Lexend Tera',
		'Lexend Zetta' => 'Lexend Zetta',
		'Libre Barcode 128' => 'Libre Barcode 128',
		'Libre Barcode 128 Text' => 'Libre Barcode 128 Text',
		'Libre Barcode 39' => 'Libre Barcode 39',
		'Libre Barcode 39 Extended' => 'Libre Barcode 39 Extended',
		'Libre Barcode 39 Extended Text' => 'Libre Barcode 39 Extended Text',
		'Libre Barcode 39 Text' => 'Libre Barcode 39 Text',
		'Libre Barcode EAN13 Text' => 'Libre Barcode EAN13 Text',
		'Libre Baskerville' => 'Libre Baskerville',
		'Libre Bodoni' => 'Libre Bodoni',
		'Libre Caslon Display' => 'Libre Caslon Display',
		'Libre Caslon Text' => 'Libre Caslon Text',
		'Libre Franklin' => 'Libre Franklin',
		'Licorice' => 'Licorice',
		'Life Savers' => 'Life Savers',
		'Lilita One' => 'Lilita One',
		'Lily Script One' => 'Lily Script One',
		'Limelight' => 'Limelight',
		'Linden Hill' => 'Linden Hill',
		'Literata' => 'Literata',
		'Liu Jian Mao Cao' => 'Liu Jian Mao Cao',
		'Livvic' => 'Livvic',
		'Lobster' => 'Lobster',
		'Lobster Two' => 'Lobster Two',
		'Londrina Outline' => 'Londrina Outline',
		'Londrina Shadow' => 'Londrina Shadow',
		'Londrina Sketch' => 'Londrina Sketch',
		'Londrina Solid' => 'Londrina Solid',
		'Long Cang' => 'Long Cang',
		'Lora' => 'Lora',
		'Love Light' => 'Love Light',
		'Love Ya Like A Sister' => 'Love Ya Like A Sister',
		'Loved by the King' => 'Loved by the King',
		'Lovers Quarrel' => 'Lovers Quarrel',
		'Luckiest Guy' => 'Luckiest Guy',
		'Lusitana' => 'Lusitana',
		'Lustria' => 'Lustria',
		'Luxurious Roman' => 'Luxurious Roman',
		'Luxurious Script' => 'Luxurious Script',
		'M PLUS 1' => 'M PLUS 1',
		'M PLUS 1 Code' => 'M PLUS 1 Code',
		'M PLUS 1p' => 'M PLUS 1p',
		'M PLUS 2' => 'M PLUS 2',
		'M PLUS Code Latin' => 'M PLUS Code Latin',
		'M PLUS Rounded 1c' => 'M PLUS Rounded 1c',
		'Ma Shan Zheng' => 'Ma Shan Zheng',
		'Macondo' => 'Macondo',
		'Macondo Swash Caps' => 'Macondo Swash Caps',
		'Mada' => 'Mada',
		'Magra' => 'Magra',
		'Maiden Orange' => 'Maiden Orange',
		'Maitree' => 'Maitree',
		'Major Mono Display' => 'Major Mono Display',
		'Mako' => 'Mako',
		'Mali' => 'Mali',
		'Mallanna' => 'Mallanna',
		'Mandali' => 'Mandali',
		'Manjari' => 'Manjari',
		'Manrope' => 'Manrope',
		'Mansalva' => 'Mansalva',
		'Manuale' => 'Manuale',
		'Marcellus' => 'Marcellus',
		'Marcellus SC' => 'Marcellus SC',
		'Marck Script' => 'Marck Script',
		'Margarine' => 'Margarine',
		'Marhey' => 'Marhey',
		'Markazi Text' => 'Markazi Text',
		'Marko One' => 'Marko One',
		'Marmelad' => 'Marmelad',
		'Martel' => 'Martel',
		'Martel Sans' => 'Martel Sans',
		'Martian Mono' => 'Martian Mono',
		'Marvel' => 'Marvel',
		'Mate' => 'Mate',
		'Mate SC' => 'Mate SC',
		'Material Icons' => 'Material Icons',
		'Material Icons Outlined' => 'Material Icons Outlined',
		'Material Icons Round' => 'Material Icons Round',
		'Material Icons Sharp' => 'Material Icons Sharp',
		'Material Icons Two Tone' => 'Material Icons Two Tone',
		'Material Symbols Outlined' => 'Material Symbols Outlined',
		'Material Symbols Rounded' => 'Material Symbols Rounded',
		'Material Symbols Sharp' => 'Material Symbols Sharp',
		'Maven Pro' => 'Maven Pro',
		'McLaren' => 'McLaren',
		'Mea Culpa' => 'Mea Culpa',
		'Meddon' => 'Meddon',
		'MedievalSharp' => 'MedievalSharp',
		'Medula One' => 'Medula One',
		'Meera Inimai' => 'Meera Inimai',
		'Megrim' => 'Megrim',
		'Meie Script' => 'Meie Script',
		'Meow Script' => 'Meow Script',
		'Merienda' => 'Merienda',
		'Merriweather' => 'Merriweather',
		'Merriweather Sans' => 'Merriweather Sans',
		'Metal' => 'Metal',
		'Metal Mania' => 'Metal Mania',
		'Metamorphous' => 'Metamorphous',
		'Metrophobic' => 'Metrophobic',
		'Michroma' => 'Michroma',
		'Milonga' => 'Milonga',
		'Miltonian' => 'Miltonian',
		'Miltonian Tattoo' => 'Miltonian Tattoo',
		'Mina' => 'Mina',
		'Mingzat' => 'Mingzat',
		'Miniver' => 'Miniver',
		'Miriam Libre' => 'Miriam Libre',
		'Mirza' => 'Mirza',
		'Miss Fajardose' => 'Miss Fajardose',
		'Mitr' => 'Mitr',
		'Mochiy Pop One' => 'Mochiy Pop One',
		'Mochiy Pop P One' => 'Mochiy Pop P One',
		'Modak' => 'Modak',
		'Modern Antiqua' => 'Modern Antiqua',
		'Mogra' => 'Mogra',
		'Mohave' => 'Mohave',
		'Molengo' => 'Molengo',
		'Molle' => 'Molle',
		'Monda' => 'Monda',
		'Monofett' => 'Monofett',
		'Monoton' => 'Monoton',
		'Monsieur La Doulaise' => 'Monsieur La Doulaise',
		'Montaga' => 'Montaga',
		'Montagu Slab' => 'Montagu Slab',
		'MonteCarlo' => 'MonteCarlo',
		'Montez' => 'Montez',
		'Montserrat' => 'Montserrat',
		'Montserrat Alternates' => 'Montserrat Alternates',
		'Montserrat Subrayada' => 'Montserrat Subrayada',
		'Moo Lah Lah' => 'Moo Lah Lah',
		'Moon Dance' => 'Moon Dance',
		'Moul' => 'Moul',
		'Moulpali' => 'Moulpali',
		'Mountains of Christmas' => 'Mountains of Christmas',
		'Mouse Memoirs' => 'Mouse Memoirs',
		'Mr Bedfort' => 'Mr Bedfort',
		'Mr Dafoe' => 'Mr Dafoe',
		'Mr De Haviland' => 'Mr De Haviland',
		'Mrs Saint Delafield' => 'Mrs Saint Delafield',
		'Mrs Sheppards' => 'Mrs Sheppards',
		'Ms Madi' => 'Ms Madi',
		'Mukta' => 'Mukta',
		'Mukta Mahee' => 'Mukta Mahee',
		'Mukta Malar' => 'Mukta Malar',
		'Mukta Vaani' => 'Mukta Vaani',
		'Mulish' => 'Mulish',
		'Murecho' => 'Murecho',
		'MuseoModerno' => 'MuseoModerno',
		'My Soul' => 'My Soul',
		'Mynerve' => 'Mynerve',
		'Mystery Quest' => 'Mystery Quest',
		'NTR' => 'NTR',
		'Nabla' => 'Nabla',
		'Nanum Brush Script' => 'Nanum Brush Script',
		'Nanum Gothic' => 'Nanum Gothic',
		'Nanum Gothic Coding' => 'Nanum Gothic Coding',
		'Nanum Myeongjo' => 'Nanum Myeongjo',
		'Nanum Pen Script' => 'Nanum Pen Script',
		'Neonderthaw' => 'Neonderthaw',
		'Nerko One' => 'Nerko One',
		'Neucha' => 'Neucha',
		'Neuton' => 'Neuton',
		'New Rocker' => 'New Rocker',
		'New Tegomin' => 'New Tegomin',
		'News Cycle' => 'News Cycle',
		'Newsreader' => 'Newsreader',
		'Niconne' => 'Niconne',
		'Niramit' => 'Niramit',
		'Nixie One' => 'Nixie One',
		'Nobile' => 'Nobile',
		'Nokora' => 'Nokora',
		'Norican' => 'Norican',
		'Nosifer' => 'Nosifer',
		'Notable' => 'Notable',
		'Nothing You Could Do' => 'Nothing You Could Do',
		'Noticia Text' => 'Noticia Text',
		'Noto Color Emoji' => 'Noto Color Emoji',
		'Noto Emoji' => 'Noto Emoji',
		'Noto Kufi Arabic' => 'Noto Kufi Arabic',
		'Noto Music' => 'Noto Music',
		'Noto Naskh Arabic' => 'Noto Naskh Arabic',
		'Noto Nastaliq Urdu' => 'Noto Nastaliq Urdu',
		'Noto Rashi Hebrew' => 'Noto Rashi Hebrew',
		'Noto Sans' => 'Noto Sans',
		'Noto Sans Adlam' => 'Noto Sans Adlam',
		'Noto Sans Adlam Unjoined' => 'Noto Sans Adlam Unjoined',
		'Noto Sans Anatolian Hieroglyphs' => 'Noto Sans Anatolian Hieroglyphs',
		'Noto Sans Arabic' => 'Noto Sans Arabic',
		'Noto Sans Armenian' => 'Noto Sans Armenian',
		'Noto Sans Avestan' => 'Noto Sans Avestan',
		'Noto Sans Balinese' => 'Noto Sans Balinese',
		'Noto Sans Bamum' => 'Noto Sans Bamum',
		'Noto Sans Bassa Vah' => 'Noto Sans Bassa Vah',
		'Noto Sans Batak' => 'Noto Sans Batak',
		'Noto Sans Bengali' => 'Noto Sans Bengali',
		'Noto Sans Bhaiksuki' => 'Noto Sans Bhaiksuki',
		'Noto Sans Brahmi' => 'Noto Sans Brahmi',
		'Noto Sans Buginese' => 'Noto Sans Buginese',
		'Noto Sans Buhid' => 'Noto Sans Buhid',
		'Noto Sans Canadian Aboriginal' => 'Noto Sans Canadian Aboriginal',
		'Noto Sans Carian' => 'Noto Sans Carian',
		'Noto Sans Caucasian Albanian' => 'Noto Sans Caucasian Albanian',
		'Noto Sans Chakma' => 'Noto Sans Chakma',
		'Noto Sans Cham' => 'Noto Sans Cham',
		'Noto Sans Cherokee' => 'Noto Sans Cherokee',
		'Noto Sans Coptic' => 'Noto Sans Coptic',
		'Noto Sans Cuneiform' => 'Noto Sans Cuneiform',
		'Noto Sans Cypriot' => 'Noto Sans Cypriot',
		'Noto Sans Deseret' => 'Noto Sans Deseret',
		'Noto Sans Devanagari' => 'Noto Sans Devanagari',
		'Noto Sans Display' => 'Noto Sans Display',
		'Noto Sans Duployan' => 'Noto Sans Duployan',
		'Noto Sans Egyptian Hieroglyphs' => 'Noto Sans Egyptian Hieroglyphs',
		'Noto Sans Elbasan' => 'Noto Sans Elbasan',
		'Noto Sans Elymaic' => 'Noto Sans Elymaic',
		'Noto Sans Ethiopic' => 'Noto Sans Ethiopic',
		'Noto Sans Georgian' => 'Noto Sans Georgian',
		'Noto Sans Glagolitic' => 'Noto Sans Glagolitic',
		'Noto Sans Gothic' => 'Noto Sans Gothic',
		'Noto Sans Grantha' => 'Noto Sans Grantha',
		'Noto Sans Gujarati' => 'Noto Sans Gujarati',
		'Noto Sans Gunjala Gondi' => 'Noto Sans Gunjala Gondi',
		'Noto Sans Gurmukhi' => 'Noto Sans Gurmukhi',
		'Noto Sans HK' => 'Noto Sans HK',
		'Noto Sans Hanifi Rohingya' => 'Noto Sans Hanifi Rohingya',
		'Noto Sans Hanunoo' => 'Noto Sans Hanunoo',
		'Noto Sans Hatran' => 'Noto Sans Hatran',
		'Noto Sans Hebrew' => 'Noto Sans Hebrew',
		'Noto Sans Imperial Aramaic' => 'Noto Sans Imperial Aramaic',
		'Noto Sans Indic Siyaq Numbers' => 'Noto Sans Indic Siyaq Numbers',
		'Noto Sans Inscriptional Pahlavi' => 'Noto Sans Inscriptional Pahlavi',
		'Noto Sans Inscriptional Parthian' => 'Noto Sans Inscriptional Parthian',
		'Noto Sans JP' => 'Noto Sans JP',
		'Noto Sans Javanese' => 'Noto Sans Javanese',
		'Noto Sans KR' => 'Noto Sans KR',
		'Noto Sans Kaithi' => 'Noto Sans Kaithi',
		'Noto Sans Kannada' => 'Noto Sans Kannada',
		'Noto Sans Kayah Li' => 'Noto Sans Kayah Li',
		'Noto Sans Kharoshthi' => 'Noto Sans Kharoshthi',
		'Noto Sans Khmer' => 'Noto Sans Khmer',
		'Noto Sans Khojki' => 'Noto Sans Khojki',
		'Noto Sans Khudawadi' => 'Noto Sans Khudawadi',
		'Noto Sans Lao' => 'Noto Sans Lao',
		'Noto Sans Lao Looped' => 'Noto Sans Lao Looped',
		'Noto Sans Lepcha' => 'Noto Sans Lepcha',
		'Noto Sans Limbu' => 'Noto Sans Limbu',
		'Noto Sans Linear A' => 'Noto Sans Linear A',
		'Noto Sans Linear B' => 'Noto Sans Linear B',
		'Noto Sans Lisu' => 'Noto Sans Lisu',
		'Noto Sans Lycian' => 'Noto Sans Lycian',
		'Noto Sans Lydian' => 'Noto Sans Lydian',
		'Noto Sans Mahajani' => 'Noto Sans Mahajani',
		'Noto Sans Malayalam' => 'Noto Sans Malayalam',
		'Noto Sans Mandaic' => 'Noto Sans Mandaic',
		'Noto Sans Manichaean' => 'Noto Sans Manichaean',
		'Noto Sans Marchen' => 'Noto Sans Marchen',
		'Noto Sans Masaram Gondi' => 'Noto Sans Masaram Gondi',
		'Noto Sans Math' => 'Noto Sans Math',
		'Noto Sans Mayan Numerals' => 'Noto Sans Mayan Numerals',
		'Noto Sans Medefaidrin' => 'Noto Sans Medefaidrin',
		'Noto Sans Meetei Mayek' => 'Noto Sans Meetei Mayek',
		'Noto Sans Mende Kikakui' => 'Noto Sans Mende Kikakui',
		'Noto Sans Meroitic' => 'Noto Sans Meroitic',
		'Noto Sans Miao' => 'Noto Sans Miao',
		'Noto Sans Modi' => 'Noto Sans Modi',
		'Noto Sans Mongolian' => 'Noto Sans Mongolian',
		'Noto Sans Mono' => 'Noto Sans Mono',
		'Noto Sans Mro' => 'Noto Sans Mro',
		'Noto Sans Multani' => 'Noto Sans Multani',
		'Noto Sans Myanmar' => 'Noto Sans Myanmar',
		'Noto Sans NKo' => 'Noto Sans NKo',
		'Noto Sans Nabataean' => 'Noto Sans Nabataean',
		'Noto Sans New Tai Lue' => 'Noto Sans New Tai Lue',
		'Noto Sans Newa' => 'Noto Sans Newa',
		'Noto Sans Nushu' => 'Noto Sans Nushu',
		'Noto Sans Ogham' => 'Noto Sans Ogham',
		'Noto Sans Ol Chiki' => 'Noto Sans Ol Chiki',
		'Noto Sans Old Hungarian' => 'Noto Sans Old Hungarian',
		'Noto Sans Old Italic' => 'Noto Sans Old Italic',
		'Noto Sans Old North Arabian' => 'Noto Sans Old North Arabian',
		'Noto Sans Old Permic' => 'Noto Sans Old Permic',
		'Noto Sans Old Persian' => 'Noto Sans Old Persian',
		'Noto Sans Old Sogdian' => 'Noto Sans Old Sogdian',
		'Noto Sans Old South Arabian' => 'Noto Sans Old South Arabian',
		'Noto Sans Old Turkic' => 'Noto Sans Old Turkic',
		'Noto Sans Oriya' => 'Noto Sans Oriya',
		'Noto Sans Osage' => 'Noto Sans Osage',
		'Noto Sans Osmanya' => 'Noto Sans Osmanya',
		'Noto Sans Pahawh Hmong' => 'Noto Sans Pahawh Hmong',
		'Noto Sans Palmyrene' => 'Noto Sans Palmyrene',
		'Noto Sans Pau Cin Hau' => 'Noto Sans Pau Cin Hau',
		'Noto Sans Phags Pa' => 'Noto Sans Phags Pa',
		'Noto Sans Phoenician' => 'Noto Sans Phoenician',
		'Noto Sans Psalter Pahlavi' => 'Noto Sans Psalter Pahlavi',
		'Noto Sans Rejang' => 'Noto Sans Rejang',
		'Noto Sans Runic' => 'Noto Sans Runic',
		'Noto Sans SC' => 'Noto Sans SC',
		'Noto Sans Samaritan' => 'Noto Sans Samaritan',
		'Noto Sans Saurashtra' => 'Noto Sans Saurashtra',
		'Noto Sans Sharada' => 'Noto Sans Sharada',
		'Noto Sans Shavian' => 'Noto Sans Shavian',
		'Noto Sans Siddham' => 'Noto Sans Siddham',
		'Noto Sans SignWriting' => 'Noto Sans SignWriting',
		'Noto Sans Sinhala' => 'Noto Sans Sinhala',
		'Noto Sans Sogdian' => 'Noto Sans Sogdian',
		'Noto Sans Sora Sompeng' => 'Noto Sans Sora Sompeng',
		'Noto Sans Soyombo' => 'Noto Sans Soyombo',
		'Noto Sans Sundanese' => 'Noto Sans Sundanese',
		'Noto Sans Syloti Nagri' => 'Noto Sans Syloti Nagri',
		'Noto Sans Symbols' => 'Noto Sans Symbols',
		'Noto Sans Symbols 2' => 'Noto Sans Symbols 2',
		'Noto Sans Syriac' => 'Noto Sans Syriac',
		'Noto Sans TC' => 'Noto Sans TC',
		'Noto Sans Tagalog' => 'Noto Sans Tagalog',
		'Noto Sans Tagbanwa' => 'Noto Sans Tagbanwa',
		'Noto Sans Tai Le' => 'Noto Sans Tai Le',
		'Noto Sans Tai Tham' => 'Noto Sans Tai Tham',
		'Noto Sans Tai Viet' => 'Noto Sans Tai Viet',
		'Noto Sans Takri' => 'Noto Sans Takri',
		'Noto Sans Tamil' => 'Noto Sans Tamil',
		'Noto Sans Tamil Supplement' => 'Noto Sans Tamil Supplement',
		'Noto Sans Tangsa' => 'Noto Sans Tangsa',
		'Noto Sans Telugu' => 'Noto Sans Telugu',
		'Noto Sans Thaana' => 'Noto Sans Thaana',
		'Noto Sans Thai' => 'Noto Sans Thai',
		'Noto Sans Thai Looped' => 'Noto Sans Thai Looped',
		'Noto Sans Tifinagh' => 'Noto Sans Tifinagh',
		'Noto Sans Tirhuta' => 'Noto Sans Tirhuta',
		'Noto Sans Ugaritic' => 'Noto Sans Ugaritic',
		'Noto Sans Vai' => 'Noto Sans Vai',
		'Noto Sans Wancho' => 'Noto Sans Wancho',
		'Noto Sans Warang Citi' => 'Noto Sans Warang Citi',
		'Noto Sans Yi' => 'Noto Sans Yi',
		'Noto Sans Zanabazar Square' => 'Noto Sans Zanabazar Square',
		'Noto Serif' => 'Noto Serif',
		'Noto Serif Ahom' => 'Noto Serif Ahom',
		'Noto Serif Armenian' => 'Noto Serif Armenian',
		'Noto Serif Balinese' => 'Noto Serif Balinese',
		'Noto Serif Bengali' => 'Noto Serif Bengali',
		'Noto Serif Devanagari' => 'Noto Serif Devanagari',
		'Noto Serif Display' => 'Noto Serif Display',
		'Noto Serif Dogra' => 'Noto Serif Dogra',
		'Noto Serif Ethiopic' => 'Noto Serif Ethiopic',
		'Noto Serif Georgian' => 'Noto Serif Georgian',
		'Noto Serif Grantha' => 'Noto Serif Grantha',
		'Noto Serif Gujarati' => 'Noto Serif Gujarati',
		'Noto Serif Gurmukhi' => 'Noto Serif Gurmukhi',
		'Noto Serif HK' => 'Noto Serif HK',
		'Noto Serif Hebrew' => 'Noto Serif Hebrew',
		'Noto Serif JP' => 'Noto Serif JP',
		'Noto Serif KR' => 'Noto Serif KR',
		'Noto Serif Kannada' => 'Noto Serif Kannada',
		'Noto Serif Khmer' => 'Noto Serif Khmer',
		'Noto Serif Khojki' => 'Noto Serif Khojki',
		'Noto Serif Lao' => 'Noto Serif Lao',
		'Noto Serif Malayalam' => 'Noto Serif Malayalam',
		'Noto Serif Myanmar' => 'Noto Serif Myanmar',
		'Noto Serif NP Hmong' => 'Noto Serif NP Hmong',
		'Noto Serif Oriya' => 'Noto Serif Oriya',
		'Noto Serif SC' => 'Noto Serif SC',
		'Noto Serif Sinhala' => 'Noto Serif Sinhala',
		'Noto Serif TC' => 'Noto Serif TC',
		'Noto Serif Tamil' => 'Noto Serif Tamil',
		'Noto Serif Tangut' => 'Noto Serif Tangut',
		'Noto Serif Telugu' => 'Noto Serif Telugu',
		'Noto Serif Thai' => 'Noto Serif Thai',
		'Noto Serif Tibetan' => 'Noto Serif Tibetan',
		'Noto Serif Toto' => 'Noto Serif Toto',
		'Noto Serif Yezidi' => 'Noto Serif Yezidi',
		'Noto Traditional Nushu' => 'Noto Traditional Nushu',
		'Nova Cut' => 'Nova Cut',
		'Nova Flat' => 'Nova Flat',
		'Nova Mono' => 'Nova Mono',
		'Nova Oval' => 'Nova Oval',
		'Nova Round' => 'Nova Round',
		'Nova Script' => 'Nova Script',
		'Nova Slim' => 'Nova Slim',
		'Nova Square' => 'Nova Square',
		'Numans' => 'Numans',
		'Nunito' => 'Nunito',
		'Nunito Sans' => 'Nunito Sans',
		'Nuosu SIL' => 'Nuosu SIL',
		'Odibee Sans' => 'Odibee Sans',
		'Odor Mean Chey' => 'Odor Mean Chey',
		'Offside' => 'Offside',
		'Oi' => 'Oi',
		'Old Standard TT' => 'Old Standard TT',
		'Oldenburg' => 'Oldenburg',
		'Ole' => 'Ole',
		'Oleo Script' => 'Oleo Script',
		'Oleo Script Swash Caps' => 'Oleo Script Swash Caps',
		'Oooh Baby' => 'Oooh Baby',
		'Open Sans' => 'Open Sans',
		'Oranienbaum' => 'Oranienbaum',
		'Orbitron' => 'Orbitron',
		'Oregano' => 'Oregano',
		'Orelega One' => 'Orelega One',
		'Orienta' => 'Orienta',
		'Original Surfer' => 'Original Surfer',
		'Oswald' => 'Oswald',
		'Outfit' => 'Outfit',
		'Over the Rainbow' => 'Over the Rainbow',
		'Overlock' => 'Overlock',
		'Overlock SC' => 'Overlock SC',
		'Overpass' => 'Overpass',
		'Overpass Mono' => 'Overpass Mono',
		'Ovo' => 'Ovo',
		'Oxanium' => 'Oxanium',
		'Oxygen' => 'Oxygen',
		'Oxygen Mono' => 'Oxygen Mono',
		'PT Mono' => 'PT Mono',
		'PT Sans' => 'PT Sans',
		'PT Sans Caption' => 'PT Sans Caption',
		'PT Sans Narrow' => 'PT Sans Narrow',
		'PT Serif' => 'PT Serif',
		'PT Serif Caption' => 'PT Serif Caption',
		'Pacifico' => 'Pacifico',
		'Padauk' => 'Padauk',
		'Padyakke Expanded One' => 'Padyakke Expanded One',
		'Palanquin' => 'Palanquin',
		'Palanquin Dark' => 'Palanquin Dark',
		'Pangolin' => 'Pangolin',
		'Paprika' => 'Paprika',
		'Parisienne' => 'Parisienne',
		'Passero One' => 'Passero One',
		'Passion One' => 'Passion One',
		'Passions Conflict' => 'Passions Conflict',
		'Pathway Gothic One' => 'Pathway Gothic One',
		'Patrick Hand' => 'Patrick Hand',
		'Patrick Hand SC' => 'Patrick Hand SC',
		'Pattaya' => 'Pattaya',
		'Patua One' => 'Patua One',
		'Pavanam' => 'Pavanam',
		'Paytone One' => 'Paytone One',
		'Peddana' => 'Peddana',
		'Peralta' => 'Peralta',
		'Permanent Marker' => 'Permanent Marker',
		'Petemoss' => 'Petemoss',
		'Petit Formal Script' => 'Petit Formal Script',
		'Petrona' => 'Petrona',
		'Philosopher' => 'Philosopher',
		'Phudu' => 'Phudu',
		'Piazzolla' => 'Piazzolla',
		'Piedra' => 'Piedra',
		'Pinyon Script' => 'Pinyon Script',
		'Pirata One' => 'Pirata One',
		'Plaster' => 'Plaster',
		'Play' => 'Play',
		'Playball' => 'Playball',
		'Playfair Display' => 'Playfair Display',
		'Playfair Display SC' => 'Playfair Display SC',
		'Plus Jakarta Sans' => 'Plus Jakarta Sans',
		'Podkova' => 'Podkova',
		'Poiret One' => 'Poiret One',
		'Poller One' => 'Poller One',
		'Poly' => 'Poly',
		'Pompiere' => 'Pompiere',
		'Pontano Sans' => 'Pontano Sans',
		'Poor Story' => 'Poor Story',
		'Poppins' => 'Poppins',
		'Port Lligat Sans' => 'Port Lligat Sans',
		'Port Lligat Slab' => 'Port Lligat Slab',
		'Potta One' => 'Potta One',
		'Pragati Narrow' => 'Pragati Narrow',
		'Praise' => 'Praise',
		'Prata' => 'Prata',
		'Preahvihear' => 'Preahvihear',
		'Press Start 2P' => 'Press Start 2P',
		'Pridi' => 'Pridi',
		'Princess Sofia' => 'Princess Sofia',
		'Prociono' => 'Prociono',
		'Prompt' => 'Prompt',
		'Prosto One' => 'Prosto One',
		'Proza Libre' => 'Proza Libre',
		'Public Sans' => 'Public Sans',
		'Puppies Play' => 'Puppies Play',
		'Puritan' => 'Puritan',
		'Purple Purse' => 'Purple Purse',
		'Qahiri' => 'Qahiri',
		'Quando' => 'Quando',
		'Quantico' => 'Quantico',
		'Quattrocento' => 'Quattrocento',
		'Quattrocento Sans' => 'Quattrocento Sans',
		'Questrial' => 'Questrial',
		'Quicksand' => 'Quicksand',
		'Quintessential' => 'Quintessential',
		'Qwigley' => 'Qwigley',
		'Qwitcher Grypen' => 'Qwitcher Grypen',
		'Racing Sans One' => 'Racing Sans One',
		'Radio Canada' => 'Radio Canada',
		'Radley' => 'Radley',
		'Rajdhani' => 'Rajdhani',
		'Rakkas' => 'Rakkas',
		'Raleway' => 'Raleway',
		'Raleway Dots' => 'Raleway Dots',
		'Ramabhadra' => 'Ramabhadra',
		'Ramaraja' => 'Ramaraja',
		'Rambla' => 'Rambla',
		'Rammetto One' => 'Rammetto One',
		'Rampart One' => 'Rampart One',
		'Ranchers' => 'Ranchers',
		'Rancho' => 'Rancho',
		'Ranga' => 'Ranga',
		'Rasa' => 'Rasa',
		'Rationale' => 'Rationale',
		'Ravi Prakash' => 'Ravi Prakash',
		'Readex Pro' => 'Readex Pro',
		'Recursive' => 'Recursive',
		'Red Hat Display' => 'Red Hat Display',
		'Red Hat Mono' => 'Red Hat Mono',
		'Red Hat Text' => 'Red Hat Text',
		'Red Rose' => 'Red Rose',
		'Redacted' => 'Redacted',
		'Redacted Script' => 'Redacted Script',
		'Redressed' => 'Redressed',
		'Reem Kufi' => 'Reem Kufi',
		'Reem Kufi Fun' => 'Reem Kufi Fun',
		'Reem Kufi Ink' => 'Reem Kufi Ink',
		'Reenie Beanie' => 'Reenie Beanie',
		'Reggae One' => 'Reggae One',
		'Revalia' => 'Revalia',
		'Rhodium Libre' => 'Rhodium Libre',
		'Ribeye' => 'Ribeye',
		'Ribeye Marrow' => 'Ribeye Marrow',
		'Righteous' => 'Righteous',
		'Risque' => 'Risque',
		'Road Rage' => 'Road Rage',
		'Roboto' => 'Roboto',
		'Roboto Condensed' => 'Roboto Condensed',
		'Roboto Flex' => 'Roboto Flex',
		'Roboto Mono' => 'Roboto Mono',
		'Roboto Serif' => 'Roboto Serif',
		'Roboto Slab' => 'Roboto Slab',
		'Rochester' => 'Rochester',
		'Rock Salt' => 'Rock Salt',
		'RocknRoll One' => 'RocknRoll One',
		'Rokkitt' => 'Rokkitt',
		'Romanesco' => 'Romanesco',
		'Ropa Sans' => 'Ropa Sans',
		'Rosario' => 'Rosario',
		'Rosarivo' => 'Rosarivo',
		'Rouge Script' => 'Rouge Script',
		'Rowdies' => 'Rowdies',
		'Rozha One' => 'Rozha One',
		'Rubik' => 'Rubik',
		'Rubik 80s Fade' => 'Rubik 80s Fade',
		'Rubik Beastly' => 'Rubik Beastly',
		'Rubik Bubbles' => 'Rubik Bubbles',
		'Rubik Burned' => 'Rubik Burned',
		'Rubik Dirt' => 'Rubik Dirt',
		'Rubik Distressed' => 'Rubik Distressed',
		'Rubik Gemstones' => 'Rubik Gemstones',
		'Rubik Glitch' => 'Rubik Glitch',
		'Rubik Iso' => 'Rubik Iso',
		'Rubik Marker Hatch' => 'Rubik Marker Hatch',
		'Rubik Maze' => 'Rubik Maze',
		'Rubik Microbe' => 'Rubik Microbe',
		'Rubik Mono One' => 'Rubik Mono One',
		'Rubik Moonrocks' => 'Rubik Moonrocks',
		'Rubik Puddles' => 'Rubik Puddles',
		'Rubik Spray Paint' => 'Rubik Spray Paint',
		'Rubik Storm' => 'Rubik Storm',
		'Rubik Vinyl' => 'Rubik Vinyl',
		'Rubik Wet Paint' => 'Rubik Wet Paint',
		'Ruda' => 'Ruda',
		'Rufina' => 'Rufina',
		'Ruge Boogie' => 'Ruge Boogie',
		'Ruluko' => 'Ruluko',
		'Rum Raisin' => 'Rum Raisin',
		'Ruslan Display' => 'Ruslan Display',
		'Russo One' => 'Russo One',
		'Ruthie' => 'Ruthie',
		'Rye' => 'Rye',
		'STIX Two Text' => 'STIX Two Text',
		'Sacramento' => 'Sacramento',
		'Sahitya' => 'Sahitya',
		'Sail' => 'Sail',
		'Saira' => 'Saira',
		'Saira Condensed' => 'Saira Condensed',
		'Saira Extra Condensed' => 'Saira Extra Condensed',
		'Saira Semi Condensed' => 'Saira Semi Condensed',
		'Saira Stencil One' => 'Saira Stencil One',
		'Salsa' => 'Salsa',
		'Sanchez' => 'Sanchez',
		'Sancreek' => 'Sancreek',
		'Sansita' => 'Sansita',
		'Sansita Swashed' => 'Sansita Swashed',
		'Sarabun' => 'Sarabun',
		'Sarala' => 'Sarala',
		'Sarina' => 'Sarina',
		'Sarpanch' => 'Sarpanch',
		'Sassy Frass' => 'Sassy Frass',
		'Satisfy' => 'Satisfy',
		'Sawarabi Gothic' => 'Sawarabi Gothic',
		'Sawarabi Mincho' => 'Sawarabi Mincho',
		'Scada' => 'Scada',
		'Scheherazade New' => 'Scheherazade New',
		'Schoolbell' => 'Schoolbell',
		'Scope One' => 'Scope One',
		'Seaweed Script' => 'Seaweed Script',
		'Secular One' => 'Secular One',
		'Sedgwick Ave' => 'Sedgwick Ave',
		'Sedgwick Ave Display' => 'Sedgwick Ave Display',
		'Sen' => 'Sen',
		'Send Flowers' => 'Send Flowers',
		'Sevillana' => 'Sevillana',
		'Seymour One' => 'Seymour One',
		'Shadows Into Light' => 'Shadows Into Light',
		'Shadows Into Light Two' => 'Shadows Into Light Two',
		'Shalimar' => 'Shalimar',
		'Shantell Sans' => 'Shantell Sans',
		'Shanti' => 'Shanti',
		'Share' => 'Share',
		'Share Tech' => 'Share Tech',
		'Share Tech Mono' => 'Share Tech Mono',
		'Shippori Antique' => 'Shippori Antique',
		'Shippori Antique B1' => 'Shippori Antique B1',
		'Shippori Mincho' => 'Shippori Mincho',
		'Shippori Mincho B1' => 'Shippori Mincho B1',
		'Shojumaru' => 'Shojumaru',
		'Short Stack' => 'Short Stack',
		'Shrikhand' => 'Shrikhand',
		'Siemreap' => 'Siemreap',
		'Sigmar One' => 'Sigmar One',
		'Signika' => 'Signika',
		'Signika Negative' => 'Signika Negative',
		'Silkscreen' => 'Silkscreen',
		'Simonetta' => 'Simonetta',
		'Single Day' => 'Single Day',
		'Sintony' => 'Sintony',
		'Sirin Stencil' => 'Sirin Stencil',
		'Six Caps' => 'Six Caps',
		'Skranji' => 'Skranji',
		'Slabo 13px' => 'Slabo 13px',
		'Slabo 27px' => 'Slabo 27px',
		'Slackey' => 'Slackey',
		'Smokum' => 'Smokum',
		'Smooch' => 'Smooch',
		'Smooch Sans' => 'Smooch Sans',
		'Smythe' => 'Smythe',
		'Sniglet' => 'Sniglet',
		'Snippet' => 'Snippet',
		'Snowburst One' => 'Snowburst One',
		'Sofadi One' => 'Sofadi One',
		'Sofia' => 'Sofia',
		'Sofia Sans' => 'Sofia Sans',
		'Sofia Sans Condensed' => 'Sofia Sans Condensed',
		'Sofia Sans Extra Condensed' => 'Sofia Sans Extra Condensed',
		'Sofia Sans Semi Condensed' => 'Sofia Sans Semi Condensed',
		'Solitreo' => 'Solitreo',
		'Solway' => 'Solway',
		'Song Myung' => 'Song Myung',
		'Sono' => 'Sono',
		'Sonsie One' => 'Sonsie One',
		'Sora' => 'Sora',
		'Sorts Mill Goudy' => 'Sorts Mill Goudy',
		'Source Code Pro' => 'Source Code Pro',
		'Source Sans 3' => 'Source Sans 3',
		'Source Sans Pro' => 'Source Sans Pro',
		'Source Serif 4' => 'Source Serif 4',
		'Source Serif Pro' => 'Source Serif Pro',
		'Space Grotesk' => 'Space Grotesk',
		'Space Mono' => 'Space Mono',
		'Special Elite' => 'Special Elite',
		'Spectral' => 'Spectral',
		'Spectral SC' => 'Spectral SC',
		'Spicy Rice' => 'Spicy Rice',
		'Spinnaker' => 'Spinnaker',
		'Spirax' => 'Spirax',
		'Splash' => 'Splash',
		'Spline Sans' => 'Spline Sans',
		'Spline Sans Mono' => 'Spline Sans Mono',
		'Squada One' => 'Squada One',
		'Square Peg' => 'Square Peg',
		'Sree Krushnadevaraya' => 'Sree Krushnadevaraya',
		'Sriracha' => 'Sriracha',
		'Srisakdi' => 'Srisakdi',
		'Staatliches' => 'Staatliches',
		'Stalemate' => 'Stalemate',
		'Stalinist One' => 'Stalinist One',
		'Stardos Stencil' => 'Stardos Stencil',
		'Stick' => 'Stick',
		'Stick No Bills' => 'Stick No Bills',
		'Stint Ultra Condensed' => 'Stint Ultra Condensed',
		'Stint Ultra Expanded' => 'Stint Ultra Expanded',
		'Stoke' => 'Stoke',
		'Strait' => 'Strait',
		'Style Script' => 'Style Script',
		'Stylish' => 'Stylish',
		'Sue Ellen Francisco' => 'Sue Ellen Francisco',
		'Suez One' => 'Suez One',
		'Sulphur Point' => 'Sulphur Point',
		'Sumana' => 'Sumana',
		'Sunflower' => 'Sunflower',
		'Sunshiney' => 'Sunshiney',
		'Supermercado One' => 'Supermercado One',
		'Sura' => 'Sura',
		'Suranna' => 'Suranna',
		'Suravaram' => 'Suravaram',
		'Suwannaphum' => 'Suwannaphum',
		'Swanky and Moo Moo' => 'Swanky and Moo Moo',
		'Syncopate' => 'Syncopate',
		'Syne' => 'Syne',
		'Syne Mono' => 'Syne Mono',
		'Syne Tactile' => 'Syne Tactile',
		'Tai Heritage Pro' => 'Tai Heritage Pro',
		'Tajawal' => 'Tajawal',
		'Tangerine' => 'Tangerine',
		'Tapestry' => 'Tapestry',
		'Taprom' => 'Taprom',
		'Tauri' => 'Tauri',
		'Taviraj' => 'Taviraj',
		'Teko' => 'Teko',
		'Telex' => 'Telex',
		'Tenali Ramakrishna' => 'Tenali Ramakrishna',
		'Tenor Sans' => 'Tenor Sans',
		'Text Me One' => 'Text Me One',
		'Texturina' => 'Texturina',
		'Thasadith' => 'Thasadith',
		'The Girl Next Door' => 'The Girl Next Door',
		'The Nautigal' => 'The Nautigal',
		'Tienne' => 'Tienne',
		'Tillana' => 'Tillana',
		'Timmana' => 'Timmana',
		'Tinos' => 'Tinos',
		'Tiro Bangla' => 'Tiro Bangla',
		'Tiro Devanagari Hindi' => 'Tiro Devanagari Hindi',
		'Tiro Devanagari Marathi' => 'Tiro Devanagari Marathi',
		'Tiro Devanagari Sanskrit' => 'Tiro Devanagari Sanskrit',
		'Tiro Gurmukhi' => 'Tiro Gurmukhi',
		'Tiro Kannada' => 'Tiro Kannada',
		'Tiro Tamil' => 'Tiro Tamil',
		'Tiro Telugu' => 'Tiro Telugu',
		'Titan One' => 'Titan One',
		'Titillium Web' => 'Titillium Web',
		'Tomorrow' => 'Tomorrow',
		'Tourney' => 'Tourney',
		'Trade Winds' => 'Trade Winds',
		'Train One' => 'Train One',
		'Trirong' => 'Trirong',
		'Trispace' => 'Trispace',
		'Trocchi' => 'Trocchi',
		'Trochut' => 'Trochut',
		'Truculenta' => 'Truculenta',
		'Trykker' => 'Trykker',
		'Tulpen One' => 'Tulpen One',
		'Turret Road' => 'Turret Road',
		'Twinkle Star' => 'Twinkle Star',
		'Ubuntu' => 'Ubuntu',
		'Ubuntu Condensed' => 'Ubuntu Condensed',
		'Ubuntu Mono' => 'Ubuntu Mono',
		'Uchen' => 'Uchen',
		'Ultra' => 'Ultra',
		'Unbounded' => 'Unbounded',
		'Uncial Antiqua' => 'Uncial Antiqua',
		'Underdog' => 'Underdog',
		'Unica One' => 'Unica One',
		'UnifrakturCook' => 'UnifrakturCook',
		'UnifrakturMaguntia' => 'UnifrakturMaguntia',
		'Unkempt' => 'Unkempt',
		'Unlock' => 'Unlock',
		'Unna' => 'Unna',
		'Updock' => 'Updock',
		'Urbanist' => 'Urbanist',
		'VT323' => 'VT323',
		'Vampiro One' => 'Vampiro One',
		'Varela' => 'Varela',
		'Varela Round' => 'Varela Round',
		'Varta' => 'Varta',
		'Vast Shadow' => 'Vast Shadow',
		'Vazirmatn' => 'Vazirmatn',
		'Vesper Libre' => 'Vesper Libre',
		'Viaoda Libre' => 'Viaoda Libre',
		'Vibes' => 'Vibes',
		'Vibur' => 'Vibur',
		'Vidaloka' => 'Vidaloka',
		'Viga' => 'Viga',
		'Voces' => 'Voces',
		'Volkhov' => 'Volkhov',
		'Vollkorn' => 'Vollkorn',
		'Vollkorn SC' => 'Vollkorn SC',
		'Voltaire' => 'Voltaire',
		'Vujahday Script' => 'Vujahday Script',
		'Waiting for the Sunrise' => 'Waiting for the Sunrise',
		'Wallpoet' => 'Wallpoet',
		'Walter Turncoat' => 'Walter Turncoat',
		'Warnes' => 'Warnes',
		'Water Brush' => 'Water Brush',
		'Waterfall' => 'Waterfall',
		'Wellfleet' => 'Wellfleet',
		'Wendy One' => 'Wendy One',
		'Whisper' => 'Whisper',
		'WindSong' => 'WindSong',
		'Wire One' => 'Wire One',
		'Work Sans' => 'Work Sans',
		'Xanh Mono' => 'Xanh Mono',
		'Yaldevi' => 'Yaldevi',
		'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
		'Yantramanav' => 'Yantramanav',
		'Yatra One' => 'Yatra One',
		'Yellowtail' => 'Yellowtail',
		'Yeon Sung' => 'Yeon Sung',
		'Yeseva One' => 'Yeseva One',
		'Yesteryear' => 'Yesteryear',
		'Yomogi' => 'Yomogi',
		'Yrsa' => 'Yrsa',
		'Yuji Boku' => 'Yuji Boku',
		'Yuji Mai' => 'Yuji Mai',
		'Yuji Syuku' => 'Yuji Syuku',
		'Yusei Magic' => 'Yusei Magic',
		'ZCOOL KuaiLe' => 'ZCOOL KuaiLe',
		'ZCOOL QingKe HuangYou' => 'ZCOOL QingKe HuangYou',
		'ZCOOL XiaoWei' => 'ZCOOL XiaoWei',
		'Zen Antique' => 'Zen Antique',
		'Zen Antique Soft' => 'Zen Antique Soft',
		'Zen Dots' => 'Zen Dots',
		'Zen Kaku Gothic Antique' => 'Zen Kaku Gothic Antique',
		'Zen Kaku Gothic New' => 'Zen Kaku Gothic New',
		'Zen Kurenaido' => 'Zen Kurenaido',
		'Zen Loop' => 'Zen Loop',
		'Zen Maru Gothic' => 'Zen Maru Gothic',
		'Zen Old Mincho' => 'Zen Old Mincho',
		'Zen Tokyo Zoo' => 'Zen Tokyo Zoo',
		'Zeyada' => 'Zeyada',
		'Zhi Mang Xing' => 'Zhi Mang Xing',
		'Zilla Slab' => 'Zilla Slab',
		'Zilla Slab Highlight' => 'Zilla Slab Highlight'
	);
	$faces = array_merge($jl_custom_font, $jl_google_font);
	// Font Size
	$font_sizes = array();
	$font_sizes_px_none = array();
	for ($i = 7; $i <= 70; $i++){
		$font_sizes[$i.'px'] = $i.'px';
		$font_sizes_px_none[$i] = $i.'px';
	}

	$num_sizes = array();
	for ($i = 1; $i <= 50; $i++){
		$num_sizes[$i] = $i;
	}
	// Font Weights
	$font_weights  = array(
		'100' => esc_html__('Thin', 'bopea'),
		'200' => esc_html__('Extra-Light', 'bopea'),
		'300' => esc_html__('Light', 'bopea'),
		'400' => esc_html__('Regular', 'bopea'),
		'500' => esc_html__('Medium', 'bopea'),
		'600' => esc_html__('Semi-Bold', 'bopea'),
		'700' => esc_html__('Bold', 'bopea'),
		'800' => esc_html__('Extra-Bold', 'bopea'),
		'900' => esc_html__('Black', 'bopea')
	);

	$wp_customize->add_panel( 'bopea_theme_options', array(
	    'priority' => 1,
	    'title' => esc_html__( 'Theme Options', 'bopea' ),
	    'description' => esc_html__( 'Options for theme customizing', 'bopea' ),
	));

	$wp_customize->add_section(
		'bopea_logo_favicon' ,
		array(
   		'title'      => esc_html__( 'Logo Settings', 'bopea' ),   		
   		'priority'  => 1,
   		'panel' => 'bopea_theme_options'
	));
    $wp_customize->add_setting(
    'bopea_logo',
    array(
	'default' 			=> '',
	'transport'   		=> 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
	));
    $wp_customize->add_control(
    	new WP_Customize_Image_Control(
    	$wp_customize,
    	'bopea_logo',
    	array(
        'label'    => esc_html__( 'Normal logo', 'bopea' ),
        'section'  => 'bopea_logo_favicon',
        'settings' => 'bopea_logo'
    )));

    $wp_customize->add_setting(
    'bopea_logow',
    array(
	'default' 			=> '',
	'transport'   		=> 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
	));
    $wp_customize->add_control(
    	new WP_Customize_Image_Control(
    	$wp_customize,
    	'bopea_logow',
    	array(
        'label'    => esc_html__( 'Dark mode logo', 'bopea' ),
        'section'  => 'bopea_logo_favicon',
        'settings' => 'bopea_logow'
    )));    

	$wp_customize->add_setting(
	    'custom_logo_link',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'custom_logo_link',
	    array(
	        'section'   => 'bopea_logo_favicon',
	        'label'     => esc_html__('Custom logo link','bopea'),
	        'type'      => 'text'
	    )
	);

    $wp_customize->add_setting(
	    'logo_width',
	    array(
	        'default'    =>  esc_attr__( '110px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'logo_width',
	    array(
	        'section'   => 'bopea_logo_favicon',
	        'label'     => esc_html__('Logo Width EX: 100px','bopea'),
	        'type'      => 'text'
	    )
	);
	$wp_customize->add_setting(
	    'm_logo_width',
	    array(
	        'default'    =>  esc_attr__( '110px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'm_logo_width',
	    array(
	        'section'   => 'bopea_logo_favicon',
	        'label'     => esc_html__('Mobile Logo Width EX: 100px','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    's_logo_width',
	    array(	        
			'default'    =>  esc_attr__( '110px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    's_logo_width',
	    array(
	        'section'   => 'bopea_logo_favicon',
	        'label'     => esc_html__('Sidebar Logo Width EX: 100px','bopea'),
	        'type'      => 'text'
	    )
	);	

	$wp_customize->add_setting(
	    'foot_logo_width',
	    array(	        
			'default'    =>  esc_attr__( '110px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'foot_logo_width',
	    array(
	        'section'   => 'bopea_logo_favicon',
	        'label'     => esc_html__('Footer Logo Width EX: 100px','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
        'enable_d_light',
        array(
            'default' => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'enable_d_light',
        array(
            'section'   => 'bopea_logo_favicon',
            'label'     => esc_html__('Enable default white logo','bopea'),
            'type'      => 'checkbox'
        )
    );

	$wp_customize->add_setting(
        'sticky_logo',
        array(
            'default' => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'sticky_logo',
        array(
            'section'   => 'bopea_logo_favicon',
            'label'     => esc_html__('Enable sticky default white logo','bopea'),
            'type'      => 'checkbox'
        )
    );

	$wp_customize->add_setting(
        'bopea_logotext_options',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new bopea_Customize_Control_Title (
            $wp_customize,
            'bopea_logotext_options',
            array(
                'label'         => esc_html__( 'Logo Text settings', 'bopea' ),
                'section'       => 'bopea_logo_favicon',
                'settings'      => 'bopea_logotext_options',
            )
        )
    );

	$wp_customize->add_setting(
        'enable_logo_txt',
        array(
            'default' => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'enable_logo_txt',
        array(
            'section'   => 'bopea_logo_favicon',
            'label'     => esc_html__('Enable logo text','bopea'),
            'type'      => 'checkbox'
        )
    );

	$wp_customize->add_setting(
	    'jl_logo_size',
	    array(
	        'default'    =>  esc_attr__( '32px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'jl_logo_size',
	    array(
	        'section'   => 'bopea_logo_favicon',
	        'label'     => esc_html__('Logo font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'jl_logo_size_mob',
	    array(
	        'default'    =>  esc_attr__( '30px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'jl_logo_size_mob',
	    array(
	        'section'   => 'bopea_logo_favicon',
	        'label'     => esc_html__('Logo mobile font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
		'logo_txt_lspace',
		array(			
			'transport'  =>  'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'logo_txt_lspace',
		array(
			'section'   => 'bopea_logo_favicon',
			'label'     => esc_html__('Logo letter spacing EX: -0.03em','bopea'),
			'type'      => 'text'
		)
	);


	$wp_customize->add_setting(
	    'jl_logo_color',
	    array(
	        'default'    =>  esc_attr__( '#fff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'jl_logo_color',
	        array(
	            'label'      => esc_html__( 'Logo text color', 'bopea' ),
	            'section'    => 'bopea_logo_favicon',
	            'settings'   => 'jl_logo_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_logo_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#fff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'jl_logo_color_dark',
	        array(
	            'label'      => esc_html__( 'Logo text color dark mode', 'bopea' ),
	            'section'    => 'bopea_logo_favicon',
	            'settings'   => 'jl_logo_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_logo_color_side',
	    array(
	        'default'    =>  esc_attr__( '#000', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'jl_logo_color_side',
	        array(
	            'label'      => esc_html__( 'Logo sidebar text color', 'bopea' ),
	            'section'    => 'bopea_logo_favicon',
	            'settings'   => 'jl_logo_color_side'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_logo_color_side_dark',
	    array(
	        'default'    =>  esc_attr__( '#fff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'jl_logo_color_side_dark',
	        array(
	            'label'      => esc_html__( 'Logo sidebar text color dark mode', 'bopea' ),
	            'section'    => 'bopea_logo_favicon',
	            'settings'   => 'jl_logo_color_side_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_logo_color_foot',
	    array(
	        'default'    =>  esc_attr__( '#000', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'jl_logo_color_foot',
	        array(
	            'label'      => esc_html__( 'Logo footer text color', 'bopea' ),
	            'section'    => 'bopea_logo_favicon',
	            'settings'   => 'jl_logo_color_foot'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_logo_color_foot_dark',
	    array(
	        'default'    =>  esc_attr__( '#fff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'jl_logo_color_foot_dark',
	        array(
	            'label'      => esc_html__( 'Logo footer text color dark mode', 'bopea' ),
	            'section'    => 'bopea_logo_favicon',
	            'settings'   => 'jl_logo_color_foot_dark'
	        )
	    )
	);

	/*General Setting*/
	$wp_customize->add_section(
		    'bopea_general_setting',
		    array(
		        'title'     => esc_html__('General Settings', 'bopea'),
		        'priority'  => 1,
		        'panel' => 'bopea_theme_options'
		    )
	);

	$wp_customize->add_setting(
	    'max_content_width',
	    array(
	        'default'    =>  '1260px',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'max_content_width',
	    array(
	        'section'   => 'bopea_general_setting',
	        'label'     => esc_html__('Content width EX: 1200px','bopea'),
	        'type'      => 'text'
	    )
	);

    $wp_customize->add_setting(
	    'bopea_site_layout',
	    array(
	        'default'    =>  esc_attr__( 'jl_lfull', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_site_layout',
	    array(
	        'section'   => 'bopea_general_setting',
	        'label'     => esc_html__('Website layout (boxed/full)','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
	        'jl_lfull' => esc_html__('Full width', 'bopea'),
			'jl_lbox' => esc_html__('Boxed width', 'bopea'),			
	        )
	    )
	);

	$wp_customize->add_setting(
		'bopea_box_bg',
		array(
		'default' 			=> '',
		'transport'   		=> 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
			$wp_customize,
			'bopea_box_bg',
			array(
			'label'    => esc_html__( 'Boxed width body background image', 'bopea' ),
			'section'  => 'bopea_general_setting',
			'settings' => 'bopea_box_bg'
		)));

		$wp_customize->add_setting(
			'jl_boxed_space',
			array(
				'default'    =>  esc_attr__( '30px', 'bopea' ),
				'transport'  =>  'refresh',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'jl_boxed_space',
			array(
				'section'   => 'bopea_general_setting',
				'label'     => esc_html__('Boxed layout space EX: 30px','bopea'),
				'type'      => 'text'
			)
		);

	$wp_customize->add_setting(
	    'bopea_title_link',
	    array(
	        'default'    =>  esc_attr__( 'jl_uline', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_title_link',
	    array(
	        'section'   => 'bopea_general_setting',
	        'label'     => esc_html__('Title hover style','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
	        'jl_tline' => esc_html__('Title hover line animation', 'bopea'),
			'jl_tcolor' => esc_html__('Title hover text color', 'bopea'),
			'jl_uline' => esc_html__('Title hover text underline', 'bopea'),
			'jl_bgt' => esc_html__('Title hover text background', 'bopea')
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_title_h',
	    array(
	        'default'    =>  esc_attr__( '1px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_title_h',
	    array(
	        'section'   => 'bopea_general_setting',
	        'label'     => esc_html__('Title line animation height EX: 2px','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'border_rounded',
	    array(
	        'default'    =>  esc_attr__( '5px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'border_rounded',
	    array(
	        'section'   => 'bopea_general_setting',
	        'label'     => esc_html__('Image border radius EX: 10px','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'top_border_rounded',
	    array(
	        'default'    =>  esc_attr__( '6px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'top_border_rounded',
	    array(
	        'section'   => 'bopea_general_setting',
	        'label'     => esc_html__('Go to top border radius EX: 10px','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
        'enable_dark_mode',
        array(
            'default' => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'enable_dark_mode',
        array(
            'section'   => 'bopea_general_setting',
            'label'     => esc_html__('Enable dark mode button','bopea'),
            'type'      => 'checkbox'
        )
    );
	

    $wp_customize->add_setting(
		'enable_dark_skin',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'enable_dark_skin',
	    array(
	        'section'   => 'bopea_general_setting',
	        'label'     => esc_html__('Enable default dark skin','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
        'jl_search_layout',
        array(
            'default' => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jl_search_layout',
        array(
            'section'   => 'bopea_general_setting',
            'label'     => esc_html__('Enable search small layout','bopea'),
            'type'      => 'checkbox'
        )
    );	

	$wp_customize->add_setting(
		'hide_breadcrumb',
		array(
			'default' => true,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'hide_breadcrumb',
	    array(
	        'section'   => 'bopea_general_setting',
	        'label'     => esc_html__('Disable breadcrumb','bopea'),
	        'type'      => 'checkbox'
	    )
	);

$wp_customize->add_setting(
		'disable_top_search',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_top_search',
	    array(
	        'section'   => 'bopea_general_setting',
	        'label'     => esc_html__('Disable search button','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'show_mb_nav',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'show_mb_nav',
	    array(
	        'section'   => 'bopea_general_setting',
	        'label'     => esc_html__('Enable mobile toggle on desktop','bopea'),
	        'type'      => 'checkbox'
	    )
	);
	
	$wp_customize->add_setting(
		'disable_social_icons',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_social_icons',
	    array(
	        'section'   => 'bopea_general_setting',
	        'label'     => esc_html__('Disable mobile menu social icons','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
        'hide_head_share',
        array(
            'default' => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'hide_head_share',
        array(
            'section'   => 'bopea_general_setting',
            'label'     => esc_html__('Hide header social icons','bopea'),
            'type'      => 'checkbox'
        )
    );

	$wp_customize->add_setting(
        'remove_woo_swatches',
        array(
            'default' => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'remove_woo_swatches',
        array(
            'section'   => 'bopea_general_setting',
            'label'     => esc_html__('Disable WooCommerce swatcher','bopea'),
            'type'      => 'checkbox'
        )
    );

	$wp_customize->add_setting(
        'remove_hzoom_img',
        array(
            'default' => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'remove_hzoom_img',
        array(
            'section'   => 'bopea_general_setting',
            'label'     => esc_html__('Disable hover zoom image','bopea'),
            'type'      => 'checkbox'
        )
    );

	$wp_customize->add_setting(
        'disable_to_top',
        array(
            'default' => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'disable_to_top',
        array(
            'section'   => 'bopea_general_setting',
            'label'     => esc_html__('Disable scoll to top','bopea'),
            'type'      => 'checkbox'
        )
    );

	$wp_customize->add_setting(
        'hide_view_backend',
        array(
            'default' => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'hide_view_backend',
        array(
            'section'   => 'bopea_general_setting',
            'label'     => esc_html__('Disable number views backend','bopea'),
            'type'      => 'checkbox'
        )
    );

/*Canvas Setting*/
$wp_customize->add_section(
	'bopea_canvas_setting',
	array(
		'title'     => esc_html__('Canvas Settings', 'bopea'),
		'priority'  => 1,
		'panel' => 'bopea_theme_options'
	)
);	

$wp_customize->add_setting(
	'canvas_width',
	array(
		'default'    =>  '350px',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'canvas_width',
	array(
		'section'   => 'bopea_canvas_setting',
		'label'     => esc_html__('Canvas width EX: 350px','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'canvas_light_logo',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'canvas_light_logo',
	array(
		'section'   => 'bopea_canvas_setting',
		'label'     => esc_html__('Enable canvas white logo','bopea'),
		'type'      => 'checkbox'
	)
);

$wp_customize->add_setting(
		'mb_nav_left',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'mb_nav_left',
	    array(
	        'section'   => 'bopea_canvas_setting',
	        'label'     => esc_html__('Canvas menu left position on desktop','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'mb_nav_right',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'mb_nav_right',
	    array(
	        'section'   => 'bopea_canvas_setting',
	        'label'     => esc_html__('Canvas menu right position on mobile','bopea'),
	        'type'      => 'checkbox'
	    )
	);


$wp_customize->add_setting(
	'canvas_bg',
	array(
		'default'    =>  esc_attr__( '#fff', 'bopea' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new bopea_alpha_color(
		$wp_customize,
		'canvas_bg',
		array(
			'label'      => esc_html__( 'Canvas background', 'bopea' ),
			'section'    => 'bopea_canvas_setting',
			'settings'   => 'canvas_bg'
		)
	)
);

$wp_customize->add_setting(
	'canvas_bg_dark',
	array(
		'default'    =>  esc_attr__( '#010617', 'bopea' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new bopea_alpha_color(
		$wp_customize,
		'canvas_bg_dark',
		array(
			'label'      => esc_html__( 'Canvas background dark mode', 'bopea' ),
			'section'    => 'bopea_canvas_setting',
			'settings'   => 'canvas_bg_dark'
		)
	)
);

$wp_customize->add_setting(
	'canvas_color',
	array(
		'default'    =>  esc_attr__( '#000', 'bopea' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new bopea_alpha_color(
		$wp_customize,
		'canvas_color',
		array(
			'label'      => esc_html__( 'Canvas color', 'bopea' ),
			'section'    => 'bopea_canvas_setting',
			'settings'   => 'canvas_color'
		)
	)
);

$wp_customize->add_setting(
	'canvas_color_dark',
	array(
		'default'    =>  esc_attr__( '#fff', 'bopea' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new bopea_alpha_color(
		$wp_customize,
		'canvas_color_dark',
		array(
			'label'      => esc_html__( 'Canvas color dark mode', 'bopea' ),
			'section'    => 'bopea_canvas_setting',
			'settings'   => 'canvas_color_dark'
		)
	)
);

$wp_customize->add_setting(
	'canvas_title',
	array(
		'default'    =>  esc_attr__( '#000', 'bopea' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new bopea_alpha_color(
		$wp_customize,
		'canvas_title',
		array(
			'label'      => esc_html__( 'Canvas title color', 'bopea' ),
			'section'    => 'bopea_canvas_setting',
			'settings'   => 'canvas_title'
		)
	)
);

$wp_customize->add_setting(
	'canvas_title_dark',
	array(
		'default'    =>  esc_attr__( '#fff', 'bopea' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new bopea_alpha_color(
		$wp_customize,
		'canvas_title_dark',
		array(
			'label'      => esc_html__( 'Canvas title color dark mode', 'bopea' ),
			'section'    => 'bopea_canvas_setting',
			'settings'   => 'canvas_title_dark'
		)
	)
);


$wp_customize->add_setting(
	'canvas_meta',
	array(
		'default'    =>  esc_attr__( '#0a0a0a', 'bopea' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new bopea_alpha_color(
		$wp_customize,
		'canvas_meta',
		array(
			'label'      => esc_html__( 'Canvas meta color', 'bopea' ),
			'section'    => 'bopea_canvas_setting',
			'settings'   => 'canvas_meta'
		)
	)
);

$wp_customize->add_setting(
	'canvas_meta_dark',
	array(
		'default'    =>  esc_attr__( '#ddd', 'bopea' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new bopea_alpha_color(
		$wp_customize,
		'canvas_meta_dark',
		array(
			'label'      => esc_html__( 'Canvas meta color dark mode', 'bopea' ),
			'section'    => 'bopea_canvas_setting',
			'settings'   => 'canvas_meta_dark'
		)
	)
);

$wp_customize->add_setting(
	'canvas_line',
	array(
		'default'    =>  esc_attr__( '#e9ecef', 'bopea' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new bopea_alpha_color(
		$wp_customize,
		'canvas_line',
		array(
			'label'      => esc_html__( 'Canvas line color', 'bopea' ),
			'section'    => 'bopea_canvas_setting',
			'settings'   => 'canvas_line'
		)
	)
);

$wp_customize->add_setting(
	'canvas_line_dark',
	array(
		'default'    =>  esc_attr__( '#303041', 'bopea' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new bopea_alpha_color(
		$wp_customize,
		'canvas_line_dark',
		array(
			'label'      => esc_html__( 'Canvas line color dark mode', 'bopea' ),
			'section'    => 'bopea_canvas_setting',
			'settings'   => 'canvas_line_dark'
		)
	)
);

/*Header*/
$wp_customize->add_section(
	'bopea_header_setting',
	array(
		'title'     => esc_html__('Header Settings', 'bopea'),
		'priority'  => 1,
		'panel' => 'bopea_theme_options'
	)
);

$wp_customize->add_setting(
	    'header_layout_design',
	    array(
	        'default'    =>  esc_attr__( 'header_3', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    new bopea_control_image_select (
	        $wp_customize,
	        'header_layout_design',
	        array(
	            'label'      	=> esc_html__( 'Header Layout (header menu and logo)', 'bopea' ),
	            'section'		=> 'bopea_header_setting',
	            'settings'		=> 'header_layout_design',
	            'choices'		=> array(
	            	'header_1'  => get_template_directory_uri().'/inc/customizer/images/header1.png',
                    'header_2' => get_template_directory_uri().'/inc/customizer/images/header2.png',
                    'header_3'   => get_template_directory_uri().'/inc/customizer/images/header3.png',					
	            ),
	            'input_attrs' => array(
	            	'multiple' => false
	            )
	        )
	    )
	);

	$wp_customize->add_setting(
	    'header_layout',
	    array(
	        'default'     => 'default',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'header_layout',
	    array(
	        'section'   => 'bopea_header_setting',
	        'label'     => esc_html__('Header Layout Custom Template','bopea'),
			'description' => esc_html__( 'Choose layout to overwrite default header','bopea'),
	        'type'      => 'select',
	        'choices'	=> $jl_layouts
	    )
	);

	$wp_customize->add_setting(
	    'header_sticky',
	    array(
	        'default'     => 'default',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'header_sticky',
	    array(
	        'section'   => 'bopea_header_setting',
	        'label'     => esc_html__('Header Sticky Custom Template','bopea'),
			'description' => esc_html__( 'Choose layout to overwrite default sticky header: Note this options work when you choose (Header Layout Custom Template)','bopea'),
	        'type'      => 'select',
	        'choices'	=> $jl_layouts
	    )
	);	

	$wp_customize->add_setting(
        'bopea_menu_sec_options',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new bopea_Customize_Control_Title (
            $wp_customize,
            'bopea_menu_sec_options',
            array(
                'label'         => esc_html__( 'Menu Section', 'bopea' ),
                'section'       => 'bopea_header_setting',
                'settings'      => 'bopea_menu_sec_options',
            )
        )
    );

	$wp_customize->add_setting(
	    'section_menu_height',
	    array(
	        'default'    =>  esc_attr__( '65px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'section_menu_height',
	    array(
	        'section'   => 'bopea_header_setting',
	        'label'     => esc_html__('Section menu height  EX: 80px','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'sticky_header',
	    array(
	        'default'    =>  esc_attr__( 'jl_sticky_smart', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'sticky_header',
	    array(
	        'section'   => 'bopea_header_setting',
	        'label'     => esc_html__('Sticky header style','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(				
				'jl_sticky_smart' => esc_html__('Header smart sticky', 'bopea'),
				'jl_sticky_fixed' => esc_html__('Header fixed sticky', 'bopea')
			
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_mh_type',
	    array(
	        'default'    =>  esc_attr__( 'jl_mm_lb', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_mh_type',
	    array(
	        'section'   => 'bopea_header_setting',
	        'label'     => esc_html__('Menu hover type','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(				
				'jl_mm_lb' => esc_html__( 'Hover line back animation', 'bopea' ),
                'jl_mm_c' => esc_html__( 'Hover text color', 'bopea' ),
                'jl_mh_bg' => esc_html__( 'Hover background', 'bopea' ),
                'jl_mm_lbt' => esc_html__( 'Hover line bottom', 'bopea' )
	        )
	    )
	);	

	$wp_customize->add_setting(
	    'mega_menu_layout',
	    array(
	        'default'    =>  esc_attr__( 'jl_mega_boxed', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'mega_menu_layout',
	    array(
	        'section'   => 'bopea_header_setting',
	        'label'     => esc_html__('Mega menu layout','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(				
				'jl_mega_full' => esc_html__('Full width', 'bopea'),
				'jl_mega_boxed' => esc_html__('Boxed width', 'bopea')
			
	        )
	    )
	);

/*Footer*/
$wp_customize->add_section(
	'bopea_footer_setting',
	array(
		'title'     => esc_html__('Footer Settings', 'bopea'),
		'priority'  => 1,
		'panel' => 'bopea_theme_options'
	)
);

$wp_customize->add_setting(
'bopea_footer_opt',
array(
	'default'     => '',
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
new bopea_Customize_Control_Title (
	$wp_customize,
	'bopea_footer_opt',
	array(
		'label'         => esc_html__( 'Footer Options', 'bopea' ),
		'section'       => 'bopea_footer_setting',
		'settings'      => 'bopea_footer_opt',
	)
)
);

$wp_customize->add_setting(
'footer_layout',
array(
	'default'     => 'default',
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
'footer_layout',
array(
	'section'   => 'bopea_footer_setting',
	'label'     => esc_html__('Footer Custom Template','bopea'),
	'description' => esc_html__( 'Choose layout to overwrite default footer','bopea'),
	'type'      => 'select',
	'choices'	=> $jl_layouts
)
);


$wp_customize->add_setting(
'footer_columns',
array(
	'default'    =>  'footer4col',
	'transport'  =>  'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
'footer_columns',
array(
	'section'   => 'bopea_footer_setting',
	'label'     => esc_html__('Footer columns','bopea'),
	'type'      => 'select',
	'choices'	=> array(
	'footer4col' => esc_html__('Footer 4 columns', 'bopea'),
	'footer3col' => esc_html__('Footer 3 columns', 'bopea'),
	'footer2col' => esc_html__('Footer 2 columns', 'bopea'),
	'footer1col' => esc_html__('Footer 1 columns', 'bopea'),
	'footer0col' => esc_html__('No Footer', 'bopea')
	)
)
);

$wp_customize->add_setting(
'footer_menu_col',
array(
	'default'    =>  '1',
	'transport'  =>  'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
'footer_menu_col',
array(
	'section'   => 'bopea_footer_setting',
	'label'     => esc_html__('Footer menu widget columns','bopea'),
	'type'      => 'select',
	'choices'	=> array(
	'1' => esc_html__('Footer menu 1 columns', 'bopea'),
	'2' => esc_html__('Footer menu 2 columns', 'bopea'),
	'3' => esc_html__('Footer menu 3 columns', 'bopea'),
	'4' => esc_html__('Footer menu 4 columns', 'bopea'),
	'5' => esc_html__('Footer menu 5 columns', 'bopea')
	)
)
);

$wp_customize->add_setting(
'footer_title_size',
array(
	'default'    =>  esc_attr__( '18px', 'bopea' ),
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
'footer_title_size',
array(
	'section'   => 'bopea_footer_setting',
	'label'     => esc_html__('Footer title font size','bopea'),
	'type'      => 'select',
	'choices'	=> $font_sizes
)
);

$wp_customize->add_setting(
'footer_font_size',
array(
	'default'    =>  esc_attr__( '14px', 'bopea' ),
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
'footer_font_size',
array(
	'section'   => 'bopea_footer_setting',
	'label'     => esc_html__('Footer text font size','bopea'),
	'type'      => 'select',
	'choices'	=> $font_sizes
)
);

$wp_customize->add_setting(
'footer_copyright_size',
array(
	'default'    =>  esc_attr__( '14px', 'bopea' ),
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
'footer_copyright_size',
array(
	'section'   => 'bopea_footer_setting',
	'label'     => esc_html__('Copyright font size','bopea'),
	'type'      => 'select',
	'choices'	=> $font_sizes
)
);

$wp_customize->add_setting(
'footer_menu_size',
array(
	'default'    =>  esc_attr__( '14px', 'bopea' ),
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
'footer_menu_size',
array(
	'section'   => 'bopea_footer_setting',
	'label'     => esc_html__('Footer Menu font size','bopea'),
	'type'      => 'select',
	'choices'	=> $font_sizes
)
);

$wp_customize->add_setting(
'sub_footer',
array(
	'default'    =>  esc_attr__( 'sub_footer0', 'bopea' ),
	'transport'  =>  'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
'sub_footer',
array(
	'section'   => 'bopea_footer_setting',
	'label'     => esc_html__('Sub footer style','bopea'),
	'type'      => 'select',
	'choices'	=> array(
	'sub_footer1' => esc_html__('Footer logo + Copyright + Menu + Social', 'bopea'),
	'sub_footer2' => esc_html__('Copyright + Social', 'bopea'),
	'sub_footer3' => esc_html__('Copyright + Menu', 'bopea'),
	'sub_footer4' => esc_html__('Copyright Center', 'bopea'),
	'sub_footer5' => esc_html__('Footer Menu Center', 'bopea'),
	'sub_footer0' => esc_html__('Disable', 'bopea')
	)
)
);

$wp_customize->add_setting(
'footer_logo',
array(
	'default'    =>  esc_attr__( 'logo_foot_normal', 'bopea' ),
	'transport'  =>  'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
'footer_logo',
array(
	'section'   => 'bopea_footer_setting',
	'label'     => esc_html__('Footer logo','bopea'),
	'type'      => 'select',
	'choices'	=> array(
	'logo_foot_white' => esc_html__('Footer dark mode logo', 'bopea'),
	'logo_foot_normal' => esc_html__('Footer normal logo', 'bopea')			
	)
)
);

$wp_customize->add_setting(
'jl_copyright',
array(
	'transport'  =>  'refresh',
	'sanitize_callback' => 'wp_kses_post',
)
);
$wp_customize->add_control(
'jl_copyright',
array(
	'section'   => 'bopea_footer_setting',
	'label'     => esc_html__('Footer copyright','bopea'),
	'type'      => 'textarea'
)
);

/*Color Setting*/
	$wp_customize->add_section(
		    'bopea_color_setting',
		    array(
		        'title'     => esc_html__('Color Settings', 'bopea'),
		        'priority'  => 1,
		        'panel' => 'bopea_theme_options'
		    )
	);	

	$wp_customize->add_setting(
        'bopea_theme_color_settings',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new bopea_Customize_Control_Title (
            $wp_customize,
            'bopea_theme_color_settings',
            array(
                'label'         => esc_html__( 'Theme color', 'bopea' ),
                'section'       => 'bopea_color_setting',
                'settings'      => 'bopea_theme_color_settings',
            )
        )
    );

	$wp_customize->add_setting(
	    'theme_color',
	    array(
	        'default'    =>  esc_attr__( '#7118ff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'theme_color',
	        array(
	            'label'      => esc_html__( 'Theme color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'theme_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'theme_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#7118ff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'theme_color_dark',
	        array(
	            'label'      => esc_html__( 'Theme color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'theme_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'theme_bg_color',
	    array(
	        'default'    =>  esc_attr__( '#FFF', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'theme_bg_color',
	        array(
	            'label'      => esc_html__( 'Body background color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'theme_bg_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'theme_bg_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#010617', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'theme_bg_color_dark',
	        array(
	            'label'      => esc_html__( 'Body background color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'theme_bg_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'theme_boxed_bg_color',
	    array(
	        'default'    =>  esc_attr__( '#FFF', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'theme_boxed_bg_color',
	        array(
	            'label'      => esc_html__( 'Boxed width background color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'theme_boxed_bg_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'theme_boxed_bg_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#010617', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'theme_boxed_bg_color_dark',
	        array(
	            'label'      => esc_html__( 'Boxed width background color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'theme_boxed_bg_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'theme_head_color',
	    array(
	        'default'    =>  esc_attr__( '#000', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'theme_head_color',
	        array(
	            'label'      => esc_html__( 'Theme heading color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'theme_head_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'theme_head_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#FFF', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'theme_head_color_dark',
	        array(
	            'label'      => esc_html__( 'Theme heading color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'theme_head_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'theme_text_color',
	    array(
	        'default'    =>  esc_attr__( '#000', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'theme_text_color',
	        array(
	            'label'      => esc_html__( 'Theme text color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'theme_text_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'theme_text_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#FFF', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'theme_text_color_dark',
	        array(
	            'label'      => esc_html__( 'Theme text color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'theme_text_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
        'bopea_menu_color_settings',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new bopea_Customize_Control_Title (
            $wp_customize,
            'bopea_menu_color_settings',
            array(
                'label'         => esc_html__( 'Menu section color', 'bopea' ),
                'section'       => 'bopea_color_setting',
                'settings'      => 'bopea_menu_color_settings',
            )
        )
    );

	$wp_customize->add_setting(
	    'ac_menu_line_color',
	    array(
	        'default'    =>  '',
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'ac_menu_line_color',
	        array(
	            'label'      => esc_html__( 'Active & hover line color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'ac_menu_line_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'ac_menu_line_height',
	    array(
	        'default'    =>  '3px',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'ac_menu_line_height',
	    array(
	        'section'   => 'bopea_color_setting',
	        'label'     => esc_html__('Active & hover line height Ex:3px','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_sub_radius',
	    array(	        
			'default'    =>  '8px',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_sub_radius',
	    array(
	        'section'   => 'bopea_color_setting',
	        'label'     => esc_html__('Sub menu border radius EX: 8px','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'menu_bg_color',
	    array(
	        'default'    =>  esc_attr__( '#ffffff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'menu_bg_color',
	        array(
	            'label'      => esc_html__( 'Main menu background', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'menu_bg_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'menu_bg_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#000f45', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'menu_bg_color_dark',
	        array(
	            'label'      => esc_html__( 'Main menu background dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'menu_bg_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'menu_text_color',
	    array(
	        'default'    =>  esc_attr__( '#000000', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'menu_text_color',
	        array(
	            'label'      => esc_html__( 'Main menu text color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'menu_text_color'
	        )
	    )
	);	

	$wp_customize->add_setting(
	    'menu_text_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#FFF', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'menu_text_color_dark',
	        array(
	            'label'      => esc_html__( 'Main menu text color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'menu_text_color_dark'
	        )
	    )
	);





	$wp_customize->add_setting(
	    'menu_text_hcolor',
	    array(
	        'default'    =>  esc_attr__( '#000000', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'menu_text_hcolor',
	        array(
	            'label'      => esc_html__( 'Main menu text active & hover color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'menu_text_hcolor'
	        )
	    )
	);	

	$wp_customize->add_setting(
	    'menu_text_hcolor_dark',
	    array(
	        'default'    =>  esc_attr__( '#FFF', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'menu_text_hcolor_dark',
	        array(
	            'label'      => esc_html__( 'Main menu text hover color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'menu_text_hcolor_dark'
	        )
	    )
	);






	$wp_customize->add_setting(
	    'submenu_back_color',
	    array(
	        'default'    =>  esc_attr__( '#fff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'submenu_back_color',
	        array(
	            'label'      => esc_html__( 'Sub menu background color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'submenu_back_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'submenu_back_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#222', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'submenu_back_color_dark',
	        array(
	            'label'      => esc_html__( 'Sub menu background color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'submenu_back_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'submenu_text_color',
	    array(
	        'default'    =>  esc_attr__( '#000', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'submenu_text_color',
	        array(
	            'label'      => esc_html__( 'Sub Menu text color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'submenu_text_color'
	        )
	    )
	);	

	$wp_customize->add_setting(
	    'submenu_text_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#FFF', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'submenu_text_color_dark',
	        array(
	            'label'      => esc_html__( 'Sub Menu text color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'submenu_text_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'submenu_line_color',
	    array(
	        'default'    =>  esc_attr__( '#eeeeee', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'submenu_line_color',
	        array(
	            'label'      => esc_html__( 'Sub line text color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'submenu_line_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'submenu_line_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#464646', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'submenu_line_color_dark',
	        array(
	            'label'      => esc_html__( 'Sub line color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'submenu_line_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'submenu_hbg',
	    array(
	        'default'    =>  esc_attr__( '#f6f6f6', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'submenu_hbg',
	        array(
	            'label'      => esc_html__( 'sub menu hover bg', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'submenu_hbg'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'submenu_hbg_dark',
	    array(
	        'default'    =>  esc_attr__( '#333', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'submenu_hbg_dark',
	        array(
	            'label'      => esc_html__( 'sub menu hover bg dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'submenu_hbg_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'submenu_hcolor',
	    array(
	        'default'    =>  esc_attr__( '#7118ff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'submenu_hcolor',
	        array(
	            'label'      => esc_html__( 'sub menu hover color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'submenu_hcolor'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'submenu_hcolor_dark',
	    array(
	        'default'    =>  esc_attr__( '#7118ff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'submenu_hcolor_dark',
	        array(
	            'label'      => esc_html__( 'sub menu hover color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'submenu_hcolor_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
        'bopea_cookie_color',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new bopea_Customize_Control_Title (
            $wp_customize,
            'bopea_cookie_color',
            array(
                'label'         => esc_html__( 'Cookie section color', 'bopea' ),
                'section'       => 'bopea_color_setting',
                'settings'      => 'bopea_cookie_color',
            )
        )
    );

    $wp_customize->add_setting(
	    'cookie_bg_color',
	    array(
	        'default'    =>  esc_attr__( '#fff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'cookie_bg_color',
	        array(
	            'label'      => esc_html__( 'Cookie background', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'cookie_bg_color'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'cookie_text_color',
	    array(
	        'default'    =>  esc_attr__( '#000', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'cookie_text_color',
	        array(
	            'label'      => esc_html__( 'Cookie text color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'cookie_text_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'cookie_bg_color_dark',
	    array(
	        'default'     => esc_attr__( '#222', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'cookie_bg_color_dark',
	        array(
	            'label'      => esc_html__( 'Cookie background dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'cookie_bg_color_dark'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'cookie_text_color_dark',
	    array(
	        'default'     => esc_attr__( '#FFF', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'cookie_text_color_dark',
	        array(
	            'label'      => esc_html__( 'Cookie text color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'cookie_text_color_dark'
	        )
	    )
	);

    $wp_customize->add_setting(
        'bopea_single_opts',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new bopea_Customize_Control_Title (
            $wp_customize,
            'bopea_single_opts',
            array(
                'label'         => esc_html__( 'Blog & Single content color', 'bopea' ),
                'section'       => 'bopea_color_setting',
                'settings'      => 'bopea_single_opts',
            )
        )
    );

	$wp_customize->add_setting(
	    'single_head_color',
	    array(
	        'default'    =>  esc_attr__( '#000', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'single_head_color',
	        array(
	            'label'      => esc_html__( 'Single head color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'single_head_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'single_head_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#FFF', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'single_head_color_dark',
	        array(
	            'label'      => esc_html__( 'Single head color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'single_head_color_dark'
	        )
	    )
	);

    $wp_customize->add_setting(
	    'single_color',
	    array(
	        'default'    =>  esc_attr__( '#282828', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'single_color',
	        array(
	            'label'      => esc_html__( 'Single color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'single_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'single_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#FFF', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'single_color_dark',
	        array(
	            'label'      => esc_html__( 'Single color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'single_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'single_link_color',
	    array(
	        'default'    =>  esc_attr__( '#7118ff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'single_link_color',
	        array(
	            'label'      => esc_html__( 'Single link color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'single_link_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'single_link_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#7118ff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'single_link_color_dark',
	        array(
	            'label'      => esc_html__( 'Single link color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'single_link_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'single_link_hover_color',
	    array(
	        'default'    =>  esc_attr__( '#7118ff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'single_link_hover_color',
	        array(
	            'label'      => esc_html__( 'Single link hover color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'single_link_hover_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'single_link_hover_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#7118ff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'single_link_hover_color_dark',
	        array(
	            'label'      => esc_html__( 'Single link hover color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'single_link_hover_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'post_h1_color',
	    array(
	        'default'    =>  esc_attr__( '#000', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_h1_color',
	        array(
	            'label'      => esc_html__( 'Post h1 color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_h1_color'
	        )
	    )
	);
$wp_customize->add_setting(
	    'post_h1_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#fff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_h1_color_dark',
	        array(
	            'label'      => esc_html__( 'Post h1 color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_h1_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'post_h2_color',
	    array(
	        'default'    =>  esc_attr__( '#000', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_h2_color',
	        array(
	            'label'      => esc_html__( 'Post h2 color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_h2_color'
	        )
	    )
	);
$wp_customize->add_setting(
	    'post_h2_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#fff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_h2_color_dark',
	        array(
	            'label'      => esc_html__( 'Post h2 color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_h2_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'post_h3_color',
	    array(
	        'default'    =>  esc_attr__( '#000', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_h3_color',
	        array(
	            'label'      => esc_html__( 'Post h3 color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_h3_color'
	        )
	    )
	);
$wp_customize->add_setting(
	    'post_h3_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#fff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_h3_color_dark',
	        array(
	            'label'      => esc_html__( 'Post h3 color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_h3_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'post_h4_color',
	    array(
	        'default'    =>  esc_attr__( '#000', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_h4_color',
	        array(
	            'label'      => esc_html__( 'Post h4 color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_h4_color'
	        )
	    )
	);
$wp_customize->add_setting(
	    'post_h4_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#fff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_h4_color_dark',
	        array(
	            'label'      => esc_html__( 'Post h4 color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_h4_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'post_h5_color',
	    array(
	        'default'    =>  esc_attr__( '#000', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_h5_color',
	        array(
	            'label'      => esc_html__( 'Post h5 color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_h5_color'
	        )
	    )
	);
$wp_customize->add_setting(
	    'post_h5_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#fff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_h5_color_dark',
	        array(
	            'label'      => esc_html__( 'Post h5 color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_h5_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'post_h6_color',
	    array(
	        'default'    =>  esc_attr__( '#000', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_h6_color',
	        array(
	            'label'      => esc_html__( 'Post h6 color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_h6_color'
	        )
	    )
	);
$wp_customize->add_setting(
	    'post_h6_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#fff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_h6_color_dark',
	        array(
	            'label'      => esc_html__( 'Post h6 color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_h6_color_dark'
	        )
	    )
	);
	
	$wp_customize->add_setting(
	    'post_meta_color',
	    array(
	        'default'    =>  esc_attr__( '#0a0a0a', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_meta_color',
	        array(
	            'label'      => esc_html__( 'Post meta color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_meta_color'
	        )
	    )
	);
$wp_customize->add_setting(
	    'post_meta_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#fff', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_meta_color_dark',
	        array(
	            'label'      => esc_html__( 'Post meta color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_meta_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'post_except_color',
	    array(
	        'default'    =>  esc_attr__( '#666', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_except_color',
	        array(
	            'label'      => esc_html__( 'Post excerpt color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_except_color'
	        )
	    )
	);
$wp_customize->add_setting(
	    'post_except_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#ddd', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_except_color_dark',
	        array(
	            'label'      => esc_html__( 'Post excerpt color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_except_color_dark'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'post_line_color',
	    array(
	        'default'    =>  esc_attr__( '#e9e9e9', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_line_color',
	        array(
	            'label'      => esc_html__( 'Post line color', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_line_color'
	        )
	    )
);

$wp_customize->add_setting(
	    'post_line_color_dark',
	    array(
	        'default'    =>  esc_attr__( '#494949', 'bopea' ),
	        'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
            'transport'  => 'refresh'
	    )
	);
    $wp_customize->add_control(
	    new bopea_alpha_color(
	        $wp_customize,
	        'post_line_color_dark',
	        array(
	            'label'      => esc_html__( 'Post line color dark mode', 'bopea' ),
	            'section'    => 'bopea_color_setting',
	            'settings'   => 'post_line_color_dark'
	        )
	    )
);

	$wp_customize->add_setting(
        'bopea_foot_opts',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new bopea_Customize_Control_Title (
            $wp_customize,
            'bopea_foot_opts',
            array(
                'label'         => esc_html__( 'Footer color', 'bopea' ),
                'section'       => 'bopea_color_setting',
                'settings'      => 'bopea_foot_opts',
            )
        )
    );

    $wp_customize->add_setting(
        'footer_bg_color',
        array(
            'default'     => esc_attr__( '#F9F9FA', 'bopea' ),
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new bopea_alpha_color(
            $wp_customize,
            'footer_bg_color',
            array(
                'label'      => esc_html__( 'Footer background color', 'bopea' ),
                'section'    => 'bopea_color_setting',
                'settings'   => 'footer_bg_color'
            )
        )
    );

	$wp_customize->add_setting(
        'footer_bg_dark',
        array(
            'default'     => esc_attr__( '#020D34', 'bopea' ),
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new bopea_alpha_color(
            $wp_customize,
            'footer_bg_dark',
            array(
                'label'      => esc_html__( 'Footer background color dark mode', 'bopea' ),
                'section'    => 'bopea_color_setting',
                'settings'   => 'footer_bg_dark'
            )
        )
    );

    $wp_customize->add_setting(
        'footer_text_color',
        array(
            'default'     => esc_attr__( '#000', 'bopea' ),
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new bopea_alpha_color(
            $wp_customize,
            'footer_text_color',
            array(
                'label'      => esc_html__( 'Footer text color', 'bopea' ),
                'section'    => 'bopea_color_setting',
                'settings'   => 'footer_text_color'
            )
        )
    );    

    $wp_customize->add_setting(
        'footer_text_dark',
        array(
            'default'     => esc_attr__( '#fff', 'bopea' ),
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new bopea_alpha_color(
            $wp_customize,
            'footer_text_dark',
            array(
                'label'      => esc_html__( 'Footer text color dark mode', 'bopea' ),
                'section'    => 'bopea_color_setting',
                'settings'   => 'footer_text_dark'
            )
        )
    );    
	
	$wp_customize->add_setting(
        'footer_link_color',
        array(
            'default'     => esc_attr__( '#000', 'bopea' ),
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
	$wp_customize->add_control(
        new bopea_alpha_color(
            $wp_customize,
            'footer_link_color',
            array(
                'label'      => esc_html__( 'Footer link color', 'bopea' ),
                'section'    => 'bopea_color_setting',
                'settings'   => 'footer_link_color'
            )
        )
    );    

    $wp_customize->add_setting(
        'footer_link_dark',
        array(
            'default'     => esc_attr__( '#fff', 'bopea' ),
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new bopea_alpha_color(
            $wp_customize,
            'footer_link_dark',
            array(
                'label'      => esc_html__( 'Footer link color dark mode', 'bopea' ),
                'section'    => 'bopea_color_setting',
                'settings'   => 'footer_link_dark'
            )
        )
    ); 

	$wp_customize->add_setting(
        'footer_link_hcolor',
        array(
            'default'     => esc_attr__( '#7118ff', 'bopea' ),
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
	$wp_customize->add_control(
        new bopea_alpha_color(
            $wp_customize,
            'footer_link_hcolor',
            array(
                'label'      => esc_html__( 'Footer link hover color', 'bopea' ),
                'section'    => 'bopea_color_setting',
                'settings'   => 'footer_link_hcolor'
            )
        )
    );    

    $wp_customize->add_setting(
        'footer_link_hdark',
        array(
            'default'     => esc_attr__( '#7118ff', 'bopea' ),
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new bopea_alpha_color(
            $wp_customize,
            'footer_link_hdark',
            array(
                'label'      => esc_html__( 'Footer link hover color dark mode', 'bopea' ),
                'section'    => 'bopea_color_setting',
                'settings'   => 'footer_link_hdark'
            )
        )
    );

	$wp_customize->add_setting(
        'footer_head_color',
        array(
            'default'     => esc_attr__( '#FFF', 'bopea' ),
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
	$wp_customize->add_control(
        new bopea_alpha_color(
            $wp_customize,
            'footer_head_color',
            array(
                'label'      => esc_html__( 'Footer heading color', 'bopea' ),
                'section'    => 'bopea_color_setting',
                'settings'   => 'footer_head_color'
            )
        )
    );    

    $wp_customize->add_setting(
        'footer_head_color_dark',
        array(
            'default'     => esc_attr__( '#000', 'bopea' ),
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new bopea_alpha_color(
            $wp_customize,
            'footer_head_color_dark',
            array(
                'label'      => esc_html__( 'Footer heading color dark mode', 'bopea' ),
                'section'    => 'bopea_color_setting',
                'settings'   => 'footer_head_color_dark'
            )
        )
    );

	$wp_customize->add_setting(
        'footer_line_color',
        array(
            'default'     => esc_attr__( 'rgba(136,136,136,0.15)', 'bopea' ),
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
	$wp_customize->add_control(
        new bopea_alpha_color(
            $wp_customize,
            'footer_line_color',
            array(
                'label'      => esc_html__( 'Footer line color', 'bopea' ),
                'section'    => 'bopea_color_setting',
                'settings'   => 'footer_line_color'
            )
        )
    );    

    $wp_customize->add_setting(
        'footer_line_color_dark',
        array(
            'default'     => esc_attr__( 'rgba(136,136,136,0.15)', 'bopea' ),
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new bopea_alpha_color(
            $wp_customize,
            'footer_line_color_dark',
            array(
                'label'      => esc_html__( 'Footer line color dark mode', 'bopea' ),
                'section'    => 'bopea_color_setting',
                'settings'   => 'footer_line_color_dark'
            )
        )
    );


	/*Typography*/
	$wp_customize->add_section(
		    'bopea_typography_setting',
		    array(
		        'title'     => esc_html__('Typography Settings', 'bopea'),
		        'priority'  => 1,
		        'panel' => 'bopea_theme_options'
		    )
	);

	$wp_customize->add_setting(
        'jl_en_txt_smooth',
        array(
            'default' => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jl_en_txt_smooth',
        array(
            'section'   => 'bopea_typography_setting',
            'label'     => esc_html__('Enable text smoothing','bopea'),
            'type'      => 'checkbox'
        )
    );

	$wp_customize->add_setting(
	    'bopea_menu_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new bopea_Customize_Control_Title (
	        $wp_customize,
	        'bopea_menu_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Navigation settings', 'bopea' ),
	            'section'		=> 'bopea_typography_setting',
	            'settings'		=> 'bopea_menu_settings_title',
	        )
	    )
	);
	$wp_customize->add_setting(
	    'bopea_menu_font_family',
	    array(
	        'default'    =>  esc_attr__( 'Work Sans', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_menu_font_family',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Menu font family','bopea'),
	        'type'      => 'select',
	        'choices'	=> $faces
	    )
	);
    $wp_customize->add_setting(
	    'bopea_menu_font_size',
	    array(
	        'default'    =>  esc_attr__( '17px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_menu_font_size',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Main menu font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'bopea_menu_font_weight',
	    array(
	        'default'    =>  esc_attr__( '600', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_menu_font_weight',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Main menu font weight','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
	$wp_customize->add_setting(
	    'bopea_menu_transform',
	    array(
	        'default'    =>  esc_attr__( 'capitalize', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'bopea_menu_transform',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Menu text transform','bopea'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'bopea'),
	        	'capitalize' => esc_html__('Capitalize', 'bopea'),
	        	'uppercase' => esc_html__('Uppercase', 'bopea')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'letter_spacing_menu',
	    array(
	        'default'    =>  esc_attr__( '-0.03em', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'letter_spacing_menu',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Menu letter spacing','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'spacing_menu',
	    array(
	        'default'    =>  esc_attr__( '25px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'spacing_menu',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Main menu items spacing','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'bopea_sub_menu_font_size',
	    array(
	        'default'    =>  esc_attr__( '15px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_sub_menu_font_size',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Sub menu font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'bopea_sub_menu_font_weight',
	    array(
	        'default'    =>  esc_attr__( '500', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_sub_menu_font_weight',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Sub menu font weight','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);

	$wp_customize->add_setting(
	    'sub_menu_transform',
	    array(
	        'default'    =>  esc_attr__( 'capitalize', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'sub_menu_transform',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Sub menu text transform','bopea'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'bopea'),
	        	'capitalize' => esc_html__('Capitalize', 'bopea'),
	        	'uppercase' => esc_html__('Uppercase', 'bopea')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'sub_spacing_menu',
	    array(
	        'default'    =>  esc_attr__( '-0.02em', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'sub_spacing_menu',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Sub menu letter spacing Ex: 0.03em','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'bopea_p_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new bopea_Customize_Control_Title (
	        $wp_customize,
	        'bopea_p_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Paragraph settings', 'bopea' ),
	            'section'		=> 'bopea_typography_setting',
	            'settings'		=> 'bopea_p_settings_title',
	        )
	    )
	);

	$wp_customize->add_setting(
	    'bopea_p_font_family',
	    array(
	        'default'    =>  esc_attr__( 'Oxygen', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_p_font_family',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Paragraph font family','bopea'),
	        'type'      => 'select',
	        'choices'	=> $faces
	    )
	);

	$wp_customize->add_setting(
	    'bopea_p_font_weight',
	    array(
	        'default'    =>  esc_attr__( '400', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_p_font_weight',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Paragraph font weight','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);

	$wp_customize->add_setting(
	    'bopea_p_font_size',
	    array(
	        'default'    =>  esc_attr__( '16px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_p_font_size',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Desktop page/post font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_t_p_font_size',
	    array(
	        'default'    =>  esc_attr__( '15px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_t_p_font_size',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Tablet page/post font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_m_p_font_size',
	    array(
	        'default'    =>  esc_attr__( '15px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_m_p_font_size',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Mobile page/post font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'letter_spacing_content',
	    array(
	        'default'    =>  esc_attr__( '0em', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'letter_spacing_content',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('page/post letter spacing Ex: 0.03em','bopea'),
	        'type'      => 'text'
	    )
	);
	$wp_customize->add_setting(
	    'p_line_height',
	    array(
	        'default'    =>  esc_attr__( '1.7', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'p_line_height',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('page/post line height Ex: 1.2','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'p_dropcap',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'p_dropcap',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Drop cap space Ex: 10px','bopea'),
	        'type'      => 'text'
	    )
	);
	
	$wp_customize->add_setting(
	    'bopea_body_settings',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new bopea_Customize_Control_Title (
	        $wp_customize,
	        'bopea_body_settings',
	        array(
	            'label'      	=> esc_html__( 'Body text settings', 'bopea' ),
	            'section'		=> 'bopea_typography_setting',
	            'settings'		=> 'bopea_body_settings',
	        )
	    )
	);

	$wp_customize->add_setting(
	    'body_font_size',
	    array(
	        'default'    =>  esc_attr__( '15px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'body_font_size',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Desktop body font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'body_t_font_size',
	    array(
	        'default'    =>  esc_attr__( '15px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'body_t_font_size',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Tablet body font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'body_m_font_size',
	    array(
	        'default'    =>  esc_attr__( '15px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'body_m_font_size',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Mobile body font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'letter_spacing_body',
	    array(
	        'default'    =>  esc_attr__( '0em', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'letter_spacing_body',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Body letter spacing Ex: 0.03em','bopea'),
	        'type'      => 'text'
	    )
	);
	$wp_customize->add_setting(
	    'body_line_height',
	    array(
	        'default'    =>  esc_attr__( '1.5', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'body_line_height',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Body line height Ex: 1.2','bopea'),
	        'type'      => 'text'
	    )
	);






	$wp_customize->add_setting(
	    'bopea_excp_settings',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new bopea_Customize_Control_Title (
	        $wp_customize,
	        'bopea_excp_settings',
	        array(
	            'label'      	=> esc_html__( 'Excerpt text settings', 'bopea' ),
	            'section'		=> 'bopea_typography_setting',
	            'settings'		=> 'bopea_excp_settings',
	        )
	    )
	);

	$wp_customize->add_setting(
	    'excpt_font_size',
	    array(
	        'default'    =>  esc_attr__( '14px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'excpt_font_size',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Desktop excerpt font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'excpt_t_font_size',
	    array(
	        'default'    =>  esc_attr__( '14px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'excpt_t_font_size',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Tablet excerpt font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'excpt_m_font_size',
	    array(
	        'default'    =>  esc_attr__( '14px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'excpt_m_font_size',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Mobile excerpt font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'letter_spacing_excpt',
	    array(
	        'default'    =>  esc_attr__( '0em', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'letter_spacing_excpt',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Excerpt letter spacing Ex: 0.03em','bopea'),
	        'type'      => 'text'
	    )
	);
	$wp_customize->add_setting(
	    'excpt_line_height',
	    array(
	        'default'    =>  esc_attr__( '1.5', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'excpt_line_height',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Excerpt line height Ex: 1.2','bopea'),
	        'type'      => 'text'
	    )
	);
	$wp_customize->add_setting(
	    'excpt_num_row',
	    array(
	        'default'    =>  esc_attr__( '2', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'excpt_num_row',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Excerpt number of row Ex: 2, Number only','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'bopea_title_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new bopea_Customize_Control_Title (
	        $wp_customize,
	        'bopea_title_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Title settings', 'bopea' ),
	            'section'		=> 'bopea_typography_setting',
	            'settings'		=> 'bopea_title_settings_title',
	        )
	    )
	);
	$wp_customize->add_setting(
	    'bopea_title_font_family',
	    array(
	        'default'    =>  esc_attr__( 'Work Sans', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_title_font_family',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Title font family','bopea'),
	        'type'      => 'select',
	        'choices'	=> $faces
	    )
	);
	$wp_customize->add_setting(
	    'bopea_title_font_weight',
	    array(
	        'default'    =>  esc_attr__( '700', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_title_font_weight',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Title font weight','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
	$wp_customize->add_setting(
	    'bopea_title_transform',
	    array(
	        'default'    =>  esc_attr__( 'none', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'bopea_title_transform',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Title text transform','bopea'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'bopea'),
	        	'capitalize' => esc_html__('Capitalize', 'bopea'),
	        	'uppercase' => esc_html__('Uppercase', 'bopea')
	        )
	    )
	);

	$wp_customize->add_setting(
	    'letter_spacing_heading',
	    array(
	        'default'    =>  esc_attr__( '-0.02em', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'letter_spacing_heading',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Title letter spacing Ex: 0.03em','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'line_height_heading',
	    array(
	        'default'    =>  esc_attr__( '1.2', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'line_height_heading',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Title line height Ex: 1.2 ','bopea'),
	        'type'      => 'text'
	    )
	);

	// Page & Archive settings
	$wp_customize->add_setting(
	    'bopea_page_ach_opt',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new bopea_Customize_Control_Title (
	        $wp_customize,
	        'bopea_page_ach_opt',
	        array(
	            'label'      	=> esc_html__( 'Page title & archive title size', 'bopea' ),
	            'section'		=> 'bopea_typography_setting',
	            'settings'		=> 'bopea_page_ach_opt',
	        )
	    )
	);	

	$wp_customize->add_setting(
	    'jl_pa_ach',
	    array(
	        'default'     => '33px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'jl_pa_ach',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Page & archive title desktop','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'jl_pa_ach_sm',
	    array(
	        'default'     => '30px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'jl_pa_ach_sm',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Page & archive title mobile','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'jl_pa_ach_excp',
	    array(
	        'default'     => '16px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'jl_pa_ach_excp',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Page & archive subtitle desktop','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);	

	$wp_customize->add_setting(
	    'jl_pa_ach_excp_sm',
	    array(
	        'default'     => '15px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'jl_pa_ach_excp_sm',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Page & archive subtitle mobile','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);


	// Archive blog settings
	$wp_customize->add_setting(
	    'bopea_ach_blog_opt',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new bopea_Customize_Control_Title (
	        $wp_customize,
	        'bopea_ach_blog_opt',
	        array(
	            'label'      	=> esc_html__( 'Archive post title size', 'bopea' ),
	            'section'		=> 'bopea_typography_setting',
	            'settings'		=> 'bopea_ach_blog_opt',
	        )
	    )
	);	

	$wp_customize->add_setting(
	    'jl_ach_list_title',
	    array(
	        'default'     => '20px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'jl_ach_list_title',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Archive list title size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'jl_ach_large_title',
	    array(
	        'default'     => '35px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'jl_ach_large_title',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Archive classic title size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'jl_ach_g2col_title',
	    array(
	        'default'     => '22px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'jl_ach_g2col_title',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Archive grid 2cols title size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'jl_ach_g3col_title',
	    array(
	        'default'     => '22px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'jl_ach_g3col_title',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Archive grid 3cols title size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'jl_ach_g4col_title',
	    array(
	        'default'     => '17px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'jl_ach_g4col_title',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Archive grid 4cols title size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'jl_ach_gov2col_title',
	    array(
	        'default'     => '23px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'jl_ach_gov2col_title',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Archive grid overlay 2cols title size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'jl_ach_gov3col_title',
	    array(
	        'default'     => '22px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'jl_ach_gov3col_title',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Archive grid overlay 3cols title size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'jl_ach_gov4col_title',
	    array(
	        'default'     => '18px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'jl_ach_gov4col_title',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Archive grid overlay 4cols title size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);


	// Single post header
	$wp_customize->add_setting(
	    'bopea_header_opt',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new bopea_Customize_Control_Title (
	        $wp_customize,
	        'bopea_header_opt',
	        array(
	            'label'      	=> esc_html__( 'Single post header size', 'bopea' ),
	            'section'		=> 'bopea_typography_setting',
	            'settings'		=> 'bopea_header_opt',
	        )
	    )
	);	

	$wp_customize->add_setting(
	    'sg_head_title',
	    array(
	        'default'     => '35px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'sg_head_title',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Single post header title desktop','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'sg_head_title_md',
	    array(
	        'default'     => '34px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'sg_head_title_md',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Single post header title tablet','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'sg_head_title_sm',
	    array(
	        'default'     => '26px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'sg_head_title_sm',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Single post header title mobile','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'sg_head_excp',
	    array(
	        'default'     => '17px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'sg_head_excp',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Single post header subtitle desktop','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'sg_head_excp_md',
	    array(
	        'default'     => '17px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'sg_head_excp_md',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Single post header subtitle tablet','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'sg_head_excp_sm',
	    array(
	        'default'     => '17px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'sg_head_excp_sm',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Single post header subtitle mobile','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	// Start single title

	$wp_customize->add_setting(
	    'bopea_heading_desktop',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new bopea_Customize_Control_Title (
	        $wp_customize,
	        'bopea_heading_desktop',
	        array(
	            'label'      	=> esc_html__( 'Single content heading size', 'bopea' ),
	            'section'		=> 'bopea_typography_setting',
	            'settings'		=> 'bopea_heading_desktop',
	        )
	    )
	);

	$wp_customize->add_setting(
	    'bopea_title_s_transform',
	    array(
	        'default'    =>  esc_attr__( 'none', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'bopea_title_s_transform',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Title text transform','bopea'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'bopea'),
	        	'capitalize' => esc_html__('Capitalize', 'bopea'),
	        	'uppercase' => esc_html__('Uppercase', 'bopea')
	        )
	    )
	);

	$wp_customize->add_setting(
	    'letter_spacing_s_heading',
	    array(
	        'default'    =>  esc_attr__( '0em', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'letter_spacing_s_heading',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Title letter spacing Ex: 0.03em','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'line_height_s_heading',
	    array(
	        'default'    =>  esc_attr__( '1.2', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'line_height_s_heading',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Title line height Ex: 1.2 ','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'bopea_h1',
	    array(
	        'default'     => '40px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_h1',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Desktop H1','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_h2',
	    array(
	        'default'     => '32px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_h2',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Desktop H2','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_h3',
	    array(
	        'default'     => '28px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_h3',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Desktop H3','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_h4',
	    array(
	        'default'     => '24px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_h4',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Desktop H4','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_h5',
	    array(
	        'default'     => '20px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_h5',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Desktop H5','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_h6',
	    array(
	        'default'     => '16px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_h6',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Desktop H6','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	
	// Tablet

	$wp_customize->add_setting(
	    'bopea_t_h1',
	    array(
	        'default'     => '40px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_t_h1',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Tablet H1','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_t_h2',
	    array(
	        'default'     => '32px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_t_h2',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Tablet H2','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_t_h3',
	    array(
	        'default'     => '28px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_t_h3',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Tablet H3','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_t_h4',
	    array(
	        'default'     => '24px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_t_h4',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Tablet H4','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_t_h5',
	    array(
	        'default'     => '20px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_t_h5',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Tablet H5','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_t_h6',
	    array(
	        'default'     => '16px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_t_h6',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Tablet H6','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	// Mobile

	$wp_customize->add_setting(
	    'bopea_m_h1',
	    array(
	        'default'     => '40px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_m_h1',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Mobile H1','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_m_h2',
	    array(
	        'default'     => '32px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_m_h2',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Mobile H2','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_m_h3',
	    array(
	        'default'     => '28px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_m_h3',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Mobile H3','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_m_h4',
	    array(
	        'default'     => '24px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_m_h4',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Mobile H4','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_m_h5',
	    array(
	        'default'     => '20px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_m_h5',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Mobile H5','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_m_h6',
	    array(
	        'default'     => '16px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_m_h6',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Mobile H6','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	// End single title

	$wp_customize->add_setting(
	    'bopea_cat_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);

	$wp_customize->add_control(
	    new bopea_Customize_Control_Title (
	        $wp_customize,
	        'bopea_cat_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Category, Meta', 'bopea' ),
	            'section'		=> 'bopea_typography_setting',
	            'settings'		=> 'bopea_cat_settings_title',
	        )
	    )
	);
	$wp_customize->add_setting(
        'bopea_cat_font_size',
        array(
            'default'    =>  esc_attr__( '13px', 'bopea' ),
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'bopea_cat_font_size',
        array(
            'section'   => 'bopea_typography_setting',
            'label'     => esc_html__('Meta cat font size','bopea'),
            'type'      => 'select',
            'choices'   => $font_sizes
        )
    );
	$wp_customize->add_setting(
	    'bopea_cat_font_weight',
	    array(
	        'default'    =>  esc_attr__( '500', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_cat_font_weight',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Meta cat font weight','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
	$wp_customize->add_setting(
	    'bopea_cat_transform',
	    array(
	        'default'    =>  esc_attr__( 'capitalize', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'bopea_cat_transform',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Meta cat text transform','bopea'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'bopea'),
	        	'capitalize' => esc_html__('Capitalize', 'bopea'),
	        	'uppercase' => esc_html__('Uppercase', 'bopea')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'letter_spacing_cat',
	    array(
	        'default'    =>  esc_attr__( '-0.03em', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'letter_spacing_cat',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Meta cat letter spacing Ex: 0.03em','bopea'),
	        'type'      => 'text'
	    )
	);
	$wp_customize->add_setting(
        'bopea_meta_font_size',
        array(
            'default'    =>  esc_attr__( '13px', 'bopea' ),
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'bopea_meta_font_size',
        array(
            'section'   => 'bopea_typography_setting',
            'label'     => esc_html__('Meta font size','bopea'),
            'type'      => 'select',
            'choices'   => $font_sizes
        )
    );

	$wp_customize->add_setting(
        'bopea_meta_font_ssize',
        array(
            'default'    =>  esc_attr__( '14px', 'bopea' ),
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'bopea_meta_font_ssize',
        array(
            'section'   => 'bopea_typography_setting',
            'label'     => esc_html__('Single meta font size','bopea'),
            'type'      => 'select',
            'choices'   => $font_sizes
        )
    );

	$wp_customize->add_setting(
	    'bopea_meta_font_weight',
	    array(
	        'default'    =>  esc_attr__( '400', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'bopea_meta_font_weight',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Meta font weight','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);

	$wp_customize->add_setting(
	    'bopea_meta_a_font_weight',
	    array(	        
			'default'    =>  esc_attr__( '500', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'bopea_meta_a_font_weight',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Meta link font weight','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);

	$wp_customize->add_setting(
	    'bopea_meta_transform',
	    array(
	        'default'    =>  esc_attr__( 'capitalize', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'bopea_meta_transform',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Meta text transform','bopea'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'bopea'),
	        	'capitalize' => esc_html__('Capitalize', 'bopea'),
	        	'uppercase' => esc_html__('Uppercase', 'bopea')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'letter_spacing_meta',
	    array(
	        'default'    =>  esc_attr__( '-0.03em', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'letter_spacing_meta',
	    array(
	        'section'   => 'bopea_typography_setting',
	        'label'     => esc_html__('Meta letter spacing Ex: 0.03em','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
		'bopea_widget_title_setting',
		array(
			'default'     => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	
	$wp_customize->add_control(
		new bopea_Customize_Control_Title (
			$wp_customize,
			'bopea_widget_title_setting',
			array(
				'label'      	=> esc_html__( 'Widget title setting', 'bopea' ),
				'section'		=> 'bopea_typography_setting',
				'settings'		=> 'bopea_widget_title_setting',
			)
		)
	);
	
	$wp_customize->add_setting(
			'bopea_widget_font',
			array(
				'default'    =>  esc_attr__( 'jl_weg_title', 'bopea' ),
				'transport'  =>  'refresh',
				'sanitize_callback' => 'sanitize_text_field',
			)
	);
	$wp_customize->add_control(
			'bopea_widget_font',
			array(
				'section'   => 'bopea_typography_setting',
				'label'     => esc_html__('Widget Font','bopea'),
				'type'      => 'select',
				'choices' 	=> array(
					'none' => esc_html__('None', 'bopea'),
					'jl_weg_title' => esc_html__('Title font', 'bopea'),
					'jl_weg_menu' => esc_html__('Menu font', 'bopea')
				)
			)
	);
	
	$wp_customize->add_setting(
			'bopea_widget_font_size',
			array(
				'default'    =>  esc_attr__( '18px', 'bopea' ),
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
			)
	);
	$wp_customize->add_control(
			'bopea_widget_font_size',
			array(
				'section'   => 'bopea_typography_setting',
				'label'     => esc_html__('Widget font size','bopea'),
				'type'      => 'select',
				'choices'   => $font_sizes
			)
	);
	
	$wp_customize->add_setting(
			'bopea_widget_transform',
			array(
				'default'    =>  esc_attr__( 'capitalize', 'bopea' ),
				'transport'  =>  'refresh',
				'sanitize_callback' => 'sanitize_text_field',
			)
	);
	$wp_customize->add_control(
			'bopea_widget_transform',
			array(
				'section'   => 'bopea_typography_setting',
				'label'     => esc_html__('Widget text transform','bopea'),
				'type'      => 'select',
				'choices' 	=> array(
					'none' => esc_html__('None', 'bopea'),
					'capitalize' => esc_html__('Capitalize', 'bopea'),
					'uppercase' => esc_html__('Uppercase', 'bopea')
				)
			)
	);
	
	$wp_customize->add_setting(
			'bopea_widget_letter_spacing',
			array(
				'default'    =>  esc_attr__( '-0.03em', 'bopea' ),
				'transport'  =>  'refresh',
				'sanitize_callback' => 'sanitize_text_field',
			)
	);
	$wp_customize->add_control(
			'bopea_widget_letter_spacing',
			array(
				'section'   => 'bopea_typography_setting',
				'label'     => esc_html__('Widget letter spacing Ex: 0.03em','bopea'),
				'type'      => 'text'
			)
	);

	

	/*Button*/
	$wp_customize->add_section(
		    'bopea_button_setting',
		    array(
		        'title'     => esc_html__('Form / Button / Load More Settings', 'bopea'),
		        'priority'  => 1,
		        'panel' => 'bopea_theme_options'
		    )
	);

	$wp_customize->add_setting(
	    'bopea_button_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new bopea_Customize_Control_Title (
	        $wp_customize,
	        'bopea_button_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Button Settings', 'bopea' ),
	            'section'		=> 'bopea_button_setting',
	            'settings'		=> 'bopea_button_settings_title',
	        )
	    )
	);
    $wp_customize->add_setting(
	    'bopea_button_font_size',
	    array(
	        'default'    =>  esc_attr__( '14px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_button_font_size',
	    array(
	        'section'   => 'bopea_button_setting',
	        'label'     => esc_html__('Button font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'bopea_button_font_weight',
	    array(
	        'default'    =>  esc_attr__( '500', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_button_font_weight',
	    array(
	        'section'   => 'bopea_button_setting',
	        'label'     => esc_html__('Button font weight','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
	$wp_customize->add_setting(
	    'bopea_button_transform',
	    array(
	        'default'    =>  esc_attr__( 'capitalize', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'bopea_button_transform',
	    array(
	        'section'   => 'bopea_button_setting',
	        'label'     => esc_html__('Button text transform','bopea'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'bopea'),
	        	'capitalize' => esc_html__('Capitalize', 'bopea'),
	        	'uppercase' => esc_html__('Uppercase', 'bopea')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'letter_spacing_button',
	    array(
	        'default'    =>  esc_attr__( '0em', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'letter_spacing_button',
	    array(
	        'section'   => 'bopea_button_setting',
	        'label'     => esc_html__('Button letter spacing','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'button_radius',
	    array(
	        'default'    =>  esc_attr__( '5px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'button_radius',
	    array(
	        'section'   => 'bopea_button_setting',
	        'label'     => esc_html__('Button border radius','bopea'),
	        'type'      => 'text'
	    )
	);

	//  Load More
	$wp_customize->add_setting(
	    'bopea_loadmore_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new bopea_Customize_Control_Title (
	        $wp_customize,
	        'bopea_loadmore_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Load More Settings', 'bopea' ),
	            'section'		=> 'bopea_button_setting',
	            'settings'		=> 'bopea_loadmore_settings_title',
	        )
	    )
	);
    $wp_customize->add_setting(
	    'bopea_loadmore_font_size',
	    array(
	        'default'    =>  esc_attr__( '13px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_loadmore_font_size',
	    array(
	        'section'   => 'bopea_button_setting',
	        'label'     => esc_html__('Load More font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'bopea_loadmore_font_weight',
	    array(
	        'default'    =>  esc_attr__( '500', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_loadmore_font_weight',
	    array(
	        'section'   => 'bopea_button_setting',
	        'label'     => esc_html__('Load More font weight','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
	$wp_customize->add_setting(
	    'bopea_loadmore_transform',
	    array(
	        'default'    =>  esc_attr__( 'capitalize', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'bopea_loadmore_transform',
	    array(
	        'section'   => 'bopea_button_setting',
	        'label'     => esc_html__('Load More text transform','bopea'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'bopea'),
	        	'capitalize' => esc_html__('Capitalize', 'bopea'),
	        	'uppercase' => esc_html__('Uppercase', 'bopea')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'letter_spacing_loadmore',
	    array(
	        'default'    =>  esc_attr__( '0em', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'letter_spacing_loadmore',
	    array(
	        'section'   => 'bopea_button_setting',
	        'label'     => esc_html__('Load More letter spacing','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'load_more_radius',
	    array(
	        'default'    =>  esc_attr__( '0px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'load_more_radius',
	    array(
	        'section'   => 'bopea_button_setting',
	        'label'     => esc_html__('Load more border radius','bopea'),
	        'type'      => 'text'
	    )
	);

	//  Form settings
	$wp_customize->add_setting(
	    'bopea_form_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new bopea_Customize_Control_Title (
	        $wp_customize,
	        'bopea_form_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Form Settings', 'bopea' ),
	            'section'		=> 'bopea_button_setting',
	            'settings'		=> 'bopea_form_settings_title',
	        )
	    )
	);
    $wp_customize->add_setting(
	    'bopea_form_font_size',
	    array(
	        'default'    =>  esc_attr__( '15px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_form_font_size',
	    array(
	        'section'   => 'bopea_button_setting',
	        'label'     => esc_html__('Form font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'form_radius',
	    array(
	        'default'    =>  esc_attr__( '5px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'form_radius',
	    array(
	        'section'   => 'bopea_button_setting',
	        'label'     => esc_html__('Form border radius','bopea'),
	        'type'      => 'text'
	    )
	);
	
	/*Blog archive*/
	$wp_customize->add_section(
		'bopea_archive_setting',
		array(
			'title'     => esc_html__('Blog / Archive Settings', 'bopea'),
			'priority'  => 1,
			'panel' => 'bopea_theme_options'
		)
);

$wp_customize->add_setting(
	    'bopea_cat_lbl',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new bopea_Customize_Control_Title (
	        $wp_customize,
	        'bopea_cat_lbl',
	        array(
	            'label'      	=> esc_html__( 'Category label', 'bopea' ),
	            'section'		=> 'bopea_archive_setting',
	            'settings'		=> 'bopea_cat_lbl',
	        )
	    )
	);

	$wp_customize->add_setting(
	    'category_label_grid',
	    array(
	        'default'    =>  esc_attr__( 'cat_label_1', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'category_label_grid',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Category label grid layout','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
	        'cat_label_1' => esc_html__('Text with line', 'bopea'),
			'cat_label_2' => esc_html__('Text only', 'bopea'),
			'cat_label_3' => esc_html__('Background color', 'bopea'),
			'cat_label_4' => esc_html__('Background color overlay bottom', 'bopea'),
			'cat_label_5' => esc_html__('Background color overlay bottom no space', 'bopea'),
			'cat_label_6' => esc_html__('Background color overlay bottom center no space', 'bopea'),
			'cat_label_7' => esc_html__('Background color overlay top', 'bopea'),
	        )
	    )
	);

	$wp_customize->add_setting(
	    'category_label_list',
	    array(
	        'default'    =>  esc_attr__( 'cat_label_3', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'category_label_list',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Category label list layout','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
	        'cat_label_1' => esc_html__('Text with line', 'bopea'),
			'cat_label_2' => esc_html__('Text only', 'bopea'),
			'cat_label_3' => esc_html__('Background color', 'bopea')
	        )
	    )
	);

	$wp_customize->add_setting(
	    'category_label_overlay',
	    array(
	        'default'    =>  esc_attr__( 'cat_label_3', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'category_label_overlay',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Category label overlay layout','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
	        'cat_label_1' => esc_html__('Text with line', 'bopea'),
			'cat_label_2' => esc_html__('Text only', 'bopea'),
			'cat_label_3' => esc_html__('Background color', 'bopea')
	        )
	    )
	);	

	$wp_customize->add_setting(
	    'category_label_small_list',
	    array(
	        'default'    =>  esc_attr__( 'cat_label_1', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'category_label_small_list',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Category label small layout','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
	        'cat_label_1' => esc_html__('Text with line', 'bopea'),
			'cat_label_2' => esc_html__('Text only', 'bopea'),			
			'cat_label_3' => esc_html__('Background color', 'bopea')
	        )
	    )
	);	

	$wp_customize->add_setting(
	    'category_label_single',
	    array(
	        'default'    =>  esc_attr__( 'cat_label_3', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'category_label_single',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Category label single post','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
	        'cat_label_1' => esc_html__('Text with line', 'bopea'),
			'cat_label_2' => esc_html__('Text only', 'bopea'),
			'cat_label_3' => esc_html__('Background color', 'bopea')
	        )
	    )
	);

	$wp_customize->add_setting(
	    'category_label_padding',
	    array(
	        'default'    =>  esc_attr__( '4px 10px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'category_label_padding',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Category background padding EX: 2px 10px','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'category_label_radius',
	    array(
	        'default'    =>  esc_attr__( '16px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'category_label_radius',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Category border radius EX: 10px','bopea'),
	        'type'      => 'text'
	    )
	);		

	$wp_customize->add_setting(
	    'category_dot_style',
	    array(
			'default'    =>  esc_attr__( 'cat_dot_cir', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'category_dot_style',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Category dotted style','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
	        '' => esc_html__('None', 'bopea'),
			'cat_dot_sq' => esc_html__('Square', 'bopea'),
			'cat_dot_cir' => esc_html__('Circle color', 'bopea')
	        )
	    )
	);

	$wp_customize->add_setting(
	    'category_bg_dot_style',
	    array(
			'default'    =>  esc_attr__( 'jl_cbgop', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'category_bg_dot_style',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Category background with dotted style','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
	        'jl_cbgca' => esc_html__('Classic background', 'bopea'),
			'jl_cbgop' => esc_html__('Opacity background', 'bopea'),
			'jl_cbgou' => esc_html__('Outline', 'bopea')
	        )
	    )
	);

	$wp_customize->add_setting(
	    'bopea_achv_layout',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new bopea_Customize_Control_Title (
	        $wp_customize,
	        'bopea_achv_layout',
	        array(
	            'label'      	=> esc_html__( 'Archive layout settings', 'bopea' ),
	            'section'		=> 'bopea_archive_setting',
	            'settings'		=> 'bopea_achv_layout',
	        )
	    )
	);	

	$wp_customize->add_setting(
	    'jl_archive_category',
	    array(
	        'default'    =>  esc_attr__( 'archive7', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_archive_category',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Archive category layout','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
				'archive1' => esc_html__('Grid post 2 columns', 'bopea'),
				'archive2' => esc_html__('Grid post 3 columns', 'bopea'),
				'archive3' => esc_html__('Grid post 4 columns', 'bopea'),
				'archive7' => esc_html__('Post list', 'bopea'),
				'archive8' => esc_html__('Post classic', 'bopea'),
				'archive9' => esc_html__('Post overlay 2 columns', 'bopea'),
				'archive10' => esc_html__('Post overlay 3 columns', 'bopea'),
				'archive11' => esc_html__('Post overlay 4 columns', 'bopea'),				
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_archive_cat_num',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_archive_cat_num',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Archive category number EX: 10','bopea'),
	        'type'      => 'text'
	    )
	);	

	$wp_customize->add_setting(
	    'jl_archive_tag',
	    array(
	        'default'    =>  esc_attr__( 'archive7', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_archive_tag',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Archive tag layout','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
				'archive1' => esc_html__('Grid post 2 columns', 'bopea'),
				'archive2' => esc_html__('Grid post 3 columns', 'bopea'),
				'archive3' => esc_html__('Grid post 4 columns', 'bopea'),
				'archive7' => esc_html__('Post list', 'bopea'),
				'archive8' => esc_html__('Post classic', 'bopea'),
				'archive9' => esc_html__('Post overlay 2 columns', 'bopea'),
				'archive10' => esc_html__('Post overlay 3 columns', 'bopea'),
				'archive11' => esc_html__('Post overlay 4 columns', 'bopea'),				
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_archive_tag_num',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_archive_tag_num',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Archive tag number EX: 10','bopea'),
	        'type'      => 'text'
	    )
	);	


	$wp_customize->add_setting(
	    'jl_archive_search',
	    array(
	        'default'    =>  esc_attr__( 'archive7', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_archive_search',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Archive search layout','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
				'archive1' => esc_html__('Grid post 2 columns', 'bopea'),
				'archive2' => esc_html__('Grid post 3 columns', 'bopea'),
				'archive3' => esc_html__('Grid post 4 columns', 'bopea'),
				'archive7' => esc_html__('Post list', 'bopea'),
				'archive8' => esc_html__('Post classic', 'bopea'),
				'archive9' => esc_html__('Post overlay 2 columns', 'bopea'),
				'archive10' => esc_html__('Post overlay 3 columns', 'bopea'),
				'archive11' => esc_html__('Post overlay 4 columns', 'bopea'),				
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_archive_search_num',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_archive_search_num',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Archive search number EX: 10','bopea'),
	        'type'      => 'text'
	    )
	);	

	$wp_customize->add_setting(
	    'jl_archive_author',
	    array(
	        'default'    =>  esc_attr__( 'archive7', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_archive_author',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Archive author layout','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
				'archive1' => esc_html__('Grid post 2 columns', 'bopea'),
				'archive2' => esc_html__('Grid post 3 columns', 'bopea'),
				'archive3' => esc_html__('Grid post 4 columns', 'bopea'),
				'archive7' => esc_html__('Post list', 'bopea'),
				'archive8' => esc_html__('Post classic', 'bopea'),
				'archive9' => esc_html__('Post overlay 2 columns', 'bopea'),
				'archive10' => esc_html__('Post overlay 3 columns', 'bopea'),
				'archive11' => esc_html__('Post overlay 4 columns', 'bopea'),				
	        )
	    )
	);	

	$wp_customize->add_setting(
	    'jl_archive_author_num',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_archive_author_num',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Archive author number EX: 10','bopea'),
	        'type'      => 'text'
	    )
	);	

	$wp_customize->add_setting(
	    'jl_archive_layout',
	    array(
	        'default'    =>  esc_attr__( 'archive7', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_archive_layout',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Archive layout','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
				'archive1' => esc_html__('Grid post 2 columns', 'bopea'),
				'archive2' => esc_html__('Grid post 3 columns', 'bopea'),
				'archive3' => esc_html__('Grid post 4 columns', 'bopea'),
				'archive7' => esc_html__('Post list', 'bopea'),
				'archive8' => esc_html__('Post classic', 'bopea'),
				'archive9' => esc_html__('Post overlay 2 columns', 'bopea'),
				'archive10' => esc_html__('Post overlay 3 columns', 'bopea'),
				'archive11' => esc_html__('Post overlay 4 columns', 'bopea'),				
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_archive_num',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_archive_num',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Archive number EX: 10','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_archive_pagination',
	    array(
	        'default'    =>  esc_attr__( 'number', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_archive_pagination',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Archive pagination layouts','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
				'number' => esc_html__('Number', 'bopea'),				
				'loadmore' => esc_html__('Load more', 'bopea'),
				'autoload' => esc_html__('Auto load', 'bopea')				
	        )
	    )
	);

	$wp_customize->add_setting(
		'jl_archive_img',
		array(
			'default'    =>  '',
			'transport'  =>  'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'jl_archive_img',
		array(
			'section'   => 'bopea_archive_setting',
			'label'     => esc_html__('Archive Image size','bopea'),
			'type'      => 'select',
			'choices'	=> array(
				''      			=>esc_html__( 'Default image size', 'bopea' ),      
				'bopea_large'      =>esc_html__( '1600 x 0', 'bopea' ),
				'bopea_medium'      =>esc_html__( '1100 x 0', 'bopea' ),
				'bopea_small'      =>esc_html__( '150 x 150', 'bopea' ),
				'bopea_layouts'      =>esc_html__( '680 x 0', 'bopea' ),				
			)
		)
	);

	$wp_customize->add_setting(
		'jl_ach_frame',
		array(
			'default'    =>  esc_attr__( 'line', 'bopea' ),
			'transport'  =>  'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'jl_ach_frame',
		array(
			'section'   => 'bopea_archive_setting',
			'label'     => esc_html__('Archive frame style','bopea'),
			'type'      => 'select',
			'choices'	=> array(
				''      			=>esc_html__( 'None', 'bopea' ),      
				'line'      =>esc_html__( 'Line', 'bopea' ),
				'shadow'      =>esc_html__( 'shadow', 'bopea' ),				
			)
		)
	);

	$wp_customize->add_setting(
		'sm_list_auto_height',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'sm_list_auto_height',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Enable small list image auto height','bopea'),
	        'type'      => 'checkbox'
	    )
	);	

	$wp_customize->add_setting(
		'jl_ach_li_rimg',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'jl_ach_li_rimg',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Enable right image list','bopea'),
	        'type'      => 'checkbox'
	    )
	);	
	
	$wp_customize->add_setting(
		'jl_sw_date_read',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'jl_sw_date_read',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Switch date to read time','bopea'),
	        'type'      => 'checkbox'
	    )
	);	

	$wp_customize->add_setting(
	    'g_img_height',
	    array(
			'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'g_img_height',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Grid card image height. EX: 56.25%','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
		'bopea_achv_metas',
		array(
			'default'     => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new bopea_Customize_Control_Title (
			$wp_customize,
			'bopea_achv_metas',
			array(
				'label'      	=> esc_html__( 'Archive meta', 'bopea' ),
				'section'		=> 'bopea_archive_setting',
				'settings'		=> 'bopea_achv_metas',
			)
		)
	);

	$wp_customize->add_setting(
		'show_author_img',
		array(
			'default' => true,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'show_author_img',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Enable meta author image','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'hide_front_author',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'hide_front_author',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Disable meta author','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'hide_front_cat',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'hide_front_cat',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Disable meta category','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'hide_front_date',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'hide_front_date',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Disable meta date','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'enable_front_date_ago',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'enable_front_date_ago',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Enable meta date ago','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'hide_front_author_date',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'hide_front_author_date',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Disable meta author & date','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'enable_share_btn',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'enable_share_btn',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Enable share meta','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
	    'btn_txt',
	    array(
			'default'    =>  esc_attr__( 'Continue Reading', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'btn_txt',
	    array(
	        'section'   => 'bopea_archive_setting',
	        'label'     => esc_html__('Read more text','bopea'),
	        'type'      => 'text'
	    )
	);

	/*Single post*/
	$wp_customize->add_section(
		    'bopea_blog_single_setting',
		    array(
		        'title'     => esc_html__('Single Post Settings', 'bopea'),
		        'priority'  => 1,
		        'panel' => 'bopea_theme_options'
		    )
	);	

	$wp_customize->add_setting(
	    'bopea_single_layout',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new bopea_Customize_Control_Title (
	        $wp_customize,
	        'bopea_single_layout',
	        array(
	            'label'      	=> esc_html__( 'Single post settings', 'bopea' ),
	            'section'		=> 'bopea_blog_single_setting',
	            'settings'		=> 'bopea_single_layout',
	        )
	    )
	);

	$wp_customize->add_setting(
	    'single_post_layout_options',
	    array(
	        'default'    =>  esc_attr__( 'single1', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'single_post_layout_options',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Single Post Layout','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
	        'single1' => esc_html__('Post Layout 1', 'bopea'),
			'single2' => esc_html__('Post Layout 2', 'bopea'),
			'single3' => esc_html__('Post Layout 3', 'bopea'),
			'single4' => esc_html__('Post Layout 4', 'bopea'),
			'single5' => esc_html__('Post Layout 5', 'bopea'),
			'single6' => esc_html__('Post Layout 6', 'bopea'),
			'single7' => esc_html__('Post Layout 7', 'bopea'),
			'single8' => esc_html__('Post Layout 8', 'bopea'),
			'single9' => esc_html__('Post Layout 9', 'bopea'),
			'single10' => esc_html__('Post Layout 10', 'bopea'),
			'single11' => esc_html__('Post Layout 11', 'bopea'),
			'single12' => esc_html__('Post Layout 12', 'bopea'),
			'single13' => esc_html__('Post Layout 13', 'bopea'),
			'single14' => esc_html__('Post Layout 14', 'bopea'),
	        )
	    )
	);

	$wp_customize->add_setting(
	    'post_sub_title_type',
	    array(
	        'default'    =>  esc_attr__( 'jl_sub_title', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'post_sub_title_type',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Sub title display type','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
				'jl_sub_title' => 'Build in sub title',
				'jl_excerpt' => 'Post excerpt'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'post_sub_title_width',
	    array(
			'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'post_sub_title_width',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Post sub title width EX: 100%, 500px','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'sg_post_full',
	    array(
	        'default'    =>  esc_attr__( 'jl_sg_side', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'sg_post_full',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Single full options','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
				'jl_sg_side' => esc_html__('Single post with sidebar','bopea'),
				'jl_sg_full' => esc_html__('Single post full width','bopea')
	        )
	    )
	);

	$wp_customize->add_setting(
	    'post_sidebar_position',
	    array(
	        'default'    =>  esc_attr__( 'jl_sright_side', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'post_sidebar_position',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Sidebar Position','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
				'jl_sleft_side' => esc_html__('Left Sidebar','bopea'),
				'jl_sright_side' => esc_html__('Right Sidebar','bopea')
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_video_style',
	    array(
	        'default'    =>  esc_attr__( 'background', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_video_style',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Archive post video style','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
	        'background' => esc_html__('Video background', 'bopea'),
			'popup' => esc_html__('Video popup', 'bopea'),
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_sg_video_style',
	    array(
	        'default'    =>  esc_attr__( 'background', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_sg_video_style',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Single overlay layout video style','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
	        'background' => esc_html__('Video background', 'bopea'),
			'popup' => esc_html__('Video popup', 'bopea'),
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_gallery_type',
	    array(
	        'default'    =>  esc_attr__( 'slider', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_gallery_type',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Single Post Gallery Layout','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
	        'slider' => esc_html__('Gallery Slider', 'bopea'),
					'popup' => esc_html__('Gallery Popup', 'bopea'),
	        )
	    )
	);	
	
	$wp_customize->add_setting(
	    'bopea_nav_post_size',
	    array(
	        'default'    =>  esc_attr__( '15px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_nav_post_size',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Post Next/Previous font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'bopea_related_size',
	    array(
	        'default'    =>  esc_attr__( '18px', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'bopea_related_size',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Related font size','bopea'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'related_num',
	    array(
			'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'related_num',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Number of related post','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_related_query',
	    array(
	        'default'    =>  esc_attr__( 'category', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_related_query',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Related by category/tag','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
				'category'      =>esc_html__( 'Category', 'bopea' ),
				'tag'      =>esc_html__( 'Tag', 'bopea' ),				
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_related_img',
	    array(
	        'default'    =>  esc_attr__( 'bopea_layouts', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_related_img',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Related Image size','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
				'bopea_large'      =>esc_html__( '1600 x 0', 'bopea' ),
				'bopea_medium'      =>esc_html__( '1100 x 0', 'bopea' ),
				'bopea_small'      =>esc_html__( '150 x 150', 'bopea' ),
				'bopea_layouts'      =>esc_html__( '680 x 0', 'bopea' ),				
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_sg_author',
	    array(
	        'default'    =>  esc_attr__( 'jl_au_sm', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_sg_author',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Author meta type','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
				'jl_au_txt'      =>esc_html__( 'Text only', 'bopea' ),
				'jl_au_sm'      =>esc_html__( 'Small image', 'bopea' ),
				'jl_au_md'      =>esc_html__( 'Medium image', 'bopea' ),
				'jl_au_l'      =>esc_html__( 'Large image', 'bopea' ),				
	        )
	    )
	);

	$wp_customize->add_setting(
		'enable_pin_it',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'enable_pin_it',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Enable pin it on image','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_head_sh',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_head_sh',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable header share','bopea'),
	        'type'      => 'checkbox'
	    )
	);	

	$wp_customize->add_setting(
		'disable_post_date',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_date',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post meta date','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'enable_single_date_ago',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'enable_single_date_ago',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Enable meta date ago','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
	    'jl_ago_pos',
	    array(
	        'default'    =>  esc_attr__( 'after', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_ago_pos',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Meta ago position','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
				'before'      =>esc_html__( 'Before', 'bopea' ),
				'after'      =>esc_html__( 'after', 'bopea' ),				
	        )
	    )
	);

	$wp_customize->add_setting(
		'enable_updated_date',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'enable_updated_date',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Enable post label updated','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_post_readtime',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_readtime',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post meta read time','bopea'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
		'disable_post_view',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_view',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post meta view','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_post_meta_author',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_meta_author',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post meta author','bopea'),
	        'type'      => 'checkbox'
	    )
	);	

	$wp_customize->add_setting(
		'disable_post_author',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_author',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post author box','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_author_box_img',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_author_box_img',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post author box image','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_post_category',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_category',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post category','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
	    'jl_review_bar',
	    array(
	        'default'    =>  esc_attr__( 'show', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_review_bar',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Hide/Show Review bar','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
	        		'show' => esc_html__('show', 'bopea'),
					'hide' => esc_html__('hide', 'bopea'),
	        )
	    )
	);

	$wp_customize->add_setting(
		'disable_post_tag',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_tag',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post tag','bopea'),
	        'type'      => 'checkbox'
	    )
	);	
	$wp_customize->add_setting(
		'disable_post_tag',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_tag',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post tag','bopea'),
	        'type'      => 'checkbox'
	    )
	);	

	$wp_customize->add_setting(
		'disable_post_share_footer',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_share_footer',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable footer post share','bopea'),
	        'type'      => 'checkbox'
	    )
	);	

	$wp_customize->add_setting(
		'disable_post_nav',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_nav',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post Next/Previous','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_section_comment',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_section_comment',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable section comment','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_section_comment_title',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_section_comment_title',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable section comment title','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_post_related',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_related',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable related post','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_s_share_fb',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_s_share_fb',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post footer share Facebook','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_s_share_tw',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_s_share_tw',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post footer share Twitter','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_s_share_pin',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_s_share_pin',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post footer share Pinterest','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_s_share_in',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_s_share_in',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post footer share Linkedin','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_s_share_whatsapp',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_s_share_whatsapp',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post footer share whatsapp','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_s_share_telegram',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_s_share_telegram',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post footer share telegram','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_s_share_tumblr',
		array(
			'default' => true,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_s_share_tumblr',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post footer share tumblr','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_s_share_line',
		array(
			'default' => true,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_s_share_line',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post footer share line','bopea'),
	        'type'      => 'checkbox'
	    )
	);
	

	$wp_customize->add_setting(
		'disable_s_share_mail',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_s_share_mail',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Disable post footer share Mail','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'bopea_share_side_single',
		array(
				'default'     => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
		)
);
	$wp_customize->add_control(
		new bopea_Customize_Control_Title (
				$wp_customize,
				'bopea_share_side_single',
				array(
						'label'      	=> esc_html__( 'Single post share left and top', 'bopea' ),
						'section'		=> 'bopea_blog_single_setting',
						'settings'		=> 'bopea_share_side_single',
				)
		)
);

$wp_customize->add_setting(
	'single_left_share_style',
	array(
		'default'    =>  esc_attr__( 'jl_share_l_line', 'bopea' ),
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'single_left_share_style',
	array(
		'section'   => 'bopea_blog_single_setting',
		'label'     => esc_html__('Share left layout','bopea'),
		'type'      => 'select',
		'choices'	=> array(
			'jl_share_l_line' => esc_html__('Share line layout', 'bopea'),
			'jl_share_l_bg' => esc_html__('Share background layout', 'bopea'),
		)
	)
);

$wp_customize->add_setting(
	'disable_post_share',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'disable_post_share',
	array(
		'section'   => 'bopea_blog_single_setting',
		'label'     => esc_html__('Disable left post share','bopea'),
		'type'      => 'checkbox'
	)
);

$wp_customize->add_setting(
    'disable_l_share_fb',
    array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'disable_l_share_fb',
    array(
        'section'   => 'bopea_blog_single_setting',
        'label'     => esc_html__('Disable post left share Facebook','bopea'),
        'type'      => 'checkbox'
    )
);

$wp_customize->add_setting(
    'disable_l_share_tw',
    array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'disable_l_share_tw',
    array(
        'section'   => 'bopea_blog_single_setting',
        'label'     => esc_html__('Disable post left share Twitter','bopea'),
        'type'      => 'checkbox'
    )
);

$wp_customize->add_setting(
    'disable_l_share_pin',
    array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'disable_l_share_pin',
    array(
        'section'   => 'bopea_blog_single_setting',
        'label'     => esc_html__('Disable post left share Pinterest','bopea'),
        'type'      => 'checkbox'
    )
);

$wp_customize->add_setting(
    'disable_l_share_in',
    array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'disable_l_share_in',
    array(
        'section'   => 'bopea_blog_single_setting',
        'label'     => esc_html__('Disable post left share Linkedin','bopea'),
        'type'      => 'checkbox'
    )
);

$wp_customize->add_setting(
    'disable_l_share_whatsapp',
    array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'disable_l_share_whatsapp',
    array(
        'section'   => 'bopea_blog_single_setting',
        'label'     => esc_html__('Disable post left share whatsapp','bopea'),
        'type'      => 'checkbox'
    )
);

$wp_customize->add_setting(
    'disable_l_share_telegram',
    array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'disable_l_share_telegram',
    array(
        'section'   => 'bopea_blog_single_setting',
        'label'     => esc_html__('Disable post left share telegram','bopea'),
        'type'      => 'checkbox'
    )
);

$wp_customize->add_setting(
    'disable_l_share_tumblr',
    array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'disable_l_share_tumblr',
    array(
        'section'   => 'bopea_blog_single_setting',
        'label'     => esc_html__('Disable post left share tumblr','bopea'),
        'type'      => 'checkbox'
    )
);

$wp_customize->add_setting(
    'disable_l_share_line',
    array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'disable_l_share_line',
    array(
        'section'   => 'bopea_blog_single_setting',
        'label'     => esc_html__('Disable post left share line','bopea'),
        'type'      => 'checkbox'
    )
);

$wp_customize->add_setting(
    'disable_l_share_mail',
    array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'disable_l_share_mail',
    array(
        'section'   => 'bopea_blog_single_setting',
        'label'     => esc_html__('Disable post left share Mail','bopea'),
        'type'      => 'checkbox'
    )
);

$wp_customize->add_setting(
	'bopea_single_share_order',
	array(
			'default'     => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new bopea_Customize_Control_Title (
			$wp_customize,
			'bopea_single_share_order',
			array(
					'label'      	=> esc_html__( 'Single post share order', 'bopea' ),
					'section'		=> 'bopea_blog_single_setting',
					'settings'		=> 'bopea_single_share_order',
			)
	)
);

$wp_customize->add_setting(
	'single_order_1',
	array(
		'default'    =>  'jl_sli_fb',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'single_order_1',
	array(
		'section'   => 'bopea_blog_single_setting',
		'type'      => 'select',
		'choices'	=> array(
			'jl_sli_fb' => esc_html__('Facebook', 'bopea'),
			'jl_sli_tw' => esc_html__('Twitter', 'bopea'),
			'jl_sli_pi' => esc_html__('Pinterest', 'bopea'),
			'jl_sli_din' => esc_html__('LinkedIn', 'bopea'),
			'jl_sli_wapp' => esc_html__('WhatsApp', 'bopea'),
			'jl_sli_tele' => esc_html__('Telegram', 'bopea'),
			'jl_sli_mil' => esc_html__('Mail', 'bopea'),
		)
	)
);

$wp_customize->add_setting(
	'single_order_2',
	array(
		'default'    =>  'jl_sli_tw',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'single_order_2',
	array(
		'section'   => 'bopea_blog_single_setting',
		'type'      => 'select',
		'choices'	=> array(
			'jl_sli_fb' => esc_html__('Facebook', 'bopea'),
			'jl_sli_tw' => esc_html__('Twitter', 'bopea'),
			'jl_sli_pi' => esc_html__('Pinterest', 'bopea'),
			'jl_sli_din' => esc_html__('LinkedIn', 'bopea'),
			'jl_sli_wapp' => esc_html__('WhatsApp', 'bopea'),
			'jl_sli_tele' => esc_html__('Telegram', 'bopea'),
			'jl_sli_mil' => esc_html__('Mail', 'bopea'),
		)
	)
);

$wp_customize->add_setting(
	'single_order_3',
	array(
		'default'    =>  'jl_sli_pi',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'single_order_3',
	array(
		'section'   => 'bopea_blog_single_setting',
		'type'      => 'select',
		'choices'	=> array(
			'jl_sli_fb' => esc_html__('Facebook', 'bopea'),
			'jl_sli_tw' => esc_html__('Twitter', 'bopea'),
			'jl_sli_pi' => esc_html__('Pinterest', 'bopea'),
			'jl_sli_din' => esc_html__('LinkedIn', 'bopea'),
			'jl_sli_wapp' => esc_html__('WhatsApp', 'bopea'),
			'jl_sli_tele' => esc_html__('Telegram', 'bopea'),
			'jl_sli_mil' => esc_html__('Mail', 'bopea'),
		)
	)
);

$wp_customize->add_setting(
	'single_order_4',
	array(
		'default'    =>  'jl_sli_din',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'single_order_4',
	array(
		'section'   => 'bopea_blog_single_setting',
		'type'      => 'select',
		'choices'	=> array(
			'jl_sli_fb' => esc_html__('Facebook', 'bopea'),
			'jl_sli_tw' => esc_html__('Twitter', 'bopea'),
			'jl_sli_pi' => esc_html__('Pinterest', 'bopea'),
			'jl_sli_din' => esc_html__('LinkedIn', 'bopea'),
			'jl_sli_wapp' => esc_html__('WhatsApp', 'bopea'),
			'jl_sli_tele' => esc_html__('Telegram', 'bopea'),
			'jl_sli_mil' => esc_html__('Mail', 'bopea'),
		)
	)
);

$wp_customize->add_setting(
	'single_order_5',
	array(
		'default'    =>  'jl_sli_wapp',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'single_order_5',
	array(
		'section'   => 'bopea_blog_single_setting',
		'type'      => 'select',
		'choices'	=> array(
			'jl_sli_fb' => esc_html__('Facebook', 'bopea'),
			'jl_sli_tw' => esc_html__('Twitter', 'bopea'),
			'jl_sli_pi' => esc_html__('Pinterest', 'bopea'),
			'jl_sli_din' => esc_html__('LinkedIn', 'bopea'),
			'jl_sli_wapp' => esc_html__('WhatsApp', 'bopea'),
			'jl_sli_tele' => esc_html__('Telegram', 'bopea'),
			'jl_sli_mil' => esc_html__('Mail', 'bopea'),
		)
	)
);

$wp_customize->add_setting(
	'single_order_6',
	array(
		'default'    =>  'jl_sli_tele',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'single_order_6',
	array(
		'section'   => 'bopea_blog_single_setting',
		'type'      => 'select',
		'choices'	=> array(
			'jl_sli_fb' => esc_html__('Facebook', 'bopea'),
			'jl_sli_tw' => esc_html__('Twitter', 'bopea'),
			'jl_sli_pi' => esc_html__('Pinterest', 'bopea'),
			'jl_sli_din' => esc_html__('LinkedIn', 'bopea'),
			'jl_sli_wapp' => esc_html__('WhatsApp', 'bopea'),
			'jl_sli_tele' => esc_html__('Telegram', 'bopea'),
			'jl_sli_mil' => esc_html__('Mail', 'bopea'),
		)
	)
);

$wp_customize->add_setting(
	'single_order_7',
	array(
		'default'    =>  'jl_sli_mil',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'single_order_7',
	array(
		'section'   => 'bopea_blog_single_setting',
		'type'      => 'select',
		'choices'	=> array(
			'jl_sli_fb' => esc_html__('Facebook', 'bopea'),
			'jl_sli_tw' => esc_html__('Twitter', 'bopea'),
			'jl_sli_pi' => esc_html__('Pinterest', 'bopea'),
			'jl_sli_din' => esc_html__('LinkedIn', 'bopea'),
			'jl_sli_wapp' => esc_html__('WhatsApp', 'bopea'),
			'jl_sli_tele' => esc_html__('Telegram', 'bopea'),
			'jl_sli_mil' => esc_html__('Mail', 'bopea'),
		)
	)
);

	
$wp_customize->add_setting(
			'bopea_auto_single',
			array(
					'default'     => '',
					'transport'   => 'refresh',
					'sanitize_callback' => 'sanitize_text_field',
			)
	);
		$wp_customize->add_control(
			new bopea_Customize_Control_Title (
					$wp_customize,
					'bopea_auto_single',
					array(
							'label'      	=> esc_html__( 'Auto load next post settings', 'bopea' ),
							'section'		=> 'bopea_blog_single_setting',
							'settings'		=> 'bopea_auto_single',
					)
			)
	);

	$wp_customize->add_setting(
	    'single_auto_load_post',
	    array(
	        'default'    =>  esc_attr__( 'disable', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'single_auto_load_post',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Auto load next post','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'enable' => esc_html__('Enable', 'bopea'),
				'disable' => esc_html__('Disable', 'bopea'),
	        )
	    )
	);

	$wp_customize->add_setting(
	    'auto_load_num',
	    array(
	        'default'     => 10,
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'auto_load_num',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Auto load number post','bopea'),
	        'type'      => 'select',
	        'choices'	=> $num_sizes
	    )
	);

	$wp_customize->add_setting(
	    'single_auto_load_type',
	    array(
	        'default'    =>  esc_attr__( 'previous', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'single_auto_load_type',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Auto load next type','bopea'),
	        'type'      => 'select',
	        'choices'	=> array(
	        	'previous' => esc_html__('Previous Date', 'bopea'),
				'next' => esc_html__('Next Date', 'bopea'),
				'random' => esc_html__('Random', 'bopea'),
	        )
	    )
	);

	$wp_customize->add_setting(
		'auto_same_cat',
		array(
			'default' => false,
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'auto_same_cat',
	    array(
	        'section'   => 'bopea_blog_single_setting',
	        'label'     => esc_html__('Load Same Category','bopea'),
	        'type'      => 'checkbox'
	    )
	);

	/*Single post progress settings*/
	$wp_customize->add_section(
		'bopea_blog_reading_setting',
		array(
			'title'     => esc_html__('Single Post Progress Settings', 'bopea'),
			'priority'  => 1,
			'panel' => 'bopea_theme_options'
		)
);

$wp_customize->add_setting(
	'enable_read_progress',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'enable_read_progress',
	array(
		'section'   => 'bopea_blog_reading_setting',
		'label'     => esc_html__('Enable reading progresss','bopea'),
		'type'      => 'checkbox'
	)
);

$wp_customize->add_setting(
	'sp_progress_height',
	array(
		'default'    =>  esc_attr__( '5px', 'bopea' ),
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'sp_progress_height',
	array(
		'section'   => 'bopea_blog_reading_setting',
		'label'     => esc_html__('Height progress bar EX: 5px','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'sp_progress_pos',
	array(
		'default'    =>  'top',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'sp_progress_pos',
	array(
		'section'   => 'bopea_blog_reading_setting',
		'label'     => esc_html__('Progress bar position','bopea'),
		'type'      => 'select',
		'choices'	=> array(	        
		'top' => esc_html__('Top position', 'bopea'),
		'bottom' => esc_html__('Bottom position', 'bopea')
		)
	)
);

$wp_customize->add_setting(
	'sp_color1',
	array(
		'default'    =>  esc_attr__( '#ae5eff', 'bopea' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new bopea_alpha_color(
		$wp_customize,
		'sp_color1',
		array(
			'label'      => esc_html__( 'First gradient color', 'bopea' ),
			'section'    => 'bopea_blog_reading_setting',
			'settings'   => 'sp_color1'
		)
	)
);

$wp_customize->add_setting(
	'sp_color2',
	array(
		'default'    =>  esc_attr__( '#8100ff', 'bopea' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new bopea_alpha_color(
		$wp_customize,
		'sp_color2',
		array(
			'label'      => esc_html__( 'Second gradient color', 'bopea' ),
			'section'    => 'bopea_blog_reading_setting',
			'settings'   => 'sp_color2'
		)
	)
);


	/*Sidebar*/
	$wp_customize->add_section(
		    'bopea_sidebar_setting',
		    array(
		        'title'     => esc_html__('Sidebar Settings', 'bopea'),
		        'priority'  => 1,
		        'panel' => 'bopea_theme_options'
		    )
	);
	$wp_customize->add_setting(
        'disable_widget_block',
        array(
            'default' => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'disable_widget_block',
        array(
            'section'   => 'bopea_sidebar_setting',
            'label'     => esc_html__('Disable widget block','bopea'),
            'type'      => 'checkbox'
        )
    );
	$wp_customize->add_setting(
	    'post_sidebar',
	    array(
	        'default'    =>  esc_attr__( 'default', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'post_sidebar',
	    array(
	        'section'   => 'bopea_sidebar_setting',
	        'label'     => esc_html__('Post sidebar','bopea'),
	        'type'      => 'select',
	        'choices'	=> $option_sidebar
	    )
	);

	$wp_customize->add_setting(
	    'page_sidebar',
	    array(
	        'default'    =>  esc_attr__( 'default', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'page_sidebar',
	    array(
	        'section'   => 'bopea_sidebar_setting',
	        'label'     => esc_html__('Page sidebar','bopea'),
	        'type'      => 'select',
	        'choices'	=> $option_sidebar
	    )
	);

	$wp_customize->add_setting(
	    'category_sidebar',
	    array(
	        'default'    =>  esc_attr__( 'default', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'category_sidebar',
	    array(
	        'section'   => 'bopea_sidebar_setting',
	        'label'     => esc_html__('Category sidebar','bopea'),
	        'type'      => 'select',
	        'choices'	=> $option_sidebar
	    )
	);

	$wp_customize->add_setting(
	    'tag_sidebar',
	    array(
	        'default'    =>  esc_attr__( 'default', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'tag_sidebar',
	    array(
	        'section'   => 'bopea_sidebar_setting',
	        'label'     => esc_html__('Tag sidebar','bopea'),
	        'type'      => 'select',
	        'choices'	=> $option_sidebar
	    )
	);

	$wp_customize->add_setting(
	    'archive_sidebar',
	    array(
	        'default'    =>  esc_attr__( 'default', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'archive_sidebar',
	    array(
	        'section'   => 'bopea_sidebar_setting',
	        'label'     => esc_html__('Archive sidebar','bopea'),
	        'type'      => 'select',
	        'choices'	=> $option_sidebar
	    )
	);

	$wp_customize->add_setting(
	    'author_sidebar',
	    array(
	        'default'    =>  esc_attr__( 'default', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'author_sidebar',
	    array(
	        'section'   => 'bopea_sidebar_setting',
	        'label'     => esc_html__('Author sidebar','bopea'),
	        'type'      => 'select',
	        'choices'	=> $option_sidebar
	    )
	);

	$wp_customize->add_setting(
	    'search_sidebar',
	    array(
	        'default'    =>  esc_attr__( 'default', 'bopea' ),
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'search_sidebar',
	    array(
	        'section'   => 'bopea_sidebar_setting',
	        'label'     => esc_html__('Search sidebar','bopea'),
	        'type'      => 'select',
	        'choices'	=> $option_sidebar
	    )
	);


	/*Social Header Link*/
	$wp_customize->add_section(
		    'bopea_social_setting',
		    array(
		        'title'     => esc_html__('Social Settings', 'bopea'),
		        'priority'  => 1,
		        'panel' => 'bopea_theme_options'
		    )
	);

	$wp_customize->add_setting(
	    'facebook',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'facebook',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Facebook','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'twitter',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'twitter',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('X','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'instagram',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'instagram',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Instagram','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'pinterest',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'pinterest',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Pinterest','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'youtube',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'youtube',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('YouTube','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'vimeo',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'vimeo',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Vimeo','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'sound_cloud',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'sound_cloud',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('SoundCloud','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'spotify_i',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'spotify_i',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Spotify','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'whatsapp',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'whatsapp',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('WhatsApp','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'linkedin',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'linkedin',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('LinkedIn','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'behance',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'behance',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Behance','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'telegram',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'telegram',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Telegram','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'tumblr',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'tumblr',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Tumblr','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'deviantart',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'deviantart',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('DeviantArt','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'dribble',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'dribble',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Dribbble','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'dropbox',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'dropbox',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Dropbox','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'rss',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'rss',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('RSS','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'skype',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'skype',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Skype','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'stumbleupon',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'stumbleupon',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('StumbleUpon','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'wordpress',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'wordpress',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('WordPress','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'yahoo',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'yahoo',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Yahoo','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'flickr',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'flickr',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Flickr','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'wechat',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'wechat',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('WeChat','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'tiktok',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'tiktok',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('TikTok','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'vk',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'vk',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('VK','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'discord',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'discord',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Discord','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'snapchat',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'snapchat',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('SnapChat','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'reddit',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'reddit',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Reddit','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'threads',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'threads',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Threads','bopea'),
	        'type'      => 'text'
	    )
	);	

	$wp_customize->add_setting(
	    'google-news',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'google-news',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Google news','bopea'),
	        'type'      => 'text'
	    )
	);	

	$wp_customize->add_setting(
	    'flipboard',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'flipboard',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Flipboard','bopea'),
	        'type'      => 'text'
	    )
	);		

	$wp_customize->add_setting(
	    'iheartradio',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'iheartradio',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('iHeartRadio','bopea'),
	        'type'      => 'text'
	    )
	);	

	$wp_customize->add_setting(
	    'apple_podcasts',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'apple_podcasts',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Apple Podcasts','bopea'),
	        'type'      => 'text'
	    )
	);	

	$wp_customize->add_setting(
	    'google_podcasts',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'google_podcasts',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Google Podcasts','bopea'),
	        'type'      => 'text'
	    )
	);	

	$wp_customize->add_setting(
	    'stitcher',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'stitcher',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Stitcher','bopea'),
	        'type'      => 'text'
	    )
	);	

	$wp_customize->add_setting(
	    'patreon',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'patreon',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Patreon','bopea'),
	        'type'      => 'text'
	    )
	);
	
	$wp_customize->add_setting(
	    'twitch',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'twitch',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Twitch','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'medium',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'medium',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Medium','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'gitlab',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'gitlab',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('GitLab','bopea'),
	        'type'      => 'text'
	    )
	);
	
	$wp_customize->add_setting(
	    'newsletter',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'newsletter',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Newsletter','bopea'),
	        'type'      => 'text'
	    )
	);	

	$wp_customize->add_setting(
	    'quora',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'quora',
	    array(
	        'section'   => 'bopea_social_setting',
	        'label'     => esc_html__('Quora','bopea'),
	        'type'      => 'text'
	    )
	);	


/*Advertisement*/
$wp_customize->add_section(
	'bopea_ads_setting',
	array(
		'title'     => esc_html__('Advertisement Settings', 'bopea'),
		'priority'  => 1,
		'panel' => 'bopea_theme_options'
	)
);

/*header above*/
$wp_customize->add_setting(
'bopea_opt_ads_head_above',
array(
	'default'     => '',
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
new bopea_Customize_Control_Title (
	$wp_customize,
	'bopea_opt_ads_head_above',
	array(
		'label'         => esc_html__( 'Header Above Ads Settings', 'bopea' ),		
		'section'       => 'bopea_ads_setting',
		'settings'      => 'bopea_opt_ads_head_above',
	)
)
);

$wp_customize->add_setting(
	'home_align_head_above',
	array(
		'default'    =>  'center',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'home_align_head_above',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Ads align','bopea'),
		'type'      => 'select',
		'choices'	=> array(
		'flex-start' => esc_html__('Left', 'bopea'),
		'center' => esc_html__('Center', 'bopea'),
		'flex-end' => esc_html__('Right', 'bopea'),		
		)
	)
);

$wp_customize->add_setting(
'home_hide_head_above',
array(
	'default' => false,
	'transport' => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
'home_hide_head_above',
array(
	'section'   => 'bopea_ads_setting',
	'label'     => esc_html__('Hide on home page','bopea'),
	'type'      => 'checkbox'
)
);

$wp_customize->add_setting(
'archives_hide_head_above',
array(
	'default' => false,
	'transport' => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
'archives_hide_head_above',
array(
	'section'   => 'bopea_ads_setting',
	'label'     => esc_html__('Hide on archives page','bopea'),
	'type'      => 'checkbox'
)
);

$wp_customize->add_setting(
'pages_hide_head_above',
array(
	'default' => false,
	'transport' => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
'pages_hide_head_above',
array(
	'section'   => 'bopea_ads_setting',
	'label'     => esc_html__('Hide on pages','bopea'),
	'type'      => 'checkbox'
)
);

$wp_customize->add_setting(
'posts_hide_head_above',
array(
	'default' => false,
	'transport' => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
'posts_hide_head_above',
array(
	'section'   => 'bopea_ads_setting',
	'label'     => esc_html__('Hide on posts','bopea'),
	'type'      => 'checkbox'
)
);


$wp_customize->add_setting(
'posts_dhide_head_above',
array(
	'default' => false,
	'transport' => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
'posts_dhide_head_above',
array(
	'section'   => 'bopea_ads_setting',
	'label'     => esc_html__('Hide on desktop','bopea'),
	'type'      => 'checkbox'
)
);

$wp_customize->add_setting(
'posts_thide_head_above',
array(
	'default' => false,
	'transport' => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
'posts_thide_head_above',
array(
	'section'   => 'bopea_ads_setting',
	'label'     => esc_html__('Hide on tablet','bopea'),
	'type'      => 'checkbox'
)
);

$wp_customize->add_setting(
'posts_mhide_head_above',
array(
	'default' => false,
	'transport' => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
'posts_mhide_head_above',
array(
	'section'   => 'bopea_ads_setting',
	'label'     => esc_html__('Hide on mobile','bopea'),
	'type'      => 'checkbox'
)
);



$wp_customize->add_setting(
'bopea_ads_head_above',
array(
	'default'    =>  '',
	'transport'  =>  'refresh',
	'sanitize_callback' => 'wp_kses_post',
)
);
$wp_customize->add_control(
'bopea_ads_head_above',
array(
	'section'   => 'bopea_ads_setting',
	'label'     => esc_html__('Header Above Ads','bopea'),
	'description' => esc_html__( 'Only shortcodes[]/HTML code is allowed here','bopea'),
	'type'      => 'textarea'
)
);

/*header below*/
$wp_customize->add_setting(
	'bopea_opt_ads_head_below',
	array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	new bopea_Customize_Control_Title (
		$wp_customize,
		'bopea_opt_ads_head_below',
		array(
			'label'         => esc_html__( 'Header Below Ads Settings', 'bopea' ),			
			'section'       => 'bopea_ads_setting',
			'settings'      => 'bopea_opt_ads_head_below',
		)
	)
	);
	
	$wp_customize->add_setting(
		'home_align_head_below',
		array(
			'default'    =>  'center',
			'transport'  =>  'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'home_align_head_below',
		array(
			'section'   => 'bopea_ads_setting',
			'label'     => esc_html__('Ads align','bopea'),
			'type'      => 'select',
			'choices'	=> array(
			'flex-start' => esc_html__('Left', 'bopea'),
			'center' => esc_html__('Center', 'bopea'),
			'flex-end' => esc_html__('Right', 'bopea'),		
			)
		)
	);
	
	$wp_customize->add_setting(
	'home_hide_head_below',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	'home_hide_head_below',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Hide on home page','bopea'),
		'type'      => 'checkbox'
	)
	);
	
	$wp_customize->add_setting(
	'archives_hide_head_below',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	'archives_hide_head_below',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Hide on archives page','bopea'),
		'type'      => 'checkbox'
	)
	);
	
	$wp_customize->add_setting(
	'pages_hide_head_below',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	'pages_hide_head_below',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Hide on pages','bopea'),
		'type'      => 'checkbox'
	)
	);
	
	$wp_customize->add_setting(
	'posts_hide_head_below',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	'posts_hide_head_below',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Hide on posts','bopea'),
		'type'      => 'checkbox'
	)
	);
	
	$wp_customize->add_setting(
	'bopea_ads_head_below',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'wp_kses_post',
	)
	);
	$wp_customize->add_control(
	'bopea_ads_head_below',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Header Below Ads','bopea'),
		'description' => esc_html__( 'Only shortcodes[]/HTML code is allowed here','bopea'),
		'type'      => 'textarea'
	)
	);

	/*footer above*/
$wp_customize->add_setting(
	'bopea_opt_ads_footer_above',
	array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	new bopea_Customize_Control_Title (
		$wp_customize,
		'bopea_opt_ads_footer_above',
		array(
			'label'         => esc_html__( 'Footer Above Ads Settings', 'bopea' ),			
			'section'       => 'bopea_ads_setting',
			'settings'      => 'bopea_opt_ads_footer_above',
		)
	)
	);
	
	$wp_customize->add_setting(
		'home_align_footer_above',
		array(
			'default'    =>  'center',
			'transport'  =>  'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'home_align_footer_above',
		array(
			'section'   => 'bopea_ads_setting',
			'label'     => esc_html__('Ads align','bopea'),
			'type'      => 'select',
			'choices'	=> array(
			'flex-start' => esc_html__('Left', 'bopea'),
			'center' => esc_html__('Center', 'bopea'),
			'flex-end' => esc_html__('Right', 'bopea'),		
			)
		)
	);
	
	$wp_customize->add_setting(
	'home_hide_footer_above',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	'home_hide_footer_above',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Hide on home page','bopea'),
		'type'      => 'checkbox'
	)
	);
	
	$wp_customize->add_setting(
	'archives_hide_footer_above',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	'archives_hide_footer_above',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Hide on archives page','bopea'),
		'type'      => 'checkbox'
	)
	);
	
	$wp_customize->add_setting(
	'pages_hide_footer_above',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	'pages_hide_footer_above',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Hide on pages','bopea'),
		'type'      => 'checkbox'
	)
	);
	
	$wp_customize->add_setting(
	'posts_hide_footer_above',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	'posts_hide_footer_above',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Hide on posts','bopea'),
		'type'      => 'checkbox'
	)
	);
	
	$wp_customize->add_setting(
	'bopea_ads_footer_above',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'wp_kses_post',
	)
	);
	$wp_customize->add_control(
	'bopea_ads_footer_above',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Footer Above Ads','bopea'),
		'description' => esc_html__( 'Only shortcodes[]/HTML code is allowed here','bopea'),
		'type'      => 'textarea'
	)
	);

	
	/*footer below*/
$wp_customize->add_setting(
	'bopea_opt_ads_footer_below',
	array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	new bopea_Customize_Control_Title (
		$wp_customize,
		'bopea_opt_ads_footer_below',
		array(
			'label'         => esc_html__( 'Footer Below Ads Settings', 'bopea' ),			
			'section'       => 'bopea_ads_setting',
			'settings'      => 'bopea_opt_ads_footer_below',
		)
	)
	);
	
	$wp_customize->add_setting(
		'home_align_footer_below',
		array(
			'default'    =>  'center',
			'transport'  =>  'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'home_align_footer_below',
		array(
			'section'   => 'bopea_ads_setting',
			'label'     => esc_html__('Ads align','bopea'),
			'type'      => 'select',
			'choices'	=> array(
			'flex-start' => esc_html__('Left', 'bopea'),
			'center' => esc_html__('Center', 'bopea'),
			'flex-end' => esc_html__('Right', 'bopea'),		
			)
		)
	);
	
	$wp_customize->add_setting(
	'home_hide_footer_below',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	'home_hide_footer_below',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Hide on home page','bopea'),
		'type'      => 'checkbox'
	)
	);
	
	$wp_customize->add_setting(
	'archives_hide_footer_below',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	'archives_hide_footer_below',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Hide on archives page','bopea'),
		'type'      => 'checkbox'
	)
	);
	
	$wp_customize->add_setting(
	'pages_hide_footer_below',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	'pages_hide_footer_below',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Hide on pages','bopea'),
		'type'      => 'checkbox'
	)
	);
	
	$wp_customize->add_setting(
	'posts_hide_footer_below',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	'posts_hide_footer_below',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Hide on posts','bopea'),
		'type'      => 'checkbox'
	)
	);
	
	$wp_customize->add_setting(
	'bopea_ads_footer_below',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'wp_kses_post',
	)
	);
	$wp_customize->add_control(
	'bopea_ads_footer_below',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Footer Below Ads','bopea'),
		'description' => esc_html__( 'Only shortcodes[]/HTML code is allowed here','bopea'),
		'type'      => 'textarea'
	)
	);

	/*single post above content*/
$wp_customize->add_setting(
	'bopea_opt_ads_single_content_above',
	array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	new bopea_Customize_Control_Title (
		$wp_customize,
		'bopea_opt_ads_single_content_above',
		array(
			'label'         => esc_html__( 'Single post above content', 'bopea' ),
			'section'       => 'bopea_ads_setting',
			'settings'      => 'bopea_opt_ads_single_content_above',
		)
	)
	);
	
	$wp_customize->add_setting(
		'home_align_single_content_above',
		array(
			'default'    =>  'center',
			'transport'  =>  'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'home_align_single_content_above',
		array(
			'section'   => 'bopea_ads_setting',
			'label'     => esc_html__('Ads align','bopea'),
			'type'      => 'select',
			'choices'	=> array(
			'flex-start' => esc_html__('Left', 'bopea'),
			'center' => esc_html__('Center', 'bopea'),
			'flex-end' => esc_html__('Right', 'bopea'),		
			)
		)
	);
	
	$wp_customize->add_setting(
	'bopea_ads_single_content_above',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'wp_kses_post',
	)
	);
	$wp_customize->add_control(
	'bopea_ads_single_content_above',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Single post above content ads','bopea'),
		'description' => esc_html__( 'Only shortcodes[]/HTML code is allowed here','bopea'),
		'type'      => 'textarea'
	)
	);

/*single post below content*/
$wp_customize->add_setting(
	'bopea_opt_ads_single_content_below',
	array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	new bopea_Customize_Control_Title (
		$wp_customize,
		'bopea_opt_ads_single_content_below',
		array(
			'label'         => esc_html__( 'Single post below content', 'bopea' ),
			'section'       => 'bopea_ads_setting',
			'settings'      => 'bopea_opt_ads_single_content_below',
		)
	)
	);
	
	$wp_customize->add_setting(
		'home_align_single_content_below',
		array(
			'default'    =>  'center',
			'transport'  =>  'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'home_align_single_content_below',
		array(
			'section'   => 'bopea_ads_setting',
			'label'     => esc_html__('Ads align','bopea'),
			'type'      => 'select',
			'choices'	=> array(
			'flex-start' => esc_html__('Left', 'bopea'),
			'center' => esc_html__('Center', 'bopea'),
			'flex-end' => esc_html__('Right', 'bopea'),		
			)
		)
	);
	
	$wp_customize->add_setting(
	'bopea_ads_single_content_below',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'wp_kses_post',
	)
	);
	$wp_customize->add_control(
	'bopea_ads_single_content_below',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Single post below content ads','bopea'),
		'description' => esc_html__( 'Only shortcodes[]/HTML code is allowed here','bopea'),
		'type'      => 'textarea'
	)
	);
		
/*single post above author*/
$wp_customize->add_setting(
	'bopea_opt_ads_single_author_above',
	array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	new bopea_Customize_Control_Title (
		$wp_customize,
		'bopea_opt_ads_single_author_above',
		array(
			'label'         => esc_html__( 'Single post above author', 'bopea' ),
			'section'       => 'bopea_ads_setting',
			'settings'      => 'bopea_opt_ads_single_author_above',
		)
	)
	);
	
	$wp_customize->add_setting(
		'home_align_single_author_above',
		array(
			'default'    =>  'center',
			'transport'  =>  'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'home_align_single_author_above',
		array(
			'section'   => 'bopea_ads_setting',
			'label'     => esc_html__('Ads align','bopea'),
			'type'      => 'select',
			'choices'	=> array(
			'flex-start' => esc_html__('Left', 'bopea'),
			'center' => esc_html__('Center', 'bopea'),
			'flex-end' => esc_html__('Right', 'bopea'),		
			)
		)
	);
	
	$wp_customize->add_setting(
	'bopea_ads_single_author_above',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'wp_kses_post',
	)
	);
	$wp_customize->add_control(
	'bopea_ads_single_author_above',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Single post above author ads','bopea'),
		'description' => esc_html__( 'Only shortcodes[]/HTML code is allowed here','bopea'),
		'type'      => 'textarea'
	)
	);

/*single post below author*/
$wp_customize->add_setting(
	'bopea_opt_ads_single_author_below',
	array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	new bopea_Customize_Control_Title (
		$wp_customize,
		'bopea_opt_ads_single_author_below',
		array(
			'label'         => esc_html__( 'Single post below author', 'bopea' ),
			'section'       => 'bopea_ads_setting',
			'settings'      => 'bopea_opt_ads_single_author_below',
		)
	)
	);
	
	$wp_customize->add_setting(
		'home_align_single_author_below',
		array(
			'default'    =>  'center',
			'transport'  =>  'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'home_align_single_author_below',
		array(
			'section'   => 'bopea_ads_setting',
			'label'     => esc_html__('Ads align','bopea'),
			'type'      => 'select',
			'choices'	=> array(
			'flex-start' => esc_html__('Left', 'bopea'),
			'center' => esc_html__('Center', 'bopea'),
			'flex-end' => esc_html__('Right', 'bopea'),		
			)
		)
	);
	
	$wp_customize->add_setting(
	'bopea_ads_single_author_below',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'wp_kses_post',
	)
	);
	$wp_customize->add_control(
	'bopea_ads_single_author_below',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Single post below author ads','bopea'),
		'description' => esc_html__( 'Only shortcodes[]/HTML code is allowed here','bopea'),
		'type'      => 'textarea'
	)
	);

	/*single post above related*/
$wp_customize->add_setting(
	'bopea_opt_ads_single_related_above',
	array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	new bopea_Customize_Control_Title (
		$wp_customize,
		'bopea_opt_ads_single_related_above',
		array(
			'label'         => esc_html__( 'Single post above related post', 'bopea' ),
			'section'       => 'bopea_ads_setting',
			'settings'      => 'bopea_opt_ads_single_related_above',
		)
	)
	);
	
	$wp_customize->add_setting(
		'home_align_single_related_above',
		array(
			'default'    =>  'center',
			'transport'  =>  'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'home_align_single_related_above',
		array(
			'section'   => 'bopea_ads_setting',
			'label'     => esc_html__('Ads align','bopea'),
			'type'      => 'select',
			'choices'	=> array(
			'flex-start' => esc_html__('Left', 'bopea'),
			'center' => esc_html__('Center', 'bopea'),
			'flex-end' => esc_html__('Right', 'bopea'),		
			)
		)
	);
	
	$wp_customize->add_setting(
	'bopea_ads_single_related_above',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'wp_kses_post',
	)
	);
	$wp_customize->add_control(
	'bopea_ads_single_related_above',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Single post above related ads','bopea'),
		'description' => esc_html__( 'Only shortcodes[]/HTML code is allowed here','bopea'),
		'type'      => 'textarea'
	)
	);
	

	/*single post below related*/
$wp_customize->add_setting(
	'bopea_opt_ads_single_related_below',
	array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
	);
	$wp_customize->add_control(
	new bopea_Customize_Control_Title (
		$wp_customize,
		'bopea_opt_ads_single_related_below',
		array(
			'label'         => esc_html__( 'Single post below related post', 'bopea' ),
			'section'       => 'bopea_ads_setting',
			'settings'      => 'bopea_opt_ads_single_related_below',
		)
	)
	);
	
	$wp_customize->add_setting(
		'home_align_single_related_below',
		array(
			'default'    =>  'center',
			'transport'  =>  'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'home_align_single_related_below',
		array(
			'section'   => 'bopea_ads_setting',
			'label'     => esc_html__('Ads align','bopea'),
			'type'      => 'select',
			'choices'	=> array(
			'flex-start' => esc_html__('Left', 'bopea'),
			'center' => esc_html__('Center', 'bopea'),
			'flex-end' => esc_html__('Right', 'bopea'),		
			)
		)
	);
	
	$wp_customize->add_setting(
	'bopea_ads_single_related_below',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'wp_kses_post',
	)
	);
	$wp_customize->add_control(
	'bopea_ads_single_related_below',
	array(
		'section'   => 'bopea_ads_setting',
		'label'     => esc_html__('Single post below related ads','bopea'),
		'description' => esc_html__( 'Only shortcodes[]/HTML code is allowed here','bopea'),
		'type'      => 'textarea'
	)
	);

	/*Cookie*/
	$wp_customize->add_section(
		    'bopea_cookie_setting',
		    array(
		        'title'     => esc_html__('Cookie Settings', 'bopea'),
		        'priority'  => 1,
		        'panel' => 'bopea_theme_options'
		    )
	);

	$wp_customize->add_setting(
        'jl_cookie_enable',
        array(
            'default' => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jl_cookie_enable',
        array(
            'section'   => 'bopea_cookie_setting',
            'label'     => esc_html__('Enable Cookie','bopea'),
            'type'      => 'checkbox'
        )
    );

	$wp_customize->add_setting(
	    'jl_cookie_dec',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'wp_kses_post',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_dec',
	    array(
	        'section'   => 'bopea_cookie_setting',
	        'label'     => esc_html__('Cookie description','bopea'),
	        'type'      => 'textarea'
	    )
	);
	$wp_customize->add_setting(
	    'jl_cookie_btn',
	    array(
	        'default'    =>  esc_attr__( 'Accept', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_btn',
	    array(
	        'section'   => 'bopea_cookie_setting',
	        'label'     => esc_html__('Cookie button','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_cookie_wdith',
	    array(
	        'default'    =>  esc_attr__( '600px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_wdith',
	    array(
	        'section'   => 'bopea_cookie_setting',
	        'label'     => esc_html__('Cookie width Ex: 600px;','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_cookie_pos',
	    array(
	        'default'    =>  esc_attr__( 'center', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_pos',
	    array(
	        'section'   => 'bopea_cookie_setting',
	        'label'     => esc_html__('Cookie position','bopea'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'center' => esc_html__('Center', 'bopea'),
	        	'flex-start' => esc_html__('Left', 'bopea'),
	        	'flex-end' => esc_html__('Right', 'bopea')
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_cookie_space',
	    array(
	        'default'    =>  esc_attr__( '10px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_space',
	    array(
	        'section'   => 'bopea_cookie_setting',
	        'label'     => esc_html__('Cookie space Ex: 12px;','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_cookie_radius',
	    array(
	        'default'    =>  esc_attr__( '10px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_radius',
	    array(
	        'section'   => 'bopea_cookie_setting',
	        'label'     => esc_html__('Cookie radius Ex: 12px;','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_cookie_padding',
	    array(
	        'default'    =>  esc_attr__( '10px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_padding',
	    array(
	        'section'   => 'bopea_cookie_setting',
	        'label'     => esc_html__('Cookie padding Ex: 10px;','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_cookie_dec_size',
	    array(
	        'default'    =>  esc_attr__( '13px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_dec_size',
	    array(
	        'section'   => 'bopea_cookie_setting',
	        'label'     => esc_html__('Cookie font size Ex: 12px;','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_cookie_btn_size',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_btn_size',
	    array(
	        'section'   => 'bopea_cookie_setting',
	        'label'     => esc_html__('Cookie button font size Ex: 12px;','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_cookie_btn_radius',
	    array(
	        'default'    =>  esc_attr__( '5px', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_btn_radius',
	    array(
	        'section'   => 'bopea_cookie_setting',
	        'label'     => esc_html__('Cookie button radius Ex: 12px;','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_cookie_btn_space',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_btn_space',
	    array(
	        'section'   => 'bopea_cookie_setting',
	        'label'     => esc_html__('Cookie button letter spacing Ex: 0.03em','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_cookie_btn_tranform',
	    array(
	        'default'    =>  esc_attr__( 'capitalize', 'bopea' ),
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_btn_tranform',
	    array(
	        'section'   => 'bopea_cookie_setting',
	        'label'     => esc_html__('Cookie button transform','bopea'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'bopea'),
	        	'capitalize' => esc_html__('Capitalize', 'bopea'),
	        	'uppercase' => esc_html__('Uppercase', 'bopea')
	        )
	    )
	);

/*Optimize / SEO*/
	$wp_customize->add_section(
		    'bopea_optimize_setting',
		    array(
		        'title'     => esc_html__('Optimize / SEO Settings', 'bopea'),
		        'priority'  => 1,
		        'panel' => 'bopea_theme_options'
		    )
	);

	$wp_customize->add_setting(
        'jl_opt_google_font',
        array(
            'default' => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jl_opt_google_font',
        array(
            'section'   => 'bopea_optimize_setting',
            'label'     => esc_html__('Preload Google Fonts','bopea'),
            'type'      => 'checkbox'
        )
    );    

    $wp_customize->add_setting(
        'jl_opt_dashicons',
        array(
            'default' => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jl_opt_dashicons',
        array(
            'section'   => 'bopea_optimize_setting',
            'label'     => esc_html__('Disable Dashicons','bopea'),
            'type'      => 'checkbox'
        )
    );

    $wp_customize->add_setting(
        'jl_opt_polyfill',
        array(
            'default' => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jl_opt_polyfill',
        array(
            'section'   => 'bopea_optimize_setting',
            'label'     => esc_html__('Disable Polyfill','bopea'),
            'type'      => 'checkbox'
        )
    );

    $wp_customize->add_setting(
        'jl_opt_woo_block',
        array(
            'default' => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jl_opt_woo_block',
        array(
            'section'   => 'bopea_optimize_setting',
            'label'     => esc_html__('Disable WooCommerce Block Style','bopea'),
            'type'      => 'checkbox'
        )
    );

    $wp_customize->add_setting(
        'jl_opt_gutenberg',
        array(
            'default' => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jl_opt_gutenberg',
        array(
            'section'   => 'bopea_optimize_setting',
            'label'     => esc_html__('Disable Gutenberg Style','bopea'),
            'type'      => 'checkbox'
        )
    );

	$wp_customize->add_setting(
        'jl_opt_lazy_img',
        array(
            'default' => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jl_opt_lazy_img',
        array(
            'section'   => 'bopea_optimize_setting',
            'label'     => esc_html__('Disable lazy load images','bopea'),
            'type'      => 'checkbox'
        )
    );

	$wp_customize->add_setting(
        'bopea_seo_sec_options',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new bopea_Customize_Control_Title (
            $wp_customize,
            'bopea_seo_sec_options',
            array(
                'label'         => esc_html__( 'SEO', 'bopea' ),
                'section'       => 'bopea_optimize_setting',
                'settings'      => 'bopea_seo_sec_options',
            )
        )
    );

	$wp_customize->add_setting(
        'jl_opt_h1_home',
        array(
            'default' => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jl_opt_h1_home',
        array(
            'section'   => 'bopea_optimize_setting',
            'label'     => esc_html__('Disable H1 logo','bopea'),
            'type'      => 'checkbox'
        )
    );

	$wp_customize->add_setting(
        'jl_opt_seo',
        array(
            'default' => false,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jl_opt_seo',
        array(
            'section'   => 'bopea_optimize_setting',
            'label'     => esc_html__('Disable Open Graph Meta','bopea'),
            'type'      => 'checkbox'
        )
    );

	$wp_customize->add_setting(
	    'jl_seo_twiter_name',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_seo_twiter_name',
	    array(
	        'section'   => 'bopea_optimize_setting',
	        'label'     => esc_html__('SEO Twiter creator name','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_seo_twiter_label',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_seo_twiter_label',
	    array(
	        'section'   => 'bopea_optimize_setting',
	        'label'     => esc_html__('SEO Twiter label','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_seo_fb_app_id',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_seo_fb_app_id',
	    array(
	        'section'   => 'bopea_optimize_setting',
	        'label'     => esc_html__('Facebook APP ID','bopea'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
		'bopea_seo_img',
		array(
		'default' 			=> '',
		'transport'   		=> 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
			$wp_customize,
			'bopea_seo_img',
			array(
			'label'    => esc_html__( 'Fallback Open Graph Image', 'bopea' ),
			'section'  => 'bopea_optimize_setting',
			'settings' => 'bopea_seo_img'
		)));


/*AMP*/
$wp_customize->add_section(
	'bopea_amp_setting',
	array(
		'title'     => esc_html__('AMP Settings', 'bopea'),
		'priority'  => 1,
		'panel' => 'bopea_theme_options'
	)
);

$wp_customize->add_setting(
'amp_head_logo',
array(
'default' 			=> '',
'transport'   		=> 'refresh',
'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control(
new WP_Customize_Image_Control(
$wp_customize,
'amp_head_logo',
array(
'label'    => esc_html__( 'Header logo', 'bopea' ),
'section'  => 'bopea_amp_setting',
'settings' => 'amp_head_logo'
)));

$wp_customize->add_setting(
'amp_foot_logo',
array(
'default' 			=> '',
'transport'   		=> 'refresh',
'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control(
new WP_Customize_Image_Control(
$wp_customize,
'amp_foot_logo',
array(
'label'    => esc_html__( 'Footer logo', 'bopea' ),
'section'  => 'bopea_amp_setting',
'settings' => 'amp_foot_logo'
)));

$wp_customize->add_setting(
	'amp_head_logo_width',
	array(
		'default'    =>  esc_attr__( '110px', 'bopea' ),
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'amp_head_logo_width',
	array(
		'section'   => 'bopea_amp_setting',
		'label'     => esc_html__('Logo width EX: 100px','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'amp_footer_logo_width',
	array(
		'default'    =>  esc_attr__( '110px', 'bopea' ),
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'amp_footer_logo_width',
	array(
		'section'   => 'bopea_amp_setting',
		'label'     => esc_html__('Footer logo width EX: 100px','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
'amp_head_bg',
array(
	'default'    =>  esc_attr__( '#000', 'bopea' ),
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
new bopea_alpha_color(
	$wp_customize,
	'amp_head_bg',
	array(
		'label'      => esc_html__( 'Header background color', 'bopea' ),
		'section'    => 'bopea_amp_setting',
		'settings'   => 'amp_head_bg'
	)
)
);

$wp_customize->add_setting(
'amp_head_color',
array(
	'default'    =>  esc_attr__( '#FFF', 'bopea' ),
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
new bopea_alpha_color(
	$wp_customize,
	'amp_head_color',
	array(
		'label'      => esc_html__( 'Header color', 'bopea' ),
		'section'    => 'bopea_amp_setting',
		'settings'   => 'amp_head_color'
	)
)
);

$wp_customize->add_setting(
'amp_content_bg',
array(
	'default'    =>  esc_attr__( '#FFF', 'bopea' ),
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
new bopea_alpha_color(
	$wp_customize,
	'amp_content_bg',
	array(
		'label'      => esc_html__( 'Contetn background color', 'bopea' ),
		'section'    => 'bopea_amp_setting',
		'settings'   => 'amp_content_bg'
	)
)
);

$wp_customize->add_setting(
'amp_content_color',
array(
	'default'    =>  esc_attr__( '#000', 'bopea' ),
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
new bopea_alpha_color(
	$wp_customize,
	'amp_content_color',
	array(
		'label'      => esc_html__( 'Contetn color', 'bopea' ),
		'section'    => 'bopea_amp_setting',
		'settings'   => 'amp_content_color'
	)
)
);

$wp_customize->add_setting(
'amp_content_link',
array(
	'default'    =>  esc_attr__( '#f00', 'bopea' ),
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
new bopea_alpha_color(
	$wp_customize,
	'amp_content_link',
	array(
		'label'      => esc_html__( 'Content link color', 'bopea' ),
		'section'    => 'bopea_amp_setting',
		'settings'   => 'amp_content_link'
	)
)
);

$wp_customize->add_setting(
'amp_footer_bg',
array(
	'default'    =>  esc_attr__( '#000', 'bopea' ),
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
new bopea_alpha_color(
	$wp_customize,
	'amp_footer_bg',
	array(
		'label'      => esc_html__( 'Footer background color', 'bopea' ),
		'section'    => 'bopea_amp_setting',
		'settings'   => 'amp_footer_bg'
	)
)
);

$wp_customize->add_setting(
'amp_footer_color',
array(
	'default'    =>  esc_attr__( '#FFF', 'bopea' ),
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
new bopea_alpha_color(
	$wp_customize,
	'amp_footer_color',
	array(
		'label'      => esc_html__( 'Footer color', 'bopea' ),
		'section'    => 'bopea_amp_setting',
		'settings'   => 'amp_footer_color'
	)
)
);

$wp_customize->add_setting(
'amp_footer_link',
array(
	'default'    =>  esc_attr__( '#f00', 'bopea' ),
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
new bopea_alpha_color(
	$wp_customize,
	'amp_footer_link',
	array(
		'label'      => esc_html__( 'Footer link color', 'bopea' ),
		'section'    => 'bopea_amp_setting',
		'settings'   => 'amp_footer_link'
	)
)
);

$wp_customize->add_setting(
'amp_sidebar_bg',
array(
	'default'    =>  esc_attr__( '#111', 'bopea' ),
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
new bopea_alpha_color(
	$wp_customize,
	'amp_sidebar_bg',
	array(
		'label'      => esc_html__( 'Sidebar background color', 'bopea' ),
		'section'    => 'bopea_amp_setting',
		'settings'   => 'amp_sidebar_bg'
	)
)
);

$wp_customize->add_setting(
'amp_sidebar_color',
array(
	'default'    =>  esc_attr__( '#FFF', 'bopea' ),
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
new bopea_alpha_color(
	$wp_customize,
	'amp_sidebar_color',
	array(
		'label'      => esc_html__( 'Sidebar color', 'bopea' ),
		'section'    => 'bopea_amp_setting',
		'settings'   => 'amp_sidebar_color'
	)
)
);

$wp_customize->add_setting(
'amp_sidebar_link',
array(
	'default'    =>  esc_attr__( '#FFF', 'bopea' ),
	'transport'   => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
)
);
$wp_customize->add_control(
new bopea_alpha_color(
	$wp_customize,
	'amp_sidebar_link',
	array(
		'label'      => esc_html__( 'Sidebar link color', 'bopea' ),
		'section'    => 'bopea_amp_setting',
		'settings'   => 'amp_sidebar_link'
	)
)
);

$wp_customize->add_setting(
	'hide_amp_related',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'hide_amp_related',
	array(
		'section'   => 'bopea_amp_setting',
		'label'     => esc_html__('Disable related posts','bopea'),
		'type'      => 'checkbox'
	)
);

$wp_customize->add_setting(
	'amp_copyright',
	array(
		'transport'  =>  'refresh',
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	'amp_copyright',
	array(
		'section'   => 'bopea_amp_setting',
		'label'     => esc_html__('Footer copyright','bopea'),
		'type'      => 'textarea'
	)
);


/*Theme string*/
$wp_customize->add_section(
	'bopea_string_setting',
	array(
		'title'     => esc_html__('Theme Strings', 'bopea'),
		'priority'  => 1,
		'panel' => 'bopea_theme_options'
	)
);

$wp_customize->add_setting(
	'bopea_s_home',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_home',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Home','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_load_more',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_load_more',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Load More','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_by',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_by',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('By','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_updated',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_updated',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Updated','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_ago',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_ago',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Ago','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_min',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_min',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('min','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_mins',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_mins',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('mins','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_hour',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_hour',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('hour','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_hours',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_hours',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('hours','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_day',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_day',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('day','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_days',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_days',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('days','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_week',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_week',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('week','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_weeks',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_weeks',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('weeks','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_month',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_month',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('month','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_months',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_months',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('months','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_year',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_year',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('year','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_mins_read',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_mins_read',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Mins read','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_views',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_views',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Views','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_previous_post',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_previous_post',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Previous post','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_next_post',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_next_post',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Next post','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_via',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_via',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Via','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_soruce',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_soruce',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Sources','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_summary',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_summary',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Summary','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_the_pros',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_the_pros',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('The Pros','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_the_cons',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_the_cons',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('The Cons','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_share',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_share',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Share','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_tweet',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_tweet',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Tweet','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_pin',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_pin',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Pin','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_written_by',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_written_by',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Written by','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_comments',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_comments',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Comments','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_comment',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_comment',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Comment','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_old_comment',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_old_comment',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Older Comments','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_new_comment',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_new_comment',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Newer Comments','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_comment_closed',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_comment_closed',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Comments are closed','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_leave_a_comment',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_leave_a_comment',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Leave a comment','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_your_name',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_your_name',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Your name','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_your_email',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_your_email',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Your email','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_your_website',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_your_website',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Your Website','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_related_articles',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_related_articles',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Related Articles','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_type_to_search',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_type_to_search',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Type to search...','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_articles',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_articles',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Articles','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_search',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_search',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Search','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_search_result_for',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_search_result_for',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Search Result for','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_404_title',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_404_title',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Oops! This page can’t be found','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_404_desc',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_404_desc',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('The page you are looking for doesn’t exist. It may have been moved or removed. Please try searching for some other page.','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_back_to_home',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_back_to_home',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Back to Home','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_filter_products',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_filter_products',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Filter Products','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_clear_filter',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_clear_filter',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Clear filters','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_shop',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_shop',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Shop','bopea'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'bopea_s_sponsored_by',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'bopea_s_sponsored_by',
	array(
		'section'   => 'bopea_string_setting',
		'label'     => esc_html__('Sponsored By','bopea'),
		'type'      => 'text'
	)
);


$wp_customize->remove_section( 'colors' );
$wp_customize->remove_section( 'background_image' );
}
add_action( 'customize_register', 'bopea_register_theme_customizer', 110 );