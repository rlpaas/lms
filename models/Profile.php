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
            [['user_id'], 'unique'],
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
}
