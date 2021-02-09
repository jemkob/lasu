<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Admin Portal',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>EDUCATION365</b>',

    'logo_mini' => '<b>E365</b>',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'red',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        
        'DASHBOARD',
        [
            'text' => 'SCHOOL MANAGER',
            'url'  => '#',
            'icon' => 'graduation-cap',
            'submenu' => [
                            [
                                'text' => 'Student Manager',
                                'url'  => 'studentmanager',
                            ],
                            [
                                'text' => 'Course Assignment',
                                'url'  => 'courseassignment',
                            ],
                            [
                                'text' => 'Course Manager',
                                'url'  => 'course',
                            ],
                            [
                                'text' => 'Course Registration Manager',
                                'url'  => '#',
                                'submenu' => [
                                                [
                                                    'text' => 'View Course Registration',
                                                    'url'  => 'courseregistration',
                                                ],
                                                [
                                                    'text' => 'Course Registration Session',
                                                    'url'  => 'courseregistration/sessionindex',
                                                ],
                                                [
                                                    'text' => 'Print Course Form',
                                                    'url'  => 'courseregistration/printindex',
                                                ],
                                                [
                                                    'text' => 'Print Course Form(session)',
                                                    'url'  => 'courseregistration/printbysessionindex',
                                                ],
                                ]
                            ],
                            [
                                'text' => 'Curriculum Manager',
                                'url'  => 'CurriculumManager',
                            ],
                            [
                                'text' => 'School Manager',
                                'url'  => 'schoolmanager',
                            ],
                            [
                                'text' => 'Department Manager',
                                'url'  => 'departmentmanager',
                            ],
                            [
                                'text' => 'Subject Combination',
                                'url'  => 'subjectcombinationindex',
                            ],
                            [
                                'text' => 'Staff Manager',
                                'url'  => 'staffmanager',
                            ],
                            [
                                'text' => 'Session Manager',
                                'url'  => 'sessionmanager',
                            ],
                            [
                                'text' => 'Activity Manager',
                                'url'  => 'activity',
                            ],
                            [
                                'text' => 'Activity Scheduler',
                                'url'  => 'activityschedule',
                            ],
                        ]
            
        ],

        [
            'text' => 'RESULT MANAGEMENT',
            'url'  => '#',
            'icon' => 'line-chart',
            'submenu' => [
                            [
                                'text' => 'Result Viewer',
                                'url'  => 'resultviewer',
                            ],
                            [
                                'text' => 'Result Slip',
                                'url'  => 'resultslipindex',
                            ],
                            [
                                'text' => 'Statement Of Result',
                                'url'  => 'resultstmtindex',
                            ],
                            [
                                'text' => 'Transcript',
                                'url'  => 'transcriptindex',
                            ],
                            [
                                'text' => 'Detailed',
                                'url'  => 'detailedresult',
                            ],
                            [
                                'text' => 'Detailed II',
                                'url'  => 'detailedresult2',
                            ],
                            [
                                'text' => 'Mark Master Sheet',
                                'url'  => 'markmastersheet',
                            ],
                            [
                                'text' => 'Mark Master Sheet II',
                                'url'  => 'mms2',
                            ],
                            [
                                'text' => 'Summary',
                                'url'  => 'summary',
                            ],
                            [
                                'text' => 'Summary Passed',
                                'url'  => 'summarypassed',
                            ],
                            [
                                'text' => 'Graduating List',
                                'url'  => 'mmsgraduating',
                            ],
                            [
                                'text' => 'ESA Scores',
                                'url'  => 'esaviewer',
                            ],
                            [
                                'text' => 'Rectify Score',
                                'url'  => 'rectify',
                            ],
                            [
                                'text' => 'Score Range',
                                'url'  => 'scorerange',
                            ],
                            [
                                'text' => 'Uploaded Scores',
                                'url'  => 'uploadedscore',
                            ],
                        ]
        ],
        [
            'text' => 'DOCUMENTS',
            'url'  => '#',
            'icon' => 'line-chart',
            'submenu' => [
                            [
                                'text' => 'EMS',
                                'url'  => '#',
                                'icon' => 'bar-chart',
                                'submenu' => [
                                                [
                                                    'text' => 'EMS',
                                                    'url'  => 'ems',
                                                ],
                                                [
                                                    'text' => 'EMS 2',
                                                    'url'  => 'ems2',
                                                ],
                                                [
                                                    'text' => 'EMS 3',
                                                    'url'  => 'ems3',
                                                ],
                                                [
                                                    'text' => 'EMS 4',
                                                    'url'  => 'ems4',
                                                ],
                                            ]
                            ],
                            [
                                'text' => 'Statistics',
                                'url'  => 'statistics',
                                'url'  => '#',
                                'icon' => 'bar-chart',
                                'submenu' => [
                                                [
                                                    'text' => 'Student Statistics',
                                                    'url'  => 'statistics/studentlist',
                                                ],
                                                [
                                                    'text' => 'Student List',
                                                    'url'  => 'statistics/studentinfo',
                                                ],
                                                [
                                                    'text' => 'Lecturer Statistics',
                                                    'url'  => 'statistics/lecturerlist',
                                                ],
                                                [
                                                    'text' => 'Course Statistics',
                                                    'url'  => 'statistics/courselist',
                                                ],
                                            ]
                            ]
                        ]
        ],
        [
            'text' => 'SETTINGS',
            'url'  => '#',
            'icon' => 'line-chart',
            'submenu' => [
                            [
                                'text' => 'Generate Matric',
                                'url'  => 'matric',
                            ],
                            [
                                'text' => 'Users',
                                'url'  => 'usermanager',
                            ],
                            [
                                'text'  => 'Pin Manager',
                                'url'   => '#',
                                'submenu' => [
                                    [
                                        'text' => 'Generate Pin',
                                        'url'  => 'generatepinpage',
                                    ],
                                    [
                                        'text' => 'Show Pin',
                                        'url'  => 'pin',
                                    ],
                                    [
                                        'text' => 'Print Pin',
                                        'url'  => 'printpin',
                                    ],
                                ]
                            ],
                            [
                                'text' => 'Promote To Next Level',
                                'url'  => 'promote',
                            ],
                            [
                                'text' => 'Reset Uploaded Score',
                                'url'  => 'resetuploadindex',
                            ],
                            [
                                'text' => 'Suspension Cases',
                                'url'  => '#',
                                'submenu' => [
                                    [
                                        'text' => 'Activate Probation',
                                        'url'  => 'suspension/probation',
                                    ],
                                    [
                                        'text' => 'De-Activate Probation',
                                        'url'  => 'suspension',
                                    ],
                                ]
                            ],
                            [
                                'text' => 'New Student Upload',
                                'url'  => 'studentmanager/fresher',
                            ],

                        ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];

