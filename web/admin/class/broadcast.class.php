<?php
/**
 * 消息广播处理类
 * PHP访问Mochiweb操作处理
 * 提供以下接口
 * 查询消息广播数据（返回所有的数据）
 * 查询某一条消息广播的详细信息
 * 添加一条消息广播
 * 删除一条或多条消息广播
 * 修改一条消息广播
 */

/*
 * Created on Oct 26, 2010
 *
 * 玩家信息类
 */
class BroadcastClass {
	 public $m_szErlangNode ;
	function BroadcastClass($erlangNode){
        $this->m_szErlangNode =  $erlangNode ;
		$jsonHomeUrl = $this->m_szErlangNode."broadcast";
	}
	/**
	 * 查询消息广播数据（返回所有的数据）
	 */
	public function listBroadcast(){
		$result = getJson ($this->m_szErlangNode."broadcast/list");
		return $result;
	}
	public function addBroadcast(){
		$result = getJson ($this->m_szErlangNode."broadcast/add");
		return $result;
	}
	public function showBroadcast($id,$type){
		$result = getJson ($this->m_szErlangNode."broadcast/show?id=".$id."&type=".$type);
		return $result;
	}
	public function editBroadcast($id,$type){
		$result = getJson ($this->m_szErlangNode."broadcast/edit?id=".$id."&type=".$type);
		return $result;
	}
	public function saveBroadcast($id,$foreign_id,$type,$send_strategy,$start_date,$end_date,$start_time,$end_time,$interval,$content){
		$saveUrl = $this->m_szErlangNode."broadcast/save?id=".$id."&foreign_id=".$foreign_id."&type=".$type."&send_strategy=".$send_strategy."&start_date=".$start_date.
					"&end_date=".$end_date."&start_time=".$start_time."&end_time=".$end_time."&interval=".$interval."&content=".$content;
//		echo $saveUrl;
		$result = getJson ($saveUrl);
		return $result;
	}
	public function delBroadcast($ids,$type){
//		echo $ids;
		$result = getJson ($this->m_szErlangNode."broadcast/del?ids=".$ids."&type=".$type);
		return $result;
	}
}
