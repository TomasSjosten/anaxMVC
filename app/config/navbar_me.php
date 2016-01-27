<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',
 
    // Here comes the menu strcture
    'items' => [

        // This is a menu item
        'home'  => [
            'class' => 'mainitem',
            'text'  => 'Home',
            'url'   => $this->di->get('url')->create(''),
            'title' => 'Home route of current frontcontroller'
        ],
 
        // This is a menu item
        'test'  => [
            'class' => 'mainitem',
            'text'  => 'Presentation',
            'url'   => $this->di->get('url')->create('presentation'),
            'title' => 'Presentation of the PHPMVC-course',

            // Here we add the submenu, with some menu items, as part of a existing menu item
            'submenu' => [

                'items' => [

                    // This is a menu item of the submenu
                    'item 0'  => [
                            'class' => 'underitem',
                            'text'  => 'Kmom01',
                            'url'   => $this->di->get('url')->create('presentation/kmom01'),
                            'title' => 'Presentation of kmom01'
                    ],
                    /*'item 1'  => [
                            'class' => 'underitem',
                            'text'  => 'Kmom02',
                            'url'   => $this->di->get('url')->create('presentation/kmom02'),
                            'title' => 'Presentation of kmom02'
                    ],*/
                ],
            ],
        ],

        'dice' => [
                'class' => 'mainitem',
                'text'  =>'Dice',
                'url'   => $this->di->get('url')->create('dice'),
                'title' => 'Throw a die or two'
        ],

        'source' => [
                'class' => 'mainitem',
                'text'  =>'Source',
                'url'   => $this->di->get('url')->create('source'),
                'title' => 'Source code of the site'
        ],
    ],
 


    /**
     * Callback tracing the current selected menu item base on scriptname
     *
     */
    'callback' => function ($url) {
        if ($url == $this->di->get('request')->getCurrentUrl(false)) {
            return true;
        }
    },



    /**
     * Callback to check if current page is a decendant of the menuitem, this check applies for those
     * menuitems that has the setting 'mark-if-parent' set to true.
     *
     */
    'is_parent' => function ($parent) {
        $route = $this->di->get('request')->getRoute();
        return !substr_compare($parent, $route, 0, strlen($parent));
    },



   /**
     * Callback to create the url, if needed, else comment out.
     *
     */
   /*
    'create_url' => function ($url) {
        return $this->di->get('url')->create($url);
    },
    */
];
