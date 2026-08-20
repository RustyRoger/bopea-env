<?php
add_action( 'init', array( 'bopea_Nav_Menu_Item_Custom_Fields', 'setup' ) );
class bopea_Nav_Menu_Item_Custom_Fields {
	static $options = array();
	static function setup() {
		$args = array(
			'post_type'     => 'jl_layout',
			'post_status'   => array( 'publish' ),
			'numberposts'   => -1,
			'orderby'       => 'title',
			'order'         => 'ASC',
			'suppress_filters'   => false
	   );
	   $megamenus = get_posts($args);
	   $jl_megamenus = array();
	   $jl_megamenus['none'] = esc_html__( 'None', 'bopea' );
	   
	   if(!empty($megamenus)){
		   foreach ($megamenus as $megamenu){
			   $jl_megamenus[$megamenu->ID] = $megamenu->post_title;
		   }
	   }

		self::$options['fields'] = array(
			'mega_menu_sidebar' => array(
				'name' => 'mega_menu_sidebar',
				'label' => esc_html__('Layout builder (custom display mega menu)', 'bopea'),
				'container_class' => '',
				'input_type' => 'select',
				'options' => $jl_megamenus,
			),
			'mega_menu' => array(
				'name' => 'mega_menu',
				'label' => esc_html__('Use Menu Category Post', 'bopea'),
				'container_class' => '',
				'input_type' => 'checkbox',
			),
			'mega_layout' => array(
				'name' => 'mega_layout',
				'label' => esc_html__('Post Layouts', 'bopea'),
				'container_class' => '',
				'input_type' => 'select',
				'options' => array (
						'mega_grid' => esc_html__('Post Grid', 'bopea'),
						'mega_grid_overlay' => esc_html__('Post Grid Overlay', 'bopea'),
						'mega_small_list' => esc_html__('Post Small list', 'bopea')
				)
			),			
			'mega_num_post' => array(
				'name' => 'mega_num_post',
				'label' => esc_html__('Number Post', 'bopea'),
				'container_class' => '',
				'input_type' => 'select',
				'options' => array (
						'2' => esc_html__('2 post', 'bopea'),
						'3' => esc_html__('3 post', 'bopea'),
						'4' => esc_html__('4 post', 'bopea'),
						'5' => esc_html__('5 post', 'bopea'),
						'6' => esc_html__('6 post', 'bopea'),
						'7' => esc_html__('7 post', 'bopea'),
						'8' => esc_html__('8 post', 'bopea'),
						'9' => esc_html__('9 post', 'bopea'),
						'10' => esc_html__('10 post', 'bopea'),
						'11' => esc_html__('11 post', 'bopea'),
						'12' => esc_html__('12 post', 'bopea'),
						'13' => esc_html__('13 post', 'bopea'),
						'14' => esc_html__('14 post', 'bopea'),
						'15' => esc_html__('15 post', 'bopea'),
						'16' => esc_html__('16 post', 'bopea'),
						'17' => esc_html__('17 post', 'bopea'),
						'18' => esc_html__('18 post', 'bopea'),
						'19' => esc_html__('19 post', 'bopea'),
						'20' => esc_html__('20 post', 'bopea'),
				)
			),
			'mega_columns' => array(
				'name' => 'mega_columns',
				'label' => esc_html__('Post Columns', 'bopea'),
				'container_class' => '',
				'input_type' => 'select',
				'options' => array (
						'2' => esc_html__('2 Columns', 'bopea'),
						'3' => esc_html__('3 Columns', 'bopea'),
						'4' => esc_html__('4 Columns', 'bopea'),
						'5' => esc_html__('5 Columns', 'bopea'),
						'6' => esc_html__('6 Columns', 'bopea'),
				)
			),
			'jl_label_menu' => array(
				'name' => 'jl_label_menu',
				'label' => esc_html__('Label Menu', 'bopea'),
				'container_class' => '',
				'input_type' => 'text',
			),
			'jl_label_color' => array(
				'name' => 'jl_label_color',
				'label' => esc_html__('Label background color', 'bopea'),
				'container_class' => '',
				'input_type' => 'color_pick',
			),
			'jl_label_text' => array(
				'name' => 'jl_label_text',
				'label' => esc_html__('Label text color', 'bopea'),
				'container_class' => '',
				'input_type' => 'color_pick',
			),			
		);

		add_filter( 'jellywp_nav_menu_item_additional_fields', array( __CLASS__, '_add_fields' ), 10, 5 );
		add_action( 'save_post', array( __CLASS__, '_save_post' ) );
	}

