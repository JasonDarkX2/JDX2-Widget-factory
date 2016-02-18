<?php
/*
Widget Name: Standard wordpress widget
Git URI: https://github.com/JasonDarkX2/JDX2-Widget-factory
Description:Simply a template for a standard wordpress widget
Author:Jason Dark X2
Author URI:http://www.jasondarkx2.com/ 
*/ 
?>

<?php

class stnd_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
  'stndwidget',
        // Widget name will appear in UI
__('Standard Widget', 'WM_widget_domain'),
        // Widget description
array( 'description' => __( 'A simple wordpress Widget', 'WM_widget_domain' ), ) 
);
}
// Creating widget front-end
public function widget( $args, $instance ) {
$title="This is a standard wordpress Widget";
    echo $args['before_widget'];
    echo $args['before_title'] . $title . $args['after_title'];
    echo "<h1>HELLO Widget Manager!!</h1>";
    echo $args['after_widget'];
}
// Widget Backend 
public function form( $instance ) {
    
}
// updating widget instances
public function update( $new_instance, $old_instance ) {
    
}
}
function stnd_widget() {
	register_widget( 'stnd_widget' );
}
add_action( 'widgets_init', 'stnd_widget' );
?>