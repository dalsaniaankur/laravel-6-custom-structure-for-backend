<?php

Route::get( '/', 'HomeController@index' );
Route::get( 'about-us', 'HomeController@aboutUs' );
Route::get( 'contact-us', 'HomeController@contactUs' );
Route::get( 'privacy-policy', 'HomeController@privacyPolicy' );
Route::get( 'terms', 'HomeController@termsServices' );

/* Password Generate */
Route::post( 'password_generate', ['uses' => 'CommonController@getPasswordGenerate','as'   => 'password_generate'] );
Route::get( 'send-schedule-notification', ['uses' => 'NotificationController@sendScheduleNotification','as'   => 'send_schedule_notification'] );

/* Admin Auth Start */
Route::get( 'admin_login', 'Admin\Auth\LoginController@showLoginForm' )->name( 'admin_login' );
Route::post( 'admin_login', 'Admin\Auth\LoginController@login' );
Route::post( 'admin_logout', 'Admin\Auth\LoginController@logout' )->name( 'admin_logout' );

/* Admin region start */
Route::group( ['middleware' => ['admin'],
               'namespace' => 'Admin',
               'prefix'     => 'admin',
               'as'         => 'admin.'], function () {

    Route::get( '/home', 'HomeController@index' );

    /* Configuration Start */
    Route::get( 'settings', ['uses' => 'Configuration\IndexController@index','as'   => 'settings'] );
    Route::post( 'settings', ['uses' => 'Configuration\IndexController@save','as'   => 'setting.save'] );
    /* Configuration End */

    /* School level Start */
    Route::delete( 'school-level/delete', ['uses' => 'SchoolLevel\IndexController@delete',
                                           'as'   => 'school_level.delete'] );

    Route::post( 'school-level/save_ajax', ['uses' => 'SchoolLevel\IndexController@saveAjax',
                                       'as'   => 'school_level.save_ajax'] );

    Route::post( 'school-level/get_data', ['uses' => 'SchoolLevel\IndexController@getDataForEditModel',
                                      'as'   => 'school_level.getdata'] );
    /* School level Start */

	/* Email Template Start */
    Route::get( 'email-templates', ['uses' => 'EmailTemplate\IndexController@index','as'   => 'email_templates'] );
    Route::get( 'email-templates/details/{emailtemplate_id}', ['uses' => 'EmailTemplate\IndexController@emailDetails','as'   => 'emailtemplate.details'] );

    Route::post( 'email-templates/save', ['uses' => 'EmailTemplate\IndexController@save','as'   => 'emailtemplate.save'] );
    /* Email Template End */

    /* School Start */
    Route::get( 'schools', ['uses' => 'School\IndexController@index',
                             'as'   => 'schools'] );

	Route::get( 'schools/{school_id?}', ['uses' => 'School\IndexController@schoolDetails',
                             'as'   => 'school.view'] );

	Route::post( 'schools/change_password', ['uses' => 'School\IndexController@changePassword',
                             'as'   => 'school.changepassword'] );

	Route::post( 'schools/saveprincipal', ['uses' => 'School\IndexController@savePrincipal',
                             'as'   => 'school.saveprincipal'] );

	Route::post( 'schools/updateschool', ['uses' => 'School\IndexController@updateSchool',
                             'as'   => 'school.updateschool'] );

	Route::post( 'schools/{school_id?}', ['uses' => 'School\IndexController@profileSave',
                             'as'   => 'school.saveprofile'] );

    Route::get( 'school/create/{school_id?}', ['uses' => 'School\IndexController@create',
                                   'as'   => 'school.create'] );

	Route::post( 'school/create', ['uses' => 'School\IndexController@schoolCreate',
                                   'as'   => 'school.create.save'] );

    Route::get( 'school/edit/{user_id}', ['uses' => 'School\IndexController@edit',
                                           'as'   => 'school.edit'] );

    Route::post( 'school/save', ['uses' => 'School\IndexController@save',
                                  'as'   => 'school.save'] );

    Route::delete( 'school/delete', ['uses' => 'School\IndexController@delete',
                                      'as'   => 'school.delete'] );

	Route::post( 'school/ban_reactive', ['uses' => 'School\IndexController@banOrReActive',
                                           'as'   => 'school.ban_reactive'] );
    /* School End */

	/* Grade Start */
	Route::get( 'grade/{school_id}', ['uses' => 'Classes\IndexController@index',
                            'as'   => 'grade'] );

    Route::get( 'grade/create/{school_id}', ['uses' => 'Grade\IndexController@create',
                            'as'   => 'grade'] );

    Route::post( 'grade/create/{school_id}', ['uses' => 'Grade\IndexController@createSave',
                                  'as'   => 'grade.create'] );

    Route::post( 'grade/save', ['uses' => 'Grade\IndexController@save',
                                 'as'   => 'grade.save'] );

    Route::post( 'grade/get_data', ['uses' => 'Grade\IndexController@getDataForEditModel',
                                    'as'   => 'grade.get_data'] );

    Route::post( 'grade/save_ajax', ['uses' => 'Grade\IndexController@saveAjax',
                                     'as'   => 'grade.save_ajax'] );

    Route::delete( 'grade/delete', ['uses' => 'Grade\IndexController@delete',
                                     'as'   => 'grade.delete'] );

	/* Grade End */

    /* Teacher Start */
    Route::get( 'teacher/create/{school_id}', ['uses' => 'Teacher\IndexController@create',
                                             'as'   => 'teacher'] );

    Route::delete( 'teacher/delete', ['uses' => 'Teacher\IndexController@delete',
                                    'as'   => 'teacher.delete'] );

    Route::post( 'teacher/create', ['uses' => 'Teacher\IndexController@createSave',
                                              'as'   => 'teacher.create'] );

    Route::post( 'teacher/get_data', ['uses' => 'Teacher\IndexController@getDataForEditTeacherModel',
                                    'as'   => 'teacher.get_data'] );

    Route::post( 'teacher/save_ajax', ['uses' => 'Teacher\IndexController@saveAjaxForTeacher',
                                     'as'   => 'teacher.save_ajax'] );

    Route::post( 'teacher_module/save_ajax', ['uses' => 'Teacher\IndexController@saveAjaxForTeacherModule',
                                       'as'   => 'teacher.save_ajax'] );

	Route::get( 'teachers', ['uses' => 'Teacher\IndexController@index',
                                             'as'   => 'teachers'] );

	Route::get( 'teacher/profile/{user_id}', ['uses' => 'Teacher\IndexController@profileDetails','as'   => 'teacher.profile'] );


    Route::post( 'teacher/ban_reactive', ['uses' => 'Teacher\IndexController@banOrReActive',
                                           'as'   => 'teacher.ban_reactive'] );

    Route::post( 'teacher/profile/save', ['uses' => 'Teacher\IndexController@profileSave','as'   => 'teacher.profile.save'] );
	Route::post( 'teacher/change_password', ['uses' => 'Teacher\IndexController@changePassword','as'   => 'teacher.change_password'] );

    Route::post( 'teacher/club/save', ['uses' => 'Teacher\IndexController@clubSave','as'   => 'teacher.club.save'] );

    Route::delete( 'teacher/club/delete', ['uses' => 'Teacher\IndexController@clubDelete',
                                           'as'   => 'teacher.club.delete'] );


    /* Teacher End */

    /* Class Start */
    Route::get( 'classes', ['uses' => 'Classes\IndexController@index',
                                        'as'   => 'classes'] );

    Route::get( 'class/create/{school_id}', ['uses' => 'Classes\IndexController@create',
                                             'as'   => 'class.create'] );

    Route::post( 'class/save', ['uses' => 'Classes\IndexController@save',
                                'as'   => 'class.save'] );

    Route::delete( 'class/delete', ['uses' => 'Classes\IndexController@delete',
                                    'as'   => 'class.delete'] );

	Route::post( 'class/get_data', ['uses' => 'Classes\IndexController@getData',
                                'as'   => 'class.getdata'] );

    /* Class End */


    /* Student Start */

    Route::get( 'students/{school_id?}', ['uses' => 'Student\IndexController@index',
                             'as'   => 'students'] );

    Route::delete( 'student/delete', ['uses' => 'Student\IndexController@delete',
                                      'as'   => 'student.delete'] );

    Route::post( 'student/save_ajax', ['uses' => 'Student\IndexController@saveAjax',
                                       'as'   => 'student.save_ajax'] );

    Route::get( 'student/profile/{user_id}', ['uses' => 'Student\IndexController@profileDetails','as'   => 'profile'] );


    Route::post( 'student/ban_reactive', ['uses' => 'Student\IndexController@banOrReActive',
                                           'as'   => 'student.ban_reactive'] );

    Route::post( 'student/profile/save', ['uses' => 'Student\IndexController@profileSave','as'   => 'student.profile.save'] );

    Route::post( 'student/allergy/save', ['uses' => 'Student\IndexController@allergySave','as'   => 'student.allergy.save'] );

    Route::delete( 'student/allergy/delete', ['uses' => 'Student\IndexController@allergyDelete',
                                    'as'   => 'student.allergy.delete'] );

    Route::post( 'student/club/save', ['uses' => 'Student\IndexController@clubSave','as'   => 'student.club.save'] );

    Route::delete( 'student/club/delete', ['uses' => 'Student\IndexController@clubDelete',
                                              'as'   => 'student.club.delete'] );

    Route::post( 'student/change_password', ['uses' => 'Student\IndexController@changePassword','as'   => 'student.change_password'] );

    Route::get( 'student/academics/{user_id}', ['uses' => 'Student\IndexController@academicsDetails','as'   => 'academics.details'] );

    Route::delete( 'student/exam-result/delete', ['uses' => 'Student\IndexController@ExamResultDelete',
                                           'as'   => 'student.exam_result.delete'] );

	Route::post( 'student/academic/get_data', ['uses' => 'Student\IndexController@getDataForEditModel','as'   => 'student.academic.get_data'] );
	Route::post( 'student/academic/ajax_save', ['uses' => 'Student\IndexController@examResultSave','as'   => 'student.academic.save_data'] );

	Route::post( 'student/academic/delete', ['uses' => 'Student\IndexController@examSubjectDelete',
                                           'as'   => 'student.exam_subject.delete'] );

    Route::post( 'student/bio/update', ['uses' => 'Student\IndexController@updateBio','as'   => 'student.bio.update'] );

    /* Student End */

    /* Student Feed Start  */

	Route::get( 'student/feed/{user_id}', ['uses' => 'Student\FeedController@feedDetails','as'   => 'feedDetails'] );

	Route::delete( 'student/feed/delete', ['uses' => 'Student\FeedController@feedDelete',
                                    'as'   => 'student.feed.delete'] );

	Route::post( 'student/feed/get_data', ['uses' => 'Student\FeedController@getDataForEditModel','as'   => 'feed.get_data'] );

	Route::post( 'student/feed/ajax_save', ['uses' => 'Student\FeedController@saveAjax',
                                       'as'   => 'student.feed.save_ajax'] );

    /* Student Feed End */

	/* Parent Start */

	 Route::get( 'parents', ['uses' => 'Parent\IndexController@index',
                             'as'   => 'parents'] );

    Route::delete( 'parent/delete', ['uses' => 'Parent\IndexController@delete',
                                      'as'   => 'parent.delete'] );

	Route::get( 'parent/profile/{user_id}', ['uses' => 'Parent\IndexController@profileDetails','as'   => 'parent.profile'] );


    Route::post( 'parent/ban_reactive', ['uses' => 'Parent\IndexController@banOrReActive',
                                           'as'   => 'parent.ban_reactive'] );

    Route::post( 'parent/profile/save', ['uses' => 'Parent\IndexController@profileSave','as'   => 'parent.profile.save'] );
	Route::post( 'parent/change_password', ['uses' => 'parent\IndexController@changePassword','as'   => 'parent.change_password'] );

	Route::post( 'parent/save_ajax', ['uses' => 'Parent\IndexController@saveAjax','as'   => 'parent.profile.saveajax'] );

	/* Parent End */

    /* Club Start */
    Route::get( 'clubs', ['uses' => 'Club\IndexController@index',
                             'as'   => 'clubs'] );

	Route::post( 'club/save', ['uses' => 'Club\IndexController@save',
                             'as'   => 'clubs.savedata'] );

	Route::post( 'club/get_data', ['uses' => 'Club\IndexController@getDataForEditModel',
                             'as'   => 'clubs.get_data'] );
    Route::delete( 'club/delete', ['uses' => 'Club\IndexController@delete',
                                      'as'   => 'club.delete'] );

    Route::get( 'club/member/{id}', ['uses' => 'Club\IndexController@member',
                                     'as'   => 'club.member'] );

    Route::delete( 'user-club/delete', ['uses' => 'Club\IndexController@deleteUserClub',
                                   'as'   => 'user_club.delete'] );

    Route::post( 'club_member/save', ['uses' => 'Club\IndexController@saveClubMember',
                               'as'   => 'club_member.save'] );

    Route::post( 'club_member/save_ajax', ['uses' => 'Club\IndexController@saveAjaxClubMember',
                                           'as'   => 'club_member.save'] );

    /* Club End */


    /* Grade Start */
    Route::get( 'grades', ['uses' => 'Grade\IndexController@index',
                          'as'   => 'grades'] );

    Route::post( 'grade/ajax_save', ['uses' => 'Grade\IndexController@saveAjax',
                               'as'   => 'grade.ajax_save'] );

    /* Grade End */

    /* Contact send mail Start */
    Route::post( 'contact/send_mail', ['uses' => 'Contact\IndexController@postSendMail',
                                        'as'   => 'contact.send_mail'] );

	Route::post( 'contact/send_mail_parent', ['uses' => 'Contact\IndexController@contactParentMail',
                                        'as'   => 'contact.send_mail_parent'] );

    /* Contact send mail End */

    /* Messages Start */
    Route::get( 'messages', ['uses' => 'Message\IndexController@index',
                            'as'   => 'messages'] );

    Route::delete( 'message/delete', ['uses' => 'Message\IndexController@delete',
                                   'as'   => 'message.delete'] );

    Route::post( 'message/save_ajax', ['uses' => 'Message\IndexController@saveAjax',
                                     'as'   => 'message.save_ajax'] );

    Route::post( 'message/get_data', ['uses' => 'Message\IndexController@getDataForEditModel',
                                   'as'   => 'message.get_data'] );
    /* Messages End */

    /* Cms Page Start */

    Route::get( 'cms-pages', ['uses' => 'CmsPage\IndexController@index',
                              'as'   => 'cms_pages'] );

    Route::post( 'cms-page/save_ajax', ['uses' => 'CmsPage\IndexController@save',
                                   'as'   => 'cms_page.save'] );

    Route::post( 'cms-page/get_data', ['uses' => 'CmsPage\IndexController@getDataForEditModel',
                                       'as'   => 'cms_page.get_data'] );

    Route::delete( 'cms-page/delete', ['uses' => 'CmsPage\IndexController@delete',
                                      'as'   => 'cms_page.delete'] );

    Route::delete( 'cms-page/delete-image', ['uses' => 'CmsPage\IndexController@deleteImage',
                                       'as'   => 'cms_page.delete_image'] );

    /* Cms Page End */

    /* Notification Start */

    Route::get( 'notifications', ['uses' => 'Notification\IndexController@index',
                             'as'   => 'notifications'] );

    Route::delete( 'notification/delete', ['uses' => 'Notification\IndexController@delete',
                                      'as'   => 'notification.delete'] );

    Route::post( 'notification/create', ['uses' => 'Notification\IndexController@save',
                                   'as'   => 'notification.save'] );

	Route::get( 'notification/details/{id}', ['uses' => 'Notification\IndexController@getDataForViewModel',
                                           'as'   => 'notification.details'] );

	Route::post( 'notification/update', ['uses' => 'Notification\IndexController@updateNotification',
                                   'as'   => 'notification.update'] );

	Route::post( 'notification/send_notification', ['uses' => 'Notification\IndexController@sendNotification',
                                       'as'   => 'notification.send'] );

    /* Notification Start */

    /* Event And Notice Start */

    Route::get( 'event-and-notices', ['uses' => 'EventAndNotification\IndexController@index',
                                  'as'   => 'event_and_notifications'] );

    Route::delete( 'event-and-notification/delete', ['uses' => 'EventAndNotification\IndexController@delete',
                                           'as'   => 'event_and_notification.delete'] );

    Route::post( 'event-and-notification/create', ['uses' => 'EventAndNotification\IndexController@save',
                                         'as'   => 'event_and_notification.save'] );

    Route::post( 'event-and-notification/get_data', ['uses' => 'EventAndNotification\IndexController@getDataForEditModel',
                                   'as'   => 'event_and_notification.get_data'] );

    Route::post( 'event-and-notification/ajax_save', ['uses' => 'EventAndNotification\IndexController@saveAjax',
                                    'as'   => 'event_and_notification.save_ajax'] );

    /* Event And Notice Start */



    /* Classes Start */
    Route::get( 'classes', ['uses' => 'Classes\IndexController@index',
                           'as'   => 'classes'] );

    Route::post( 'class/ajax_save', ['uses' => 'Classes\IndexController@saveAjax',
                                     'as'   => 'classes.ajax_save'] );
    /* Classes End */

    /* Configuration Start */
    Route::get( 'settings', ['uses' => 'Configuration\IndexController@index',
                             'as'   => 'settings'] );

    Route::post( 'settings', ['uses' => 'Configuration\IndexController@save',
                              'as'   => 'setting.save'] );

    /* Configuration End */

    /* Grade Start */
    Route::get( 'exams', ['uses' => 'Exam\IndexController@index',
                                        'as'   => 'exams'] );

	Route::post( 'exam/get_data', ['uses' => 'Exam\IndexController@getDataForEditModel',
                                     'as'   => 'exam.getdata'] );

    Route::post( 'exam/ajax_save', ['uses' => 'Exam\IndexController@saveAjax',
                                     'as'   => 'exam.save_ajax'] );

    Route::delete( 'exam/delete', ['uses' => 'Exam\IndexController@delete',
                                   'as'   => 'exam.delete'] );

    /* Grade End */


    /* Profile Start */
    Route::get( 'profile', ['uses' => 'Profile\IndexController@index','as'   => 'profile'] );
    Route::post( 'profile', ['uses' => 'Profile\IndexController@profileSave','as'   => 'profile'] );
    Route::post( 'change_password', ['uses' => 'Profile\IndexController@changePassword','as'   => 'change_password'] );
    /* Profile end */

    /* PTA Member Start */

    Route::get( 'pta-members', ['uses' => 'PTAMember\IndexController@index',
                                'as'   => 'pta_members'] );

    Route::delete( 'pta_member/delete', ['uses' => 'PTAMember\IndexController@delete',
                                         'as'   => 'pta_member.delete'] );

    Route::post( 'pta_member/save_ajax', ['uses' => 'PTAMember\IndexController@saveAjax',
                                          'as'   => 'pta_member.save_ajax'] );

    Route::get( 'pta-member/profile/{user_id}', ['uses' => 'PTAMember\IndexController@profileDetails','as'   => 'pta_member.profile'] );


    Route::post( 'pta_member/ban_reactive', ['uses' => 'PTAMember\IndexController@banOrReActive',
                                             'as'   => 'pta_member.ban_reactive'] );

    Route::post( 'pta_member/profile/save', ['uses' => 'PTAMember\IndexController@profileSave','as'   => 'pta_member.profile.save'] );

    Route::post( 'pta_member/change_password', ['uses' => 'PTAMember\IndexController@changePassword','as'   => 'pta_member.change_password'] );

	/*allergy*/
	Route::delete( 'allergy/delete', ['uses' => 'Allergy\IndexController@delete',
                                      'as'   => 'allergy.delete'] );

	Route::post( 'allergy/save_ajax', ['uses' => 'Allergy\IndexController@saveAjax',
                                          'as'   => 'allergy.save_ajax'] );

	Route::post( 'allergy/get_data', ['uses' => 'Allergy\IndexController@getDataForEditModel',
                                     'as'   => 'allergy.getdata'] );
    /* PTA Member End */

    /* Backend Logs Start */
    //Route::get( 'backend-logs', ['uses' => 'BackendLog\IndexController@index','as'   => 'backend_logs'] );

});
/* Admin region end */

