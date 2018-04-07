<?php

function getStars($rating) {

  // Round to nearest half
  $rating = round($rating * 2) / 2;
  $output = [];

  // Append all the filled whole stars
  for ($i = $rating; $i >= 1; $i--)
    $output[] = '<i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>&nbsp;';

  // If there is a half a star, append it
  if ($i == .5) $output[] = '<i class="fa fa-star-half-o" aria-hidden="true" style="color: gold;"></i>&nbsp;';

  // Fill the empty stars
  for ($i = (5 - $rating); $i >= 1; $i--)
    $output[] = '<i class="fa fa-star-o" aria-hidden="true" style="color: gold;"></i>&nbsp;';

  return join("",$output);

}