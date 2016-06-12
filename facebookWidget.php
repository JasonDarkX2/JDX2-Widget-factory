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

    function __construct() {
        parent::__construct(
// Base ID of your widget
                'fbwidget',
                // Widget name will appear in UI
                __('Facebook Widget', 'WM_widget_domain'),
                // Widget description
                array('description' => __('Facebook page plugin widget', 'WM_widget_domain'),)
        );
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
        $title = $instance['title'];
        $url = $instance['url'];
        $dropList = $instance['dropList'];
        $cover = $instance['cover'];
        $header = $instance['header'];
        $faces = $instance['faces'];
        $adpwidth = $instance['adpwidth'];
        $tabs = $instance['tabs'];
        $name = $instance['name'];
        ?>
        <p>

            <label for="title">Title</label>
            <input 
                id="<?php echo $this->get_field_id('title'); ?>" 
                name="<?php echo $this->get_field_name('title'); ?>" 
                type="text" 
                value="<?php echo esc_attr($title); ?>" 
                />
            <br/>
            <label for="text">FaceBook Page URL:</label>
            <input
                id="<?php echo $this->get_field_id('url'); ?>" 
                name="<?php echo $this->get_field_name('url'); ?>" 
                type="text"
                value="<?php echo esc_attr($url); ?>"</input>
            <br/>
            <label for="title">Hide Cover Image:</label>
            <input 
                id="<?php echo $this->get_field_id('cover'); ?>" 
                name="<?php echo $this->get_field_name('cover'); ?>" 
                type="checkbox" 
                value="true"
        <?php checked(1, $cover); ?>
                />
            <br/>
            <label for="title">Use Small Header:</label>
            <input 
                id="<?php echo $this->get_field_id('header'); ?>" 
                name="<?php echo $this->get_field_name('header'); ?>" 
                type="checkbox" 
                value="true"
        <?php checked(1, $header); ?>
                />
            <br/>
            <label for="title">Show Friend's Faces:</label>
            <input 
                id="<?php echo $this->get_field_id('faces'); ?>" 
                name="<?php echo $this->get_field_name('faces'); ?>" 
                type="checkbox" 
                value="true"
        <?php checked(1, $faces); ?>
                />
            <br/>
              <label for="title">Adapt to widget container width:</label>
            <input 
                id="<?php echo $this->get_field_id('adpwidth'); ?>" 
                name="<?php echo $this->get_field_name('adpwidth'); ?>" 
                type="checkbox" 
                value="true"
        <?php checked(1, $adpwidth); ?>
                />
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
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['url'] = (!empty($new_instance['url']) ) ? strip_tags($new_instance['url']) : '';
        foreach (array_slice($new_instance, 2) as $i => $v) {
            if (isset($v)) {
                $instance[$i] = TRUE;
            } else {
                $instance[$i] = FALSE;
            }
        }
        $instance['tabs'] = (!empty($new_instance['tabs']) ) ? strip_tags($new_instance['tabs']) : '';
        $matches = array();
        $yup = preg_match("/[^\/]+$/", $instance['url'], $matches);
        $instance['name'] = $matches[0];
        return $instance;
    }

}

function fb_widget() {
    register_widget('fb_widget');
}

add_action('widgets_init', 'fb_widget');
?>