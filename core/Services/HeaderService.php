<?php
/**
 * Created by PhpStorm.
 * User: cbonfre
 * Date: 15/05/2019
 * Time: 15:56
 */

namespace Unt\Services;


class HeaderService {
    /**
     * @return array of Menu
     */
    public function getHeaderMenuList() : array {
        $locations = get_nav_menu_locations();

        $result = [];

        if(isset($locations['header'])) {
            $menuItems = wp_get_nav_menu_items($locations['header']);

            if ($menuItems) {
                foreach ($menuItems as $item) {
                    if($item->menu_item_parent == 0) {
                        $menuTitle = $item->title;
                        $menuUrl = $item->url;
                        $subMenus = $this::getSubMenus($item->ID, $menuItems);
                        $menu = [
                            "title" => $menuTitle,
                            "value" => $menuUrl,
                            "subMenus" => $subMenus
                        ];
                        array_push($result, $menu);
                    }
                }
            }
        }
        return $result;
    }

    private function getSubMenus($menuId, $menuList) : array {
        $subMenusList = [];

        foreach ($menuList as $menuItem) {
            if($menuItem->menu_item_parent == $menuId) {
                $subMenus = $this::getSubMenus($menuItem->ID, $menuList);
                $subMenu = [
                    "title" => $menuItem->title,
                    "value" => $menuItem->url,
                    "subMenus" => $subMenus
                ];
                array_push($subMenusList,$subMenu);
            }
        }

        return $subMenusList;
    }
}