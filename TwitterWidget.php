<?php
/*
Widget Name: Twitter wordpress widget
Git URI: https://github.com/JasonDarkX2/JDX2-Widget-factory
Description:Simply a Twitter for a wordpress
Author:Jason Dark X2
Author URI:http://www.jasondarkx2.com/ 
*/ 
?>

<?php

class tw_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
  'twwidget',
        // Widget name will appear in UI
__('Twitter Widget', 'WM_widget_domain'),
        // Widget description
array( 'description' => __( 'A simple Twitter Widget', 'WM_widget_domain' ), ) 
);
}
// Creating widget front-end
public function widget( $args, $instance ) {
$title="Twitter Widget";
    echo $args['before_widget'];
    output($username,$id);
    echo $args['after_widget'];
}
// Widget Backend 
public function form( $instance ) {
    //admin form
    $username = $instance[ 'username' ];
    $height = $instance[ 'height' ];
    $option = $instance[ 'option' ];
    $theme = $instance[ 'theme' ];
    ?>
<p>
   <label for="title">Username</label>
   <input 
   id="<?php echo $this->get_field_id( 'username' ); ?>" 
   name="<?php echo $this->get_field_name( 'username' ); ?>" 
   type="text" 
   value="<?php echo esc_attr( $username ); ?>" 
   />
   <br/>
    <label for="text">height</label>
    <textarea 
   id="<?php echo $this->get_field_id( 'height' ); ?>" 
   name="<?php echo $this->get_field_name( 'height' ); ?>"  
   ><?php echo esc_attr( $text);?></textarea>
    <br/>
     <label for="title">exclude replies:</label>
   <input 
   id="<?php echo $this->get_field_id( 'option' ); ?>" 
   name="<?php echo $this->get_field_name( 'option' ); ?>" 
   type="checkbox" 
   value="true"
   <?php checked( $option,1);  ?>
   />
   <br/>
    <label for="options">theme:</label>
 <select name="<?php echo$this->get_field_name( 'theme'); ?>">
        <option value="">Options</option>
           <?php 
    $options=array('1','2','3','4','5');
    foreach($options as $t) {
    if(strcmp($instance['theme'],$t)==0){
   echo  '<option value="'. $t .'" selected>' . stripslashes($t) .'</option>';
    }else{
        echo  '<option value="'. $t .'">' . stripslashes($t) .'</option>';
    }
} ?>
    </select>
</p>
<?php }

// updating widget instances
public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['username'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['height'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
    $instance['theme'] = ( ! empty( $new_instance['dropList'] ) ) ? strip_tags( $new_instance['theme'] ) : '';
    if(isset($new_instance['option'])){ 
    $instance['option'] = TRUE;
    }else{
        $instance['option'] = FALSE;
    }
    return $instance;
}
}
function output($username,$id){?>
                <a class="twitter-timeline"  href="https://twitter.com/<?php echo $username; ?>" data-widget-id="<?php echo $id; ?>">Tweets by @<?php echo $username; ?></a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
            </script>

<?php }
function tw_widget() {
	register_widget( 'tw_widget' );
}
add_action( 'widgets_init', 'tw_widget' );
 ?>