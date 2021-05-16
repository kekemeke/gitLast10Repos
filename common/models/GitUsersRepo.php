<?php
declare(strict_types=1);

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "gitUsersRepo".
 *
 * @property int $id
 * @property string $username
 * @property string $updated_at
 * @property string $link
 * @property string|null $updated_by_cron
 */
final class GitUsersRepo extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'gitUsersRepo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['username', 'updated_at'], 'required'],
            [['updated_by_cron'], 'safe'],
            [['username', 'updated_at', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'link' => 'Repo link',
            'updated_at' => 'Repository last time updated',
            'updated_by_cron' => 'Updated By Cron',
        ];
    }
}
