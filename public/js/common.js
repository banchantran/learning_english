let System = {};

System.showLoading = function () {
    $('#loading').show();
}

System.hideLoading = function () {
    $('#loading').hide();
}

System.removeRow = function(e) {
    if ($(e).closest('.root-form').find('.root-row').length === 1) {
        return;
    }

    $(e).closest('.root-row').remove();
}

System.uploadAudio = function(e) {
    let inputFile = $(e).closest('.upload-audio').find('input[type="file"]');

    inputFile.click();
}

System.setAudioName = function(e) {
    let inputFile = $(e),
        audioFile = $(e).closest('.root-row').find('audio'),
        fileName = inputFile.val().match(/[^\\/]*$/)[0];

    let audioUrl = URL.createObjectURL(inputFile[0].files[0]);

    audioFile.attr('src', audioUrl);
    inputFile.closest('.upload-audio').find('span').html(fileName);
}

System.playAudio = function(e) {
    let fileAudio = $(e).closest('.root-row').find('audio');

    // stop other audio
    $('audio').each(function(){
        this.pause(); // Stop playing
        this.currentTime = 0; // Reset time
    });

    if (fileAudio.attr('src') === '') return;

    fileAudio[0].play();
}

System.addMoreRow = function(e) {
    let form = $(e).closest('form'),
        rootForm = form.find('.root-form'),
        rootRow = form.find('.root-row:first-child').clone();

    rootRow.find('input[type="hidden"]').val('');
    rootRow.find('input[type="text"]').val('');
    rootRow.find('input[type="file"]').val('');
    rootRow.find('.file-name').html('Audio');
    rootRow.find('audio').attr('src', '');

    rootForm.append(rootRow);
}

System.showEditModal = function (modalId, e) {

    let modal = $(modalId),
        url = $(e).attr('data-url');

    System.showLoading();
    System.resetModal(modalId);

    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        success: function (obj) {
            System.hideLoading();

            if (obj.success === true) {
                $.each(obj.data, function(field, value) {
                    modal.find('input[name="'+ field +'"]').val(value);
                });

                modal.modal();
            }
        },
        error: function (obj) {
            System.hideLoading();

            alert('Oops! hihi ^^');
        }
    });
}

System.showAjaxEditModal = function (modalId, e) {

    let modal = $(modalId),
        url = $(e).attr('data-url');

    System.showLoading();
    System.resetModal(modalId);

    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        success: function (obj) {
            System.hideLoading();

            modal.find('.ajax-form').html('');
            if (obj.success === true) {
                modal.find('.ajax-form').html(obj.data);
                modal.modal();
            } else {
                window.location.reload();
            }
        },
        error: function (obj) {
            System.hideLoading();

            alert('Oops! hihi ^^');
        }
    });
}

System.showModal = function (modalId, e) {
    let modal = $(modalId);

    if ($(e).attr('data-url')) {
        modal.find('.btn-primary').attr('data-url', $(e).attr('data-url'));
    }

    System.resetModal(modalId);

    // show modal
    modal.modal();
}

System.resetModal = function(modalId) {
    let modal = $(modalId);

    modal.find('.alert-danger').hide();
    modal.find('.list-errors').empty();
    modal.find('input, select').val('');
    modal.find('audio').attr('src', '');
    modal.find('[data-text-default]').each(function(i, item) {
        $(item).html($(item).attr('data-text-default'));
    });
}

System.submitForm = function (e) {
    let form = $(e).closest('form'),
        url = form.attr('action'),
        formData = new FormData(form[0]);

    System.showLoading();

    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: formData,
        contentType: false,
        processData: false,
        success: function (obj) {
            if (obj.success === true) {
                window.location.reload();
            }
        },
        error: function (obj) {
            let response = JSON.parse(obj.responseText);
            System.showErrors(form, response.errors);
            System.hideLoading();
        }
    });
}

System.showErrors = function (form, errors) {
    let listErrors = '';

    $.each(errors, function (i, item) {
        listErrors += '<li><span class="error">' + item[0] + '</span></li>';
    });

    form.find('.list-errors').html(listErrors);
    form.find('.alert-danger').show();
}

System.deleteConfirm = function (e) {
    let url = $(e).attr('data-url');

    System.showLoading();

    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        success: function (obj) {
            if (obj.success === true) {
                window.location.reload();
            }
        }
    })
}