	static function get_fields_schema() {
		$schema = array();
		foreach(self::$options['fields'] as $name => $field) {
			if (empty($field['name'])) {
				$field['name'] = $name;
			}
			$schema[] = $field;
		}
		return $schema;
	}

	static function get_menu_item_postmeta_key($name) {
		return 'pp_menu_item_' . $name;
	}

	static function _add_fields($new_fields, $item_output, $item, $depth, $args) {
		$schema = self::get_fields_schema($item->ID);
		$new_fields = '';
		foreach($schema as $field) {
			$field['value'] = get_post_meta($item->ID, self::get_menu_item_postmeta_key($field['name']), true);			
			$field['id'] = $item->ID;			
			switch($field['input_type']){
				case 'text':
					$lbl_value = '';
					if(!empty($field['value'])){$lbl_value= $field['value'];}
					$new_fields.= '<p style="display: none;" class="additional-menu-field-'.$field['name'].' description description-wide">';
					$new_fields.= '<label for="edit-menu-item-'.$field['name'].'-'.$field['id'].'">'.$field['label'].'</label><br><input type="text" id="edit-menu-item-'.$field['name'].'-'.$field['id'].'" class="edit-menu-item-'.$field['name'].'" name="menu-item-'.$field['name'].'['.$field['id'].']" value="'.$lbl_value.'"';															
					$new_fields.= '>';
					$new_fields.= '</p>';
				break;
				case 'color_pick':
					$lbl_value = '';
					if(!empty($field['value'])){$lbl_value= $field['value'];}
					$new_fields.= '<p style="display: none;" class="additional-menu-field-'.$field['name'].' description description-wide">';
					$new_fields.= '<label for="edit-menu-item-'.$field['name'].'-'.$field['id'].'">'.$field['label'].'</label><br><input type="text" id="edit-menu-item-'.$field['name'].'-'.$field['id'].'" class="colorpicker edit-menu-item-'.$field['name'].'" name="menu-item-'.$field['name'].'['.$field['id'].']" value="'.$lbl_value.'"';															
					$new_fields.= '>';
					$new_fields.= '</p>';
				break;
				case 'checkbox':
					$new_fields.= '<p style="display: none;" class="additional-menu-field-'.$field['name'].' description description-wide">';
					$new_fields.= '<input type="checkbox" id="edit-menu-item-'.$field['name'].'-'.$field['id'].'" class="edit-menu-item-'.$field['name'].'" name="menu-item-'.$field['name'].'['.$field['id'].']" value="1"';
					
					if(!empty($field['value'])){
						$new_fields.= 'checked';
					}					
					$new_fields.= '>&nbsp;';
					$new_fields.= '<label for="edit-menu-item-'.$field['name'].'-'.$field['id'].'">'.$field['label'].'</label></p>';
				break;
				case 'select':
					$new_fields.= '<p style="display: none;" class="additional-menu-field-'.$field['name'].' description description-wide">';
					$new_fields.= '<label for="edit-menu-item-'.$field['name'].'-'.$field['id'].'">'.$field['label'].'</label><br>';
					$new_fields.= '<select id="edit-menu-item-'.$field['name'].'-'.$field['id'].'" class="edit-menu-item-'.$field['name'].'" name="menu-item-'.$field['name'].'['.$field['id'].']">';
					if(!empty($field['options'])){
						foreach($field['options']  as $key => $option){
							$new_fields.= '<option value="'.$key.'" ';							
							if($key==$field['value']){
								$new_fields.= 'selected';
							}							
							$new_fields.= '>'.$option.'</option>';
						}
					}					
					$new_fields.= '</select></p>';
				break;
			}
		}
		return $new_fields;
	}

