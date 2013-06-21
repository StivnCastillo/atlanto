<?php
$theme = $this->config->item('template');

$this->load->view($theme.'/header_view');
$this->load->view($theme.'/menu_view');
$this->load->view($content);
$this->load->view($theme.'/footer_view');
