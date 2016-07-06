<?php
/*
  Widget Name: FacebookWidget
  Git URI: https://github.com/JasonDarkX2/JDX2-Widget-factory
  Description:Simply a Facebook page Widget
  Author:Jason Dark X2
  Author URI:http://www.jasondarkx2.com/
 */
?>

<?php

class fb_widget extends WP_Widget {
public $statusParam=array('cover','header','faces','adpwidth');
    function __construct() {
        parent::__construct(
// Base ID of your widget
                'fbwidget',
                // Widget name will appear in UI
                __('Facebook Widget', 'WM_widget_domain'),
                // Widget description
                array('description' => __('Facebook page plugin widget', 'WM_widget_domain'),)
        );
        if(is_admin()){
        wp_enqueue_script('script', plugin_dir_url(__FILE__) . 'newjavascript.js', array('jquery'));
        }
    }

// Creating widget front-end
    public function widget($args, $instance) {
        $title = "Facebook";
        echo $args['before_widget'];
        echo $args['before_title'] . $instance['title'] . $args['after_title'];
        ?>
        <?php
        $status = array();
        foreach (array_slice($instance, 2) as $i => $v) {
            $status[$i] = ($v) ? 'true' : 'false';
        }
        ?>
        <div class="fb-page" data-href="<?php echo $instance['url']; ?>" 
             data-tabs="<?php echo $instance['tabs']; ?>" 
             data-small-header="<?php echo $status['header']; ?>" 
             data-width="<?php echo $instance['width']; ?>" 
             data-adapt-container-width="<?php echo $status['adpwidth']; ?>" 
             data-hide-cover="<?php echo $status['cover']; ?>"  
             data-show-facepile="<?php echo $status['faces']; ?>">
            <div class="fb-xfbml-parse-ignore">
                <blockquote cite="<?php echo $instance['url']; ?>">
                    <a href="<?php echo $instance['url']; ?>">
        <?php echo $instance['name']; ?></a>
                </blockquote>
            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }

// Widget Backend 
    public function form($instance) {
        //admin form
        ?>
        <p>

            <label for="title">Title</label>
            <input 
                id="<?php echo $this->get_field_id('title'); ?>" 
                name="<?php echo $this->get_field_name('title'); ?>" 
                type="text" 
                value="<?php echo esc_attr($instance['title']); ?>" 
                />
            <br/>
            <label for="text">FaceBook Page URL:</label>
            <input
                id="<?php echo $this->get_field_id('url'); ?>" 
                name="<?php echo $this->get_field_name('url'); ?>" 
                type="text"
                value="<?php echo esc_attr($instance['url']); ?>"</input>
            <br/>
                       <?php
               foreach ($this->statusParam as $i) {
                   $this->output_option($i, $instance[$i]);
        }      
           ?>
            <label id="displayrange"></label>
            180<input 
                id="<?php echo $this->get_field_id('width'); ?>" 
                name="<?php echo $this->get_field_name('width'); ?>" 
                type="range"
                min="180"
                max="500"
                step="1"
                value="<?php echo $instance['width'];?>"
                />500
            <br/>
            <label for="options">Tabs:</label>
            <select name="<?php echo $this->get_field_name('tabs'); ?>">
                <option value=" ">Options</option>
                <?php
                $options = array('timeline', 'event', 'message', 'timeline,event,message', 'none');
                foreach ($options as $t) {
                    if (strcmp($tabs, $t) == 0) {
                        echo '<option value="' . $t . '" selected>' . stripslashes($t) . '</option>';
                    } else {
                        echo '<option value="' . $t . '">' . stripslashes($t) . '</option>';
                    }
                }
                ?>
            </select>
        </p>
    <?php
    }

// updating widget instances
    public function update($new_instance, $old_instance) {
        $instance = array();
                foreach ($this->statusParam as $i) {
            $instance[$i] = (isset($new_instance[$i]) && $new_instance[$i]!=NULL) ? true : false;
        }
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['url'] = (!empty($new_instance['url']) ) ? strip_tags($new_instance['url']) : '';
        $instance['width'] =($new_instance['width']>500||$new_instance['width']<180 ? 180 :$new_instance['width'] );
        $instance['tabs'] = (!empty($new_instance['tabs']) ) ? strip_tags($new_instance['tabs']) : '';
        $matches = array();
        $yup = preg_match("/[^\/]+$/", $instance['url'], $matches);
        $instance['name'] = $matches[0];
        return $instance;
    }
function output_option($type,$checked){?>
        <?php switch ($type){
            case 'cover':
         echo'<label for="title">Hide Cover Image:</label>';
        break;
    case 'header':
        echo '<label for="title">Small Header:</label>';
        break;
    case 'faces':
        echo '<label for="title">Show Friend Faces:</label>';
        break;
    case 'adpwidth':
        echo '<label for="title">Adapt to widget container width:</label>';
        break;
        }?>
     <input 
   id="<?php echo $this->get_field_id( $type ); ?>" 
   name="<?php echo $this->get_field_name( $type ); ?>" 
   type="checkbox" 
   value="true"
   <?php checked($checked,1);  ?>
   />
     <br/>
    <?php }
}

function fb_widget() {
    register_widget('fb_widget');
}

add_action('widgets_init', 'fb_widget');
?>