	static function _save_post($post_id) {
		if (get_post_type($post_id) !== 'nav_menu_item') {
			return;
		}
		$fields_schema = self::get_fields_schema($post_id);
		foreach($fields_schema as $field_schema) {
			$form_field_name = 'menu-item-' . $field_schema['name'];
			if (isset($_POST[$form_field_name][$post_id])) {
				$key = self::get_menu_item_postmeta_key($field_schema['name']);
				$value = stripslashes($_POST[$form_field_name][$post_id]);
				update_post_meta($post_id, $key, $value);
			}else{
				$key = self::get_menu_item_postmeta_key($field_schema['name']);
				update_post_meta($post_id, $key, '');
			}
		}
	}
}

add_filter( 'wp_edit_nav_menu_walker', 'custom_nav_edit_walker',10,2 );
function custom_nav_edit_walker() {
    return 'jellywp_Walker_Nav_Menu_Edit';
}

require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
class jellywp_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$item_output = '';
		parent::start_el($item_output, $item, $depth, $args);
		$new_fields = apply_filters( 'jellywp_nav_menu_item_additional_fields', '', $item_output, $item, $depth, $args );
		if ($new_fields) {
			$item_output = preg_replace('/(?=<div[^>]+class="[^"]*submitbox)/', $new_fields, $item_output);
		}
		$output .= $item_output;
	}
}

