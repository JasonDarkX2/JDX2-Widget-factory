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
array( 'description' => __( 'Facebook page plugin widget', 'WM_widget_domain' ), ) 
);
}
// Creating widget front-end
public function widget( $args, $instance ) {
$title="Facebook";
    echo $args['before_widget'];
    echo $args['before_title'] . $instance['title'] . $args['after_title'];
?>
<div class="fb-page" data-href="https://www.facebook.com/facebook" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false">
    <div class="fb-xfbml-parse-ignore">
        <blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">Facebook</a>
        </blockquote>
    </div>
</div>
<?php
    echo $args['after_widget'];
}
// Widget Backend 
public function form( $instance ) {
    //admin form
    $title = $instance[ 'title' ];
    $text = $instance[ 'text' ];
    $dropList = $instance[ 'dropList' ];
    ?>
<p>
   <label for="title">Title</label>
   <input 
   id="<?php echo $this->get_field_id( 'title' ); ?>" 
   name="<?php echo $this->get_field_name( 'title' ); ?>" 
   type="text" 
   value="<?php echo esc_attr( $title ); ?>" 
   />
   <br/>
    <label for="text">Text</label>
    <textarea 
   id="<?php echo $this->get_field_id( 'text' ); ?>" 
   name="<?php echo $this->get_field_name( 'text' ); ?>"  
   ><?php echo esc_attr( $text);?></textarea>
    <br/>
    <label for="options">DropDown List:</label>
 <select name="<?php echo$this->get_field_name( 'dropList'); ?>">
        <option value="">Options</option>
           <?php 
    $options=array('1','2','3','4','5');
    foreach($options as $t) {
    if(strcmp($instance['dropList'],$t)==0){
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
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
    $instance['dropList'] = ( ! empty( $new_instance['dropList'] ) ) ? strip_tags( $new_instance['dropList'] ) : '';
    return $instance;
}
function op_widget() {
	register_widget( 'fb_widget' );
}
}
add_action( 'widgets_init', 'fb_widget' );
 ?>