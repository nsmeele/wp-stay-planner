<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

class CouponPostType extends AbstractPostType
{
    public function getTag(): string
    {
        return 'coupon';
    }

    protected function getPostTypeProperties(): array
    {
        return array_merge(
            parent::getPostTypeProperties(),
            [
                'labels' => [
                    'name' => __('Coupons', 'textdomain'),
                    'singular_name' => __('Coupon', 'textdomain'),
                    'add_new' => 'Maak nieuwe coupon',
                    'add_new_item' => 'Nieuwe coupon',
                    'edit_item' => 'Wijzig coupon'
                ],
            ]
        );
    }
}
