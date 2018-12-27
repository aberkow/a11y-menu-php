<?php

namespace A11y;

/**
 * 
 * A class for creating accessible menu markup.
 * based on - https://github.com/aberkow/a11y-menu/blob/master/src/js/utils/displayMenu.js
 * 
 */

class Menu_Generator {

  /**
   * 
   * This function generates the markup for each menu item.
   *
   * @param object $menu_item - a single menu item object from the JSON menu array
   * @return string - an html string representing a single item in the menu.
   * 
   */
  static private function generate_markup($menu_item) {
    $has_link = false;
    $has_submenu = false;
    $html = '';

    if (isset($menu_item->link) && strlen($menu_item->link) && $menu_item->link !== '#') {
      $has_link = true;
    }

    if (isset($menu_item->sub) && $menu_item->sub === true) {
      $has_submenu = true;
    }

    if ($has_link && $has_submenu) {
      // a top-level link with a submenu
      $html .= "<a href='$menu_item->link' class='am-submenu-link' aria-label='$menu_item->name, tab to the next button to expand the sub-menu'>";
      $html .= $menu_item->name;
      $html .= "</a>";
      $html .= "<button class='am-submenu-button am-submenu-toggle' aria-haspopup='true' aria-expanded='false'>";
      $html .= "<span class='am-submenu-icon' aria-hidden='true' data-before='∨'></span>";
      $html .= "</button>";
    } elseif (!$has_link || !$has_link && $has_submenu) {
      // an interactive top-level item that does not include a link.
      $html .= "<button class='am-submenu-toggle' aria-haspopup='true' aria-expanded='false'>";
      $html .= $menu_item->name;
      $html .= "<span class='am-submenu-icon' aria-hidden='true' data-before='∨'></span>";
      $html .= "</button>";
    } else {
      $html .= "<a class='am-submenu-link' aria-label='$menu_item->name, tab to the next button to expand the submenu' href='$menu_item->link'>";
      $html .= $menu_item->name;
      $html .= "</a>";
    }
    
    return $html;
  }

  /**
   * 
   * This function should take in a JSON object with one property that holds an array of items.
   * It aggregates all the menu items to output a complete menu.
   * 
   * @param array $data - an array of menu item objects. See mock-data.json for format.
   * @return string - an html string representing the menu.
   * 
   */

  static public function display_menu($data) {
    // create an array of html strings for each menu item
    $menu_array = array_map(function($menu_item) {
      
      // the no-js class will be removed by the Navigation js script
      $classes = "no-js ";

      // if there are additional classes in the JSON object, add them
      if (isset($menu_item->classes)) {
        $classes .= implode(" ", $menu_item->classes);
      }
      $classes = trim($classes);

      // begin making the markup
      $html = "<li class='$classes'>";

      // create the interior html for each item.
      $html .= self::generate_markup($menu_item);

      // handle submenus
        if (isset($menu_item->sub) && $menu_item->sub === true) {
          $html .= "<ul class='am-submenu-list'>";
          // create sub-items by calling this function recursively
          $html .= self::display_menu($menu_item->menu);
          $html .= "</ul>";
        }
      
      // finish the menu item and return
      $html .= "</li>";
      return $html;
    }, $data);

    // transform the array into a valid html string and return.
    $menu_html = implode($menu_array);
    return $menu_html;
  }
}