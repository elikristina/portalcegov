<?php

/**
 * This is the model class for table "Notificacao".
 *
 * The followings are the available columns in table 'Notificacao':
 * @property integer $notf_id
 * @property integer $sender
 * @property integer $receiver
 * @property string $message
 * @property string $url
 * @property boolean $read
 * @property string $time
 *
 * The followings are the available model relations:
 * @property Pessoa $sender0
 * @property Pessoa $receiver0
 */
class Notificacao extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Notificacao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notificacao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sender, receiver, message, url, time', 'required'),
			array('sender, receiver', 'numerical', 'integerOnly'=>true),
			array('read', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('notf_id, sender, receiver, message, url, read, time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'sender0' => array(self::BELONGS_TO, 'Pessoa', 'sender'),
			'receiver0' => array(self::BELONGS_TO, 'Pessoa', 'receiver'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'notf_id' => 'Notf',
			'sender' => 'Sender',
			'receiver' => 'Receiver',
			'message' => 'Message',
			'url' => 'Url',
			'read' => 'Read',
			'time' => 'Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('notf_id',$this->notf_id);
		$criteria->compare('sender',$this->sender);
		$criteria->compare('receiver',$this->receiver);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('read',$this->read);
		$criteria->compare('time',$this->time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/*
	*@param $id - Identificador do usuario
	*/
	public static function getNotifications($id, $limit=6, $offset=0){

		if (Yii::app()->user->getId() != $id) throw new CHttpException(403);

		$result = array();

		$command =  Yii::app()->db->createCommand();
		$select = array(
					'notf_id'
				,	'message'
				,	'read'
				,	'url'
				,	'time'				
		);
		$command->from('notificacao');
		$command->params = array('receiver'=>$id);
		$command->where = "receiver = :receiver";
		$command->select = implode(', ', $select);
		$command->order = 'read ASC, time DESC';
		$command->limit($limit, $offset);
		
		$result['items'] =  array_map(function($item){
			$item['notf_url'] = Yii::app()->createUrl('/notificacao/view',array('id'=>$item['notf_id']));
			return $item;
		}, $command->queryAll());

		$command_count = Yii::app()->db->createCommand();
		$command_count->from('notificacao');
		$command_count->where = "receiver = :receiver AND read = false";
		$command_count->params = array('receiver'=>$id);
		$command_count->select = "count(notf_id)";
		$result['count_new'] = $command_count->queryScalar();

		return $result;

	}

	public static function notify($receiver, $message, $url, $sender=null){
		if ($sender == null) $sender = Yii::app()->user->getId();

		$notif = new Notificacao();
		$notif->sender = $sender;
		$notif->receiver = $receiver;
		$notif->message = $message;
		$notif->url = $url;

		return $notif->save();
	}
}