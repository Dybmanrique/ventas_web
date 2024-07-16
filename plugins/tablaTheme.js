$(function(){
    $('.open-popup-link').magnificPopup({
        type: 'inline',
        midClick: true,
        callbacks: {
            open: function () {
                // Will fire when this exact popup is opened
                // this - is Magnific Popup object
                $('#table0').tablesorter({
                    theme: 'blue',
                    headerTemplate : '{content} {icon}', // Add icon for various themes
                    widgets: ['zebra', 'filter', 'stickyHeaders'],
                    widgetOptions: {
                        // jQuery selector or object to attach sticky header to
                        stickyHeaders_attachTo: '.mfp-wrap',
                        stickyHeaders_offset: 0,
                        // caption set by demo button value
                        stickyHeaders_includeCaption: includeCaption
                    }
                });
            }
        }
    });
    /* make second table scroll within its wrapper */
    $('#table2,#table1,#table3,#table4, .table2').tablesorter({ //add eblas: ,#table1,#table3,#table4, .table2
        widthFixed : true,
        headerTemplate : '{content} {icon}', // Add icon for various themes
        widgets: [ 'zebra', 'stickyHeaders', 'filter' ],
        widgetOptions: {
            // jQuery selector or object to attach sticky header to
            stickyHeaders_attachTo : '.wrapper' // or $('.wrapper')
        }
    });

});
$(function() {
    window.includeCaption = true;
    $('.caption').on('click', function(){
        includeCaption = !includeCaption;
        $(this).html( '' + includeCaption );
        $('#table2, .nested,#table1,#table3,#table4').each(function(){ //add eblas: ,#table1,#table3,#table4
            if (this.config) {
                this.config.widgetOptions.stickyHeaders_includeCaption = includeCaption;
                this.config.widgetOptions.$sticky.children('caption').toggle(includeCaption);
            }
        });
    });
    // removed jQuery UI theme because of the accordion!
    $('link.theme').each(function(){ this.disabled = true; });
    var themes = 'blue ice default green grey black-ice dark dropbox metro-dark',i, o = '', t = themes.split(' ');
    for (i = 0; i < t.length; i++) {
        o += '<option value="' + t[i] + '">' + t[i] + '</option>';
    }
    $('#theme').append(o).change(function(){
        var theme = $(this).val().toLowerCase(),
        // ui-theme is added by the themeswitcher
        files = $('link.theme').each(function(){
            this.disabled = true;
        })
        files.filter('.' + theme).each(function(){
            this.disabled = false; 
        });
        $('table').removeClass('tablesorter-' + t.join(' tablesorter-')).addClass('tablesorter-' + (theme === 'black-ice' ? 'blackice' : theme) );
    }).change();
});