<?php
/**********************************************************************************************************************************
*
* Custom Detail Fields Class
* This class prepared for help to create auto config file.
* Author: Webbu
*
***********************************************************************************************************************************/

/**
 * Custom Points Setup
 */
trait PointFinderCustomPointsTrait
{
    public $CDFoutput;
	public $GFoutput;
	
	public function GFPFSP($params = array()){

		$defaults = array( 
	        'fid' => '',
	        'ftitle' => '',
	        'fdesc' => '',
	        'ftype' => '',
	        'fdata' => array(),
	        'compiler' => '',
	        'mode' => 'color',
	        'options' => array(),
	    );

	    $params = array_merge($defaults, $params);

	    $fdata = $params['fdata'];
	    $fid = $params['fid'];
	    $ftitle = $params['ftitle'];
	    $fdesc = $params['fdesc'];
	    $ftype = $params['ftype'];
	    $compiler = $params['compiler'];
	    $mode = $params['mode'];
	    $options = $params['options'];


	    //Defaults
		if(empty($fdata['required'])){$fdata['required'] = '';};
		if(!isset($fdata['default'])){$fdata['default'] = '';}else{if(!is_int($fdata['default'])){$fdata['default'] = ''.$fdata['default'].'';}};
		if(empty($fdata['notice'])){$fdata['notice'] = '';};
		if(empty($fdata['style'])){$fdata['style'] = '';};
		if(empty($fdata['condition'])){$fdata['condition'] = '=';};
		if(!isset($fdata['required_condition_text'])){$fdata['required_condition_text'] = '1';};
				
		switch($ftype){
			case 'media':
				$field_output_arr = array(
					'id' => $fid,
					'title' => $ftitle,
					'type' => 'media',
					'desc' => $fdesc,
					'compiler' => $compiler
				);
				if($fdata['required'] != ''){

					$field_output_arr['required'] = array($fdata['required'], $fdata['condition'], $fdata['required_condition_text']);
					
				}
				$this->GFoutput = $field_output_arr;
				break;
			case 'color':
				$field_output_arr = array(
					'id' => $fid,
					'title' => $ftitle,
					'type' => 'color',
					'validate' => 'color',
					'desc' => $fdesc,
					'transparent'=>false,
					'compiler' => $compiler,
					'default' => $fdata['default'],
					'mode'=>$mode
				);
				if($fdata['required'] != ''){

					$field_output_arr['required'] = array($fdata['required'], $fdata['condition'], $fdata['required_condition_text']);
					
				}

				$this->GFoutput = $field_output_arr;

				break;

			case 'info':
				$this->GFoutput = array(
					'id' => $fid,
					'title' => $ftitle,
					'type' => 'info',
					'notice' => $fdata['notice'],
					'style' => $fdata['style'],
					'desc' => $fdesc,
					'compiler' => $compiler
				);
				break;
				
			case 'button_set':
				$field_output_arr = array(
					'id' => $fid,
					'title' => $ftitle,
					'desc' => $fdesc,
					'type' => $ftype,
					'default' => $fdata['default'],
					'options' => $options,
					'compiler' => $compiler
				);

				if($fdata['required'] != ''){

					$field_output_arr['required'] = array($fdata['required'], $fdata['condition'], $fdata['required_condition_text']);
					
				}

				$this->GFoutput = $field_output_arr;
				break;
			case 'textarea':
			case 'multi_text':
			case 'text':
			case 'extension_custom_icon':
				$field_output_arr = array(
					'id' => $fid,
					'title' => $ftitle,
					'type' => $ftype,
					'desc' => $fdesc,
					'default' => $fdata['default'],
					'compiler' => $compiler
				);

				if($fdata['required'] != ''){

					$field_output_arr['required'] = array($fdata['required'], $fdata['condition'], $fdata['required_condition_text']);
					
				}

				$this->GFoutput = $field_output_arr;
				break;
			
			case 'indentstart':
				$field_output_arr  = array(
						'id' => 'section-'.$fid.'-start',
						'type' => 'section',
						'indent' => true 
					);

				if($fdata['required'] != ''){

					$field_output_arr['required'] = array($fdata['required'], $fdata['condition'], $fdata['required_condition_text']);
					
				}
				$this->GFoutput = $field_output_arr;
				break;
			
			case 'indentend':
				$field_output_arr  = array(
						'id' => 'section-'.$fid.'-end',
						'type' => 'section',
						'indent' => false 
					);

				if($fdata['required'] != ''){

					$field_output_arr['required'] = array($fdata['required'], $fdata['condition'], $fdata['required_condition_text']);
					
				}
				$this->GFoutput = $field_output_arr;

				break;
				

		}
		
		return $this->GFoutput;
	
	}
	