class jellywp_walker extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= '<ul class="sub-menu">';
	}
 
	function end_lvl(&$output, $depth = 0, $args = array()) {
		$output .= '</ul>';
	}
 
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$atts_styles = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes; 		
		$obj_jellywp_nav = new bopea_Nav_Menu_Item_Custom_Fields();
		$mega_menu_sidebar = get_post_meta($item->ID, $obj_jellywp_nav->get_menu_item_postmeta_key('mega_menu_sidebar'), true);
		$use_mega_menu = get_post_meta($item->ID, $obj_jellywp_nav->get_menu_item_postmeta_key('mega_menu'), true);
		$use_lbl_text  = get_post_meta($item->ID, $obj_jellywp_nav->get_menu_item_postmeta_key('jl_label_menu'), true);
		$use_lbl_color = get_post_meta($item->ID, $obj_jellywp_nav->get_menu_item_postmeta_key('jl_label_color'), true);
		$jl_label_text = get_post_meta($item->ID, $obj_jellywp_nav->get_menu_item_postmeta_key('jl_label_text'), true);
		$mega_layout = get_post_meta($item->ID, $obj_jellywp_nav->get_menu_item_postmeta_key('mega_layout'), true);
		$mega_columns = get_post_meta($item->ID, $obj_jellywp_nav->get_menu_item_postmeta_key('mega_columns'), true);
		$mega_num_post = get_post_meta($item->ID, $obj_jellywp_nav->get_menu_item_postmeta_key('mega_num_post'), true);
		$megaclass ="";
		if(!empty($use_mega_menu)){
			$megaclass= "menupost mega-category-menu ";
		}
		if( !empty($mega_menu_sidebar) && $mega_menu_sidebar != 'none'){
			$megaclass= "menupost mega-category-menu ";
		}
		$data_ajax_filter = '';
		if ( 1 == $depth && ( 'category' == $item->object ) ) {
				if ( ! empty( $item->menu_item_parent ) ) {
					$parent_id              = $item->menu_item_parent;
					$enable_mega_cat_parent = get_post_meta($parent_id, $obj_jellywp_nav->get_menu_item_postmeta_key('mega_menu'), true);
					if ( ! empty( $enable_mega_cat_parent ) ) {
						$data_ajax_filter = ' ' . 'data-mega_sub_filter=' . '"' . esc_attr( $item->object_id ) . '"' . ' ';
					}
				};
			}			
		$atts_styles = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$atts_styles = ' class="' . esc_attr( $megaclass ) .''. esc_attr( $atts_styles ) . '"';
		$output .= $indent . '<li' . $value . $atts_styles  . $data_ajax_filter .'>';
		$attributes = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )	 ? ' target="' . esc_attr( $item->target	 ) .'"' : '';
		$attributes .= ! empty( $item->xfn )		? ' rel="'	. esc_attr( $item->xfn		) .'"' : '';
		$attributes .= ! empty( $item->url )		? ' href="'   . esc_attr( $item->url		) .'"' : '';			
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		if(!empty($use_lbl_text)){
			$lbl_bg      = 'style="background: #222 !important;"';
			$lbl_color	 = 'style="color: #FFF !important;"';
			if(!empty($jl_label_text)){
				$lbl_color = 'style="color: '.esc_attr($jl_label_text).' !important;"';
			}
			if(!empty($use_lbl_color)){
				$lbl_bg      = 'style="background: '.esc_attr($use_lbl_color).' !important;"';		
			}
			$item_output .= '<span class="jl_menu_lb" '. $lbl_color .'><span class="jl_lb_ar" '. $lbl_bg .'></span>'. esc_attr( $use_lbl_text ) .'</span>';
		}
		$item_output .= '</a>';

		if(!empty($use_mega_menu)){
			$item_output			     .= '<div class="sub-menu menu_post_feature jl-cus-mega-menu"><div class="jl_mega_inner">';
			$current_classes = $item->classes;
			$item_has_children = false;				
			if ( is_array( $current_classes ) ) {
				if ( in_array( 'menu-item-has-children', $current_classes ) ) {
					$item_has_children = true;
				}
			}
			if(!empty($mega_layout)){
				$mega_layout = $mega_layout;
			}else{
				$mega_layout= 'mega_grid';
			}
			if(!empty($mega_columns)){
				$mega_columns = $mega_columns;
			}else{
				$mega_columns= 2;
			}
			if(!empty($mega_num_post)){
				$mega_num_post = $mega_num_post;
			}else{
				$mega_num_post= 2;
			}			
				$item_output			 .= '<div class="jl_mega_contents">';
				$module              	  = array();
				$module ['category'] 	  = $item->object_id;
				$module['blockid'] 		  = 'block-mega-' . esc_attr( $item->ID );
				$module['pagination'] 	  = 'next_prev';
				$module['section_style']  = $mega_layout;
				$module['posts_cols'] 	  = $mega_columns;
				$module['posts_per_page'] = $mega_num_post;
				ob_start();
				echo bopea_menu_layout( $module );
				$item_output 			 .= ob_get_clean();
			$item_output			     .= '</div>';
		}
		if( !empty($mega_menu_sidebar) && $mega_menu_sidebar != 'none'){
			$item_has_children = false;			
			if ( false == $item_has_children ){
				$item_output.= '<div class="sub-menu menu_post_feature jl_megal_bw jl-cus-mega-menu"><div class="jl_megal_bu">';				
				$item_output.= do_shortcode( '[jl_layout id="' . esc_attr($mega_menu_sidebar) . '"]' );
				$item_output.= '</div></div>';				
			}	
		}
		$item_output					 .= $args->after;				
		$output 					     .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( &$output, $item, $depth = 0, $args = null ) {
		$obj_jellywp_nav = new bopea_Nav_Menu_Item_Custom_Fields();
		$use_mega_menu = get_post_meta($item->ID, $obj_jellywp_nav->get_menu_item_postmeta_key('mega_menu'), true);
		if(!empty($use_mega_menu)){
			$output			     .= '</div></div>';
		}		
	}
}
?>