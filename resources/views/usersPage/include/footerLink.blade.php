<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/js/adminlte.min.js')}}"></script>
<script src="{{asset('admin/js/select2.min.js')}}"></script>
<script src="{{asset('admin/js/summernote.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/js/demo.js')}}"></script>

<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        let slugEdited = false;

        function slugify(text) {
            return text
                .toLowerCase()
                .normalize("NFD").replace(/[\u0300-\u036f]/g, "")
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-+|-+$/g, '');
        }

        $('#name').on('keyup', function() {
            if (!slugEdited) {
                $('#slug').val(slugify($(this).val()));
            }
        });

        $('#slug').on('input', function() {
            slugEdited = $(this).val().trim() !== '';
        });

    });
    // Initialize Summernote Editor
    $('#description').summernote({
        placeholder: "Enter Description...",
        height: 250,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    function changeStatus(id, type) {
        let status = document.getElementById('switch' + id).checked ? 1 : 0;

        fetch("{{ url('admin/change-status') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    id: id,
                    type: type,
                    status: status
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    toastr.success(data.msg);
                } else {
                    toastr.error(data.msg);
                }
            });
    }
</script>