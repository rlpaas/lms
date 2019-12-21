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
            'department_division_name' => 'Department Division Name',
            'is_active' => 'Is Active',
        ];
    }
}
