@extends('backend.master')

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/davicotico/menu-editor@1.2.0/dist/styles.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .menu-editor-item i {
            margin-right: 6px;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-4">
        <h4 class="mb-3">Menu Builder</h4>

        <div class="row">
            {{-- MENU TREE --}}
            <div class="col-md-6">
                <div class="card card-body">
                    <div id="element-id"></div>
                </div>
            </div>

            {{-- FORM --}}
            <div class="col-md-6">
                <div class="card card-body">

                    {{-- Menu Text --}}
                    <div class="mb-2">
                        <label>Menu Title</label>
                        <input type="text" id="txtText" class="form-control">
                    </div>

                    {{-- Menu Type --}}
                    <div class="mb-2">
                        <label>Menu Source</label>
                        <select id="menuType" class="form-control">
                            <option value="page">Dynamic Page</option>
                            <option value="language">Language</option>
                        </select>
                    </div>

                    {{-- PAGE SELECT --}}
                    <div class="mb-2 d-none" id="pageBox">
                        <label>Select Page</label>
                        <select id="pageSelect" class="form-control" disabled>
                            <option value="">-- Select Page --</option>

                            {{-- Landing Page --}}
                            <option value="landing">Landing Page (Default)</option>

                            {{-- Dynamic Pages --}}
                            @foreach ($pages as $pg)
                                <option value="{{ $pg->page_slug }}">
                                    {{ $pg->page_title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- LANGUAGE SELECT --}}
                    <div class="mb-2 d-none" id="languageBox">
                        <label>Select Language</label>
                        <select id="languageSelect" class="form-control" disabled>
                            <option value="">-- Select Language --</option>
                            @foreach ($languages as $lang)
                                <option value="{{ $lang->slug }}">
                                    {{ $lang->display_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- POSITION --}}
                    <div class="mb-2">
                        <label>Menu Position</label>
                        <select id="menuPosition" class="form-control">
                            <option value="header">Header</option>
                            <option value="footer">Footer</option>
                        </select>
                    </div>

                    {{-- BUTTONS --}}
                    <div class="d-flex gap-2 mt-3">
                        <button id="btnAdd" class="btn btn-primary btn-sm">Add</button>
                        <button id="btnUpdate" class="btn btn-warning btn-sm">Update</button>
                        <button id="btnSave" class="btn btn-success btn-sm">Save</button>
                        <button id="btnEmpty" class="btn btn-danger btn-sm">Clear</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davicotico/menu-editor@1.2.0/dist/menu-editor.min.js"></script>

    <script>
        /* ================= TYPE TOGGLE ================= */
        $('#menuType').on('change', function() {
            let type = $(this).val();

            if (type === 'page') {
                $('#pageBox').removeClass('d-none');
                $('#pageSelect').prop('disabled', false);

                $('#languageBox').addClass('d-none');
                $('#languageSelect').prop('disabled', true);
            } else {
                $('#languageBox').removeClass('d-none');
                $('#languageSelect').prop('disabled', false);

                $('#pageBox').addClass('d-none');
                $('#pageSelect').prop('disabled', true);
            }
        }).trigger('change');

        /* ================= MENU EDITOR ================= */
        const menuEditor = new MenuEditor('element-id', {
            maxLevel: 3
        });
        let currentEditItem = null;

        /* LOAD MENU */
        let nestedData = {!! $menuJson !!};
        menuEditor.setArray(nestedData);
        menuEditor.mount();

        /* EDIT */
        menuEditor.onClickEdit((event) => {
            currentEditItem = event.item;
            menuEditor.edit(currentEditItem);

            const d = currentEditItem.getDataset();

            $('#txtText').val(d.text || '');
            $('#menuPosition').val(d.position || 'header');

            if (d.type === 'page') {
                $('#menuType').val('page').trigger('change');
                $('#pageSelect').val(d.slug);
            } else {
                $('#menuType').val('language').trigger('change');
                $('#languageSelect').val(d.slug);
            }
        });

        /* DELETE */
        menuEditor.onClickDelete((event) => {
            if (confirm('Delete "' + event.item.getDataset().text + '" ?')) {
                event.item.remove();
                currentEditItem = null;
            }
        });

        /* ADD */
        $('#btnAdd').on('click', function() {
            let type = $('#menuType').val();
            let slug = type === 'page' ?
                $('#pageSelect').val() :
                $('#languageSelect').val();

            if (!slug) {
                alert('Please select page or language');
                return;
            }

            menuEditor.add({
                text: $('#txtText').val(),
                slug: slug,
                href: '/' + slug,
                type: type,
                position: $('#menuPosition').val()
            });
        });

        /* UPDATE */
        $('#btnUpdate').on('click', function() {
            if (!currentEditItem) {
                alert('Select a menu first');
                return;
            }

            let type = $('#menuType').val();
            let slug = type === 'page' ?
                $('#pageSelect').val() :
                $('#languageSelect').val();

            menuEditor.update({
                text: $('#txtText').val(),
                slug: slug,
                href: '/' + slug,
                type: type,
                position: $('#menuPosition').val()
            });

            currentEditItem = null;
        });

        /* CLEAR */
        $('#btnEmpty').on('click', function() {
            if (confirm('Remove all menus?')) {
                menuEditor.empty();
                currentEditItem = null;
            }
        });

        /* SAVE */
        $('#btnSave').on('click', function() {
            fetch("{{ route('admin.menu.builder.save') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        menu: menuEditor.getArray()
                    })
                })
                .then(res => res.json())
                .then(res => alert(res.message));
        });
    </script>
@endsection
