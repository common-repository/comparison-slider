<?php
	$countBreadcrumbs = count($this->breadcrumbsList);
?>
<nav id="supsystic-breadcrumbs" class="supsystic-breadcrumbs <?php dispatcherIcs::doAction('adminBreadcrumbsClassAdd'); ?>">
	<?php dispatcherIcs::doAction('beforeAdminBreadcrumbs'); ?>
	<?php foreach ($this->breadcrumbsList as $i => $crumb) { ?>
        <?php if ($crumb['label'] === 'Edit') { ?>
            <a class="supsystic-breadcrumb-el" href="<?php echo esc_url($crumb['url']); ?>"><?php echo esc_html($this->title); ?></a>
        <?php } else { ?>
		    <a class="supsystic-breadcrumb-el" href="<?php echo esc_url($crumb['url']); ?>"><?php echo esc_html($crumb['label']); ?></a>
        <?php } ?>
		<?php if ($i < ($countBreadcrumbs - 1)) { ?>
			<span class="breadcrumbs-separator"></span>
		<?php } ?>
	<?php } ?>
	<?php dispatcherIcs::doAction('afterAdminBreadcrumbs'); ?>
</nav>