<?php
require_once(__DIR__ . '/lib/functions.php');

return [

    'plugin' => [
		'name' => 'Debates for elgg',
		'activate_on_install' => false,
		'dependencies' => [
			'tagcloud' => [],
		],
	],
    //Declare the Debates Entity
    'entities' =>[
        [
			'type' => 'object',
			'subtype' => 'debates',
			'class' => 'ElggDebates',
			'capabilities' => [
				'commentable' => true,
				'searchable' => true,
				'likable' => true,
				'restorable' => true,
			],
		],
    ],

    //Set the plugin actions. This is where we save our debates or add support
    'actions' =>[
        'debates/save' => [],
        'debates/support' => []
    ],

    'routes' => [
        //Default route. It is used by the navigation menu
        'default:object:debates' => [
			'path' => '/debates',
			'resource' => 'debates/all',
		],

        //View the Debate created
        'view:object:debates' => [
			'path' => '/debates/view/{guid}/{title?}',
			'resource' => 'debates/view',
		],

        //Add new debate route
        'add:object:debates' => [
            'path' => '/debates/add/{guid}',
			'resource' => 'debates/add',
			'middleware' => [
				\Elgg\Router\Middleware\Gatekeeper::class,
                \Elgg\Router\Middleware\PageOwnerGatekeeper::class,
			],
        ],

        //All debates route
        'collection:object:debates:all' =>[
            'path' => '/debates/all',
            'resource' => 'debates/all'
        ],


        //Filter by SDG
        'selected:object:debates' => [
			'path' => '/debates/filter_by',
			'resource' => 'debates/sdg',
			
		],

        //Edit debate
        'edit:object:debates' => [
			'path' => '/debates/edit/{guid}',
			'resource' => 'debates/edit',
			'middleware' => [
				\Elgg\Router\Middleware\Gatekeeper::class,
			],
		],

        'collection:object:debates:owner' => [
			'path' => '/debates/owner/{username}/{lower?}/{upper?}',
			'resource' => 'debates/owner',
			'requirements' => [
				'lower' => '\d+',
				'upper' => '\d+',
			],
			'middleware' => [
				\Elgg\Router\Middleware\UserPageOwnerGatekeeper::class,
			],
		],


    ],

    'view_extensions' => [
        'elgg.css' => [
			'custom/debates/debates.css' => [],
		],
    ],

    'hooks' => [

        //Register the menus
        'register' => [
            
            //The navigation menu to access all debates
            'menu:site' => [
                'Elgg\Debates\Menus\Site::register' => [],
            ],

            //If the default route doesn't exists, it wont work
            'menu:title:object:debates' => [
                \Elgg\Notifications\RegisterSubscriptionMenuItemsHandler::class => [],
            ],
        ]
    ],
];