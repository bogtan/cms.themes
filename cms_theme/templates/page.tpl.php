<div class="navbar navbar-static-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <a class="brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
                <?php print $site_name; ?>
            </a>

            <div class="nav-collapse">
                <?php
                    if ($main_menu) {
                ?>
                <ul class="nav">
                    <?php
                    $type= '';
                        if ((arg(0) == 'node') && (is_numeric(arg(1)))) {
                            $node = node_load(arg(1));
                            $type = $node->type;
                        }

                        foreach($main_menu as $menu_item) {
                    ?>
                    <li <?php if ((current_path() == $menu_item['href']) || ((isset($type)) && $type == strtolower($menu_item['title']))) { ?>class="active"<?php } ?>>
                        <?php
                            print l($menu_item['title'], $menu_item['href']);
                        ?>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
                <?php
                    }
                ?>
            <?php if ($primary_nav): ?>
                <?php print $primary_nav; ?>
            <?php endif; ?>

            <?php if ($secondary_nav): ?>
                <?php print $secondary_nav; ?>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="span12">
            <?php
                if ($breadcrumb) {
                    print $breadcrumb;
                }
            ?>

            <?php if ($title): ?>
            <h1>
                <?php print $title; ?>
            </h1>
            <?php endif; ?>

            <?php print $messages; ?>

            <?php
            $match = FALSE;
            $types = array('species', 'listing');
            if (arg(0) == 'node' && is_numeric(arg(1))) {
                $nid = arg(1);
                $node = node_load($nid);
                $type = $node->type;
                if (in_array($type, $types)) {
                    $match = TRUE;
                }
            }elseif (in_array(arg(1), $types)) {
                $match = TRUE;
            }

            if ($tabs and !$match) {
                print render($tabs);
            }
            ?>

            <?php if ($page['help']): ?> 
            <div class="well">
                <?php print render($page['help']); ?>
            </div>
            <?php endif; ?>

            <?php if ($action_links and !$match): ?>
                <div class="subnav">
                    <ul class="nav nav-pills action-links"><?php print render($action_links); ?></ul>
                </div>
            <?php endif; ?>

            <?php print render($page['submenu']); ?>

            <?php print render($page['content']); ?>

        </div>
    </div>

    <footer class="footer">
        <div class="row">
        <?php print render($page['footer']); ?>
        </div>
    </footer>
</div><!-- /div.container -->
