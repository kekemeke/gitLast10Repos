<?php
declare(strict_types=1);

namespace common\models;

use yii\db\ActiveRecord;

final class GitUser extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'gitUser';
    }

    public function rules(): array
    {
        return [
            [['username'], 'required'],
            [['username'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
        ];
    }
}
