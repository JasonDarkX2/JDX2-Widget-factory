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
    echo $args['before_widget'];
    echo $args['before_title'] . $instance['title'] . $args['after_title'];
    output($instance);
    echo $args['after_widget'];
}
// Widget Backend 
public function form( $instance ) {
    //admin form
     $title = $instance[ 'title' ];
    $username = $instance[ 'username' ];
    $height = $instance[ 'height' ];
    $width= $instance['width'];
    $replies = $instance[ 'replies' ];
    $theme = $instance[ 'theme' ];
    $footer = $instance[ 'nofooter' ];
    $header = $instance[ 'noheader' ];
    $border = $instance[ 'noborders' ];
    $scrollbar = $instance[ 'noscrollbar' ];
    ?>
<p>
      <label for="Title">Title:</label>
   <input 
   id="<?php echo $this->get_field_id( 'title' ); ?>" 
   name="<?php echo $this->get_field_name( 'title' ); ?>" 
   type="text" 
   value="<?php echo esc_attr( $title ); ?>" 
   />
   <br/>
   <label for="username">Username:</label>
   <input 
   id="<?php echo $this->get_field_id( 'username' ); ?>" 
   name="<?php echo $this->get_field_name( 'username' ); ?>" 
   type="text" 
   value="<?php echo esc_attr( $username ); ?>" 
   />
   <br/>
   <label for="text">height:</label>
   200<input
           id="<?php echo $this->get_field_id('height'); ?>" 
           name="<?php echo $this->get_field_name('height'); ?>"  
           type="range"
           min="200"
           max="1080"
           step="1"
           value="<?php echo $height; ?>"
           />1080
   <br>
     <label for="text">width:</label>
   200<input
           id="<?php echo $this->get_field_id('width'); ?>" 
           name="<?php echo $this->get_field_name('width'); ?>"  
           type="range"
           min="220"
           max="2000"
           step="1"
           value="<?php echo $width; ?>"
           />2000
           <br/>
           <?php
               foreach (array_slice($instance, 5) as $i => $v) {
                   $this->output_option($i, $v,$this);
        }      
           ?>
    <label for="theme">theme:</label>
 <select name="<?php echo $this->get_field_name( 'theme'); ?>">
           <?php 
    $options=array('Light','Dark');
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
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['username'] = ( ! empty( $new_instance['username'] ) ) ? strip_tags( $new_instance['username'] ) : '';
    $instance['height'] = ( ! empty( $new_instance['height'] ) ) ? strip_tags( $new_instance['height'] ) : '';
    $instance['width'] = ( ! empty( $new_instance['width'] ) ) ? strip_tags( $new_instance['width'] ) : '';
    $instance['theme'] = ( ! empty( $new_instance['theme'] ) ) ? strip_tags( $new_instance['theme'] ) : '';
    if(count($new_instance)>count($old_instance)){
        $splice=count($old_instance);
            foreach (array_slice($new_instance, $splice) as $i => $v) {
            $instance[$i] = (isset($new_instance[$i]) && $new_instance[$i]!=NULL) ? true : false;
        }
    }else{
    foreach (array_slice($old_instance, 5) as $i => $v) {
            $instance[$i] = (isset($new_instance[$i]) && $new_instance[$i]!=NULL) ? true : false;
        }
    }
    return $instance;
}
function output_option($type,$checked){?>
<?php switch ($type){
    case 'replies':
         echo'<label for="title">Exclude replies:</label>';
        break;
    case 'nofooter':
        echo '<label for="title">Hide Footer</label>';
        break;
    case 'noheader':
        echo '<label for="title">Hide Header</label>';
        break;
    case 'noborders':
        echo '<label for="title">Hide Border</label>';
        break;
    case 'noscrollbar':
        echo '<label for="title">Hide Scrollbar</label>';
        break;
} ?>
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
function output($instance){?>

 
<a class="twitter-timeline" data-theme="<?php echo $instance['theme'];  ?>"   href="https://twitter.com/<?php echo $instance['username'];?>" 
   width="<?php echo $instance['width']; ?>"
   height="<?php echo $instance['height']; ?>"
    data-chrome="<?php  foreach (array_slice($instance, 5) as $i => $v) {if($v){echo $i .' ';}}?>"
   >
    Tweets by @<?php echo $username; ?></a>
    <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

<?php }
function tw_widget() {
	register_widget( 'tw_widget' );
}
add_action( 'widgets_init', 'tw_widget' );
 ?>