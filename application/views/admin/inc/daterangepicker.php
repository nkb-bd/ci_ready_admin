<?php
	if(empty($this->config->item('date_or_time_format')))
	{
?>
		var start_date = "<?php echo date('Y-m-d') ?>";
		var end_date   = "<?php echo date('Y-m-d') ?>";

		$('#daterangepicker').daterangepicker({
		    autoApply: true,
		
			"ranges": {
				"<?php echo ("Today"); ?>": [
					"<?php echo date('m/d/Y', mktime(0,0,0,date("m"),date("d"),date("Y")));?>",
					"<?php echo date('m/d/Y', mktime(0,0,0,date("m"),date("d")+1,date("Y"))-1);?>"
				],"<?php echo ("Yesterday"); ?>": [
					"<?php echo date('m/d/Y', mktime(0,0,0,date("m"),date("d")-1,date("Y")));?>",
					"<?php echo date('m/d/Y', mktime(0,0,0,date("m"),date("d"),date("Y"))-1);?>"
				],
				"<?php echo ("Last 7"); ?>": [
					"<?php echo date('m/d/Y', mktime(0,0,0,date("m"),date("d")-6,date("Y")));?>",
					"<?php echo date('m/d/Y', mktime(0,0,0,date("m"),date("d")+1,date("Y"))-1);?>"
				],
				"<?php echo ("Last 30"); ?>": [
					"<?php echo date('m/d/Y', mktime(0,0,0,date("m"),date("d")-29,date("Y")));?>",
					"<?php echo date('m/d/Y', mktime(0,0,0,date("m"),date("d")+1,date("Y"))-1);?>"
				],
				"<?php echo ("This month"); ?>": [
					"<?php echo date('m/d/Y', mktime(0,0,0,date("m"),1,date("Y")));?>",
					"<?php echo date('m/d/Y', mktime(0,0,0,date("m")+1,1,date("Y"))-1);?>"
				],
				"<?php echo ("Last month"); ?>": [
					"<?php echo date('m/d/Y', mktime(0,0,0,date("m")-1,1,date("Y")));?>",
					"<?php echo date('m/d/Y', mktime(0,0,0,date("m"),1,date("Y"))-1);?>"
				],
				"<?php echo ("This year"); ?>": [
					"<?php echo date('m/d/Y', mktime(0,0,0,1,1,date("Y")));?>",
					"<?php echo date('m/d/Y', mktime(0,0,0,date("m"),1,date("Y")+1)-1);?>"
				],
				"<?php echo ("Last year"); ?>": [
					"<?php echo date('m/d/Y', mktime(0,0,0,1,1,date("Y")-1));?>",
					"<?php echo date('m/d/Y', mktime(0,0,0,1,1,date("Y"))-1);?>"
				],
				"<?php echo ("All time"); ?>": [
					"<?php echo date('m/d/Y', mktime(0,0,0,1,1,2010));?>",
					"<?php echo date('m/d/Y', mktime(0,0,0,date("m"),date("d")+1,date("Y"))-1);?>"
				],
			},
			"alwaysShowCalendars": true,
			"startDate": "<?php echo date('m/d/Y', mktime(0,0,0,date("m"),date("d")+1,date("Y"))-1);?>",
			"endDate": "<?php echo date('m/d/Y', mktime(0,0,0,date("m"),date("d")+1,date("Y"))-1);?>",
			"minDate": "<?php echo date('m/d/Y', mktime(0,0,0,01,01,2010));?>",
			"maxDate": "<?php echo date('m/d/Y', mktime(0,0,0,date("m"),date("d")+1,date("Y"))-1);?>"
		}, function(start, end, label) {
			start_date = start.format('YYYY-MM-DD');
			end_date = end.format('YYYY-MM-DD');
		});
<?php
	}
	else
	{
?>
		var start_date = "<?php echo date('Y-m-d H:i:s', mktime(0,0,0,date("m"),date("d"),date("Y")))?>";
		var end_date = "<?php echo date('Y-m-d H:i:s', mktime(23,59,59,date("m"),date("d"),date("Y")))?>";
		$('#daterangepicker').daterangepicker({
			"ranges": {
				"<?php echo ("Today"); ?>": [
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'), mktime(0,0,0,date("m"),date("d"),date("Y")));?>",
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(23,59,59,date("m"),date("d"),date("Y")));?>"
				],
				"<?php echo ("Today_last_year"); ?>": [
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(0,0,0,date("m"),date("d"),date("Y")-1));?>",
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(23,59,59,date("m"),date("d"),date("Y")-1));?>"
				],
				"<?php echo ("datepicker_yesterday"); ?>": [
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(0,0,0,date("m"),date("d")-1,date("Y")));?>",
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(23,59,59,date("m"),date("d")-1,date("Y")));?>"
				],
				"<?php echo ("Last_7"); ?>": [
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(0,0,0,date("m"),date("d")-6,date("Y")));?>",
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(23,59,59,date("m"),date("d"),date("Y")));?>"
				],
				"<?php echo ("Last_30"); ?>": [
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(0,0,0,date("m"),date("d")-29,date("Y")));?>",
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(23,59,59,date("m"),date("d"),date("Y")));?>"
				],
				"<?php echo ("This_month"); ?>": [
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(0,0,0,date("m"),1,date("Y")));?>",
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(23,59,59,date("m"),date("d"),date("Y")));?>"
				],
				"<?php echo ("datepicker_same_month_to_same_day_last_year"); ?>": [
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(0,0,0,date("m"),1,date("Y")-1));?>",
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(23,59,59,date("m"),date("d"),date("Y")-1));?>"
				],
				"<?php echo ("datepicker_same_month_last_year"); ?>": [
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(0,0,0,date("m"),1,date("Y")-1));?>",
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(23,59,59,date("m")+1,0,date("Y")-1));?>"
				],
				"<?php echo ("Last_month"); ?>": [
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(0,0,0,date("m")-1,1,date("Y")));?>",
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(23,59,59,date("m"),0,date("Y")));?>"
				],
				"<?php echo ("This_year"); ?>": [
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(0,0,0,1,1,date("Y")));?>",
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(23,59,59,date("m")+1,0,date("Y")));?>"
				],
				"<?php echo ("Last_year"); ?>": [
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(0,0,0,1,1,date("Y")-1));?>",
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(23,59,59,12,31,date("Y")-1));?>"
				],
				"<?php echo ("This_financial_year"); ?>": [
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(0,0,0,$this->config->item('financial_year'),1,date("Y")));?>",
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(23,59,59,date("m")+1,0,date("Y")));?>"
				],
				"<?php echo ("Last_financial_year"); ?>": [
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(0,0,0,$this->config->item('financial_year'),1,date("Y")-1));?>",
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(23,59,59,$this->config->item('financial_year'),0,date("Y")));?>"
				],
				"<?php echo ("datepicker_all_time"); ?>": [
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(0,0,0,1,1,2010));?>",
					"<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(23,59,59,date("m"),date("d"),date("Y")));?>"
				],
			},
			"locale": {
				"format": '<?php echo dateformat_momentjs($this->config->item("dateformat")." ".$this->config->item('timeformat'))?>',
				"separator": " - ",
				"applyLabel": "<?php echo ("datepicker_apply"); ?>",
				"cancelLabel": "<?php echo ("datepicker_cancel"); ?>",
				"fromLabel": "<?php echo ("datepicker_from"); ?>",
				"toLabel": "<?php echo ("To"); ?>",
				"customRangeLabel": "<?php echo ("datepicker_custom"); ?>",
				"daysOfWeek": [
					"<?php echo ("cal_su"); ?>",
					"<?php echo ("cal_mo"); ?>",
					"<?php echo ("cal_tu"); ?>",
					"<?php echo ("cal_we"); ?>",
					"<?php echo ("cal_th"); ?>",
					"<?php echo ("cal_fr"); ?>",
					"<?php echo ("cal_sa"); ?>",
					"<?php echo ("cal_su"); ?>"
				],
				"monthNames": [
					"<?php echo ("cal_january"); ?>",
					"<?php echo ("cal_february"); ?>",
					"<?php echo ("cal_march"); ?>",
					"<?php echo ("cal_april"); ?>",
					"<?php echo ("cal_may"); ?>",
					"<?php echo ("cal_june"); ?>",
					"<?php echo ("cal_july"); ?>",
					"<?php echo ("cal_august"); ?>",
					"<?php echo ("cal_september"); ?>",
					"<?php echo ("cal_october"); ?>",
					"<?php echo ("cal_november"); ?>",
					"<?php echo ("cal_december"); ?>"
				],
				"firstDay": <?php echo ("datepicker_weekstart"); ?>
			},
		    "timePicker": true,
		    "timePickerSeconds": true,
			"alwaysShowCalendars": true,
			"startDate": "<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(0,0,0,date("m"),date("d"),date("Y")));?>",
			"endDate": "<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(23,59,59,date("m"),date("d"),date("Y")));?>",
			"minDate": "<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(0,0,0,01,01,2010));?>",
			"maxDate": "<?php echo date('m/d/Y'." ".$this->config->item('timeformat'),mktime(23,59,59,date("m"),date("d"),date("Y")));?>"
		}, function(start, end, label) {
			start_date = start.format('YYYY-MM-DD HH:mm:ss');
			end_date = end.format('YYYY-MM-DD HH:mm:ss');
		});
<?php
	}
?>
