<?php
require __DIR__ . '/lib.php';
$state = get_state();
$q = trim((string)($_GET['q'] ?? ''));
$batches = catalog()['batches'];
if ($q !== '') {
    $needle = mb_strtolower($q);
    $batches = array_values(array_filter(array_map(function(array $b) use ($needle) {
        $subjects = [];
        foreach ($b['subjects'] as $s) {
            $chapters = array_values(array_filter($s['chapters'], fn(array $c) => str_contains(mb_strtolower($b['title'].' '.$b['subtitle'].' '.$s['name'].' '.$c['name']), $needle)));
            if ($chapters) { $s['chapters'] = $chapters; $subjects[] = $s; }
        }
        if (!$subjects) return null;
        $b['subjects'] = $subjects; return $b;
    }, $batches)));
}
$t = progress_totals($state); $plan = schedule_items($state); $planDone = count(array_filter($plan, fn($x) => !empty($x['done'])));
page_header('Overview', 'home', $q ? 'Search results' : 'Free resources');
?>
<div class="hero"><div><div class="eyebrow">Good to see you</div><h1>Make progress you can feel.</h1><p><?=e(catalog()['app']['tagline'])?> Follow a batch, open a chapter, then learn it three ways: lecture, notes and practice.</p></div><div class="date-pill">Today · <span><?=e(date('D, M j'))?></span></div></div>
<div class="stat-grid"><div class="stat"><div class="stat-label">Chapters completed</div><div class="stat-value"><?=$t['done']?><span style="color:#687594;font-size:15px"> / <?=$t['chapters']?></span></div><div class="stat-detail">Keep your next win small</div></div><div class="stat"><div class="stat-label">Weekly plan</div><div class="stat-value"><?=$planDone?><span style="color:#687594;font-size:15px"> / <?=count($plan)?></span></div><div class="stat-detail">sessions checked off</div></div><div class="stat"><div class="stat-label">DPPs attempted</div><div class="stat-value"><?=$t['dpps']?></div><div class="stat-detail">practice builds recall</div></div><div class="stat"><div class="stat-label">Current focus</div><div class="stat-value" style="font-size:19px">Choose a room</div><div class="stat-detail">free content, no paywall</div></div></div>
<div class="workspace" id="rooms"><div><div class="section-head"><div><h2><?=$q ? 'Search results' : 'Pick a learning room'?></h2><p><?=$q ? 'Matching free study paths for “'.e($q).'”.' : 'Curated free paths for focused study.'?></p></div><?php if($q): ?><a class="text-btn" href="index.php">Clear search →</a><?php else: ?><a class="text-btn" href="schedule.php">Plan my week →</a><?php endif; ?></div><?php if (!$batches): ?><div class="empty">No matching room or chapter found. Try “physics”, “biology” or “sets”.</div><?php else: ?><div class="batch-grid"><?php foreach($batches as $b) echo batch_card($b,$state); ?></div><?php endif; ?><div class="source-line"><?=e(catalog()['app']['notice'])?> · <a href="https://ncert.nic.in/textbook.php" target="_blank" rel="noopener">NCERT textbook portal</a></div></div>
<section class="schedule-card"><h2>This week</h2><p>Seven gentle targets. Change them anytime.</p><div class="schedule-list"><?php foreach($plan as $item): ?><div class="schedule-item <?=!empty($item['done'])?'done':''?>"><span class="day-dot"><?=e($item['day'])?></span><span class="schedule-title"><?=e($item['title'])?><span class="schedule-sub"><?=e($item['sub'])?></span></span></div><?php endforeach; ?></div><a class="schedule-save" style="display:block;text-align:center" href="schedule.php">Open weekly schedule →</a></section></div>
<?php page_footer(); ?>
