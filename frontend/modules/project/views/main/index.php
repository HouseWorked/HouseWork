<?php
\frontend\assets\ProjectAsset::register($this);
?>
<div class="ajax_windows_content" style="min-height: 600px">
    <ul id="accordion" class="accordion">
        <?php foreach($menu as $menu_item): ?>
            <?php if($menu_item->parents === null): ?>
                <li> <!-- пункт меню -->
                    <div class="link"><i class="fa fa-database"></i><?=  $menu_item->title ?><i class="fa fa-chevron-down"></i></div><!-- Название пункта меню -->
                    <?php if($menu_item->getChildrens($menu_item->id)): ?><!-- Подпункт меню -->
                        <ul class="submenu">
                            <?php foreach($menu_item->getChildrens($menu_item->id) as $menu_children_item): ?>
                                <li class="select_left_menu" data-type="<?= $menu_children_item->id ?>"><a href="#"><?= $menu_children_item->title ?></a></li>
                            <?php endforeach;?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endif; ?>
        <?php endforeach;?>
    </ul>
    <div class="text_windows_content">
        В данном разделе вы можете управлять и следить за выполнением проектов
    </div>
</div>
<script>
    $(function() {
        var Accordion = function(el, multiple) {
            this.el = el || {};
            this.multiple = multiple || false;

            // Variables privadas
            var links = this.el.find('.link');
            // Evento
            links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
        };

        Accordion.prototype.dropdown = function(e) {
            var $el = e.data.el;
            $this = $(this),
                $next = $this.next();

            $next.slideToggle();
            $this.parent().toggleClass('open');

            if (!e.data.multiple) {
                $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
            };
        };

        var accordion = new Accordion($('#accordion'), false);
    });
</script>