<?php
\frontend\assets\ProjectAsset::register($this);
?>
<div class="ajax_windows_content" style="min-height: 600px">
    <ul id="accordion" class="accordion">
        <div class="links view_project" data-type="teem"><a href="#">Команда проекта</a></div>
        <div class="links view_project" data-type="tech"><a href="#">ТЗ</a></div>
        <div class="links view_project" data-type="settings"><a href="#">Настройки</a></div>
        <div class="links view_project" data-type="task"><a href="#">Задачи</a></div>
        <div class="links view_project" data-type="errors"><a href="#">Лог ошибок</a></div>
    </ul>
    <input type="hidden" value="<?= $id ?>" name="main_project_id">
    <div class="text_windows_content">

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