<?php

/**
 * This is the model class for table "brief".
 *
 * The followings are the available columns in table 'brief':
 * @property integer $id
 * @property integer $uid
 * @property string $bid
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property string $create_time
 * @property string $modify_time
 */
class Brief extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'brief';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, status', 'numerical', 'integerOnly'=>true),
			array('bid, title', 'length', 'max'=>100),
			array('content', 'length', 'max'=>200),
			array('create_time, modify_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uid, bid, title, content, status, create_time, modify_time', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => '用户id',
			'bid' => '序号',
			'title' => '标题',
			'content' => '内容',
			'status' => '1：正常 0：删除',
			'create_time' => '创建时间',
			'modify_time' => '更新时间',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('bid',$this->bid,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('modify_time',$this->modify_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->db_sec;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Brief the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getList($page = 1, $page_size = 10, $where = '', $order_by = 'order by id desc')
	{
        $offset     = ($page - 1) * $page_size;
        $where      = empty($where) ? 'where status = 1' : "where status = 1 and ($where)";
        $sql        = "select SQL_CALC_FOUND_ROWS * from brief $where $order_by limit $offset, $page_size";
        $list       = Yii::app()->db_sec->createCommand($sql)->queryAll();
        $total      = Yii::app()->db_sec->createCommand("select FOUND_ROWS()")->queryScalar();
        $total_page = $total > 0 ? ceil($total / $page_size) : 0;
        return array(
            'page'       => $page,
            'page_size'  => $page_size,
            'total'      => $total,
            'total_page' => $total_page,
            'items'      => $list
        );
	}
}
