<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function LinkToScoreCard($element_name, $endpoint, $artist = NULL)
{
  $element_link = urlencode($element_name);
  $artist = urlencode($artist);
  if($artist == NULL):?>
  <a href= "<?php echo site_url("scorecard/$endpoint?name=$element_link");?>"> <?php echo $element_name ?> </a>
<?php
  else: ?>
  <a href= "<?php echo site_url("scorecard/$endpoint?name=$element_link&by=$artist");?>"> <?php echo $element_name ?> </a>
<?php endif;
}

function LinkToChartByDate($chart_name, $date)
{ ?>
  <a href= "<?php echo site_url("chart/view/$chart_name/$date");?>"> <?php echo $date ?> </a>
<?php
}

?>
