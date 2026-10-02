<?php
declare(strict_types=1);
require __DIR__ . '/lib.php';
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
$state=get_state();
if(($_SERVER['REQUEST_METHOD']??'GET')==='GET'){echo json_encode(['ok'=>true,'state'=>$state],JSON_UNESCAPED_SLASHES);exit;}
if(($_SERVER['REQUEST_METHOD']??'GET')!=='POST'){http_response_code(405);echo json_encode(['ok'=>false,'error'=>'Method not allowed']);exit;}
$body=json_decode((string)file_get_contents('php://input'),true);
if(!is_array($body)){http_response_code(400);echo json_encode(['ok'=>false,'error'=>'Invalid JSON']);exit;}
$action=(string)($body['action']??'');
if($action==='toggle_complete'){
  $id=(string)($body['id']??''); if(!preg_match('/^[a-z0-9-]{1,100}$/',$id)){http_response_code(400);echo json_encode(['ok'=>false,'error'=>'Invalid item']);exit;}
  if(in_array($id,$state['completed'],true))$state['completed']=array_values(array_diff($state['completed'],[$id]));else$state['completed'][]=$id;
}elseif($action==='save_dpp'){
  $id=(string)($body['id']??'');$score=max(0,min(100,(int)($body['score']??0)));if(!preg_match('/^[a-z0-9-]{1,100}$/',$id)){http_response_code(400);echo json_encode(['ok'=>false,'error'=>'Invalid item']);exit;}$state['dpp'][$id]=['score'=>$score,'at'=>date('c')];
}else{http_response_code(400);echo json_encode(['ok'=>false,'error'=>'Unknown action']);exit;}
save_state($state);echo json_encode(['ok'=>true,'state'=>$state],JSON_UNESCAPED_SLASHES);
