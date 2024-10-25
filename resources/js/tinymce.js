import 'tinymce/tinymce';
import 'tinymce/skins/ui/oxide/skin.min.css';
import 'tinymce/icons/default/icons';
import 'tinymce/themes/silver/theme';
import 'tinymce/models/dom/model';

import 'tinymce/plugins/table/plugin';
import 'tinymce/plugins/emoticons/plugin';
import 'tinymce/plugins/emoticons/js/emojiimages';
import 'tinymce/plugins/emoticons/js/emojis';
import 'tinymce/plugins/code/plugin';

window.addEventListener('DOMContentLoaded', () => {
    tinymce.init({
        selector: 'textarea.letter',
        plugins: ['code','table','lists','emoticons'],
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | emoticons', // Добавляем 'emoticons' в панель инструментов
        menubar: true, // Опционально: скрываем меню, если оно не нужно
        skin: false,
        content_css: false
    });
});