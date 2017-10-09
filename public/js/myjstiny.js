$(document).ready(function () {
    var ed = new tinymce.Editor('content', {
        mode: "exact",
        theme: "advanced",
        plugins: "emotions,table",
        theme_advanced_toolbar_location: "top",
        theme_advanced_statusbar_location: "bottom",
        theme_advanced_resizing: true,
        theme_advanced_buttons1: "bold,italic,underline,fontselect,fontsizeselect,forecolor,backcolor,|,code,",
        theme_advanced_buttons2: "",
        theme_advanced_buttons3: "",
        table_default_cellspacing: 0,
        table_default_border: 1,
        remove_linebreaks: false
    });

    $('.my_text').editable({
        type: 'wysiwyg',
        editor: ed,
        onSubmit: function submitData(content) {
            alert(content.current);
        },
        submit: 'save',
        cancel: 'cancel'
    });
});