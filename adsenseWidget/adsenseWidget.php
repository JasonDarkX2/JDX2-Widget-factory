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
   value="<?php echo esc_attr( $title ); ?>" 
   />
   <br/>
<label for="content">Ad Unit Code:</label>
    <textarea 
        rows="20" cols="60"
   id="<?php echo $this->get_field_id( 'content' ); ?>" 
   name="<?php echo $this->get_field_name( 'content' ); ?>"  
   ><?php echo esc_attr( $text);?></textarea>
    <br/>
<?php }
public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['content'] = (!empty($new_instance['content']) ) ? $new_instance['content'] : '';
        $instance['title'] = (!empty($new_instance['title']) ) ? $new_instance['title'] : '';
        return $instance;
}
}
function Adsense_widget() {
	register_widget( 'Adsense_widget' );
}
add_action( 'widgets_init', 'Adsense_widget' );
?>