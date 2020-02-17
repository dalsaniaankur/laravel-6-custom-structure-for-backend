<?php

namespace App\Classes\Models\Teacher;

use App\Classes\Models\AuthBaseModel;
use App\Classes\Helpers\User\Helper;
use App\Classes\Common\Common;
use App\Classes\Models\Roles\Roles;
use App\Notifications\Admin\ResetPasswordNotification;
use App\Notifications\Admin\VerifyEmail;
use Illuminate\Support\Facades\Hash;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Auth;
use App\Classes\Helpers\Roles\Helper as HelperRoles;
use App\Classes\Models\Classes\Classes;
use App\Classes\Models\City\City;
use App\Classes\Models\State\State;
use App\Classes\Models\SchoolLevel\SchoolLevel;
use App\Classes\Models\Country\Country;
use App\Classes\Models\Grade\Grade;
use App\Classes\Models\Club\Club;
use App\Classes\Models\Allergy\Allergy;
use App\Classes\Models\StudentAllergies\StudentAllergies;
use App\Classes\Models\UserClub\UserClub;
use App\Classes\Models\User\User;


class Teacher extends AuthBaseModel
{
    public $table = 'ka_users';
    public $primaryKey = 'user_id';
    public $entity = 'users';
    protected $searchableColumns = ['first_name',
                                    'last_name'];

    protected $fillable = ['first_name',
                           'last_name',
                           'school_name',
                           'school_level_id',
                           'email',
                           'password',
                           'school_id',
                           'class_id',
                           'grade_id',
                           'phone',
                           'gender',
                           'eye_color',
                           'height_in_meter',
                           'height_in_inche',
                           'comment',
                           'bio',
                           'principal_first_name',
                           'principal_last_name',
                           'principal_email',
                           'principal_phone',
                           'school_motto',
                           'core_values',
                           'short_description',
                           'address',
                           'country_id',
                           'state_id',
                           'city_id',
                           'zipcode',
                           'photo',
                           'last_login_date',
                           'created_type',
                           'ip_address',
                           'fcm_token',
                           'device_type',
                           'role_id',
                           'status',
                           'email_verified_at',
                           'remember_token'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password',
                         'remember_token',];

    protected $_helper;
    protected $_helperRoles;
    protected $cityObj;
    protected $allergyObj;
    protected $studentAllergiesObj;
    protected $studentClubObj;

    public function __construct( array $attributes = [] )
    {
        $this->bootIfNotBooted();
        $this->syncOriginal();
        $this->fill( $attributes );
        $this->_helper = new Helper();
        $this->_helperRoles = new HelperRoles();
        $this->cityObj = new City();
        $this->allergyObj = new Allergy();
        $this->studentAllergiesObj = new StudentAllergies();
        $this->studentClubObj = new UserClub();
    }

    public function school()
    {
        return $this->belongsTo( User::class, 'school_id', 'user_id' );
    }

    public function role()
    {
        return $this->belongsTo( Roles::class, 'role_id', 'role_id' );
    }

    public function grade()
    {
        return $this->belongsTo( Grade::class, 'grade_id', 'grade_id' );
    }

    public function classes()
    {
        return $this->belongsTo( Classes::class, 'class_id', 'class_id' );
    }

    public function city()
    {
        return $this->belongsTo( City::class, 'city_id', 'city_id' );
    }

    public function state()
    {
        return $this->belongsTo( State::class, 'state_id', 'state_id' );
    }

	public function country()
    {
        return $this->belongsTo( Country::class, 'country_id', 'country_id' );
    }

    public function getNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getGenderTypeAttribute()
    {
        if ( ! empty( $this->gender ) ) {

            if ( $this->gender == 1 ) {
                return "M";
            } else {
                return "F";
            }
        }
        return "";
    }

    public function getPrincipalNameAttribute()
    {
        return $this->principal_first_name . " " . $this->principal_last_name;
    }

	public function getSchoolLevel(){
		return $this->belongsTo( SchoolLevel::class, 'school_level_id', 'school_level_id' );
	}

