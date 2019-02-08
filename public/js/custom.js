

$(document).ready(function() {

    feather.replace()

    $('#destroy-btn').on('click', function(){
       
        $('.admin-table').closest('form').submit();

    });

    $('#select-all').on('click', function(){
            

       $('.admin-table .destroy').prop('checked', this.checked);

    });

     new MediaLibField($, 'photo');
     new MediaLibField($, 'icon');

});