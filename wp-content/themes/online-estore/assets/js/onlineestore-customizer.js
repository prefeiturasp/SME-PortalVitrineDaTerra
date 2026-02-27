jQuery(document).ready(function($){

    /*
     * Switch On/Off Control
    */
    $('body').on('click', '.onoffswitch', function(){
        var $this = $(this);
        if($this.hasClass('switch-on')){
            $(this).removeClass('switch-on');
            $this.next('input').val('off').trigger('change')
        }else{
            $(this).addClass('switch-on');
            $this.next('input').val('on').trigger('change')
        }
    });

    /**
     * Checkbox Multiple Control 
    */
    $( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on('change', function() {

            checkbox_values = $( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map( function() {
                    return this.value;
                }
            ).get().join( ',' );

            $( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
        }
    );

    /** 
      * Preloader Selection 
    */  
    $(".onlineestore-preloader").click(function (e) {
        e.preventDefault();
        var preloader = $(this).attr("preloader");      
        $(this).parents(".onlineestore-preloader-container").find('.onlineestore-preloader').removeClass('active');
        $(this).addClass('active');
        $(this).parents(".onlineestore-preloader-container").next('input:hidden').val(preloader).change();
    });


    /**
     * Repeater Fields
    */
    function education_web_refresh_repeater_values(){
        $(".onlineestore-repeater-field-control-wrap").each(function(){            
            var values = []; 
            var $this = $(this);            
            $this.find(".onlineestore-repeater-field-control").each(function(){
            var valueToPush = {};
            $(this).find('[data-name]').each(function(){
                var dataName = $(this).attr('data-name');
                var dataValue = $(this).val();
                valueToPush[dataName] = dataValue;
            });
            values.push(valueToPush);
            });
            $this.next('.onlineestore-repeater-collector').val(JSON.stringify(values)).trigger('change');
        });
    }

    $('#customize-theme-controls').on('click','.onlineestore-repeater-field-title',function(){
        $(this).next().slideToggle();
        $(this).closest('.onlineestore-repeater-field-control').toggleClass('expanded');
    });
    $('#customize-theme-controls').on('click', '.onlineestore-repeater-field-close', function(){
        $(this).closest('.onlineestore-repeater-fields').slideUp();;
        $(this).closest('.onlineestore-repeater-field-control').toggleClass('expanded');
    });

    $("body").on("click",'.onlineestore-add-control-field', function(){
        var $this = $(this).parent();
        if(typeof $this != 'undefined') {
            var field = $this.find(".onlineestore-repeater-field-control:first").clone();
            if(typeof field != 'undefined'){                
                field.find("input[type='text'][data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });
                field.find("textarea[data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });
                field.find("select[data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });

                field.find(".onlineestore-icon-list").each(function(){
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);
                    $(this).prev('.onlineestore-selected-icon').children('i').attr('class','').addClass(defaultValue);
                    
                    $(this).find('li').each(function(){
                        var icon_class = $(this).find('i').attr('class');
                        if(defaultValue == icon_class ){
                            $(this).addClass('icon-active');
                        }else{
                            $(this).removeClass('icon-active');
                        }
                    });
                });

                field.find(".attachment-media-view").each(function(){
                    var defaultValue = $(this).find('input[data-name]').attr('data-default');
                    $(this).find('input[data-name]').val(defaultValue);
                    if(defaultValue){
                        $(this).find(".thumbnail-image").html('<img src="'+defaultValue+'"/>').prev('.placeholder').addClass('hidden');
                    }else{
                        $(this).find(".thumbnail-image").html('').prev('.placeholder').removeClass('hidden');   
                    }
                });

                field.find('.onlineestore-fields').show();

                $this.find('.onlineestore-repeater-field-control-wrap').append(field);

                field.addClass('expanded').find('.onlineestore-repeater-fields').show(); 
                $('.accordion-section-content').animate({ scrollTop: $this.height() }, 1000);
                education_web_refresh_repeater_values();
            }

        }
        return false;
     });
    
    $("#customize-theme-controls").on("click", ".onlineestore-repeater-field-remove",function(){
        if( typeof  $(this).parent() != 'undefined'){
            $(this).closest('.onlineestore-repeater-field-control').slideUp('normal', function(){
                $(this).remove();
                education_web_refresh_repeater_values();
            });         
        }
        return false;
    });

    $("#customize-theme-controls").on('keyup change', '[data-name]',function(){
         education_web_refresh_repeater_values();
         return false;
    });


    // Set all variables to be used in scope
    var frame;
    // ADD IMAGE LINK
    $('.customize-control-repeater').on( 'click', '.onlineestore-upload-button', function( event ){
        event.preventDefault();
        var imgContainer = $(this).closest('.onlineestore-fields-wrap').find( '.thumbnail-image'),
        placeholder = $(this).closest('.onlineestore-fields-wrap').find( '.placeholder'),
        imgIdInput = $(this).siblings('.upload-id');

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Image',
            button: {
            text: 'Use Image'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected in the media frame...
        frame.on( 'select', function() {
            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();
            // Send the attachment URL to our custom image input field.
            imgContainer.html( '<img src="'+attachment.url+'" style="max-width:100%;"/>' );
            placeholder.addClass('hidden');
            // Send the attachment id to our hidden input
            imgIdInput.val( attachment.url ).trigger('change');
        });

        // Finally, open the modal on click
        frame.open();
    });


    // DELETE IMAGE LINK
    $('.customize-control-repeater').on( 'click', '.onlineestore-delete-button', function( event ){

        event.preventDefault();
        var imgContainer = $(this).closest('.onlineestore-fields-wrap').find( '.thumbnail-image'),
        placeholder = $(this).closest('.onlineestore-fields-wrap').find( '.placeholder'),
        imgIdInput = $(this).siblings('.upload-id');

        // Clear out the preview image
        imgContainer.find('img').remove();
        placeholder.removeClass('hidden');

        // Delete the image id from the hidden input
        imgIdInput.val( '' ).trigger('change');

    });


    $('body').on('click', '.onlineestore-icon-list li', function(){
        var icon_class = $(this).find('i').attr('class');
        $(this).addClass('icon-active').siblings().removeClass('icon-active');
        $(this).parent('.onlineestore-icon-list').prev('.onlineestore-selected-icon').children('i').attr('class','').addClass(icon_class);
        $(this).parent('.onlineestore-icon-list').next('input').val(icon_class).trigger('change');
        education_web_refresh_repeater_values();
    });

    $('body').on('click', '.onlineestore-selected-icon', function(){
        $(this).next().slideToggle();
    });

    /*Drag and drop to change order*/
    $(".onlineestore-repeater-field-control-wrap").sortable({
        orientation: "vertical",
        update: function( event, ui ) {
            education_web_refresh_repeater_values();
        }
    });


    /**
     * Radio Image control in customizer
     */
    // Use buttonset() for radio images.
    $( '.customize-control-radio-image .buttonset' ).buttonset();

    // Handles setting the new value in the customizer.
    $( '.customize-control-radio-image input:radio' ).change(
        function() {

            // Get the name of the setting.
            var setting = $( this ).attr( 'data-customize-setting-link' );

            // Get the value of the currently-checked radio input.
            var image = $( this ).val();

            // Set the new value.
            wp.customize( setting, function( obj ) {

                obj.set( image );
            } );
        }
    );

});