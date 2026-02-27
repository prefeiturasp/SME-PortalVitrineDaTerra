<div class="welcome-getting-started">
    <div class="welcome-demo-import">
        <h3><?php echo esc_html__('Manual Setup', 'online-estore'); ?></h3>

        <p><?php echo esc_html__('You can setup the home page sections either from Customizer Panel or from Elementor Pagebuilder', 'online-estore'); ?></p>
        <p><strong><?php echo esc_html__('FROM CUSTOMIZER', 'online-estore'); ?></strong></p>
        <ol>
            <li><?php echo esc_html__('Go to Appearance &gt; Customize', 'online-estore'); ?></li>
            <li><?php echo esc_html__('Click on ', 'online-estore'); ?><strong>"<a href="<?php echo esc_url(admin_url('customize.php?autofocus[section]=static_front_page')); ?>" target="_blank"><?php echo esc_html__('Enable Front Page', 'online-estore'); ?></a>"</strong> <?php echo esc_html__('and choose "Your Latest Post" and check the Enable Online eStore Front Page.', 'online-estore'); ?></li>
            <li><?php echo sprintf(
                    esc_html__('Now go back to %s and manage the widgets.', 'online-estore'), '<a href="'.esc_url(admin_url('widgets.php')).'" target="_blank">' . esc_html__('Online eStore Home Page Widgets area', 'online-estore') . '</a>'); ?></li>
        </ol>
        <p><strong><?php echo esc_html__('FROM ELEMENTOR', 'online-estore'); ?></strong></p>
        <ol>
            <li><?php echo esc_html__('Firstly install and activate "Elementor Website Builder" plugin from', 'online-estore'); ?> <a href="<?php echo esc_url(admin_url('post-new.php?page=onlineestore-welcome&section=recommended_plugins')); ?>" target="_blank"><?php echo esc_html__('Recommended Plugin page.', 'online-estore'); ?></a></li>
            <li><?php echo esc_html__('Create a new page and edit with Elementor. Drag and drop the elements in the Elementor to create your own design.', 'online-estore'); ?></li>
            <li><?php echo esc_html__('Now go to Appearance &gt; Customize &gt; Homepage Settings and choose "A static page" for "Your latest posts" and select the created page for "Home Page" option.', 'online-estore'); ?></li>
        </ol>
        
        <p>
            <?php echo sprintf(esc_html__('For more detail visit our theme %s.', 'online-estore'), '<a href="'.esc_url('https://docs.sparklewpthemes.com/').'" target="_blank">' . esc_html__('Documentation Page', 'online-estore') . '</a>'); ?>
        </p>
    </div>

    <div class="welcome-demo-import">
        <h3><?php echo esc_html__('Demo Importer', 'online-estore'); ?></h3>
        <div class="welcome-theme-thumb">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/screenshot.png'); ?>" alt="<?php printf(esc_attr__('%s Demo', 'online-estore'), $this->theme_name); ?>">
        </div>

        <div class="welcome-demo-import-text">
            <p><?php esc_html_e('Or you can get started by importing the demo with just one click.', 'online-estore'); ?></p>
            <p><?php echo sprintf(esc_html__('Click on the button below to install and activate the One Click Demo Importer Plugin. For more detailed documentation on how the demo importer works, click %s.', 'online-estore'), '<a href="'.esc_url('https://docs.sparklewpthemes.com/').'" target="_blank">' . esc_html__('here', 'online-estore') . '</a>'); ?></p>
            <?php echo $this->generate_demo_installer_button(); ?>
        </div>
    </div>
</div>