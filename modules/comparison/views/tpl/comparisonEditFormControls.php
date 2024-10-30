<div class="supsystic-bar" style="display: inline-block; float: right;">

    <!--
    <div id="icsComparisonTitleLabel" style="display: inline;">
        <?php echo htmlIcs::text('title', array(
            'value' => (isset($this->slider['title']) ? $this->slider['title'] : ''),
            'attrs' => 'style="float: left; width:200px;"',
            'required' => true,
        )); ?>
    </div>
    -->

    <button class="button button-primary icsComparisonSaveBtn" style="margin-left: 10px; background-color: white">
        <i class="fa fa-check"></i>
        <?php echo esc_html__('Save', ICS_LANG_CODE); ?>
    </button>
</div>

