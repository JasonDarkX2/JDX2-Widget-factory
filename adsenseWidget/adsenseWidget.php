<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Adsense_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'JDX2-adsense_widget', 

// Widget name will appear in UI
__('Adsense widget(powered by JDX2)', 'JDX2_Adsense_widget_domain'), 

// Widget description
array( 'description' => __( ' Adnse widgets allows you to easily place your ad sense Ad units ', 'JDX2_Adsense_widget_domain' ), ) 
);
}
// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
    echo '<i>'. $instance['title'] .'</i>';
     echo $instance['content'];
}
// Widget Backend 
    public function form($instance) {
        //admin form
        $title= $instance['title'];
        $text= $instance['content'];
?>
<label for="title">Title:</label>
   <input 
   id="<?php echo $this->get_field_id( 'title' ); ?>" 
   name="<?php echo $this->get_field_name( 'title' ); ?>" 
   type="text" 
   style="width:100%;"
   value="<?php echo esc_attr( $title ); ?>" 
   />
   <br/>
<label for="content">Ad Unit Code:</label>
    <textarea  rows="20"
        style="-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;

	width: 100%;"
   id="<?php echo $this->get_field_id( 'content' ); ?>" 
   name="<?php echo $this->get_field_name( 'content' ); ?>"  
   ><?php echo esc_attr( $text);?></textarea>
    <br/>
    <label for="options">Ad unit size:</label>
 <select name="<?php echo$this->get_field_name( 'adSize'); ?>" style="width:100%;">
        <option value="">Options</option>
           <?php 
    $options=array('300 x 250','336 x 280','728 x 90','160 x 600','responsive');
    foreach($options as $t) {
    if(strcmp($instance['adSize'],$t)==0){
   echo  '<option value="'. $t .'" selected>' . stripslashes($t) .'</option>';
    }else{
        echo  '<option value="'. $t .'">' . stripslashes($t) .'</option>';
    }
} ?>
    </select>
<?php }
public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['content'] = (!empty($new_instance['content']) ) ? $new_instance['content'] : '';
        $instance['title'] = (!empty($new_instance['title']) ) ? $new_instance['title'] : '';
        $instance['adSize'] = ( ! empty( $new_instance['adSize'] ) ) ? strip_tags( $new_instance['adSize'] ) : '';
        return $instance;
}
function get_size(){
    
  switch($instance['adSize']) {
      case '300 x 250':
          $size= "width:300px;height:250px";
          break;
      case '336 x 280':
           $size= "width:336px;height:280px";
          break;
      case '728 x 90':
      $size= "width:728px;height:90px";
          break;
      case  '160 x 600':
           $size= "width:300px;height:250px";
          break;
      case 'responsive':
          $size="";
      default:
          
          }
          return $size;
}
}


function Adsense_widget() {
	register_widget( 'Adsense_widget' );
}
add_action( 'widgets_init', 'Adsense_widget' );
?>