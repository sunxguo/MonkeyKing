<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class CommonGetData{
	var $CI;
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->model("dbHandler");
	}
	/**
	 * 获取网站配置信息
	 * return array or string
	 */
	public function getWebsiteConfig($info="ALLINFO"){
		$condition=array(
			'table'=>'websiteconfig',
			'result'=>'data'
		);
		if($info!="ALLINFO") $condition['where']=array('key_websiteconfig'=>$info);
		$result=$this->CI->dbHandler->selectData($condition);
		if($info!="ALLINFO") return $result[0]->value_websiteconfig;
		else return $result;
	}
	/**
	 * 按格式获取栏目信息
	 * 指定某些类型的栏目$typeArray=array(),是否按id做索引 $index=false
	 * return array
	 */
	public function getColumns($typeArray=array(),$index=false){
		$condition=array(
			'table'=>'column',
			'result'=>'data',
			'where'=>array('column_fid'=>'0'),
			'order_by'=>array('column_ordernum'=>'ASC')
		);
		$typeArray=$this->getColumnTypeArray($typeArray);
		if(sizeof($typeArray)>0) $condition['where_in']['column_type']=$typeArray;
		$columns=$this->CI->dbHandler->selectData($condition);
		foreach($columns as $col){
			$condition=array(
				'table'=>'column',
				'result'=>'data',
				'where'=>array('column_fid'=>$col->column_id),
				'order_by'=>array('column_ordernum'=>'ASC')
			);
			if(sizeof($typeArray)>0) $condition['where_in']['column_type']=$typeArray;
			$col->subColumns=$this->CI->dbHandler->selectData($condition);
		}
		if($index){
			$indexColumn=array();
			foreach($columns as $col){
				$indexColumn[$col->column_id]=$col;
				foreach($col->subColumns as $subCol){
					$indexColumn[$subCol->column_id]=$subCol;
				}
			}
			$columns=$indexColumn;
		}
		return $columns;
	}
	public function getPositions($type,$getSubColumn=false){
		$typeCode=$this->getPositionType($type);
		$condition['table']="position";
		$condition['where']=array('position_type'=>$typeCode);
		$condition['result']="data";
		$condition['join']=array("column"=>"column.column_id=position.position_column");
		$condition['order_by']=array('position_ordernum'=>'ASC');
		$positions=$this->getData($condition);
		if($getSubColumn){
			foreach($positions as $item){
				if($item->column_fid==0) $item->subColumns=$this->getSubColumn($item->column_id);
				else $item->subColumns=array();
			}
		}
		return $positions;
	}
	/**
	 * 根据名称获取类型号
	 * 0:文章列表1:商品列表2:文章3：商品 4:图片集
	 */
	public function getColumnTypeArray($type_text_array){
		$NoArray=array();
		foreach($type_text_array as $value){
			$NoArray[]=$this->getColumnTypeNo($value);
		}
		return $NoArray;
	}
	public function getColumnTypeNo($typeText){
		$type_No=0;
		switch($typeText){
			case 'essayList':
				$type_No=0;
			break;
			case 'productList':
				$type_No=1;
			break;
			case 'essay':
				$type_No=2;
			break;
			case 'product':
				$type_No=3;
			break;
			case 'imageList':
				$type_No=4;
			break;
			case 'forumList':
				$type_No=5;
			break;
		}
		return $type_No;
	}
	public function getAllColumnType($lang){
		if($lang=='english') return array("essayList","productList","essay","product","imageList","forumList");
		elseif($lang=='tw_cn') return array("文章列表","商品列表","一篇文章","一件商品","圖片集","論壇");
		else return array("文章列表","商品列表","一篇文章","一件商品","图片集","论坛");
	}
	public function getUserType($typeText){
		$typeNo=0;
		switch($typeText){
			case 'admin':
				$typeNo=0;
			break;
			case 'merchant':
				$typeNo=0;
			break;
			case 'user':
				$typeNo=0;
			break;
		}
		return $typeNo;
	}
	//0:发布1:草稿2:删除
	public function getContentState($contentId=null){
		$stateArray=array(
			'0'=>'已发布',
			'1'=>'草稿箱',
			'2'=>'已删除'
		);
		if(isset($contentId)) return $stateArray[$contentId];
		else return $stateArray;
	}
	//1:顶部菜单栏2:顶部滚动图3:侧边栏4:首页主体
	public function getPositionType($positionType=null){
		$positionArray=array(
			'topBar'=>'1',
			'sliderImage'=>'2',
			'sider'=>'3',
			'index'=>'4'
		);
		if(isset($positionType)) return $positionArray[$positionType];
		else return $positionArray;
	}
	public function getColumn($columnId){
		$condition=array(
			'table'=>'column',
			'result'=>'data',
			'where'=>array('column_id'=>$columnId)
		);
		return $this->getOneData($condition);
	}
	public function getUser($userId){
		$condition=array(
			'table'=>'user',
			'result'=>'data',
			'where'=>array('user_id'=>$userId)
		);
		return $this->getOneData($condition);
	}
	public function getSubColumn($fColumnId){
		$condition=array(
			'table'=>'column',
			'result'=>'data',
			'where'=>array('column_fid'=>$fColumnId)
		);
		return $this->getData($condition);
	}
	public function getContent($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array($type.'_id'=>$contentId)
		);
		return $this->getOneData($condition);
	}
	public function getSliderImage(){
		$sliderImageColumns=$this->getPositions('sliderImage');
		$sliderImageColumn=$sliderImageColumns[0];
		$condition=array(
			'table'=>'image',
			'result'=>'data',
			'where'=>array('image_column'=>$sliderImageColumn->column_id)
		);
		return $this->getData($condition);
	}
	/**
	 * 获取数据库信息
	 * return array
	 */
	public function getData($condition){
		return $this->CI->dbHandler->selectData($condition);
	}
	/**
	 * 获取一条数据库信息
	 * return object
	 */
	public function getOneData($condition){
		if(!isset($condition['result'])) $condition['result']='data';
		$data=$this->CI->dbHandler->selectData($condition);
		return $data[0];
	}
	/**
	 * 更新数据库信息
	 * return int
	 */
	public function updateData($condition){
		return $this->CI->dbHandler->updateData($condition);
	}
	/**
	 * 更新访问量 essay,image,forum,websiteconfig
	 * return int
	 */
	public function updateVisit($table,$id=0){
		$condition=array('table'=>$table);
		switch($table){
			case 'essay':
				$condition['where']=array('essay_id'=>$id);
				$data=$this->getOneData($condition);
				$condition['data']=array('essay_visits'=>$data->essay_visits+1);
			break;
			case 'image':
				$condition['where']=array('image_id'=>$id);
				$data=$this->getOneData($condition);
				$condition['data']=array('image_visits'=>$data->image_visits+1);
			break;
			case 'forum':
				$condition['where']=array('forum_id'=>$id);
				$data=$this->getOneData($condition);
				$condition['data']=array('forum_visits'=>$data->forum_visits+1);
			break;
			case 'websiteconfig':
				$condition['where']=array('key_websiteconfig'=>'visits');
				$data=$this->getOneData($condition);
				$condition['data']=array('value_websiteconfig'=>$data->value_websiteconfig+1);
			break;
		}
		return $this->updateData($condition);
	}
	public function getEssay($id){
		$condition=array(
				'table'=>'essay',
				'result'=>'data'
		);
		if(is_numeric($id)) $condition['where']=array('essay_id'=>$id);
		else{
			$columnCondition=array(
				'table'=>'column',
				'result'=>'data',
				'where'=>array('column_name'=>$id)
			);
			$column=$this->getOneData($columnCondition);
			$condition['where']=array('essay_column'=>$column->column_id);
		}
		return $this->getOneData($condition);
	}
	public function getForum($id){
		$condition=array(
				'table'=>'forum',
				'where'=>array('forum_id'=>$id),
				'join'=>array('user'=>'user.user_id=forum.forum_author_id'),
				'result'=>'data'
		);
		return $this->getOneData($condition);
	}
	public function getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount){
		$pageAmount=ceil($amount/$amountPerPage);
		$page=array(
			'firstPage'=>($currentPage!=1)?$baseUrl.'&page=1':'no',
			'lastPage'=>($currentPage!=$pageAmount)?$baseUrl.'&page='.$pageAmount:'no',
			'prevPage'=>($currentPage>1)?$baseUrl.'&page='.($currentPage-1):'no',
			'nextPage'=>($currentPage<$pageAmount)?$baseUrl.'&page='.($currentPage+1):'no',
			'jumpPage'=>$baseUrl.'&page=',
			'selectPage'=>$selectUrl,
			'currentPage'=>$currentPage,
			'pageAmount'=>$pageAmount,
			'amount'=>$amount,
			'limit'=>array('offset'=>$amountPerPage*($currentPage-1),'limit'=>$amountPerPage)
		);
		return $page;
	}
	/**
	 * 检查是否已存在
	 */
	public function isExist($table,$field,$value){
		$condition=array(
				'table'=>$table,
				'where'=>array($field=>$value),
				'result'=>'count'
		);
		$amount=$this->CI->dbHandler->selectData($condition);
		if($amount>0) return true;
		else return false;
	}
}

/* End of file Common.php */