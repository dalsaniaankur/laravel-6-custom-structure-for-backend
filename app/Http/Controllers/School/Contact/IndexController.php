<?php

namespace App\Http\Controllers\School\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\User\User;
use App\Classes\Models\StudentParent\StudentParent;
use App\Classes\Helpers\User\Helper;
use App\Classes\Helpers\Roles\Helper as HelperRoles;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    protected $userObj;
    protected $_helper;
    protected $_helperRoles;
    protected $_searchHelper;
    protected $studentParentObj;

    public function __construct( User $userModel )
    {
        $this->userObj = $userModel;
        $this->_helper = new Helper();
        $this->_helperRoles = new HelperRoles();
        $this->studentParentObj = new StudentParent();
    }

    public function postSendMail( Request $request )
    {
        $data = $request->all();

        $response = [];
        $response['success'] = false;
        $response['message'] = 'Message has been sent successfully.';

        if ( ! empty( $data['user_id'] ) ) {
            
            $user = $this->userObj->getDateById( $data['user_id'] );
            if ( ! empty( $user->user_id ) && $user->user_id > 0 ) {

                $fromName = "Kidrend";
                $subject = 'Message from the admin';
                $toName = $user->name;
                $toEmail = $user->email;

                /*switch ($user->role_id) {
                    case $this->_helperRoles->getSchoolRoleId():
                        $htmlContent = \View::make( 'admin.emails.school.contact', ['name'    => $toName,
                                                                                    'subject' => $subject,
                                                                                    'message' => $data['message']] )->render();
                        break;
                }*/

                $htmlContent = \View::make( 'admin.emails.school.contact', ['name'    => $toName,
                                                                            'subject' => $subject,
                                                                            'message' => $data['message']] )->render();

                $results = Common::sendMailByMailJet( $htmlContent, $fromName, '', $subject, $toName, $toEmail );
                if ( ! empty( $results->Messages[0]->Status ) && $results->Messages[0]->Status == 'success' ) {
                    $response['success'] = true;
                } else {
                    $response['message'] = 'Oops, Something went wrong.';
                }
            } else {
                $response['message'] = 'This user dose not exits';
            }
        }
        return response()->json( $response );
    }
	
	public function contactParentMail( Request $request )
    {
        $data = $request->all();

        $response = [];
        $response['success'] = false;
        $response['message'] = 'Message has been sent successfully.';

        if ( ! empty( $data['user_id'] ) ) {            
			$studentId =  $data['user_id'];
			$filter = ['student_id' => $studentId];
			$searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter );
			$studentParents = $this->studentParentObj->getList($searchHelper);
			echo 'count'.$studentParents->count();
            if ( $studentParents->count() > 0  ) {
                $fromName = "Kidrend";
                $subject = 'Message from the admin';
				foreach( $studentParents as $studentParentKey => $studentParent ) {
					$toName = $studentParent->parent->name;
					$toEmail = $studentParent->parent->email;

					$htmlContent = \View::make( 'admin.emails.school.contact', ['name'    => $toName,
																				'subject' => $subject,
																				'message' => $data['message']] )->render();

					$results = Common::sendMailByMailJet( $htmlContent, $fromName, '', $subject, $toName, $toEmail );
					if ( ! empty( $results->Messages[0]->Status ) && $results->Messages[0]->Status == 'success' ) {
						$response['success'] = true;
					} else {
						$response['message'] = 'Oops, Something went wrong.';
					}
				}
            } else {
                $response['message'] = 'This student does not have any parent';
            }
        }
        return response()->json( $response );
    }
}