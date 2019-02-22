


class MediaLib {

  
  constructor(jQuery) {

    this.$ = jQuery; 

    this.public_dir = '/storage';
    this.sizeOptions = false;

    this.routes = {index: '/admin/media',
                   store: '/admin/media',
                   destroy: '/admin/media/destroy'};

    this.popup = this.$(this.template);
    this.uploadForm = this.popup.find('form');

    this.content = this.popup.find('.media-lib-content');
    this.loader = this.popup.find('.media-lib-loading');

    this.sizesSelect = this.popup.find('.media-lib-sizes');
    this.sizesSelect.hide();

    this.messageBag = this.popup.find('.media-lib-message');
    this.messageBag.clear = () => this.messageBag.hide().removeClass('alert-danger alert-warning alert-success');

    this.pagination = new MediaLibPagination(jQuery);      

    this.init();   

  }

  set publicDir(dir) {

    this.public_dir = dir;

  }

  get publicDir() {

    return this.public_dir;

  }

    
  showSizes() {
    
     this.sizeOptions = true; 
     this.sizesSelect.show();

     this.sizesSelect.on('change', ev => {
       
      this.picked.url = this.picked.url.replace(/(_[a-z]+)?\./, '_'+ev.target.value+'.').replace(/_full/, '');

     });

     return this;

  }

  loadItemSizes(item) {

     let sizes = JSON.parse(item.sizes) || [];
     sizes.unshift('full');
     this.sizesSelect.html(sizes.map(size => `<option value="${size}">${size}</option>`).join(''));
     
     return this;
  }

  init() {

     this.load(this.routes.index);
     
     this.popup.find('.media-lib-close').on('click', ev => {
     
      ev.preventDefault()
      this.close();

     });

     this.popup.find('#pick').on('click', ev=> {
                                                  if(this.onFinish && this.picked) this.onFinish(this.picked);
                                                  this.close();
                                                });


    this.popup.find('.media-lib-delete').on('click', ev => {

      ev.preventDefault();

      this.destroy();
 
    });      

     this.popup.find('.btn-success').on('click', ev => {
        this.popup.find('[name="file"]').trigger('click');
     });                                  

     this.popup.find('[type="file"]').on('change', ev => this.upload());

     this.popup.hide();

     this.$('body').prepend(this.popup);

     this.$('.media-lib-overlay').on('click', ev => {
        
        if($(ev.target).attr('class') == 'media-lib-overlay') {

            this.close();
        }
          
     })
     
  }

  upload() {

   
    this.loading();

    let fd = new FormData(this.uploadForm[0]);
    fd.set('_method', 'POST');

    this.uploadForm[0].reset();
    
    this.$.ajax({url: this.routes.store,
                type: 'POST',
                data: fd,
                contentType: false,
                cache: false,
                processData: false,
                headers: {
                            'X-CSRF-TOKEN': this.$('meta[name="csrf-token"]').attr('content')
                            }}
                ).done(response => {
                    
                    
                    this.prepareDom(response);
    

                }).fail(response => {

                    this.prepareDom(response);

                });

    

  

  }

  destroy() {

      if(this.picked) { 
       
        let result = confirm("Наистина ли искате да изтриете тази снимка?");
        if (result) {
           
           this.loading();

           let fd = new FormData();
           fd.set('destroy[]', [this.picked.id]);
           fd.set('_method', 'DELETE');
           
           this.$.ajax({url: this.routes.destroy,
                        type: 'POST',
                        data: fd,
                        contentType: false,
                        cache: false,
                        processData: false,
                        headers: {
                                  'X-CSRF-TOKEN': this.$('meta[name="csrf-token"]').attr('content')
                                 }}).done(response => {
                          
                          this.prepareDom(response);
         

                        });

        }

      }

  }

  loading() {
     
     this.content.find('ul').remove();
     this.content.append(this.loader);

  }

