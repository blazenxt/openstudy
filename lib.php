<?php
declare(strict_types=1);

$CATALOG = require __DIR__ . '/content.php';

function e(mixed $value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function catalog(): array { global $CATALOG; return $CATALOG; }
function all_chapters(): array {
    $out = [];
    foreach (catalog()['batches'] as $b) foreach ($b['subjects'] as $s) foreach ($s['chapters'] as $c) $out[] = ['batch'=>$b,'subject'=>$s,'chapter'=>$c];
    return $out;
}
function find_batch(string $id): ?array { foreach (catalog()['batches'] as $b) if ($b['id'] === $id) return $b; return null; }
function find_subject(array $batch, string $id): ?array { foreach ($batch['subjects'] as $s) if ($s['id'] === $id) return $s; return null; }
function find_chapter(array $subject, string $id): ?array { foreach ($subject['chapters'] as $c) if ($c['id'] === $id) return $c; return null; }
function ensure_state_cookie(): string {
    if (!isset($_COOKIE['openstudy_id']) || !preg_match('/^[a-f0-9]{24}$/', (string)$_COOKIE['openstudy_id'])) {
        $id = bin2hex(random_bytes(12));
        setcookie('openstudy_id', $id, ['expires'=>time()+31536000,'path'=>'/','httponly'=>true,'samesite'=>'Lax']);
        $_COOKIE['openstudy_id'] = $id;
        return $id;
    }
    return (string)$_COOKIE['openstudy_id'];
}
function state_file(): string { $dir=__DIR__.'/storage'; if(!is_dir($dir)) @mkdir($dir,0775,true); return $dir.'/'.ensure_state_cookie().'.json'; }
function get_state(): array {
    $base=['completed'=>[],'dpp'=>[],'dpp_answers'=>[],'schedule'=>[],'updated_at'=>date('c')];
    $file=state_file();
    if(is_file($file)){ $raw=json_decode((string)file_get_contents($file),true); if(is_array($raw)) $base=array_merge($base,$raw); }
    $base['completed']=array_values(array_unique(array_filter(array_map('strval',(array)$base['completed']))));
    return $base;
}
function save_state(array $state): void {
    $state['updated_at']=date('c'); $file=state_file(); $tmp=$file.'.tmp';
    file_put_contents($tmp,json_encode($state,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES),LOCK_EX); @rename($tmp,$file);
}
function is_done(array $state,string $id): bool { return in_array($id,(array)$state['completed'],true); }
function batch_progress(array $batch,array $state): int { $all=[]; foreach($batch['subjects'] as $s) foreach($s['chapters'] as $c)$all[]=$c['id']; return count($all)?(int)round(count(array_intersect($all,$state['completed']))/count($all)*100):0; }
function default_schedule(): array {
    $items=[]; $days=['MON','TUE','WED','THU','FRI','SAT','SUN']; $all=all_chapters();
    foreach(array_slice($all,0,7) as $i=>$x) $items[]=['day'=>$days[$i],'title'=>$x['chapter']['name'],'sub'=>$x['subject']['name'].' · '.$x['batch']['title'],'id'=>$x['chapter']['id'],'done'=>false];
    return $items;
}
function schedule_items(array $state): array { return !empty($state['schedule']) && is_array($state['schedule']) ? array_slice($state['schedule'],0,14) : default_schedule(); }
function progress_totals(array $state): array { $all=all_chapters(); return ['chapters'=>count($all),'done'=>count(array_intersect(array_column(array_column($all,'chapter'),'id'),$state['completed'])),'dpps'=>count((array)$state['dpp'])]; }
function page_header(string $title,string $active='home',string $crumb='Overview'): void {
    $app=catalog()['app'];
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="theme-color" content="#0b1020"><title><?=e($title)?> · <?=e($app['name'])?></title><link rel="stylesheet" href="style.css"></head><body><div class="app"><aside class="sidebar" id="sidebar"><div class="brand"><div class="brand-mark">✦</div><div><strong>OpenStudy</strong><small>free learning room</small></div></div><div class="nav-label">Workspace</div><nav class="nav"><a class="page-nav-link <?= $active==='home'?'active':'' ?>" href="index.php"><span class="nav-icon">⌂</span>Overview</a><a class="page-nav-link <?= $active==='library'?'active':'' ?>" href="index.php#rooms"><span class="nav-icon">▦</span>Batch browser</a><a class="page-nav-link <?= $active==='plan'?'active':'' ?>" href="schedule.php"><span class="nav-icon">◷</span>Weekly schedule</a></nav><div class="nav-label" style="margin-top:28px">Your rhythm</div><div class="sidebar-note"><b>Small sessions add up.</b>Mark a chapter complete after you finish its lecture, notes and DPP. Your progress stays in this browser.</div></aside><main class="main"><header class="topbar"><button class="mobile-menu" onclick="document.getElementById('sidebar').classList.toggle('open')">☰</button><div class="crumb"><a href="index.php"><b>Overview</b></a> <span>/</span> <?=e($crumb)?></div><div class="top-actions"><form class="search-form" action="index.php" method="get"><input class="search" name="q" type="search" value="<?=e($_GET['q']??'')?>" placeholder="Search batches or chapters…"></form><div class="avatar">OS</div></div></header><div class="content">
<?php }
function page_footer(): void { echo '</div></main></div><div class="footer-note">OpenStudy · Free public learning resources · No paid-content proxying</div></body></html>'; }
function notice(?string $text, string $type=''): void { if($text) echo '<div class="notice '.e($type).'">'.e($text).'</div>'; }
function batch_card(array $b,array $state): string { $count=0; foreach($b['subjects'] as $s)$count+=count($s['chapters']); $p=batch_progress($b,$state); return '<a class="batch-card accent-'.e($b['accent']).'" href="batch.php?id='.e($b['id']).'"><div class="batch-top"><div class="batch-icon">'.e($b['icon']).'</div><span class="tag">'.e($b['level']).'</span></div><h3>'.e($b['title']).'</h3><p>'.e($b['subtitle']).'</p><div class="batch-foot"><div><div class="meta">'.$count.' chapters · '.$p.'% complete</div><div class="progress-line"><i style="width:'.$p.'%"></i></div></div><span class="open-btn">Open room →</span></div></a>'; }
