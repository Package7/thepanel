<?php

	if(count($teams) == 0)
	{
		
?>
<div class="modal-header">
		<button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
		<h3 class="modal-title">Assign account</strong></h3>
	</div>
	<div class="modal-body"><div role="alert" class="alert alert-warning alert-icon alert-icon-colored">
											<div class="icon">
												<span class="mdi mdi-alert-triangle"></span>
											</div>
											<div class="message">
												Currently no teams have been created. 
											</div>
										</div>
	</div>
</div>
<?php

	}
	else
	{
	
?>
<form id="assign_account">
	<div class="modal-header">
		<button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
		<h3 class="modal-title">Assign account</strong></h3>
	</div>
	<div class="modal-body">
		
			<div id="assign_account_console"></div>
		<input type="hidden" name="company_id" id="company_id" value="<?= $company_id; ?>"/>
		<input type="hidden" name="account_id" id="account_id" value="<?= $account_id; ?>"/>
		<div class="form-group">
			<label>Team <span class="mandatory">*</span></label>
			<select name="team_id" id="team_id" class="form-control">
				<option value="0">-- Select team --</option>
				<?php foreach($teams as $team): ?>
				<option value="<?= $team['team_id']; ?>"><?= $team['team_name']; ?> (<?= $team['company_name']; ?>)</option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default md-close">Cancel</button>
		<button type="button" id="assign_account" class="btn btn-primary">Save</button>
	</div>
</form>
<script type="text/javascript">
$(document).ready(function()
{
	$('button#assign_account').on('click', function(event)
	{
		event.preventDefault();
		$.ajax(
		{
			type: 'POST',
			url: '<?= base_url('accounts/assign_account_process'); ?>',
			data: $('form#assign_account').serialize(),
			success: function(data)
			{
				// $('div#assign_account_console').html(data);
				
				try
				{
					var response = $.parseJSON(JSON.stringify(data));
					
					if(response.status==200)
					{
						if(response['url'] == 'refresh')
					  {
						  window.location.reload();
					  }
					  else
					  {
						  window.location.replace(response['url']);
					  }
					}
					else
					{
						$('div#assign_account_console').html('<div class="alert alert-danger"><strong>Please correct the following:</strong>' + response.errors + '</div>');
					}
				}
				catch(e)
				{
				}				
			}
		});
	});
});
</script>
<?php

	}
	
?>