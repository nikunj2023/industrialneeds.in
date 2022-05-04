<?php 

if (!trait_exists('PointFinderMegaMenu')) {
	/**
	 * Megamenu Functions
	 */
	trait PointFinderMegaMenu
	{

		public function pointfinder_new_nav_menu($item_id, $item, $depth, $args){

	        ob_start();

	        /*
	         * Mega menu Checkbox Field ------------------------------------------------------------------------
	         */
	        ?>  
	        <p class="field-breakline description description-wide"></p>
	        
	        <p class="field-link-megamenu description description-thin">
	            <label for="edit-menu-item-megamenu-<?php echo $item_id; ?>">
	                <input type="checkbox" id="edit-menu-item-megamenu-<?php echo $item_id; ?>" value="1" name="menu-item-megamenu[<?php echo $item_id; ?>]"<?php checked( $item->megamenu, '1' ); ?> />
	                <?php esc_html_e( 'Enable Mega Menu', 'pointfindercoreelements' ); ?>
	            </label>
	        </p>

	        <p class="field-link-megamenu-hide description description-thin">
	            <label for="edit-menu-item-megamenu-hide-<?php echo $item_id; ?>">
	                <input type="checkbox" id="edit-menu-item-megamenu-hide-<?php echo $item_id; ?>" value="1" name="menu-item-megamenu-hide[<?php echo $item_id; ?>]"<?php checked( $item->megamenu_hide_menu, '1' ); ?> />
	                <?php esc_html_e( 'Hide Menu', 'pointfindercoreelements' ); ?>
	            </label>
	        </p>

	        <p class="field-breakline description description-wide"></p>

	        <?php
	        /*
	         * Column Field ------------------------------------------------------------------------
	         */
	        ?>
	        <p class="field-columnvalue description description-wide">
	            <label for="edit-menu-item-columnvalue-<?php echo $item_id; ?>">
	                <?php esc_html_e( 'Column Number for Mega Menu', 'pointfindercoreelements' ); ?><br />
	               
	                <select name="menu-item-columnvalue[<?php echo $item_id; ?>]" id="edit-menu-item-columnvalue-<?php echo $item_id; ?>" class="input-block-level aura_wpmse_select2_<?php echo $item_id; ?>" style="width: 100%;" required>
	                    <?php if($item->columnvalue != ''){?>
	                    <option value="<?php echo esc_attr( $item->columnvalue ); ?>" data-icon="<?php echo esc_attr( $item->columnvalue ); ?>" selected><?php echo esc_attr( $item->columnvalue ); ?></option>
	                    <option value="1">1</option>
	                    <option value="2">2</option>
	                    <option value="3">3</option>
	                    <option value="4">4</option>
	                    <?php }else{?>
	                    <option value="1"><?php echo __('Please select','pointfindercoreelements');?></option>
	                    <option value="1">1</option>
	                    <option value="2">2</option>
	                    <option value="3">3</option>
	                    <option value="4">4</option>
	                    <?php }?>
	                </select>
	            </label>
	        </p>

	        <p class="field-breakline description description-wide"></p>

	        <p class="description description-wide">
	            <label for="edit-menu-item-icon-<?php echo $item_id; ?>">
	                <?php esc_html_e( 'Desktop Icon', 'pointfindercoreelements' ); ?><br />
	                <input type="text" id="edit-menu-item-icon-<?php echo $item_id; ?>" class="widefat edit-menu-item-icon" name="menu-item-icon[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->icon ); ?>" />
	            </label>
	        </p>
	        
	        <p class="description description-wide">
	            <label for="edit-menu-item-iconm-<?php echo $item_id; ?>">
	                <?php esc_html_e( 'Mobile Icon', 'pointfindercoreelements' ); ?><br />
	                <input type="text" id="edit-menu-item-iconm-<?php echo $item_id; ?>" class="widefat edit-menu-item-iconm" name="menu-item-iconm[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->iconm ); ?>" />
	            </label>
	        </p>

	        <?php
	        $output = ob_get_clean();
	        echo $output;
		}

		public function pointfinder_custom_nav_item($menu_item) {
		    $menu_item->columnvalue = get_post_meta( $menu_item->ID, '_menu_item_columnvalue', true );
		    $menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
		    $menu_item->megamenu_hide_menu = get_post_meta( $menu_item->ID, '_menu_item_megamenu_hide', true );
		    $menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
		    $menu_item->iconm = get_post_meta( $menu_item->ID, '_menu_item_iconm', true );
		    return $menu_item;
		}

		public function pointfinder_custom_nav_update($menu_id, $menu_item_db_id, $args ) {
		    if(empty($_REQUEST['menu-item-columnvalue'])){
		        update_post_meta( $menu_item_db_id, '_menu_item_columnvalue', '0' );
		    }else{
		        if ( is_array($_REQUEST['menu-item-columnvalue']) ) {
		        	if (isset($_REQUEST['menu-item-columnvalue'][$menu_item_db_id])) {
		        		$custom_value = $_REQUEST['menu-item-columnvalue'][$menu_item_db_id];
		            	update_post_meta( $menu_item_db_id, '_menu_item_columnvalue', $custom_value );
		        	}else{
		        		update_post_meta( $menu_item_db_id, '_menu_item_columnvalue', "" );
		        	}
		        }
		    }

		    if(empty($_REQUEST['menu-item-megamenu'])){
		        update_post_meta( $menu_item_db_id, '_menu_item_megamenu', '0' );
		    }else{
		        if ( is_array($_REQUEST['menu-item-megamenu']) ) {
		            
		            if (isset($_REQUEST['menu-item-megamenu'][$menu_item_db_id])) {
		                $custom_value2 = $_REQUEST['menu-item-megamenu'][$menu_item_db_id];
		                update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $custom_value2 );
		            }
		        }
		    }

		    if(empty($_REQUEST['menu-item-megamenu-hide'])){
		        update_post_meta( $menu_item_db_id, '_menu_item_megamenu_hide', '0' );
		    }else{
		        if ( is_array($_REQUEST['menu-item-megamenu-hide']) ) {
		            
		            if (isset($_REQUEST['menu-item-megamenu-hide'][$menu_item_db_id])) {
		                $custom_value2 = $_REQUEST['menu-item-megamenu-hide'][$menu_item_db_id];
		                update_post_meta( $menu_item_db_id, '_menu_item_megamenu_hide', $custom_value2 );
		            }
		        }
		    }


		    if(empty($_REQUEST['menu-item-icon'])){
		        update_post_meta( $menu_item_db_id, '_menu_item_icon', '' );
		    }else{
		        if ( is_array($_REQUEST['menu-item-icon']) ) {
		            
		            if (isset($_REQUEST['menu-item-icon'][$menu_item_db_id])) {
		                $custom_value2 = $_REQUEST['menu-item-icon'][$menu_item_db_id];
		                update_post_meta( $menu_item_db_id, '_menu_item_icon', $custom_value2 );
		            }
		        }
		    }


		    if(empty($_REQUEST['menu-item-iconm'])){
		        update_post_meta( $menu_item_db_id, '_menu_item_iconm', '' );
		    }else{
		        if ( is_array($_REQUEST['menu-item-iconm']) ) {
		            
		            if (isset($_REQUEST['menu-item-iconm'][$menu_item_db_id])) {
		                $custom_value2 = $_REQUEST['menu-item-iconm'][$menu_item_db_id];
		                update_post_meta( $menu_item_db_id, '_menu_item_iconm', $custom_value2 );
		            }
		        }
		    }
		}
	}
}