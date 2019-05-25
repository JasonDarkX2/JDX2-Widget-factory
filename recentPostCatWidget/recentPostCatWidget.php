<?php
    class recentPostCat_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'JDX2-rpc_widget', 

// Widget name will appear in UI
__('Recent Reviews(powered by JDX2)', 'JDX2-rpc_widget_domain'), 

// Widget description
array( 'description' => __( 'Simply showing the popular posts widget \(^.^)/ ',  
        'JDX2-rpc_widget_domain' ), ) 
);
}
// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {

$title="Recent Reviews";
    echo $args['before_widget'];
    echo $args['before_title'] . $title . $args['after_title'];
    $popularpost = new WP_Query( array('posts_per_page' => 5, 
        'category_name' =>'Reviews', 'orderby'  => 'date&order=DESC'    ) );

echo '<ul class="recentReviews">';

while ( $popularpost->have_posts() ) : $popularpost->the_post();?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" ><?php 
//$attr = array( 'alt' =>  get_the_title());
//echo get_the_post_thumbnail($post->ID,'postThumbNails',$attr);
the_title();
?> </a></li><?php endwhile;
echo"</ul>";
echo $args['after_widget'];
}
}// Class widget ends here
// Register and load the widget
function recentPostCat_widget() {
	register_widget( 'recentPostCat_widget' );
}
add_action( 'widgets_init', 'recentPostCat_widget' );
?>