/*---------------------------------------------------------------------------------------------------*/

/* School Auth Start */
Route::get( 'school_login', 'School\Auth\LoginController@showLoginForm' )->name( 'school_login' );
Route::post( 'school_login', 'School\Auth\LoginController@login' );
Route::post( 'school_logout', 'School\Auth\LoginController@logout' )->name( 'school_logout' );

// School registration Routes
/*Route::get( 'school_register', ['uses' => 'School\Auth\RegisterController@showRegistrationForm',
                                'as'   => 'school_register'] );*/
Route::post( 'school_register', ['uses' => 'School\Auth\RegisterController@register',
                                'as'   => 'school_register'] );

//School Password Reset Routes
Route::get( 'school_password/reset', 'School\Auth\ForgotPasswordController@showLinkRequestForm' )
     ->name( 'school.password.request' );
Route::post( 'school_password/email', 'School\Auth\ForgotPasswordController@sendResetLinkEmail' )
     ->name( 'school.password.email' );

Route::get( 'school_password/reset/{token}', 'School\Auth\ResetPasswordController@showResetForm' )
     ->name( 'school.password.reset' );
Route::post( 'school_password/reset', 'School\Auth\ResetPasswordController@reset' )
     ->name( 'school.password.reset' );

Route::get('school_email/verify', 'School\Auth\VerificationController@show')->name('school.verification.notice');
Route::get('school_email/verify/{id}', 'School\Auth\VerificationController@verify')->name('school.verification.verify');
Route::get('school_email/resend', 'School\Auth\VerificationController@resend')->name('school.verification.resend');

