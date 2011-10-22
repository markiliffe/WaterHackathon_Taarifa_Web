<script type="text/javascript"> 
function forwardMessage<?php echo $message_id; ?>()
{
	$("#forwarded_<?php echo $message_id; ?>").fadeIn("slow");
	var groupId = $("#input_forwardto_<?php echo $message_id; ?>").val();
	<?php if(isset($_GET['status'])) $status = $_GET['status']; else $status = '' ?>
	$.get("<?php echo url::site()."admin/simplegroups/forwardto/index/".$message_id."/".$item_type."/"; ?>" + groupId + "/<?php echo $status ?>",
		function(data) {
			var forwardSpan = $("#msg_fwrd_to_<?php echo $message_id; ?>");
			if(data == "") {
			  forwardSpan.parents('tr').empty();
		  }
		  else {
			  forwardSpan.html(data);
			  $("#forwarded_<?php echo $message_id; ?>").fadeOut("slow");
      }
		});
	return false;
}

</script>

<?php
	$assigned_groups_text = "";
	$count = 0;
	foreach($assigned_groups as $assigned_group)
	{
		$count++;
		if($count > 1)
		{
			$assigned_groups_text = $assigned_groups_text.", ";
		}
		$assigned_groups_text = $assigned_groups_text.  "<a href=\"".url::site()."admin/simplegroups_settings/edit/".$assigned_group->id."\">".$assigned_group->name."</a>";
	}
	
	if($assigned_groups_text != "")
	{
		echo "<span id=\"msg_fwrd_to_".$message_id."\"> Assigned to group(s): ". $assigned_groups_text. "</span><br/>";
	}
	else
	{
		echo "<span id=\"msg_fwrd_to_".$message_id."\"></span><br/>";
	}
?>
<?php echo Kohana::lang('simplegroups.forward_to');?>
<?php print form::dropdown("input_forwardto_".$message_id, $groups_array, 'standard'); ?>
<a href="#" onclick="javascript:forwardMessage<?php echo $message_id; ?>(); return false;"  style="border: #d1d1d1 1px solid; background-color:#F2F7Fa; color: #5c5c5c; padding: 0px 9px; line-height:24px; text-decoration:none;"><?php echo Kohana::lang('simplegroups.forward');?></a>
<span id="forwarded_<?php echo $message_id; ?>"style="width: 70px; display:none; color:#555; background-color:#d8f1d8; border: 2px solid #a7d1a7;">F<?php echo Kohana::lang('simplegroups.forwarded');?></span>
