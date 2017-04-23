$(document).ready(function() {
    $('#category_id').change(function(event) {
        alert(1111);
        val = $(this).val();
        $.ajax({
            url: 'admin/getLesson',
            type: 'GET',
            data: {category_id: val},
            success : function(data) {
                var lesson_ids = data.lesson_ids;
                console.log(lesson_ids);

            }
        })
    });
});
