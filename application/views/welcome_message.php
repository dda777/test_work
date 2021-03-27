<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('__ROOT__', dirname(dirname(__FILE__)));

?>
<body class='welcome'>
	<div id="container">
		<h1>Welcome to solved tasks by Denis Dikiy</h1>
		<div id="body">
			<div class='my-2'>
				<a class="btn btn-info" data-toggle="collapse" href="#collapse_task_1" role="button" aria-expanded="false" aria-controls="collapse_task_1">
					First Task
				</a>
			</div>
			<div class="collapse" id="collapse_task_1">
				<div class="card card-body">
					<code>
						<?php require_once __ROOT__.'/views/tasks/task_1.php'; ?>
					</code>
					<?php $concat_array = new ConcatArray; echo $concat_array;  ?>
				</div>
			</div>
			<div class='my-2'>
				<a class="btn btn-info" data-toggle="collapse" href="#collapse_task_2" role="button" aria-expanded="false" aria-controls="collapse_task_2">
					Second Task
				</a>
			</div>
			<div class="collapse" id="collapse_task_2">
				<div class="card card-body">
					<code>
						<?php require_once __ROOT__.'/views/tasks/task_2.php'; ?>
					</code>
				</div>
			</div>
			<div class='mt-2'>
				<a class="btn btn-info" href="/comments">Comment Task</a>
			</div>
		</div>
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div>
</body>
</html>
