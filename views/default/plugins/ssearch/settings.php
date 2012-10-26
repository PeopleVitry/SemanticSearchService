<?php
$plug_ver = LiangLee_version('ssearch');
$plug_rel = LiangLee_release('ssearch');

$settings = <<<__HTML
   <div>
	<div class='elgg-module-inline'>
		<div class='elgg-head'>
		<h3>Holla, Search Settings</h3></div></div>
		    <hr>
		 <p></p>
		<p>Release: $plug_rel</p>
		<p>Version: $plug_ver</p>

    </div>
    <hr>
</div>
__HTML;

echo $settings;