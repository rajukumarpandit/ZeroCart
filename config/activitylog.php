<?php
return [

'default_log_name' => 'zyrocart',

'activity_model' => Spatie\Activitylog\Models\Activity::class,

'table_name' => 'activity_log',

'submit_empty_logs' => false,

'delete_records_older_than_days' => 365, // 1 year retention

];