<?php
\frontend\assets\ProjectAsset::register($this);
?>
<div class="ajax_windows_content" style="min-height: 600px">
    <ul id="accordion" class="accordion">
        <li>
            <div class="link"><i class="fa fa-database"></i>Веб-роекты<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                <li class="select_left_menu" data-type="1"><a href="#">Создание сайтов</a></li>
                <li class="select_left_menu" data-type="2"><a href="#">Поддержка</a></li>
                <li class="select_left_menu" data-type="3"><a href="#">SEO продвижение</a></li>
                <li class="select_left_menu" data-type="4"><a href="#">Крупный проект</a></li>
                <li class="select_left_menu" data-type="5"><a href="#">Дизайн</a></li>
                <li class="select_left_menu" data-type="6"><a href="#">Реклама</a></li>
            </ul>
        </li>
        <li>
            <div class="link"><i class="fa fa-database"></i>Мобильные приложения<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                <li class="select_left_menu" data-type="1"><a href="#">Создание сайтов</a></li>
                <li class="select_left_menu" data-type="2"><a href="#">Поддержка</a></li>
                <li class="select_left_menu" data-type="3"><a href="#">SEO продвижение</a></li>
                <li class="select_left_menu" data-type="4"><a href="#">Крупный проект</a></li>
                <li class="select_left_menu" data-type="5"><a href="#">Дизайн</a></li>
                <li class="select_left_menu" data-type="6"><a href="#">Реклама</a></li>
            </ul>
        </li>
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