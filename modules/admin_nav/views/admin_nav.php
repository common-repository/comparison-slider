<?php
class admin_navViewIcs extends viewIcs {
	public function getBreadcrumbs() {
		$this->assign('breadcrumbsList', dispatcherIcs::applyFilters('mainBreadcrumbs', $this->getModule()->getBreadcrumbsList()));

        $id = (int) reqIcs::getVar('id', 'get');
        if (!empty($id)){
            $slider = frameIcs::_()->getModule('comparison')->getModel()->getById($id);
            if (!empty($slider['title'])) {
                $title = $slider['title'];
            } else {
                $title = $slider['id'];
            }
            $this->assign('title', $title);
        }
		return parent::getContent('adminNavBreadcrumbs');
	}
}
