<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Kiwys_Lite
 * @subpackage Kiwys_Lite/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div id="kiwys-lite-admin">
    <div class="container mx-auto max-w-5xl mt-8">
        <?php
        if ($this->user) {
            require_once plugin_dir_path(dirname(__FILE__)) . 'partials/kiwys-lite-admin-display-header.php';
            if ($this->website) {
                require_once plugin_dir_path(dirname(__FILE__)) . 'partials/kiwys-lite-admin-display-website-state.php';
        ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php require_once plugin_dir_path(dirname(__FILE__)) . 'partials/kiwys-lite-admin-display-options.php'; ?>
                    <?php require_once plugin_dir_path(dirname(__FILE__)) . 'partials/kiwys-lite-admin-display-metrics.php'; ?>
                </div>
        <?php
            } else {
                require_once plugin_dir_path(dirname(__FILE__)) . 'partials/kiwys-lite-admin-display-no-website.php';
            }
        } else {
            require_once plugin_dir_path(dirname(__FILE__)) . 'partials/kiwys-lite-admin-display-login.php';
        }
        ?>
    </div>
</div>