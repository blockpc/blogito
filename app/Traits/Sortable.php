<?php

namespace App\Traits;

trait Sortable
{
    public function reorder($reordered, $existing)
    {
        if (count($reordered) > 0) {
            foreach ($reordered as $order) {
                $new_order[] = $existing[$order['value']];
            }
            return $new_order;
        } else {
            return $existing;
        }
    }
}