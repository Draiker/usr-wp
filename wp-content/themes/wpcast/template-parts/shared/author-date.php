<?php
/**
 * 
 * Display author and date for a post
 *
 * @package WordPress
 * @subpackage wpcast
 * @version 1.0.0
*/

?>
<span class="wpcast-p-author"><?php the_author(); ?></span> <span class="wpcast-p-date"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></span>