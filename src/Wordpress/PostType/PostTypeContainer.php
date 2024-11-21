<?php

namespace Nsmeele\WpStayPlanner\Wordpress\PostType;

class PostTypeContainer
{
    private static ?PostTypeContainer $instance = null;

    private array $defaultPostTypeClasses = [
        BookingPostType::class,
        RoomPostType::class,
        CouponPostType::class,
        OfferPostType::class,
        SeasonPostType::class,
        OutOfOfficePostType::class,
    ];

    // De volgorde van deze lijst bepaalt ook de volgorde van de menu items in de admin.
    private array $postTypes = [];

    private function __construct()
    {
        $this->resolvePostTypeClasses();
    }

    public static function getInstance(): PostTypeContainer
    {
        if (self::$instance === null) {
            self::$instance = new PostTypeContainer();
        }
        return self::$instance;
    }

    /**
     * @return BasePostType[]
     */
    public function getPostTypes(): array
    {
        return $this->postTypes;
    }

    private function resolvePostTypeClasses(): void
    {
        foreach ($this->defaultPostTypeClasses as $postTypeClass) {
            $this->postTypes[] = new $postTypeClass();
        }
    }
}