/* End School Auth */

/*---------------------------------------------------------------------------------------------------*/

/* School region start */
Route::group( ['middleware' => ['school'],
               'namespace' => 'School',
               'prefix'     => 'school',
               'as'         => 'school.'], function () {

    Route::get( '/home', 'HomeController@index' );


    /* Grade Start */

    Route::get( 'grades', ['uses' => 'Grade\IndexController@index',
                                        'as'   => 'grades'] );

    Route::post( 'grade/ajax_save', ['uses' => 'Grade\IndexController@saveAjax',
                                     'as'   => 'grade.ajax_save'] );

    Route::post( 'grade/get_data', ['uses' => 'Grade\IndexController@getDataForEditModel',
                                    'as'   => 'grade.get_data'] );

    Route::delete( 'grade/delete', ['uses' => 'Grade\IndexController@delete',
                                    'as'   => 'grade.delete'] );

    /* Grade End */


    /* Student Start */

    Route::get( 'students/{school_id?}', ['uses' => 'Student\IndexController@index',
                                          'as'   => 'students'] );

    Route::delete( 'student/delete', ['uses' => 'Student\IndexController@delete',
                                      'as'   => 'student.delete'] );

    Route::post( 'student/save_ajax', ['uses' => 'Student\IndexController@saveAjax',
                                       'as'   => 'student.save_ajax'] );

    Route::get( 'student/profile/{user_id}', ['uses' => 'Student\IndexController@profileDetails','as'   => 'profile'] );


    Route::post( 'student/ban_reactive', ['uses' => 'Student\IndexController@banOrReActive',
                                          'as'   => 'student.ban_reactive'] );

    Route::post( 'student/profile/save', ['uses' => 'Student\IndexController@profileSave','as'   => 'student.profile.save'] );

    Route::post( 'student/allergy/save', ['uses' => 'Student\IndexController@allergySave','as'   => 'student.allergy.save'] );

    Route::delete( 'student/allergy/delete', ['uses' => 'Student\IndexController@allergyDelete',
                                              'as'   => 'student.allergy.delete'] );

    Route::post( 'student/club/save', ['uses' => 'Student\IndexController@clubSave','as'   => 'student.club.save'] );

    Route::delete( 'student/club/delete', ['uses' => 'Student\IndexController@clubDelete',
                                           'as'   => 'student.club.delete'] );

    Route::post( 'student/change_password', ['uses' => 'Student\IndexController@changePassword','as'   => 'student.change_password'] );

    Route::get( 'student/academics/{user_id}', ['uses' => 'Student\IndexController@academicsDetails','as'   => 'academics.details'] );

    Route::delete( 'student/exam-result/delete', ['uses' => 'Student\IndexController@ExamResultDelete',
                                                  'as'   => 'student.exam_result.delete'] );

    Route::post( 'student/academic/get_data', ['uses' => 'Student\IndexController@getDataForEditModel','as'   => 'student.academic.get_data'] );
    Route::post( 'student/academic/ajax_save', ['uses' => 'Student\IndexController@examResultSave','as'   => 'student.academic.save_data'] );

    Route::post( 'student/academic/delete', ['uses' => 'Student\IndexController@examSubjectDelete',
                                             'as'   => 'student.exam_subject.delete'] );

    Route::post( 'student/bio/update', ['uses' => 'Student\IndexController@updateBio','as'   => 'student.bio.update'] );

    /* Student End */

    /* Student Feed Start  */

    Route::get( 'student/feed/{user_id}', ['uses' => 'Student\FeedController@feedDetails','as'   => 'feedDetails'] );

    Route::delete( 'student/feed/delete', ['uses' => 'Student\FeedController@feedDelete',
                                           'as'   => 'student.feed.delete'] );

    Route::post( 'student/feed/get_data', ['uses' => 'Student\FeedController@getDataForEditModel','as'   => 'feed.get_data'] );

    Route::post( 'student/feed/ajax_save', ['uses' => 'Student\FeedController@saveAjax',
                                            'as'   => 'student.feed.save_ajax'] );

    /* Student Feed End */


    /* Exam Start */
    Route::get( 'exams', ['uses' => 'Exam\IndexController@index',
                          'as'   => 'exams'] );

    Route::post( 'exam/get_data', ['uses' => 'Exam\IndexController@getDataForEditModel',
                                   'as'   => 'exam.getdata'] );

    Route::post( 'exam/ajax_save', ['uses' => 'Exam\IndexController@saveAjax',
                                    'as'   => 'exam.save_ajax'] );

    Route::delete( 'exam/delete', ['uses' => 'Exam\IndexController@delete',
                                   'as'   => 'exam.delete'] );

    /* Exam End */

    /* Profile Start */
    Route::get( 'profile', ['uses' => 'Profile\IndexController@index','as'   => 'profile'] );
    Route::post( 'profile', ['uses' => 'Profile\IndexController@profileSave','as'   => 'profile'] );
    Route::post( 'change_password', ['uses' => 'Profile\IndexController@changePassword','as'   => 'change_password'] );
    Route::post( 'save_principal', ['uses' => 'Profile\IndexController@savePrincipal',
                                           'as'   => 'save_principal'] );
    Route::post( 'save_school', ['uses' => 'Profile\IndexController@saveSchool',
                                          'as'   => 'save_school'] );
    /* Profile end */
});
/* School region end */

