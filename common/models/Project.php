<?php

namespace common\models;

use yii\web\UploadedFile;
use Yii;
use yii\helpers\Url;


/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $short_name
 * @property string $title
 * @property string $description
 * @property string $link
 * @property string $image
 */
class Project extends \yii\db\ActiveRecord
{

    public $_image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['short_name', 'title', 'description', 'link','color'], 'required'],
            [['description','color'], 'string'],
            [['short_name'], 'string', 'max' => 50],
            [['title', 'link'], 'string', 'max' => 150],
            [['image'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'short_name' => 'Short Name',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'link' => 'Ссылка',
            'color' => 'Цвет',
            'image' => 'Рисунок',
        ];
    }

    public function upload()
    {

        if ($this->validate()) {
            $this->_image = UploadedFile::getInstance($this, '_image');
            if($this->_image) {
                $this->image =  $this->short_name . '.' . $this->_image->extension;
                $this->_image->saveAs(Url::to('@frontend/web/images/projects/') . $this->image);
            }
            $this->save();
            return true;
        } else {
            return false;
        }
    }


}
