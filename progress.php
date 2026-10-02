<?php
declare(strict_types=1);
require __DIR__ . '/lib.php';
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') { header('Location: index.php'); exit; }
$action=(string)($_POST['action']??''); $state=get_state();
function chapter_redirect(string $batch,string $subject,string $chapter,string $tab='lecture'): never { header('Location: chapter.php?'.http_build_query(['batch'=>$batch,'subject'=>$subject,'chapter'=>$chapter,'tab'=>$tab])); exit; }
if($action==='toggle_complete'){
    $id=(string)($_POST['id']??''); $batch=(string)($_POST['batch']??''); $subject=(string)($_POST['subject']??''); $chapter=(string)($_POST['chapter']??'');
    if(!preg_match('/^[a-z0-9-]{1,100}$/',$id)) { header('Location: index.php'); exit; }
    if(in_array($id,$state['completed'],true)) $state['completed']=array_values(array_diff($state['completed'],[$id])); else $state['completed'][]=$id;
    save_state($state); chapter_redirect($batch,$subject,$chapter,'dpp');
}
if($action==='answer_dpp'){
    $batch=(string)($_POST['batch']??''); $subject=(string)($_POST['subject']??''); $chapterId=(string)($_POST['chapter']??''); $qi=(int)($_POST['question']??-1); $answer=(int)($_POST['answer']??-1);
    $b=find_batch($batch); $s=$b?find_subject($b,$subject):null; $c=$s?find_chapter($s,$chapterId):null;
    if(!$b||!$s||!$c||!isset($c['dpp'][$qi])||$answer<0||$answer>=count($c['dpp'][$qi]['options'])) { header('Location: index.php'); exit; }
    if(!isset($state['dpp_answers'][$chapterId])||!is_array($state['dpp_answers'][$chapterId]))$state['dpp_answers'][$chapterId]=[];
    $state['dpp_answers'][$chapterId][(string)$qi]=$answer;
    $answers=$state['dpp_answers'][$chapterId]; $correct=0;
    foreach($answers as $question=>$choice) if(isset($c['dpp'][(int)$question])&&(int)$choice===(int)$c['dpp'][(int)$question]['answer'])$correct++;
    $state['dpp'][$chapterId]=['score'=>(int)round($correct/count($c['dpp'])*100),'answered'=>count($answers),'at'=>date('c')];
    save_state($state); chapter_redirect($batch,$subject,$chapterId,'dpp');
}
if($action==='save_schedule'){
    $items=schedule_items($state); $done=is_array($_POST['done']??null)?$_POST['done']:[];
    foreach($items as $i=>&$item)$item['done']=isset($done[(string)$i])||isset($done[$i]); unset($item);
    $state['schedule']=$items; save_state($state); header('Location: schedule.php?saved=1'); exit;
}
header('Location: index.php');
