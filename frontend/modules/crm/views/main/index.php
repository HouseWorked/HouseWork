<?php
\frontend\assets\ProjectAsset::register($this);
?>
<div class="ajax_windows_content" style="min-height: 600px">
    <ul id="accordion" class="accordion">
        <li>
            <div class="link"><i class="fa fa-database"></i>Основные настройки<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                <li class="select_left_menu" data-type="direct"><a href="#">Направления</a></li>
                <li class="select_left_menu" data-type="test"><a href="#">Безопасность</a></li>
                <li class="select_left_menu" data-type="self"><a href="#">Личные данные</a></li>
                <li class="select_left_menu" data-type="alert"><a href="#">Уведомления</a></li>
                <li class="select_left_menu" data-type="teem"><a href="#">Данные о компании</a></li>
            </ul>
        </li>
        <div class="links select_left_menu" data-type="black"><a href="#">Черный список</a></div>
        <div class="links select_left_menu" data-type="icrm"><a href="#">O CRM</a></div>
    </ul>
    <div class="text_windows_content">
        menu
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