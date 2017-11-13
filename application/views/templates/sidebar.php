<div class="be-left-sidebar">
	<div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle"><?= $webpage_title; ?></a>
		<div class="left-sidebar-spacer">
			<div class="left-sidebar-scroll">
				<div class="left-sidebar-content">
					<ul class="sidebar-elements">
						<li class="divider">Menu</li>
						<li>
							<a href="<?php echo base_url(); ?>"><i class="icon mdi icon mdi-view-dashboard"></i> Dashboard</a>
						</li>
						<?php
						
							// echo '<pre>';
							// print_r($this->Account->debug());
							// echo '</pre>';
							
							if(!$this->Permissions_Model->is_admin() && isset($this->Account->account_companies)) {
								foreach($menu as $item) {
									echo $item;
								}
							}
							
						?>
						<!--<li<?php if(base_url(uri_string())==base_url('projects')) echo ' class="active"'; ?>>
							<a href="<?php echo base_url('projects'); ?>"> Projects</a>
						</li>
						<li class="parent">
							<a href="#"><i class="icon mdi icon mdi-settings"></i><span>Settings</span></a>
							<ul class="sub-menu">
								<li<?php if(base_url(uri_string())==base_url('settings/general')) echo ' class="active"'; ?>>
									<a href="<?= base_url('settings/general'); ?>"><i class="icon mdi icon mdi-accounts"></i> General</a>
								</li>
								<li<?php if(base_url(uri_string())==base_url('settings/integrations')) echo ' class="active"'; ?>>
									<a href="<?= base_url('settings/integrations'); ?>"><i class="icon mdi icon mdi-accounts"></i> Integrations</a>
								</li>
							</ul>
						</li>-->
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>