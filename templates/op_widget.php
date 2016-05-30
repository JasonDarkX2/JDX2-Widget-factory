<?php
/*
Widget Name: Option wordpress widget
Git URI: https://github.com/JasonDarkX2/JDX2-Widget-factory
Description:Simply a template for a wordpress widget with options
Author:Jason Dark X2
Author URI:http://www.jasondarkx2.com/ 
*/ 
?>

<?php

class op_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
  'opwidget',
        // Widget name will appear in UI
__('Option Widget', 'WM_widget_domain'),
        // Widget description
array( 'description' => __( 'A simple wordpress Widget with options', 'WM_widget_domain' ), ) 
);
}
// Creating widget front-end
public function widget( $args, $instance ) {
$title="This is a standard wordpress Widget";
    echo $args['before_widget'];
    echo $args['before_title'] . $instance['title'] . $args['after_title'];
    echo  $instance['text'];
    echo $args['after_widget'];
}
// Widget Backend 
public function form( $instance ) {
    //admin form
    $title = $instance[ 'title' ];
    $text = $instance[ 'text' ];
    $check = $instance[ 'check' ];
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
     <label for="title">Check Box:</label>
   <input 
   id="<?php echo $this->get_field_id( 'check' ); ?>" 
   name="<?php echo $this->get_field_name( 'check' ); ?>" 
   type="checkbox" 
   value="true"
   <?php checked( $check,1);  ?>
   />
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
    if(isset($new_instance['check'])){ 
    $instance['check'] = TRUE;
    }else{
        $instance['check'] = FALSE;
    }
    return $instance;
}
}
function op_widget() {
	register_widget( 'op_widget' );
}
add_action( 'widgets_init', 'op_widget' );
 ?>