    public function getStatusStringAttribute()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }

    public function sendPasswordResetNotification( $token )
    {
        //$this->notify( new ResetPasswordNotification( $token ) );
        $fromName = "Kidrend";
        $subject = 'Reset Password Notification';
        $toName = $this->name;
        $toEmail = $this->email;
        $htmlContent = \View::make('backend.auth.emails.forgot_password',['token' => $token,'subject' => $subject,'name' => $toName,'roleBaseRoute' => 'teacher'])->render();
        $results = Common::sendMailByMailJet($htmlContent,$fromName,'',$subject,$toName,$toEmail);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify( new VerifyEmail );
    }

    public function getDateById( $userId )
    {
        $return = $this->setSelect()
                       ->addUserIdFilter( $userId )
                       ->get()
                       ->first();
        return $return;
    }

    public function getTeacherStudent( $schoolId = 0, $classId = 0, $status = 1 )
    {
        $studentRoleId = $this->_helperRoles->getStudentRoleId();
        $return = $this->setSelect()
                       ->addStatusFilter( 'status', $status )
                       ->addSchoolIdFilter( $schoolId )
                       ->addClassIdFilter( $classId )
                       ->addRoleIdFilter( $studentRoleId )
                       ->get();
        return $return;
    }

    public function school_classes_count()
    {
        return $this->hasMany( Classes::class, 'school_id', 'user_id' )
                    ->count();
    }

	public function school_grade_count()
    {
        return $this->hasMany( Grade::class, 'school_id', 'user_id' )
                    ->count();
    }

    public function addSchoolIdFilter( $schoolId = 0 )
    {
        if ( ! empty( $schoolId ) && $schoolId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.school_id', '=', $schoolId );
        }
        return $this;
    }

    public function addClassIdFilter( $classId = 0 )
    {
        if ( ! empty( $classId ) && $classId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.class_id', '=', $classId );
        }
        return $this;
    }

    public function addRoleIdInFilter( $roleIdArray = [] )
    {
        if ( ! empty( $roleIdArray ) ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->whereIn( $tableName . '.role_id', $roleIdArray );
        }
        return $this;
    }

    public function getSchoolDropDown( $prepend = '', $status = 1, $prependKey = 0 )
    {
        $roleId = $this->_helperRoles->getSchoolRoleId();
        $return = $this->setSelect()
                       ->addRoleIdFilter( $roleId )
                       ->addStatusFilter('status',  $status )
                       ->addSortOrder( ['school_name' => 'asc'] )
                       ->get()
                       ->pluck( 'school_name', 'user_id' );

        if ( ! empty( $prepend ) ) {
            $return->prepend( $prepend, $prependKey );
        }

        return $return;
    }

    public function getDropDown( $prepend = '', $roleId = 0, $schoolId = 0, $status = -1, $isVerified = -1, $classId = 0 )
    {
        $return = $this->setSelect()
                       ->addStatusFilter( 'status', $status )
                       ->addIsVerifiedFilter( $isVerified )
                       ->addSchoolIdFilter( $schoolId )
                       ->addClassIdFilter( $classId )
                       ->addRoleIdFilter( $roleId )
                       ->addSortOrder( ['first_name' => 'asc'] )
                       ->get()
                       ->pluck( 'name', 'user_id' );

        if ( ! empty( $prepend ) ) {
            $return->prepend( $prepend, 0 );
        }

        return $return;
    }


    public function addIsVerifiedFilter( $isVerified = -1 )
    {
        if ( $isVerified != '-1' && $isVerified != -1 ) {
            $tableName = $this->getTableName();
            if ( $isVerified == 1 ) {
                $this->queryBuilder->where( $tableName . '.email_verified_at', '!=', null );
            }
            if ( $isVerified == 0 ) {
                $this->queryBuilder->where( $tableName . '.email_verified_at', '=', null );
            }
        }
        return $this;
    }

    public function addIsLoginFilter( $isLogin = -1 )
    {
        if ( $isLogin != '-1' && $isLogin != -1 ) {
            $tableName = $this->getTableName();
            if ( $isLogin == 1 ) {
                $this->queryBuilder->where( $tableName . '.last_login_date', '!=', null );
            }
            if ( $isLogin == 0 ) {
                $this->queryBuilder->where( $tableName . '.last_login_date', '=', null );
            }
        }
        return $this;
    }

    public function addNameLikeFilter( $name = '' )
    {
        if ( ! empty( trim( $name ) ) ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( function ( $q ) use ( $name, $tableName ) {
                $q->where( \DB::raw("CONCAT($tableName.first_name, ' ',$tableName.last_name)"),'like' , '%' .$name. '%' );
            } );
        }
        return $this;
    }

    public function addSignUpDateFilter( $startDate = '', $endDate = '' )
    {
        $tableName = $this->getTableName();
        if ( ! empty( $startDate ) ) {
            $startDate = date( "Y-m-d", strtotime( $startDate ) );
            $this->queryBuilder->whereDate( $tableName . '.created_at', '>=', "$startDate" );
        }

        if ( ! empty( $endDate ) ) {
            $endDate = date( "Y-m-d", strtotime( $endDate ) );
            $this->queryBuilder->whereDate( $tableName . '.created_at', '<=', "$endDate" );
        }

        return $this;
    }

    public function addEmailFilter( $email = '' )
    {
        if ( ! empty( trim( $email ) ) ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.email', '=', trim( $email ) );
        }
        return $this;
    }


    public function addPrincipalEmailFilter( $email = '' )
    {
        if ( ! empty( trim( $email ) ) ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.principal_email', '=', trim( $email ) );
        }
        return $this;
    }

    public function addUserIdFilter( $userId = 0 )
    {
        if ( ! empty( $userId ) && $userId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.user_id', '=', $userId );
        }
        return $this;
    }

    public function addRoleIdFilter( $roleId = 0 )
    {
        if ( ! empty( $roleId ) && $roleId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.role_id', '=', $roleId );
        }
        return $this;
    }

    public function addSchoolLevelFilter( $schoolLevelId = 0 )
    {
        if ( ! empty( $schoolLevelId ) && $schoolLevelId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.school_level_id', '=', $schoolLevelId );
        }
        return $this;
    }

    public function addCityFilter( $cityId )
    {

        if ( ! empty( $cityId ) && $cityId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.city_id', '=', $cityId );
        }
        return $this;
    }

    public function addSchoolNameLikeFilter( $schoolName )
    {
        if ( ! empty( $schoolName ) ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.school_name', 'like', '%' . $schoolName . '%' );
        }
        return $this;
    }

    public function addGenderFilter( $gender = 0 )
    {
        if ( ! empty( $gender ) && $gender > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.gender', '=', $gender );
        }
        return $this;
    }

    public function addGradeIdFilter( $gradeId = 0 )
    {
        if ( ! empty( $gradeId ) && $gradeId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.grade_id', '=', $gradeId );
        }
        return $this;
    }


    public function addGradeIdFilter1( $gradeId = 0 )
    {
        if ( ! empty( $gradeId ) && $gradeId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.grade_id', '=', $gradeId );
        }
        return $this;
    }

    public function addAllergieIdFilter( $allergieId = 0 )
    {
        if ( ! empty( $allergieId ) && $allergieId > 0 ) {
            $tableName = $this->studentAllergiesObj->getTable();
            $this->queryBuilder->where( $tableName . '.allergie_id', '=', $allergieId );
        }
        return $this;
    }

	public function addClubIdFilter( $clubId = 0 )
    {
        if ( ! empty( $clubId ) && $clubId > 0 ) {
            $tableName = $this->studentClubObj->getTableName();
            $this->queryBuilder->where( $tableName . '.club_id', '=', $clubId );
        }
        return $this;
    }

	public function joinClub( $clubId = 0, $searchable = false )
    {
        if ( ! empty( $clubId ) && $clubId > 0 ) {

            $studentClubTableName = $this->studentClubObj->getTable();
            $searchableColumns = $this->studentClubObj->getSearchableColumns();
            $this->joinTables[] = ['table'             => $studentClubTableName,
                                   'searchable'        => $searchable,
                                   'searchableColumns' => $searchableColumns];

            $this->queryBuilder->leftJoin( $studentClubTableName, function ( $join ) use ( $studentClubTableName ) {
                $join->on( $this->table . '.user_id', '=', $studentClubTableName . '.user_id' );

            } );
        }
        return $this;
    }

    public function joinAllergie( $allergieId = 0, $searchable = false )
    {
        if ( ! empty( $allergieId ) && $allergieId > 0 ) {

            $studentAllergieTableName = $this->studentAllergiesObj->getTable();
            $searchableColumns = $this->studentAllergiesObj->getSearchableColumns();
            $this->joinTables[] = ['table'             => $studentAllergieTableName,
                                   'searchable'        => $searchable,
                                   'searchableColumns' => $searchableColumns];

            $this->queryBuilder->leftJoin( $studentAllergieTableName, function ( $join ) use ( $studentAllergieTableName ) {
                $join->on( $this->table . '.user_id', '=', $studentAllergieTableName . '.user_id' );

            } );
        }
        return $this;
    }

    public function getList( $searchHelper )
    {
        $this->reset();
        $perPage = ($searchHelper->_perPage == 0) ? $this->_helper->getConfigPerPageRecord() : $searchHelper->_perPage;

        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $roleId = ( ! empty( $searchHelper->_filter['role_id'] )) ? $searchHelper->_filter['role_id'] : 0;
        $name = ( ! empty( $searchHelper->_filter['name'] )) ? $searchHelper->_filter['name'] : '';
        $email = ( ! empty( $searchHelper->_filter['email'] )) ? $searchHelper->_filter['email'] : '';
        $signUpStartDate = ( ! empty( $searchHelper->_filter['created_start_date'] )) ? $searchHelper->_filter['created_start_date'] : '';
        $signUpEndDate = ( ! empty( $searchHelper->_filter['created_end_date'] )) ? $searchHelper->_filter['created_end_date'] : '';
        $status = (isset ( $searchHelper->_filter['status'] )) ? $searchHelper->_filter['status'] : -1;
        $isVerified = ( ! empty( $searchHelper->_filter['is_verified'] )) ? $searchHelper->_filter['is_verified'] : -1;
        $isLogin = ( ! empty( $searchHelper->_filter['is_login'] )) ? $searchHelper->_filter['is_login'] : -1;
        $school_level = ( ! empty( $searchHelper->_filter['school_level'] )) ? $searchHelper->_filter['school_level'] : -1;
        $principal_email = ( ! empty( $searchHelper->_filter['principal_email'] )) ? $searchHelper->_filter['principal_email'] : '';
        $city_id = ( ! empty( $searchHelper->_filter['city_id'] )) ? $searchHelper->_filter['city_id'] : '';
        $school_name = ( ! empty( $searchHelper->_filter['school_name'] )) ? $searchHelper->_filter['school_name'] : '';
        $gender = ( ! empty( $searchHelper->_filter['gender'] )) ? $searchHelper->_filter['gender'] : 0;
        $clubId = ( ! empty( $searchHelper->_filter['club_id'] )) ? $searchHelper->_filter['club_id'] : -1;
        $gradeId = ( ! empty( $searchHelper->_filter['grade_id'] )) ? $searchHelper->_filter['grade_id'] : -1;
        $allergieId = ( ! empty( $searchHelper->_filter['allergie_id'] )) ? $searchHelper->_filter['allergie_id'] : -1;
        $roleIdIn = ( ! empty( $searchHelper->_filter['role_id_in'] )) ? $searchHelper->_filter['role_id_in'] : [];
		$schoolId = ( ! empty( $searchHelper->_filter['school_id'] )) ? $searchHelper->_filter['school_id'] : -1;

        $list = $this->setSelect()
                     ->joinAllergie( $allergieId )
                     ->addSearch( $search )
                     ->addAllergieIdFilter( $allergieId )
                     ->addRoleIdInFilter( $roleIdIn )
                     ->addGradeIdFilter( $gradeId )
                     ->joinClub( $clubId )
                     ->addClubIdFilter( $clubId )
                     ->addRoleIdFilter( $roleId )
                     ->addGenderFilter( $gender )
                     ->addNameLikeFilter( $name )
                     ->addSchoolIdFilter( $schoolId )
                     ->addEmailFilter( $email )
                     ->addSignUpDateFilter( $signUpStartDate, $signUpEndDate )
                     ->addStatusFilter( 'status', $status )
                     ->addCityFilter( $city_id )
                     ->addSchoolNameLikeFilter( $school_name )
                     ->addSchoolLevelFilter( $school_level )
                     ->addPrincipalEmailFilter( $principal_email )
                     ->addIsVerifiedFilter( $isVerified )
                     ->addIsLoginFilter( $isLogin )
                     ->addSortOrder( $searchHelper->_sortOrder )
                     ->addPaging( $searchHelper->_page, $perPage )
                     ->addGroupBy( $searchHelper->_groupBy )
                     ->get( $searchHelper->_selectColumns );

        return $list;
    }

    public function getListTotalCount( $searchHelper )
    {
        $this->reset();

        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $roleId = ( ! empty( $searchHelper->_filter['role_id'] )) ? $searchHelper->_filter['role_id'] : 0;
        $name = ( ! empty( $searchHelper->_filter['name'] )) ? $searchHelper->_filter['name'] : '';
        $email = ( ! empty( $searchHelper->_filter['email'] )) ? $searchHelper->_filter['email'] : '';
        $signUpStartDate = ( ! empty( $searchHelper->_filter['created_start_date'] )) ? $searchHelper->_filter['created_start_date'] : '';
        $signUpEndDate = ( ! empty( $searchHelper->_filter['created_end_date'] )) ? $searchHelper->_filter['created_end_date'] : '';
        $status = ( ! empty( $searchHelper->_filter['status'] )) ? $searchHelper->_filter['status'] : -1;
        $isVerified = ( ! empty( $searchHelper->_filter['is_verified'] )) ? $searchHelper->_filter['is_verified'] : -1;
        $isLogin = ( ! empty( $searchHelper->_filter['is_login'] )) ? $searchHelper->_filter['is_login'] : -1;
        $school_level = ( ! empty( $searchHelper->_filter['school_level'] )) ? $searchHelper->_filter['school_level'] : -1;
        $principal_email = ( ! empty( $searchHelper->_filter['principal_email'] )) ? $searchHelper->_filter['principal_email'] : '';
        $school_name = ( ! empty( $searchHelper->_filter['school_name'] )) ? $searchHelper->_filter['school_name'] : '';
        $gender = ( ! empty( $searchHelper->_filter['gender'] )) ? $searchHelper->_filter['gender'] : 0;
        $clubId = ( ! empty( $searchHelper->_filter['club_id'] )) ? $searchHelper->_filter['club_id'] : -1;
        $gradeId = ( ! empty( $searchHelper->_filter['grade_id'] )) ? $searchHelper->_filter['grade_id'] : -1;
        $allergieId = ( ! empty( $searchHelper->_filter['allergie_id'] )) ? $searchHelper->_filter['allergie_id'] : -1;
        $city_id = ( ! empty( $searchHelper->_filter['city_id'] )) ? $searchHelper->_filter['city_id'] : '';
        $roleIdIn = ( ! empty( $searchHelper->_filter['role_id_in'] )) ? $searchHelper->_filter['role_id_in'] : [];
		$schoolId = ( ! empty( $searchHelper->_filter['school_id'] )) ? $searchHelper->_filter['school_id'] : -1;

        $count = $this->setSelect()
                      ->joinAllergie( $allergieId )
                      ->addSearch( $search )
                      ->addAllergieIdFilter( $allergieId )
                      ->addGradeIdFilter( $gradeId )
                      ->joinClub( $clubId )
                      ->addRoleIdInFilter( $roleIdIn )
                      ->addRoleIdFilter( $roleId )
                      ->addGenderFilter( $gender )
                      ->addNameLikeFilter( $name )
					  ->addSchoolIdFilter( $schoolId )
                      ->addEmailFilter( $email )
                      ->addSignUpDateFilter( $signUpStartDate, $signUpEndDate )
                      ->addStatusFilter( 'status', $status )
                      ->addCityFilter( $city_id )
                      ->addSchoolNameLikeFilter( $school_name )
                      ->addSchoolLevelFilter( $school_level )
                      ->addPrincipalEmailFilter( $principal_email )
                      ->addIsVerifiedFilter( $isVerified )
                      ->addIsLoginFilter( $isLogin )
                      ->addSortOrder( $searchHelper->_sortOrder )
                      ->addGroupBy( $searchHelper->_groupBy )
                      ->get()
                      ->count();

        return $count;
    }

    public function saveRecord( $data )
    {
        $tableName = $this->getTableName();

        $rules = ['first_name' => ['required',
                                   'string',
                                   'max:100'],
                  'last_name'  => ['required',
                                   'string',
                                   'max:100'],
                  'email'      => ['required',
                                   'string',
                                   'email',
                                   'max:191',
                                   'unique:' . $tableName],
                  'photo'      => ['mimes:jpeg,jpg,png,gif'],];
        $userId = 0;
        if ( isset( $data['user_id'] ) && $data['user_id'] != '' && $data['user_id'] > 0 ) {
            $userId = $data['user_id'];
            $rules['email'] = 'required|string|email|max:191|unique:' . $tableName . ',email,' . $userId . ',user_id';
        }

        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            $result['user_id'] = 0;
            return $result;
        }

        if ( ! empty( $data['photo'] ) ) {
            $filePath = $this->_helper->getImagePath();
            $data['photo'] = Common::fileUpload( $filePath, $data['photo'] );
        }

        if ( $userId > 0 ) {
            $user = self::findOrFail( $data['user_id'] );

            /* Delete Image */
            if ( ! empty( $data['photo'] ) ) {
                Common::deleteFile( $user->photo );
            }

            $user->update( $data );
            $result['user_id'] = $user->user_id;;

        } else {
            $user = self::create( $data );
            $result['user_id'] = $user->user_id;;
        }
        $result['success'] = true;
        $result['message'] = "User saved successfully.";
        return $result;
    }

    public function changePassword( $data )
    {
        $rules = ['password' => ['required',
                                 'string',
                                 'min:6',
                                 'confirmed']];

        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            return $result;
        }

        $user = self::findOrFail( $data['user_id'] );
        $data['password'] = Common::generatePassword( $data['password'] );
        $user->update( $data );

        $result['user_id'] = $user->user_id;
        $result['success'] = true;
        $result['message'] = "User password changed successfully.";
        return $result;
    }

    public function profileSave( $data )
    {
        $tableName = $this->getTableName();
        $userId = $data['user_id'];
        $rules = ['first_name' => ['required',
                                   'string',
                                   'max:100'],
                  'last_name'  => ['required',
                                   'string',
                                   'max:100'],
                  'phone'      => ['required',
                                   'numeric',
                                   'min:10'],
                  'address'    => ['required'],
                  'state_id'   => ['required'],
                  'city_id'    => ['required'],
                  'email'      => ['required',
                                   'string',
                                   'email',
                                   'max:191',
                                   'unique:' . $tableName . ',email,' . $userId . ',user_id'],
                  'photo'      => ['mimes:jpeg,jpg,png,gif'],];

        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            $result['user_id'] = $userId;
            return $result;
        }

        if ( ! empty( $data['photo'] ) ) {

            $filePath = $this->_helper->getImagePath();
            $data['photo'] = Common::fileUpload( $filePath, $data['photo'] );
        }

        $user = self::findOrFail( $userId );

        /* Delete Image */
        if ( ! empty( $data['photo'] ) && ! empty( $user->photo ) ) {
            Common::deleteFile( $user->photo );
        }

        $user->update( $data );
        $result['user_id'] = $user->user_id;
        $result['success'] = true;
        $result['message'] = "User profile updated successfully.";
        return $result;
    }

    public function adminProfileSave( $data )
    {
        $tableName = $this->getTableName();
        $userId = $data['user_id'];
        $rules = ['first_name' => ['required',
                                   'string',
                                   'max:100'],
                  'last_name'  => ['required',
                                   'string',
                                   'max:100'],
                  'email'      => ['required',
                                   'string',
                                   'email',
                                   'max:191',
                                   'unique:' . $tableName . ',email,' . $userId . ',user_id'],
                  'photo'      => ['mimes:jpeg,jpg,png,gif'],];

        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            $result['user_id'] = $userId;
            return $result;
        }

        if ( ! empty( $data['photo'] ) ) {

            $filePath = $this->_helper->getImagePath();
            $data['photo'] = Common::fileUpload( $filePath, $data['photo'] );
        }

        $user = self::findOrFail( $userId );

        /* Delete Image */
        if ( ! empty( $data['photo'] ) && ! empty( $user->photo ) ) {
            Common::deleteFile( $user->photo );
        }

        $user->update( $data );
        $result['user_id'] = $user->user_id;
        $result['success'] = true;
        $result['message'] = "User profile updated successfully.";
        return $result;
    }

	public function savePrincipal( $data )
    {
        $tableName = $this->getTableName();
        $userId = $data['user_id'];
        $rules = ['principal_first_name' => ['required',
                                   'string',
                                   'max:100'],
                  'principal_last_name'  => ['required',
                                   'string',
                                   'max:100'],
                  'principal_phone'      => ['required',
                                   'numeric',
                                   'min:10'],
                  'principal_email' => ['required',
                                   'string',
                                   'email',
                                   'max:191',
                                  ],
                 ];

        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            $result['user_id'] = $userId;
            return $result;
        }
        $user = self::findOrFail( $userId );
        $user->update( $data );
        $result['user_id'] = $user->user_id;
        $result['success'] = true;
        $result['message'] = "Principal profile updated successfully.";
        return $result;
    }

	public function updateSchool( $data )
    {
        $tableName = $this->getTableName();
        $userId = $data['user_id'];
        $rules = ['school_name' => ['required',
                                   'string',
                                   'max:100'],
                  'address'  => ['required',
                                   'string',
                                   'max:100'],
                  'school_motto' => ['required'],
                  'core_values' => ['required'],
				 'short_description' => ['required'],
				'photo'      => ['mimes:jpeg,jpg,png,gif'],
                  ];

        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            $result['user_id'] = $userId;
            return $result;
        }

	   if ( ! empty( $data['photo'] ) ) {

            $filePath = $this->_helper->getImagePath();
            $data['photo'] = Common::fileUpload( $filePath, $data['photo'] );
        }

        $user = self::findOrFail( $userId );

        /* Delete Image */
        if ( ! empty( $data['photo'] ) && ! empty( $user->photo ) ) {
            Common::deleteFile( $user->photo );
        }

        $user->update( $data );
        $result['user_id'] = $user->user_id;
        $result['success'] = true;
        $result['message'] = "School details updated successfully..";
        return $result;
    }

    public function banOrReActive( $data )
    {
        $user = self::findOrFail( $data['user_id'] );
        $user->update( $data );
        $result['user_id'] = $user->user_id;
        $result['success'] = true;
        $result['message'] = "User banned successfully.";
        if($data['status'] == 1) {
            $result['message'] = "User reactivated successfully.";
        }
        return $result;
    }
}