/*---------------------------------------------------------------------------------------------------*/

/* School Auth Start */
Route::get( 'teacher_login', 'Teacher\Auth\LoginController@showLoginForm' )->name( 'teacher_login' );
Route::post( 'teacher_login', 'Teacher\Auth\LoginController@login' );
Route::post( 'teacher_logout', 'Teacher\Auth\LoginController@logout' )->name( 'teacher_logout' );

// School registration Routes
/*Route::get( 'teacher_register', ['uses' => 'Teacher\Auth\RegisterController@showRegistrationForm',
                                'as'   => 'teacher_register'] );*/
Route::post( 'teacher_register', ['uses' => 'Teacher\Auth\RegisterController@register',
                                 'as'   => 'teacher_register'] );

//School Change Password Routes
/*Route::get( 'teacher_change_password', 'Teacher\Auth\ChangePasswordController@showChangePasswordForm' )
     ->name( 'teacher_change_password' );
Route::patch( 'teacher_change_password', 'Teacher\Auth\ChangePasswordController@changePassword' )
     ->name( 'teacher_change_password' );*/

//School Password Reset Routes
Route::get( 'teacher_password/reset', 'Teacher\Auth\ForgotPasswordController@showLinkRequestForm' )
     ->name( 'teacher.password.request' );
