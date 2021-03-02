<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string|null $created_on
 * @property string $title
 * @property string $description
 * @property int $budget
 * @property string $expire
 * @property int|null $category_id
 * @property float $latitude
 * @property float $longitude
 * @property string|null $address
 * @property int|null $owner_id
 *
 * @property Notification[] $notifications
 * @property Response[] $responses
 * @property Review[] $reviews
 * @property Category $category
 * @property User $owner
 * @property TaskFile[] $taskFiles
 */
class Task extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_on', 'expire'], 'safe'],
            [['title', 'description', 'budget', 'expire', 'latitude', 'longitude'], 'required'],
            [['title', 'description', 'address'], 'string'],
            [['budget', 'category_id', 'owner_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [
                ['category_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Category::className(),
                'targetAttribute' => ['category_id' => 'id']
            ],
            [
                ['owner_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['owner_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_on' => 'Created On',
            'title' => 'Title',
            'description' => 'Description',
            'budget' => 'Budget',
            'expire' => 'Expire',
            'category_id' => 'Category ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'address' => 'Address',
            'owner_id' => 'Owner ID',
        ];
    }

    /**
     * Gets query for [[Notifications]].
     *
     * @return ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Owner]].
     *
     * @return ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    /**
     * Gets query for [[TaskFiles]].
     *
     * @return ActiveQuery
     */
    public function getTaskFiles()
    {
        return $this->hasMany(TaskFile::className(), ['task_id' => 'id']);
    }
}
