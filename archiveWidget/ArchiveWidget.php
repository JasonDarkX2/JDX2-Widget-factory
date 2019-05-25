<?php

class Archive_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'JDX2-archive_widget', 

// Widget name will appear in UI
__('Archive widget(powered by JDX2)', 'JDX2_Archive_widget_domain'), 

// Widget description
array( 'description' => __( ' Archive widget that iss better than stock one bling bling yo!\(^.^)/ ', 'JDX2_Archive_widget_domain' ), ) 
);
}
// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
    
    $title="Archive";
    echo $args['before_widget'];
    echo $args['before_title'] . $title . $args['after_title'];?>
<?php
global $wpdb;
$limit = 0;
$year_prev = null;
$months = $wpdb->get_results("SELECT DISTINCT DATE_FORMAT( post_date,'%m' ) AS month ,	YEAR( post_date ) AS year, COUNT( id ) as post_count,post_date as pdate FROM "
        . "$wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'post' GROUP BY month , year ORDER BY post_date DESC");
echo"<ul>";
foreach($months as $month) :
	$year_current = $month->year;
$pdate=$month->pdate;
$datetime1 = new DateTime();
$datetime2 = date_create($month->pdate);
$interval = date_diff($datetime2, $datetime1);
$diff=$interval->format('%a');
if($diff>200){
	$format= date_i18n("F", mktime(0, 0, 0, $month->month, 1, $month->year)). "&nbsp;". $month->year;
	if ($year_current !=date('Y') && $year_current !=$year_prev ){?>
<li><a href= "<?php bloginfo('url') ?>/?m=<?php echo$month->year;?>" class="Ayear" title="<?php echo $month->year;?>Archrives" ><?php echo $month->year;?></a></li>
		<?php } ?>
    <?php if ($year_current != date('Y')){?>
        <li><span class="yeartwrap"><a href="<?php bloginfo('url') ?>/?m=<?php echo $month->year; ?><?php echo $month->month; ?>" title="<?php echo $format; ?> Archives"><?php echo $format?></a>
        &nbsp;<?php echo'('.$month->post_count .')'; ?></span>
</li>
	<?php } else{ ?>
<li><span class="twrap"><a href="<?php bloginfo('url') ?>/?m=<?php echo $month->year; ?><?php echo $month->month; ?>" title="<?php echo $format; ?> Archives"><?php echo $format?></a>
        &nbsp;<?php echo'('.$month->post_count .')'; ?></span>
</li>
        <?php }?>
<?php $year_prev = $year_current;
}

if(++$limit >= 4) { break; }
 endforeach;
 echo"</ul>";    
 ?>
           
<?php
        echo $args['after_widget'];
}
}
function Archive_widget() {
	register_widget( 'Archive_widget' );
}
add_action( 'widgets_init', 'Archive_widget' );
?>
