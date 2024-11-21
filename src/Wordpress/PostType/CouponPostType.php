<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

class CouponPostType extends BasePostType
{
    protected function getTag(): string
    {
        return 'coupon';
    }

    public function registerPostType(): void
    {
        register_post_type(
            $this->getTag(),
            array_merge(
                $this->getDefaultProperties(),
                [
                    'labels' => [
                        'name'          => __('Coupons', 'textdomain'),
                        'singular_name' => __('Coupon', 'textdomain'),
                        'add_new'       => 'Maak nieuwe coupon',
                        'add_new_item'  => 'Nieuwe coupon',
                        'edit_item'     => 'Wijzig coupon'
                    ],
                ]
            ),
        );
    }
}
