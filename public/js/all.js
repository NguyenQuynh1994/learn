$(document).ready(function () {
    $.ajaxSetup({
        beforeSend: function (xhr, settings) {
            if (settings.type == 'POST' || settings.type == 'PUT' || settings.type == 'DELETE') {
                xhr.setRequestHeader("X-CSRF-TOKEN", $('[name="csrf_token"]').attr('content'));
            }
        }
    });

    getLesson();

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image-url').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('.last-content').addClass('hidden');

    $("#image").change(function () {
        $('#image_hidden').val('');
        readURL(this);
    });

    $("#btn-back").click(function () {
        window.history.back();
    });

    $('#btn-deletes').on('click', function(event) {
        var response = confirm('Are you sure delete record selected?');
        if (response) {
            var ids = [];
            $('input[type="checkbox"]:checked').each(function() {
                ids.push($(this).val());
            });
            if (ids.length == 0) {
                alert('You have not selected record. Please select records before delete');
                return;
            }
            $.ajax({
                url: $(this).data('url'),
                type: 'DELETE',
                data: {ids: ids},
                success : function(data) {
                    location.reload(true);
                }
            });
        }
    });

    $('.btn-edit-level').on('click', function() {
        var id = $(this).data('id');
        var name = $('#name-' + id).val();
        var no = $('#no-' + id).val();

        $.ajax({
            url: $(this).data('url'),
            type: 'PUT',
            data: {
                name: name,
                no: no,
            },
            success : function(data) {
                if (data.success) {
                    location.reload(true);
                    // window.location.replace($('.btn-edit-level').data('manage'));
                }
            }
        })

    });
    $('#btn-create-level').on('click', function() {
        var name = $('#name_level').val();
        var no = $('#no_level').val();

        $.ajax({
            url: $(this).data('url'),
            type: 'POST',
            data: {
                name: name,
                no: no,
            },
            success : function(data) {
                if (data.success) {
                    location.reload(true);
                    // window.location.replace($('#btn-create-level').data('manage'));
                }
            }
        })

    });
    $('section').on('click', '#btn-create', function (event) {
        window.location.replace($(this).data('url'));
    });

    $('.select-all').on('click', function () {
        $("input[type='checkbox']").prop('checked', !$("input[type='checkbox']").prop('checked'));
    });

    $('#btn-create').on('click', function() {
        window.location.replace($(this).data('url'));
    });

    $('.btn-common').on('click', function() {
        window.location.replace($(this).data('url'));
    });

    $('#btn-manage').on('click', function() {
        window.location.replace($(this).data('url'));
    });
    $('#btn-create-lesson').on('click', function() {
        var name = $('#name').val();
        var category_id = $('#category_id').val();
        var description = $('#description').val();

        $.ajax({
            url: $(this).data('url'),
            type: 'POST',
            data: {
                name: name,
                category_id: category_id,
                description: description,
            },
            success : function(data) {
                if (data.success) {
                    location.reload(true);
                    // window.location.replace($('#btn-create-lesson').data('manage'));
                }
            }
        })

    });
    $('#btn-edit-lesson').on('click', function() {
        var id = $(this).data('id');
        var name = $('#name-' + id).val();
        var description = $('#description-' + id).val();
        var category_id = $('#category_id-' +id).val();

        $.ajax({
            url: $(this).data('url'),
            type: 'PUT',
            data: {
                name: name,
                description: description,
                category_id: category_id,
            },
            success : function(data) {
                if (data.success) {
                    location.reload(true);
                    // window.location.replace($('#btn-edit-lesson').data('manage'));
                }
            }
        })
    });
    $('#btn-create-word').on('click', function() {
        var content = $('#content').val();
        var lesson_id = $('#lesson_id').val();

        $.ajax({
            url: $(this).data('url'),
            type: 'POST',
            data: {
                content: content,
                lesson_id: lesson_id,
            },
            success : function(data) {
                if (data.success) {
                    location.reload(true);
                    // window.location.replace($('#btn-create-word').data('manage'));
                }
            }
        })

    });
    $('.btn-edit-word').on('click', function() {
        var id = $(this).data('id');
        var content = $('#content-' + id).val();
        var lesson_id = $('#lesson_id-' + id).val();
        console.log(lesson_id);
        console.log(content);
        console.log($(this).data('url'));
        $.ajax({
            url: $(this).data('url'),
            type: 'PUT',
            data: {
                content: content,
                lesson_id: lesson_id,
            },
            success : function(data) {
                if (data.success) {
                    location.reload(true);
                    // window.location.replace($('.btn-edit-word').data('manage'));
                }
            }
        })
    });

    $('#category_id_create_lesson').change(function(event) {
        getLesson();
    });
    $('#lessonword-correct').change(function(event) {
        val = $(this).val();
        $.ajax({
            url: '/admin/getLessonWord',
            type: 'POST',
            data: {lesson_id: val},
            success : function(data) {
                var option = data.html;
                $('#lesson_word_id').find('option').remove().end().append(option);
            }
        })
    });

    $('.new').on('click', function() {
        var type = parseInt($('.type').val());
        if (type == 3) {
            no = $('.manage-write').find('.row-word').last().attr('id').split('-')[1];
            no = parseInt(no) + 1;
            option = $('.manage-write').find('.row-word').last().clone();
            option.find('.input-content').attr({name: 'input-content-' + no});
            $('.manage-write').append(option);
            $('.manage-write').find('.row-word').last().attr({id: 'row-' + no});
        }
        if (type == 1 || type == 2) {
            no = $('.manage').find('.row-word').last().attr('id').split('-')[1];
            option = $('#row-' + no).clone();
            if (no == undefined){
                no = 1;
            } else {
                no = parseInt(no) + 1;
            }
            option.find('.content').attr({name: 'content-' + no});
            option.find('.correct').attr({name: 'correct-' + no});
            option.find('.image').attr({name: 'image-' + no, id: 'image-' + no});
            option.find('.img').attr({id: 'image-url-' + no});
            $('.manage').append(option);
            $('.manage').find('.row-word').last().attr({id: 'row-' + no});
        }
        if (type == 4) {
            no = $('.manage-select').find('.row-select').last().attr('id').split('-')[2];

            option = $('.manage-select').find('.row-select').last().clone();
            if (no == undefined){
                no = 1;
            } else {
                no = parseInt(no) + 1;
            }

            option.find('.select-content').attr({name: 'select-content-' + no});
            option.find('.select-correct').attr({name: 'select-correct-' + no});
            $('.manage-select').append(option);
            $('.manage-select').find('.row-select').last().attr({id: 'row-select-' + no});
        }
    });
    $('.remove').on('click', function() {
        var type = parseInt($('.type').val());
        if (type == 3) {
            no = $('.manage-write').find('.row-word').last().attr('id').split('-')[1];
            if (no == 0) {
                return;
            } else {
                $('.manage-write').find('.row-word').last().remove();
            }
        }
        if (type == 1 || type == 2) {
            no = $('.manage').find('.row-word').last().attr('id').split('-')[1];
            if (no == 0) {
                return;
            } else {
                 $('.manage').find('.row-word').last().remove();
            }
        }

        if (type == 4) {
            no = $('.manage-select').find('.row-select').last().attr('id').split('-')[2];
            if (no == 0) {
                return;
            } else {
                 $('.manage-select').find('.row-select').last().remove();
            }
        }
    });

    loadAnswerByType();

    $('.type').on('change', function() {
        loadAnswerByType();
    });

    $('.frmCreate').on('submit', function(event) {
        var type = parseInt($('.type').val());
        if (type == 3) {
            total = $('.manage-write').find('.row-word').last().attr('id').split('-')[1];
            $('.total-write').val(total);
        }
        if (type == 1 || type == 2) {
            total = $('.manage').find('.row-word').last().attr('id').split('-')[1];
            $('.total').val(total);
        }
        if (type == 4) {
            total = $('.manage-select').find('.row-select').last().attr('id').split('-')[2];
            $('.total-select').val(total);
        }
    });

    $('.done').on('click', function() {
        var type = $('.word-type').val();
        var word_id = $('#word-id').val();
        var index = $('#index').val();
        var correct = $('#correct').val();

        if (type == 1) {
            var answer_id = $('.radio input[type=radio]:checked').val();
            $.ajax({
                url: '/result',
                type: 'POST',
                data: {
                    type: type,
                    word_id: word_id,
                    answer_id: answer_id,
                    index: index,
                    correct: correct
                },
                success: function(data) {
                    $('.done').addClass('hidden');
                    $('.next').removeClass('hidden');
                    // location.reload(true);
                    if (data.success) {
                        var html = '<div class="flash alert-info"><p class="panel-body"> ' + data.message + '</p></div>';
                    } else {
                        var html = '<div class="flash alert-danger"><p class="panel-body"> ' + data.message + '</p></div>';
                    }
                    $('.row .col-md-8').last().append(html);
                }
            });
        }

        if (type == 2) {
            var answer_ids = [];

            $('input[type="checkbox"]:checked').each(function() {
                answer_ids.push($(this).val());
            });

            $.ajax({
                url: '/result',
                type: 'POST',
                data: {
                    type: type,
                    word_id: word_id,
                    answer_ids: answer_ids,
                    index: index,
                    correct: correct
                },
                success: function(data) {
                    $('.done').addClass('hidden');
                    $('.next').removeClass('hidden');
                    // location.reload(true);
                    if (data.success) {
                        var html = '<div class="flash alert-info"><p class="panel-body"> ' + data.message + '</p></div>';
                    } else {
                        var html = '<div class="flash alert-danger"><p class="panel-body"> ' + data.message + '</p></div>';
                    }
                    $('.row .col-md-8').last().append(html);
                }
            });
        }
        if (type == 3) {
            var answer = $('input.input-answer').val();

            $.ajax({
                url: '/result',
                type: 'POST',
                data: {
                    type: type,
                    word_id: word_id,
                    answer: answer,
                    index: index,
                    correct: correct
                },
                success: function(data) {
                    $('.done').addClass('hidden');
                    $('.next').removeClass('hidden');
                    // location.reload(true);
                    if (data.success) {
                        var html = '<div class="flash alert-info"><p class="panel-body"> ' + data.message + '</p></div>';
                    } else {
                        var html = '<div class="flash alert-danger"><p class="panel-body"> ' + data.message + '</p></div>';
                    }
                    $('.row .col-md-8').last().append(html);
                }
            });
        }

        if (type == 4) {
            var select_answer = $('select option:selected').val();
            $.ajax({
                url: '/result',
                type: 'POST',
                data: {
                    type: type,
                    word_id: word_id,
                    select_answer: select_answer,
                    index: index,
                    correct: correct
                },
                success: function(data) {
                    $('.done').addClass('hidden');
                    $('.next').removeClass('hidden');
                    if (data.success) {
                        var html = '<div class="flash alert-info"><p class="panel-body"> ' + data.message + '</p></div>';
                    } else {
                        var html = '<div class="flash alert-danger"><p class="panel-body"> ' + data.message + '</p></div>';
                    }
                    $('.row .col-md-8').last().append(html);
                }
            });
        }
    });

    $('.next').on('click', function() {
        $url = $(this).data('url');
        $('.row .col-md-8').last().remove();
        $('.next').addClass('hidden');
        $('.done').removeClass('hidden');
        window.location.replace($url);
    });
});
function getLesson() {
    val = $('#category_id_create_lesson').val();
    lesson = $('#lessonword-correct').val();
    if (val != '') {
        $.ajax({
            url: '/admin/getLesson',
            type: 'POST',
            data: {category_id: val},
            success : function(data) {
                var option = data.html;
                $('#lessonword-correct').find('option').remove().end().append(option);
            }
        })
    } else {
        option = '<option value="">Choose lesson</option>';
        $('#lessonword-correct').find('option').remove().end().append(option);
    }
}

function loadAnswerByType() {
    var type = parseInt($('.type').val());
    if (type == 1 || type == 2) {
        $('.manage').show();
        $('.last-content').addClass('hidden');
        $('.manage-write').addClass('hidden');
        $('.manage-select').addClass('hidden');
    }
    if ( type == 3) {
        $('.manage').hide();
        $('.managa-select').hide();
        $('.last-content').addClass('hidden');
        $('.manage-write').removeClass('hidden');
    }
    if (type == 4) {
        $('.last-content').removeClass('hidden');
        $('.manage-select').removeClass('hidden');
        $('.manage').hide();
        $('.manage-write').addClass('hidden');
    }
}
