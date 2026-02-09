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
 <script src="{{ asset('backend/vendor/DataTables/datatables.min.js') }}"></script>
 <script src="{{ asset('backend/vendor/timepicker/jquery.timepicker.min.js') }}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
 <script src="{{ asset('backend/vendor/chosen_v1.8.7/chosen.jquery.js') }}"></script>
 <script src="{{ asset('backend/vendor/select2/select2.min.js') }}"></script>
 <script src="{{ asset('backend/vendor/notyf/notyf.min.js') }}"></script>
 <script src="{{ asset('backend/vendor/simplebar/dist/simplebar.min.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
 <script src="{{ asset('backend/assets/js/volt.js') }}"></script>
 <script src="{{ asset('backend/assets/js/custom.js') }}"></script>


 <script>
     var input = document.getElementById('meta_tags');
     var tagify = new Tagify(input);

     input.form.addEventListener('submit', function() {
         input.value = tagify.value.map(t => t.value).join(', ');
     });
 </script>

 <!-- Dropify JS -->
 <script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>


 <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/super-build/ckeditor.js"></script>

 <script>
     (function($) {
         $(document).ready(function() {
             let editorInstances = {};

             const editorConfig = {
                 toolbar: {
                     items: [
                         'heading', '|',
                         'bold', 'italic', 'strikethrough', 'underline', 'removeFormat', '|',
                         'bulletedList', 'numberedList', 'todoList', '|',
                         'fontSize', 'fontColor', 'fontBackgroundColor', '|',
                         'alignment', '|',
                         'link', 'insertTable', 'mediaEmbed', 'sourceEditing', '|',
                         'undo', 'redo'
                     ],
                     shouldNotGroupWhenFull: true
                 },
                 heading: {
                     options: [
                         { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                         { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                         { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                         { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                         { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                         { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                         { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                     ]
                 },
                 removePlugins: [
                     'AIAssistant', 'CKBox', 'CKFinder', 'EasyImage', 'RealTimeCollaborativeComments',
                     'RealTimeCollaborativeTrackChanges', 'RealTimeCollaborativeRevisionHistory',
                     'PresenceList', 'Comments', 'TrackChanges', 'TrackChangesData',
                     'RevisionHistory', 'Pagination', 'WProofreader', 'MathType',
                     'SlashCommand', 'Template', 'DocumentOutline', 'FormatPainter',
                     'TableOfContents', 'PasteFromOfficeEnhanced', 'CaseChange'
                 ]
             };

             function initGlobalEditor(element) {
                 if (typeof CKEDITOR === 'undefined') {
                     setTimeout(() => initGlobalEditor(element), 500);
                     return;
                 }
                 if (element.classList.contains('ck-initialized') || element.nextElementSibling?.classList.contains('ck-editor')) {
                     return;
                 }
                 CKEDITOR.ClassicEditor.create(element, editorConfig)
                 .then(editor => {
                     element.classList.add('ck-initialized');
                     const name = element.getAttribute('name') || Math.random().toString(36).substring(7);
                     editorInstances[name] = editor;
                 })
                 .catch(error => console.error(error));
             }

             $('.my-editor, #description').each(function() {
                 initGlobalEditor(this);
             });

             $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                 const targetId = $(e.target).data('bs-target');
                 $(targetId).find('.my-editor').each(function() {
                     initGlobalEditor(this);
                 });
             });

             $(document).on('submit', 'form', function() {
                 Object.values(editorInstances).forEach(editor => {
                     if (editor) editor.updateSourceElement();
                 });
             });
         });
     })(jQuery);
 </script>

 <style>
     .ck-editor__editable_inline {
         min-height: 250px !important;
         background: white !important;
         color: black !important;
     }
     .my-editor, #description { display: none; }
     .ck.ck-editor { width: 100% !important; }
 </style>



 <script>
     document.addEventListener('DOMContentLoaded', function() {
         var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
         tooltipTriggerList.map(function(tooltipTriggerEl) {
             return new bootstrap.Tooltip(tooltipTriggerEl)
         })
     });
 </script>



 @yield('script')