Route::post( 'teacher_password/email', 'Teacher\Auth\ForgotPasswordController@sendResetLinkEmail' )
     ->name( 'teacher.password.email' );

Route::get( 'teacher_password/reset/{token}', 'Teacher\Auth\ResetPasswordController@showResetForm' )
     ->name( 'teacher.password.reset' );
Route::post( 'teacher_password/reset', 'Teacher\Auth\ResetPasswordController@reset' )
     ->name( 'teacher.password.reset' );


Route::get('teacher_email/verify', 'Teacher\Auth\VerificationController@show')->name('teacher.verification.notice');
Route::get('teacher_email/verify/{id}', 'Teacher\Auth\VerificationController@verify')->name('teacher.verification.verify');
Route::get('teacher_email/resend', 'Teacher\Auth\VerificationController@resend')->name('teacher.verification.resend');

/* End School Auth */

/*---------------------------------------------------------------------------------------------------*/

/* School region start */
Route::group( ['middleware' => ['teacher'],
               'namespace' => 'Teacher',
               'prefix'     => 'teacher',
               'as'         => 'teacher.'], function () {

    Route::get( '/home', 'HomeController@index' );


    /* Parent Start */

    Route::get( 'parents', ['uses' => 'Parent\IndexController@index',
                            'as'   => 'parents'] );

    Route::delete( 'parent/delete', ['uses' => 'Parent\IndexController@delete',
                                     'as'   => 'parent.delete'] );

    Route::get( 'parent/profile/{user_id}', ['uses' => 'Parent\IndexController@profileDetails','as'   => 'parent.profile'] );


    Route::post( 'parent/ban_reactive', ['uses' => 'Parent\IndexController@banOrReActive',
                                         'as'   => 'parent.ban_reactive'] );

    Route::post( 'parent/profile/save', ['uses' => 'Parent\IndexController@profileSave','as'   => 'parent.profile.save'] );
    Route::post( 'parent/change_password', ['uses' => 'parent\IndexController@changePassword','as'   => 'parent.change_password'] );

    Route::post( 'parent/save_ajax', ['uses' => 'Parent\IndexController@saveAjax','as'   => 'parent.profile.saveajax'] );

    /* Parent End */

    /* Profile Start */
    Route::get( 'profile', ['uses' => 'Profile\IndexController@index','as'   => 'profileview'] );
    Route::post( 'profile', ['uses' => 'Profile\IndexController@profileSave','as'   => 'profileview'] );
    Route::post( 'change_password', ['uses' => 'Profile\IndexController@changePassword','as'   => 'change_password'] );
    /* Profile end */

	 /* Student Start */

    Route::get( 'students/', ['uses' => 'Student\IndexController@index',
                                          'as'   => 'students'] );

    Route::delete( 'student/delete', ['uses' => 'Student\IndexController@delete',
                                      'as'   => 'student.delete'] );

    Route::post( 'student/save_ajax', ['uses' => 'Student\IndexController@saveAjax',
                                       'as'   => 'student.save_ajax'] );

    Route::get( 'student/profile/{user_id}', ['uses' => 'Student\IndexController@profileDetails','as'   => 'profile'] );


    Route::post( 'student/ban_reactive', ['uses' => 'Student\IndexController@banOrReActive',
                                          'as'   => 'student.ban_reactive'] );

    Route::post( 'student/profile/save', ['uses' => 'Student\IndexController@profileSave','as'   => 'student.profile.save'] );

    Route::post( 'student/allergy/save', ['uses' => 'Student\IndexController@allergySave','as'   => 'student.allergy.save'] );

    Route::delete( 'student/allergy/delete', ['uses' => 'Student\IndexController@allergyDelete',
                                              'as'   => 'student.allergy.delete'] );

    Route::post( 'student/club/save', ['uses' => 'Student\IndexController@clubSave','as'   => 'student.club.save'] );

    Route::delete( 'student/club/delete', ['uses' => 'Student\IndexController@clubDelete',
                                           'as'   => 'student.club.delete'] );

    Route::post( 'student/change_password', ['uses' => 'Student\IndexController@changePassword','as'   => 'student.change_password'] );

    Route::get( 'student/academics/{user_id}', ['uses' => 'Student\IndexController@academicsDetails','as'   => 'academics.details'] );

    Route::delete( 'student/exam-result/delete', ['uses' => 'Student\IndexController@ExamResultDelete',
                                                  'as'   => 'student.exam_result.delete'] );

    Route::post( 'student/academic/get_data', ['uses' => 'Student\IndexController@getDataForEditModel','as'   => 'student.academic.get_data'] );
    Route::post( 'student/academic/ajax_save', ['uses' => 'Student\IndexController@examResultSave','as'   => 'student.academic.save_data'] );

    Route::post( 'student/academic/delete', ['uses' => 'Student\IndexController@examSubjectDelete',
                                             'as'   => 'student.exam_subject.delete'] );

    Route::post( 'student/bio/update', ['uses' => 'Student\IndexController@updateBio','as'   => 'student.bio.update'] );

    /* Student End */

    /* Student Feed Start  */

    Route::get( 'student/feed/{user_id}', ['uses' => 'Student\FeedController@feedDetails','as'   => 'feedDetails'] );

    Route::delete( 'student/feed/delete', ['uses' => 'Student\FeedController@feedDelete',
                                           'as'   => 'student.feed.delete'] );

    Route::post( 'student/feed/get_data', ['uses' => 'Student\FeedController@getDataForEditModel','as'   => 'feed.get_data'] );

    Route::post( 'student/feed/ajax_save', ['uses' => 'Student\FeedController@saveAjax',
                                            'as'   => 'student.feed.save_ajax'] );

    /* Student Feed End */

    /* Exam Start */
    Route::get( 'exams', ['uses' => 'Exam\IndexController@index',
                          'as'   => 'exams'] );

    Route::post( 'exam/get_data', ['uses' => 'Exam\IndexController@getDataForEditModel',
                                   'as'   => 'exam.getdata'] );

    Route::post( 'exam/ajax_save', ['uses' => 'Exam\IndexController@saveAjax',
                                    'as'   => 'exam.save_ajax'] );

    Route::delete( 'exam/delete', ['uses' => 'Exam\IndexController@delete',
                                   'as'   => 'exam.delete'] );
    /* Exam End */

	/* Home Work Start*/
	Route::get( 'homework', ['uses' => 'Homework\IndexController@index',
                          'as'   => 'homework'] );

    Route::post( 'homework/get_data', ['uses' => 'Homework\IndexController@getDataForEditModel',
                                   'as'   => 'homework.getdata'] );

    Route::post( 'homework/ajax_save', ['uses' => 'Homework\IndexController@saveAjax',
                                    'as'   => 'homework.save_ajax'] );

    Route::delete( 'homework/delete', ['uses' => 'Homework\IndexController@delete',
                                   'as'   => 'homework.delete'] );
	/* Home Work End*/

	/* Events Work Start*/
	/*Route::get( 'events', ['uses' => 'Events\IndexController@index',
                          'as'   => 'events'] );

    Route::post( 'event/get_data', ['uses' => 'Events\IndexController@getDataForEditModel',
                                   'as'   => 'events.getdata'] );

    Route::post( 'event/ajax_save', ['uses' => 'Events\IndexController@saveAjax',
                                    'as'   => 'event.save_ajax'] );

    Route::delete( 'event/delete', ['uses' => 'Events\IndexController@delete',
                                   'as'   => 'event.delete'] );*/
	/* Events Work End*/

    /* Messages Start */
    Route::get( 'messages', ['uses' => 'Message\IndexController@index',
                             'as'   => 'messages'] );

    Route::delete( 'message/delete', ['uses' => 'Message\IndexController@delete',
                                      'as'   => 'message.delete'] );

    Route::post( 'message/save_ajax', ['uses' => 'Message\IndexController@saveAjax',
                                       'as'   => 'message.save_ajax'] );

    Route::post( 'message/get_data', ['uses' => 'Message\IndexController@getDataForEditModel',
                                      'as'   => 'message.get_data'] );
    /* Messages End */


});
/*---------------------------------------------------------------------------------------------------*/


