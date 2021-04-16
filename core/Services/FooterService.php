<?php

namespace Unt\Services;

class FooterService
{
    /**
     * @return array of Menu
     */
    public function getFooterMenuList() : array
    {
        $locations = get_nav_menu_locations();

        $result = [];

        if(isset($locations['footer'])) {
            $menuItems = wp_get_nav_menu_items($locations['footer']);
            if ($menuItems) {
                foreach ($menuItems as $item) {
                    if($item->menu_item_parent == 0) {
                        $menuTitle =  $item->title;
                        $menuUrl = $item->url;
                        $subMenus = [];
                        foreach ($menuItems as $otherItem) {
                            if($otherItem->menu_item_parent == $item->ID) {
                                $subMenu = [
                                    "title" => $otherItem->title,
                                    "value" => $otherItem->url
                                ];
                                array_push($subMenus,$subMenu);
                            }
                        }
                        $menu = [
                            "title" => $menuTitle,
                            "value" => $menuUrl,
                            "subMenus" => $subMenus
                        ];
                        array_push($result,$menu);
                    }
                }
            }
        }

        return $result;
    }
}