  prepareDom(response) {

    this.messageBag.clear();
     

     if(response.message) {

        let {status, message} = response.message;
        status = status == 'error' ? 'danger' : status;

        this.messageBag.addClass('alert-'+status).html(message).fadeIn();

     }

   

   if(response.status == 422 && response.responseJSON) {

       let error = response.responseJSON.errors ? response.responseJSON.errors.file[0] : 'Something wrong happened!';
       this.messageBag.addClass('alert-danger').html(error).fadeIn();
       response = this.backup;
     
   } 
   

   if(response.message && !response.paginator.data.length) {

    this.messageBag.addClass('alert-warning').html("There are no media files...").fadeIn();
    this.popup.find('.media-lib-content .media-lib-loading').replaceWith("<ul></ul>");
    this.popup.find('.media-lib-panel').hide();
   }

   if(response.paginator && response.paginator.data.length > 0) {

        this.items = response.paginator.data;

        var mediaLibContent = "<ul>";
        

        for(var i = 0; i < this.items.length; i++) {

         this.items[i].icon = this.public_dir+this.items[i].icon;
         this.items[i].url = this.public_dir+this.items[i].url;

         mediaLibContent += `<li><img class="media-lib-icon" data-id="${i}" src="${this.items[i].icon}" alt="" /></li>`;
        }
    
        mediaLibContent += "</ul>";

        this.backup = response;
        this.pagination.load(response.paginator, url => this.load(url));

     
        this.loader.remove();
        this.content.append(mediaLibContent);
        
        this.pick(0);

        this.popup.find('.media-lib-footer .pagination')
                    .replaceWith(this.pagination.render());

        this.popup.find('.media-lib-content ul li img').on('click', ev => {
            
                this.pick(ev.target.getAttribute('data-id')); 

        });



     } 


  }

  load(url) {

      this.loading();

      this.$.ajax(url).done( response => {

             this.prepareDom(response);
         
        });

  }


  pick(index) {

    this.picked = this.items[index];
    
    this.loadItemSizes(this.picked);

    let src = this.items[index].icon;
    this.popup.find('.media-lib-panel .media-lib-icon').attr({'src': src});
    this.popup.find('.media-name').html(this.items[index].title);
    
    this.popup.find('.active').removeClass('active');
    
    this.popup.find(`[data-id="${index}"]`).addClass('active');

  }

  open() {

    this.$('body').css('overflow', 'hidden');
    this.popup.show();

  }

  close() {
     
     
     this.$('body').css('overflow', 'auto');
     this.popup.hide();
     this.messageBag.clear();
     


  }

  onFinish(callback) {
   
    this.onFinish = callback;
    return this;
  
  }

  get template() {

     return `<div class="media-lib-overlay">
<div class="media-lib">

  <div class="media-lib-header">
    <h1>Избери медия файл</h1>
    <a class="media-lib-close" href="#"><span class="fa fa-times"></span></a>
  </div>

  <div class="media-lib-body">
     
     <div class="media-lib-content">
         <div class="media-lib-message alert"></div>
         <img class="media-lib-loading" src="/storage/loading.gif" alt="loading..." />

     </div>

     <div class="media-lib-panel d-none d-md-block">

           <img src="" class="media-lib-icon" />

           <select class="media-lib-sizes">
             <option>Малък размер</option>
             <option>Среден размер</option>
             <option>Голям размер</option>
             <option>Огромен размер</option>
             <option>Цял размер</option>
           </select>

           <p>File: <span class="media-name"></span> (<a href="#" class="media-lib-delete">изтрий</a>)</p>

     </div> 
  
  </div>
  <div class="media-lib-footer">
    <ul class="pagination"></ul>
    <div class="d-flex">
    <form method="POST">
      <button type="button" class="btn btn-success">Choose File</button>
      <input type="file" class="d-none" name="file" />
    </form>
    <button type="button" name="pick" id="pick" class="ml-2 btn btn-primary">Зареди</button>
    </div>
  </div>

</div>
</div>`;

  }

}

class MediaLibPagination {

  constructor(jQuery) {
    
    this.$ = jQuery;

    this.totalPages = 1; 
    this.currentPage = 1; 
    this.lastPageUrl = null;
    this.firstPageUrl = null; 
    this.nextPageUrl = null;
    this.prevPageUrl = null;

  }

  load(laravelPagination, callback) {

    this.currentPage = laravelPagination.current_page;
    this.totalPages = laravelPagination.last_page; 
    this.lastPageUrl = laravelPagination.last_page_url;
    this.firstPageUrl = laravelPagination.path;
    this.nextPageUrl = laravelPagination.next_page_url;
    this.prevPageUrl = laravelPagination.prev_page_url;

    this.onLinkClick(callback);
    return this;
  }