/* Common region start */

Route::post( 'getgradedropdown', ['uses' => 'CommonController@getGradeDropdown',
                                  'as'   => 'getgradedropdown'] );


Route::post( 'getclassdropdown', ['uses' => 'CommonController@getClassDropdown',
                                 'as'   => 'getclassdropdown'] );

Route::post( 'getstudentdropdown', ['uses' => 'CommonController@getStudentDropdown',
                                 'as'   => 'getstudentdropdown'] );

Route::post( 'getstudentmultipledropdown', ['uses' => 'CommonController@getStudentMultipleDropDown',
                                    'as'   => 'getstudentmultipledropdown'] );

Route::post( 'getclass_single_select_dropdown', ['uses' => 'CommonController@getClassSingleClassDropdown',
                                  'as'   => 'getclass_single_select_dropdown'] );

/*Route::post( 'getteacherdropdown', ['uses' => 'CommonController@getTeacherDropdown',
                                 'as'   => 'getteacherdropdown'] );*/

Route::post( 'getstatedropdown', ['uses' => 'CommonController@getStateDropdown',
                                 'as'   => 'getstatedropdown'] );

Route::post( 'getcitydropdown', ['uses' => 'CommonController@getCityDropdown',
                                 'as'   => 'getcitydropdown'] );

