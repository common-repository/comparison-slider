<section>
    <div class="supsystic-item supsystic-panel">
        <div id="containerWrapper">
            <ul id="icsComparisonTblNavBtnsShell" class="supsystic-bar-controls">
                <li title="<?php echo esc_attr__('Delete selected', ICS_LANG_CODE); ?>">
                    <button class="button" id="icsComparisonRemoveGroupBtn" disabled data-toolbar-button>
                        <i class="fa fa-fw fa-trash-o"></i>
						<?php echo esc_html__('Delete selected', ICS_LANG_CODE); ?>
                    </button>
                </li>
                <li title="<?php echo esc_attr__('Search', ICS_LANG_CODE); ?>">
                    <input id="icsComparisonTblSearchTxt" type="text" name="tbl_search" placeholder="<?php echo esc_attr__('Search', ICS_LANG_CODE); ?>">
                </li>
            </ul>
            <div id="icsComparisonTblNavShell" class="supsystic-tbl-pagination-shell"></div>
            <div style="clear: both;"></div>
            <hr />
            <table id="icsComparisonTbl"></table>
            <div id="icsComparisonTblNav"></div>
            <div id="icsComparisonTblEmptyMsg" style="display: none;">
                <h3><?php echo esc_html__('You have no Sliders for now.', ICS_LANG_CODE) . ' <a href="' . esc_url($this->addNewLink) . '" style="font-style: italic;">' . esc_html__('Create', ICS_LANG_CODE) . '</a> ' . esc_html__('your Slider', ICS_LANG_CODE) . '!'; ?></h3>
            </div>
        </div>
        <div style="clear: both;"></div>
        <div id="prewiew" style="margin-top: 30px"></div>
    </div>
</section>