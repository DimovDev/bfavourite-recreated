

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
     
     let pillField = new PillFeald($, 'category');
   
     $( "#category" ).autocomplete({
        source: '/admin/categories/auto',
        minLength: 3,
        select: (event, ui) => {

            let pill = pillField.push(ui.item);
           
          if(pill) {  
            $('.values').append(pill);
            feather.replace();
          }

        }

      });
  


});

class PillFeald {

    constructor(jQuery, field = null) {
      
      this.items = [];
      this.$ = jQuery;
      this.field = field;

    }

    push (item) {
     
      if(item.id && item.value) {
      
       if(!this.items.find(archived => archived.id == item.id)) {
        
        this.items.push(item);

        return this.prepare(item);

       }


      }

    }
     
    prepare(item) {

      let pill = this.$(`<div class="badge badge-pill badge-primary p-2 m-1">
                          <input type="hidden" name="${this.field}[]" value="${item.id}" />
                          ${item.value}
                         </div>`);

       let close = $('<span data-feather="x"></span>');
       pill.append(close);

       pill.on('click', ev => {

           pill.remove();
           this.items = this.items.filter(archived => archived.id != item.id);

       });       
       
       return pill;

    }

}