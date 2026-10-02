<?php
require __DIR__ . '/lib.php';
$batch = find_batch((string)($_GET['id'] ?? ''));
if (!$batch) { http_response_code(404); page_header('Room not found','library','Not found'); echo '<div class="empty"><h2>Learning room not found</h2><p>Return to the batch browser and choose a free room.</p><a class="primary-btn" href="index.php#rooms">Back to rooms</a></div>'; page_footer(); exit; }
$state=get_state();
$subject = find_subject($batch,(string)($_GET['subject']??'')) ?? $batch['subjects'][0];
page_header($batch['title'],'library',$batch['title']);
$back='batch.php?id='.rawurlencode($batch['id']);
?>
<a class="back-btn" href="index.php#rooms">← Back to batch browser</a>
<div class="workspace-title"><div><div class="eyebrow"><?=e($batch['level'])?></div><h1><?=e($batch['title'])?></h1><p><?=e($batch['subtitle'])?> · <b style="color:#b9c4df"><?=batch_progress($batch,$state)?>% complete</b></p></div><span class="tag"><?=count($batch['subjects'])?> subjects</span></div>
<div class="subject-row"><?php foreach($batch['subjects'] as $s): ?><a class="subject-btn subject-link <?=$s['id']===$subject['id']?'selected':''?>" href="<?=$back?>&subject=<?=rawurlencode($s['id'])?>"><span class="subject-icon"><?=e($s['short'])?></span><span><b><?=e($s['name'])?></b><small><?=count($s['chapters'])?> chapters</small></span></a><?php endforeach; ?></div>
<div class="chapter-panel"><div class="chapter-header"><h2><?=e($subject['name'])?> chapters</h2><span><?=count(array_filter($subject['chapters'],fn($c)=>is_done($state,$c['id'])))?> of <?=count($subject['chapters'])?> complete</span></div><div class="chapter-list"><?php foreach($subject['chapters'] as $i=>$c): $url='chapter.php?'.http_build_query(['batch'=>$batch['id'],'subject'=>$subject['id'],'chapter'=>$c['id']]); ?><a class="chapter-row" href="<?=$url?>"><span class="chapter-number"><?=str_pad((string)($i+1),2,'0',STR_PAD_LEFT)?></span><span class="chapter-info"><b><?=e($c['name'])?></b><small><?=e($c['duration'])?> · <?=count($c['dpp'])?> DPP questions</small></span><span class="check <?=is_done($state,$c['id'])?'done':''?>"><?=is_done($state,$c['id'])?'✓':''?></span></a><?php endforeach; ?></div></div>
<div class="source-line">Public lecture links, NCERT notes and original practice questions. Select a chapter to start.</div>
<?php page_footer(); ?>
