<div class="wrap">
    <div class="supsystic-plugin">
        <?php /*?><header class="supsystic-plugin">
            <h1><?php echo ICS_WP_PLUGIN_NAME?></h1>
        </header><?php */?>
		<?php echo $this->breadcrumbs; ?>
        <section class="supsystic-content">
            <nav class="supsystic-navigation supsystic-sticky <?php dispatcherIcs::doAction('adminMainNavClassAdd'); ?>">
                <ul>
					<?php foreach ($this->tabs as $tabKey => $tab) { ?>
						<?php if (isset($tab['hidden']) && $tab['hidden']) continue; ?>
						<li class="supsystic-tab-<?php echo esc_attr($tabKey); ?> <?php echo esc_attr(($this->activeTab == $tabKey || in_array($tabKey, $this->activeParentTabs)) ? 'active' : ''); ?>">
							<a href="<?php echo esc_url($tab['url']); ?>" title="<?php echo esc_attr($tab['label']); ?>">
								<?php if (isset($tab['fa_icon'])) { ?>
									<i class="fa <?php echo esc_attr($tab['fa_icon']); ?>"></i>
								<?php } else if (isset($tab['wp_icon'])) { ?>
									<i class="dashicons-before <?php echo esc_attr($tab['wp_icon']); ?>"></i>
								<?php } else if (isset($tab['icon'])) { ?>
									<i class="<?php echo esc_attr($tab['icon']); ?>"></i>
								<?php } ?>
								<span class="sup-tab-label"><?php echo esc_html($tab['label']); ?></span>
							</a>
						</li>
					<?php } ?>
                </ul>
            </nav>
            <div class="supsystic-container supsystic-<?php echo esc_attr($this->activeTab); ?>">
				<?php echo $this->content; ?>
                <div class="clear"></div>
            </div>
        </section>
    </div>
</div>
<!--Option available in PRO version Wnd-->
<div id="icsOpt" style="display: none;" title="qwe">

</div>
