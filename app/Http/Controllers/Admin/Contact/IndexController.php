<?php
namespace App\Http\Controllers\Admin\Contact;

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

        $response = ['success' => false, 'message' => 'Message has been sent successfully.'];

        if ( ! empty( $data['user_id'] ) ) {

            $user = $this->userObj->getDateById( $data['user_id'] );

            if ( ! empty( $user->user_id ) && $user->user_id > 0 ) {

                $fromName = "Kidrend";
                $subject = 'Message from the admin';
                $toName = $user->name;
                $toEmail = $user->email;

                $htmlContent = \View::make( 'backend.emails.contact', ['name'    => $toName,
                                                                            'subject' => $subject,
                                                                            'message' => $data['message']] )->render();
                Common::sendMailByMailJet( $htmlContent, $fromName, '', $subject, $toName, $toEmail );
                $response['success'] = true;
            } else {
                $response['message'] = 'This user dose not exits';
            }
        }
        return response()->json( $response );
    }
}
