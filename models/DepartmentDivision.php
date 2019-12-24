<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department_division".
 *
 * @property int $id
 * @property string $department_division_name
 * @property int $is_active
 */
class DepartmentDivision extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const IS_ACTIVE_YES = 1;
    const IS_ACTIVE_NO = 2;
    
    public static function tableName()
    {
        return 'department_division';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_division_name', 'is_active'], 'required'],
            [['is_active'], 'integer'],
            [['department_division_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department_division_name' => 'Department/Division Name',
            'is_active' => 'Is Active',
        ];
    }

    public function getIsActiveList()
    {
        $typeArray = [
            self::IS_ACTIVE_YES => 'Yes',
            self::IS_ACTIVE_NO => 'No',
        ];

        return $typeArray;

    }

    public function getIsActiveName($name = null)
    {
        $name = (empty($is_active)) ? $this->is_active : $is_active;

        if($name === self::IS_ACTIVE_YES)
        {
            return 'Yes';
        }else{

            return 'No';
        }
    }
}
