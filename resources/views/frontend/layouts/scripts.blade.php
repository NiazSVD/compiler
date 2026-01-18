<!-- Lib -->
<script src="{{ asset('frontend/assets/lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/assets/lib/popperjs/popper.min.js') }}"></script>
<script src="{{ asset('frontend/assets/lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/assets/lib/vivus-master/dist/vivus.min.js') }}"></script>

<!-- Custom -->
<script src="{{ asset('frontend/assets/js/script.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.search-box').on('keyup', function() {
            let value = $(this).val().toLowerCase().trim();
            let visibleCount = 0;

            $('#language-list .language-item').each(function() {
                let text = $(this).find('p').text().toLowerCase();

                if (text.indexOf(value) > -1) {
                    $(this).show();
                    visibleCount++;
                } else {
                    $(this).hide();
                }
            });

            if (visibleCount === 0) {
                if ($('#no-language').length === 0) {
                    $('#language-list').append(`
                        <div class="col-md-6 mx-auto" id="no-language">
                            <div class="alert alert-info text-center">
                                No language found.
                            </div>
                        </div>
                    `);
                }
            } else {
                $('#no-language').remove();
            }
        });
    });
</script>


@yield('scripts')
