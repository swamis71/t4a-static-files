jQuery(function($) {

  var file_frame;

  $(document).on('click', '#travel_booking_pro_team_gallery a.img-gallery-add', function(e) {

    e.preventDefault();

    if (file_frame) file_frame.close();

    file_frame = wp.media.frames.file_frame = wp.media({
      title: $(this).data('uploader-title'),
      button: {
        text: $(this).data('uploader-button-text'),
      },
      multiple: true
    });

    file_frame.on('select', function() {
      var listIndex = $('#img-gallery-metabox-list li').index($('#img-gallery-metabox-list li:last')),
          selection = file_frame.state().get('selection');

      selection.map(function(attachment, i) {
        attachment = attachment.toJSON(),
        index      = listIndex + (i + 1);

        $('#img-gallery-metabox-list').append('<li><input type="hidden" name="tb_team_gallery_ids[' + index + ']" value="' + attachment.id + '"><img class="image-preview" src="' + attachment.sizes.thumbnail.url + '"><a class="change-image button button-small" href="javascript:void(0);" data-uploader-title="' + tb_gallery_data.change_image + '" data-uploader-button-text="' + tb_gallery_data.change_image + '">' + tb_gallery_data.change_image + '</a><br><small><a class="remove-image" href="javascript:void(0);">' + tb_gallery_data.remove_image + '</a></small></li>');
      });
    });

    makeSortable();
    
    file_frame.open();

  });

  $(document).on('click', '#travel_booking_pro_team_gallery a.change-image', function(e) {

    e.preventDefault();

    var that = $(this);

    if (file_frame) file_frame.close();

    file_frame = wp.media.frames.file_frame = wp.media({
      title: $(this).data('uploader-title'),
      button: {
        text: $(this).data('uploader-button-text'),
      },
      multiple: false
    });

    file_frame.on( 'select', function() {
      attachment = file_frame.state().get('selection').first().toJSON();

      that.parent().find('input:hidden').attr('value', attachment.id);
      that.parent().find('img.image-preview').attr('src', attachment.sizes.thumbnail.url);
    });

    file_frame.open();

  });

  function resetIndex() {
    $('#img-gallery-metabox-list li').each(function(i) {
      $(this).find('input:hidden').attr('name', 'tb_team_gallery_ids[' + i + ']');
    });
  }

  function makeSortable() {
    $('#img-gallery-metabox-list').sortable({
      opacity: 0.6,
      stop: function() {
        resetIndex();
      }
    });
  }

  $(document).on('click', '#travel_booking_pro_team_gallery a.remove-image', function(e) {
    e.preventDefault();

    $(this).parents('li').animate({ opacity: 0 }, 200, function() {
      $(this).remove();
      resetIndex();
    });
  });

  makeSortable();

});