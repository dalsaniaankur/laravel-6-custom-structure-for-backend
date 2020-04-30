<?php
return ['footer'                                     => [['link'  => '/',
                                                          'label' => 'Home',],
                                                         ['link'  => 'about-us',
                                                          'label' => 'About us',],
                                                         ['link'  => 'terms',
                                                          'label' => 'Terms and Conditions',],
                                                         ['link'  => 'privacy-policy',
                                                          'label' => 'Privacy policy',],
                                                         ['link'  => 'contact-us',
                                                          'label' => 'Contact us',],],
        'header_top'                                 => [['link'  => '/',
                                                          'label' => 'Home'],
                                                         ['link'  => 'about-us',
                                                          'label' => 'About us',],
                                                         ['link'  => '',
                                                          'label' => 'Download the App',],
                                                         ['link'  => 'contact-us',
                                                          'label' => 'Contact us',],],
        'header_top_side_menu_admin'                 => [['link'  => 'home',
                                                          'label' => 'Dash Home'],
                                                         ['link'  => 'schools',
                                                          'label' => 'Schools',],
                                                         ['link'  => 'email-templates',
                                                          'label' => 'Email Templates',],
                                                         ['link'  => 'messages',
                                                          'label' => 'Messages',],
                                                         ['link'  => 'cms-pages',
                                                          'label' => 'CMS Pages',],
                                                         ['link'  => 'notifications',
                                                          'label' => 'Notifications',],
                                                         ['link'  => 'event-and-notices',
                                                          'label' => 'Event And Notices',],
                                                         ['link'  => 'settings',
                                                          'label' => 'Settings',],
                                                         ['link'  => 'profile',
                                                          'label' => 'Profile',],],
        'header_top_side_menu_school'                => [['link'  => 'home',
                                                          'label' => 'Dash Home'],
                                                         ['link'  => 'grades',
                                                          'label' => 'Grades'],
                                                         ['link'  => 'students',
                                                          'label' => 'Students'],
                                                         ['link'  => 'exams',
                                                          'label' => 'Exams'],
                                                         ['link'  => 'profile',
                                                          'label' => 'Profile'],],
        'header_top_side_menu_teacher'               => [['link'  => 'home',
                                                          'label' => 'Dash Home'],
                                                         ['link'  => 'students',
                                                          'label' => 'Students'],
                                                         ['link'  => 'parents',
                                                          'label' => 'Parents'],
                                                         ['link'  => 'homework',
                                                          'label' => 'Homework'],
                                                         ['link'  => 'messages',
                                                          'label' => 'Messages'],
                                                         ['link'  => 'profile',
                                                          'label' => 'Profile'],],
        'header_top_login_menu'                      => [['link'  => 'school_login',
                                                          'label' => 'School'],
                                                         ['link'  => 'teacher_login',
                                                          'label' => 'Teacher']],
        'show_login_menu_in_page_type'               => ['school_auth',
                                                         'teacher_auth'],
        'show_forgot_password_link_in_page_type'     => ['school_auth',
                                                         'teacher_auth'],
        'show_side_menu_in_page_type'                => ['admin',
                                                         'school',
                                                         'teacher'],
        'show_backend_style_and_script_in_page_type' => ['admin',
                                                         'school',
                                                         'teacher'],

];