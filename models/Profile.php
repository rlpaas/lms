<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;

use dektrium\user\models\Profile as BaseProfile;
use dektrium\user\models\User;

/**
 * This is the model class for table "profile".
 *
 * @property int $user_id
 * @property int $empno
 * @property string $last_name
 * @property string $first_name
 * @property string $mi
 * @property string $birth_date
 * @property string $adddress
 * @property int $campus_id
 * @property int $school_college_id
 * @property int $department_id
 * @property int $contact_number
 * @property int $classification_id
 * @property int $job_type_id
 *
 * @property User $user
 */
class Profile extends BaseProfile
{
    /**
     * {@inheritdoc}
     */

    const JOB_TYPE_FACULTY = 1;
    const JOB_TYPE_NON_TEACHING = 2;
    const JOB_TYPE_MIDDLE_MANAGER = 3;

    const CLASSIFICATION_REGULAR = 1;
    const CLASSIFICATION_PAYEE = 2;


    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           
            [['user_id', 'campus_id', 'school_college_id', 'department_division_id', 'contact_number', 'classification_id', 'job_type_id'], 'integer'],
            [['birth_date'], 'safe'],
            [['address'], 'string'],
            [['gravatar_id'], 'string','max' => 32],
            [['empno'], 'string','max' => 155],
            [['last_name', 'first_name', 'mi'], 'string', 'max' => 255],
            [['user_id','empno'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'empno' => 'Empno',
            'last_name' => 'Last Name',
            'first_name' => 'First Name',
            'mi' => 'Mi',
            'birth_date' => 'Birth Date',
            'address' => 'Adddress',
            'campus_id' => 'Campus',
            'school_college_id' => 'School/College',
            'department_division_id' => 'Department/Division',
            'contact_number' => 'Contact Number',
            'classification_id' => 'Classification',
            'job_type_id' => 'Job Type',
        ];
    }


    public function getTypeName($type = null)
    {
        $type = (empty($type_id)) ? $this->job_type_id : $type_id;

        if($type === self::JOB_TYPE_FACULTY)
        {
            return 'Faculty';

        }elseif($type === self::JOB_TYPE_NON_TEACHING){

            return 'Non-Teaching';
        }elseif($type === self::JOB_TYPE_MIDDLE_MANAGER){

            return 'Middle Manager';
        }else{

            return '-';
        }
    }

    public function getTypeList()
    {
        $typeArray = [
            self::JOB_TYPE_FACULTY => 'Faculty',
            self::JOB_TYPE_NON_TEACHING => 'Non-Teaching',
            self::JOB_TYPE_MIDDLE_MANAGER => 'Middle Manager',
        ];

        return $typeArray;

    }

    public function getClassificationName($type = null)
    {
        $class = (empty($classification_id)) ? $this->classification_id : $tclassification_id;

        if($class === self::CLASSIFICATION_REGULAR)
        {
            return 'Regular Member';

        }elseif($class === self::CLASSIFICATION_PAYEE){

            return 'Payee';

        }else{

            return '-';
        }
    }

    public function getClassificationList()
    {
        $typeArray = [
            self::CLASSIFICATION_REGULAR => 'Regular Member',
            self::CLASSIFICATION_PAYEE => 'Payee',

        ];

        return $typeArray;

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne($this->module->modelMap['User'], ['id' => 'user_id']);
    }

    public function getAvatarUrl($size = 200)
    {
        return '//gravatar.com/avatar/' . $this->gravatar_id . '?s=' . $size;
    }

    public function getCampus()
    {
        return $this->hasOne(Campus::className(), ['id'=>'campus_id']);
    }

    public function getSchoolCollege()
    {
        return $this->hasOne(SchoolCollege::className(), ['id'=>'school_college_id']);
    }

    public function getDepartmentDivision()
    {
        return $this->hasOne(DepartmentDivision::className(), ['id'=>'department_division_id']);
    }
}
