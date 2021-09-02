<?php 
function wpblg_minutesConverter($date_time) {
    $dt_end = new DateTime($date_time);
    $remain = $dt_end->diff(new DateTime());
    $dt_arr = array();
    if($remain)
    {
        if($remain->y)
        {
            $dt_arr[] = $remain->y.' '.__('Year','wp_blogger');
        }
        else if($remain->m)
        {
            $dt_arr[] = $remain->m.' '.__('Month','wp_blogger');
        }
        else if($remain->d)
        {
            $dt_arr[] = $remain->d.' '.__('Days','wp_blogger');
        }
        else if($remain->h)
        {
            $dt_arr[] = $remain->h.' '.__('Hours','wp_blogger');
        }
        else if($remain->i)
        {
            $dt_arr[] = $remain->i.' '.__('Minute','wp_blogger');
        }
        else if($remain->s)
        {
            $dt_arr[] = $remain->s.' '.__('Second','wp_blogger');
        }
    }
    
    return implode(', ',$dt_arr).' '.__('ago','wp_blogger');
};
?>