  onLinkClick(callback) {

     this.linkClick = callback;
     return this;
  }

  render() {

   this.pagination = this.$(`<ul class="pagination">
              
                                <li class="page-item ${this.currentPage == 1 ? 'disabled' : null}">
                                    <a class="page-link" href="${this.firstPageUrl}"><<</a>
                                </li>
                                
                                <li class="page-item ${this.currentPage == 1 ? 'disabled' : null}"">
                                    <a class="page-link" href="${this.prevPageUrl}"><</a>
                                </li>

                                <li class="page-item disabled">
                                    <a class="page-link" href="#">${this.currentPage} / ${this.totalPages}</a>
                                </li>

                                <li class="page-item ${this.currentPage == this.totalPages ? 'disabled' : null}">
                                    <a class="page-link" href="${this.nextPageUrl}">></a>
                                </li>

                                <li class="page-item ${this.currentPage == this.totalPages ? 'disabled' : null}">
                                    <a class="page-link" href="${this.lastPageUrl}">>></a>
                                </li>

                                </ul>`);

     this.pagination.find('.page-link').on('click', ev => {

        ev.preventDefault();
     
        this.linkClick(ev.target.href);

     });
    
     return this.pagination;
  }

}



class MediaLibField {
  
  constructor(jQuery, fieldName) {

    this.$ = jQuery;
    this.items = [];
    this.domElements = [];

    this.opener = this.$('[data-media-field="'+fieldName+'"]');
    
    /*Abort if there is no opener/button */
    if(!this.opener.length) return;

    this.fieldName = fieldName;

    this.multiple = false; 
    this.mediaLib = new MediaLib($);
    this.mediaLib.onFinish(item => this.push(item));

    this.public_dir = '/storage';
    this.mediaLib.publicDir = this.public_dir;

    
    this.field = this.$(`<div class="media-lib-field"><input type="hidden" value="" name="${fieldName}" /></div>`);
    this.opener.after(this.field);



    this.multiple = parseInt(this.opener.attr('data-media-multiple')) || this.opener[0].hasAttribute('data-media-multiple');


    this.opener.on('click', ev =>  this.mediaLib.open());

    this.openerValue = this.opener.attr('data-media-value');
     
    if(this.openerValue) {
      
       try {
         
         let values = JSON.parse(this.openerValue);
         
         if(typeof values == 'object' && values.length > 0) {

            this.load(values);

         }

       } catch(error) {


       }

    }

  }

  set publicDir(dir) {

    this.public_dir = dir;

  }

  get publicDir() {

    return this.public_dir;

  }

  load(items) {
    
    items.map(item => {
     
       if(item.url && item.url.search(this.public_dir) == -1) item.url = this.public_dir+item.url;
       if(item.icon && item.icon.search(this.public_dir) == -1) item.icon = this.public_dir+item.icon;

       this.push(item)

      });

    return this;

  }

  push(item) {
    

    this.items.push(item);
    this.prepareDom(item);

    return this;

  }

  remove(index) {

    delete this.items[index];

    return this;     

  }

  setValue() {
     
     let val = this.items.filter(item => { return item});
     this.field.find('input').val(JSON.stringify(val))
     return this;

  }
  
  destroy() {

      this.$('.media-lib-field-item button').trigger('click');

  }

  prepareDom(item) {

    let itemDom = this.$(`<div class="media-lib-field-item">
                            <img src="${item.icon || item.url}" alt="${item.title}" />
                            <button type="button" class="btn btn-danger">Изтрий</button>
                          </div>`);
     
     let index = this.domElements.push(itemDom)-1;   
     
     this.setValue();                   

     itemDom.find('button').on('click', ev => {

        this.$(ev.target).closest('.media-lib-field-item').remove();
        this.remove(index);
        
        delete this.domElements[index];
        this.setValue();

        if((!this.multiple && this.domElements.filter(el => el).length < 1) || 
             this.multiple > this.items.filter(el => el).length) this.opener.show();

     });

     this.field.append(itemDom);

     if(!this.multiple || this.multiple === this.items.filter(el => el).length) this.opener.hide();

  }

}

  export { MediaLib, MediaLibField, MediaLibPagination};