Route::post( 'getuserdropdownbyschoolid', ['uses' => 'CommonController@getUserDropDownBySchoolId',
                                 'as'   => 'getuserdropdownbyschoolid'] );

Route::post( 'getuserdropdownbyclubid', ['uses' => 'CommonController@getUserDropDownByClubId',
                                 'as'   => 'getuserdropdownbyclubid'] );

Route::get( 'city-insert', ['uses' => 'CommonController@cityInsert'] );

Route::post( 'getuserdropdown', ['uses' => 'CommonController@getUserDropdown',
                                 'as'   => 'getuserdropdown'] );

Route::post( 'getuserdropdownbyroletype', ['uses' => 'CommonController@getUserDropDownByRoleType',
                                 'as'   => 'getuserdropdownbyroletype'] );

Route::post( 'get_club_dropdown', ['uses' => 'CommonController@getClubDropdown',
                                 'as'   => 'get_club_dropdown'] );

Route::post( 'get_user_dropdown_by_club_id_for_notification', ['uses' => 'CommonController@getUserDropdownByClubIdForNotification',
                                   'as'   => 'get_user_dropdown_by_club_id_for_notification'] );

Route::post( 'get_grade_dropdown', ['uses' => 'CommonController@getGradeDropdownForNotification',
                                   'as'   => 'get_grade_dropdown'] );

Route::post( 'get_class_dropdown_by_grade_id', ['uses' => 'CommonController@getClassDropdownByGradeId',
                                    'as'   => 'get_class_dropdown_by_grade_id'] );

Route::post( 'get_user_dropdown_by_class_id_for_notification', ['uses' => 'CommonController@getUserDropdownByClassIdForNotification',
                                                               'as'   => 'get_user_dropdown_by_class_id_for_notification'] );







/* Common region end */

/*---------------------------------------------------------------------------------------------------*/


/* Contact send mail Start */

    Route::post( 'contact/send_mail', ['uses' => 'Admin\Contact\IndexController@postSendMail',
                                       'as'   => 'contact.send_mail'] );

/* Contact send mail End */