	public function PFGetDefaultFieldValuesofThisCS($slug,$field){
		
		$this_field_arr = 
		array(
			array(
				'fid' => 'pscp_'.$slug.'_type',
				'ftitle' =>	esc_html__('Point Type','pointfindercoreelements'),
				'ftype' => 'button_set',
				'fdesc' => '<strong>'.esc_html__('IMPORTANT : ','pointfindercoreelements').'</strong>'.esc_html__('Please change a color value at least for generate dynamic point styles.','pointfindercoreelements'),
				'fdata' => array('default'=>'0'),
				'options' => array(1 => esc_html__('Custom Image','pointfindercoreelements'), 0 => esc_html__('Predefined Icon','pointfindercoreelements')),
			),
			array(
				'fid' => 'pscp_'.$slug.'iconc',
				'ftype' => 'indentstart',
				'fdata' => array('required'=>'pscp_'.$slug.'_type')
			),
				
				array(
					'fid' => 'pscp_'.$slug.'_bgimage',
					'ftitle' =>	esc_html__('Point Image','pointfindercoreelements'),
					'ftype' => 'media',
					'fdata' => array('required'=>'pscp_'.$slug.'_type')
				),
			array(
				'fid' => 'pscp_'.$slug.'iconc',
				'ftype' => 'indentend',
				'fdata' => array('required'=>'pscp_'.$slug.'_type')
			),

			array(
				'fid' => 'pscp_'.$slug.'icon',
				'ftype' => 'indentstart',
				'fdata' => array('required'=>'pscp_'.$slug.'_type','condition'=>'!=')
			),
				array(
					'fid' => 'pscp_'.$slug.'_icontype',
					'ftitle' =>	esc_html__('Point Icon Type','pointfindercoreelements'),
					'compiler' => true,
					'ftype' => 'button_set',
					'options' => array(1 => esc_html__('Round','pointfindercoreelements'), 2 => esc_html__('Square','pointfindercoreelements'),3 => esc_html__('Dot','pointfindercoreelements')),
					'fdata' => array('default'=>1,'required'=>'pscp_'.$slug.'_type','condition'=>'!=')
				),
				array(
					'fid' => 'pscp_'.$slug.'_iconsize',
					'ftitle' =>	esc_html__('Point Icon Size','pointfindercoreelements'),
					'compiler' => true,
					'ftype' => 'button_set',
					'options' => array('small' => esc_html__('Small','pointfindercoreelements'), 'middle' => esc_html__('Middle','pointfindercoreelements'), 'large' => esc_html__('Large','pointfindercoreelements'), 'xlarge' => esc_html__('X-Large','pointfindercoreelements')),
					'fdata' => array('default'=>'middle','required'=>'pscp_'.$slug.'_type','condition'=>'!=')
				),
				array(
					'fid' => 'pscp_'.$slug.'_bgcolor',
					'ftitle' =>	esc_html__('Point Color','pointfindercoreelements'),
					'ftype' => 'color',
					'fdata' => array('required'=>'pscp_'.$slug.'_type','condition'=>'!=','default'=>'#b00000'),
					'compiler' => array('.pfcat'.$slug.'-mapicon'),
					'mode'=>'background'
				),
				array(
					'fid' => 'pscp_'.$slug.'_bgcolorinner',
					'ftitle' =>	esc_html__('Point Inner Color','pointfindercoreelements'),
					'ftype' => 'color',
					'fdata' => array('required'=>'pscp_'.$slug.'_type','condition'=>'!=','default'=>'#ffffff'),
					'compiler' => array('.pfcat'.$slug.'-mapicon:after'),
					'mode'=>'background'
				),
				array(
					'fid' => 'pscp_'.$slug.'_iconcolor',
					'ftitle' =>	esc_html__('Point Icon Color','pointfindercoreelements'),
					'ftype' => 'color',
					'fdata' => array('required'=>'pscp_'.$slug.'_type','condition'=>'!=','default'=>'#b00000'),
					'compiler' => array('.pfcat'.$slug.'-mapicon i')
				),
				
				array(
					'fid' => 'pscp_'.$slug.'_iconfs',
					'ftitle' =>	esc_html__('Point FontAwesome Icon (NEW)','pointfindercoreelements'),
					'ftype' => 'text',
					'fdesc' => wp_sprintf(esc_html__('Please type %sFontAwesome 5 Free%s icon name like: far fa-heart','pointfindercoreelements'),'<a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">','</a>'),
					'fdata' => array('required'=>'pscp_'.$slug.'_type','condition'=>'!='),
					'compiler' => true
				),
				array(
					'fid' => 'pscp_'.$slug.'_iconname',
					'ftitle' =>	esc_html__('Point Icon Name','pointfindercoreelements'),
					'fdesc' =>	esc_html__('Additional Settings Panel > Site Speed Optimization > Flat Icons must leave enabled!','pointfindercoreelements'),
					'ftype' => 'extension_custom_icon',
					'fdata' => array('required'=>'pscp_'.$slug.'_type','condition'=>'!='),
					'compiler' => true
				),
			array(
				'fid' => 'pscp_'.$slug.'icon',
				'ftype' => 'indentend',
				'fdata' => array('required'=>'pscp_'.$slug.'_type','condition'=>'!=')
			),
			
		);
		$this_field_arr_output = array();
		foreach ($this_field_arr as $single_arr) {
			$this_field_arr_output[] = $this->GFPFSP($single_arr);
		}
		return $this_field_arr_output;

	}


	public function PFDF($title, $slug,$type){
		
		if($slug != '' && $title != ''){
			
			$title_output = ($slug == 'pfdefaultcat')? ''.$title.'' : ''.$title.' '.esc_html__('Category','pointfindercoreelements').'';
			
			if ($type == 'parent') {
				$this->CDFoutput = array(
					'id' => 'pscp_'.$slug.'',
					'title' => ''.$title_output.'',
					'fields' => array()
				);
			}else{
				$this->CDFoutput = array(
					'id' => 'pscp_sub_'.$slug.'',
					'title' => ''.$title_output.'',
					'subsection' => true,
					'fields' => array()
				);
			}
			

			
			$getfields = $this->PFGetDefaultFieldValuesofThisCS($slug,'defaults');
			
			$this->CDFoutput['fields'] = $getfields;
			
		}
		
		return $this->CDFoutput;
	}
}