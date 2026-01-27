 <!-- Core -->
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
     integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
 </script>
 <script src="{{ asset('backend/vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
 <script src="{{ asset('backend/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('backend/vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>
 <script src="{{ asset('backend/vendor/nouislider/dist/nouislider.min.js') }}"></script>
 <script src="{{ asset('backend/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
 <script src="{{ asset('backend/vendor/chartist/dist/chartist.min.js') }}"></script>
 <script src="{{ asset('backend/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
 <script src="{{ asset('backend/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>
 <script src="{{ asset('backend/vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
 {{-- <script src="{{ asset('backend/vendor/dropify-master/dist/js/dropify.min.js') }}"></script> --}}
 <script src="{{ asset('backend/vendor/DataTables/datatables.min.js') }}"></script>
 <script src="{{ asset('backend/vendor/timepicker/jquery.timepicker.min.js') }}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
 <script src="{{ asset('backend/vendor/chosen_v1.8.7/chosen.jquery.js') }}"></script>
 <script src="{{ asset('backend/vendor/select2/select2.min.js') }}"></script>
 <script src="{{ asset('backend/vendor/notyf/notyf.min.js') }}"></script>
 <script src="{{ asset('backend/vendor/simplebar/dist/simplebar.min.js') }}"></script>
 <script src="{{ asset('backend/assets/js/volt.js') }}"></script>
 <script src="{{ asset('backend/assets/js/custom.js') }}"></script>
 <!-- Dropify JS -->
 <script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>

 <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>


 <script>
     $('#description').summernote({
         placeholder: 'Hello stand alone ui',
         tabsize: 2,
         height: 300,
         toolbar: [
             ['style', ['style']],
             ['font', ['bold', 'underline', 'clear']],
             ['color', ['color']],
             ['para', ['ul', 'ol', 'paragraph']],
             ['table', ['table']],
             ['insert', ['link', 'picture', 'video']],
             ['view', ['fullscreen', 'codeview', 'help']]
         ]
     });
 </script>


 <script>
     document.addEventListener('DOMContentLoaded', function() {
         var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
         tooltipTriggerList.map(function(tooltipTriggerEl) {
             return new bootstrap.Tooltip(tooltipTriggerEl)
         })
     });
 </script>



 @yield('script')
