@extends('backend.master')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="bi bi-house-door fs-6"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Menus</li>
                </ol>
            </nav>
            <h2 class="h4">Menus</h2>
            <small class="mb-0">Manage Multi-language Menus</small>
        </div>

        <div class="mt-3 mt-md-0">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMenuModal">
                <i class="bi bi-plus-circle me-1"></i> Add Menu
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h5 class="card-title mb-0">Menu List</h5>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Menu Name (Current)</th>
                                <th>Type</th>
                                <th>Link</th>
                                <th>Position</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($menus as $menu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- Trait এর মাধ্যমে বর্তমান ভাষার নাম দেখানো হচ্ছে --}}
                                    <td><strong>{{ $menu->getTranslation('name') }}</strong></td>
                                    <td>{{ ucfirst($menu->menu_type) }}</td>
                                    <td>
                                        @if ($menu->menu_type == 'page' && $menu->page_id)
                                            <span class="badge bg-light text-primary">Page: {{ $menu->page->page_title ?? 'N/A' }}</span>
                                        @elseif ($menu->menu_type == 'language' && $menu->lang_id)
                                            <span class="badge bg-light text-success">Lang Link: {{ $menu->language->name ?? 'N/A' }}</span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>{{ ucfirst($menu->position) }}</td>
                                    <td>{{ $menu->order }}</td>
                                    <td>
                                        <span class="badge {{ $menu->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $menu->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-secondary text-white"
                                            onclick="editMenu({{ $menu->id }})">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <form id="delete-form-{{ $menu->id }}"
                                            action="{{ route('admin.menu.delete', $menu->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="confirmDelete({{ $menu->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">No menus found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= ADD MENU MODAL ================= --}}
    <div class="modal fade" id="addMenuModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.menu.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        {{-- MultiLang অনুযায়ী ডাইনামিক নাম ইনপুট --}}
                        <div class="p-2 bg-light mb-3 rounded">
                            <h6>Menu Names (Multi-language)</h6>
                            @foreach($multiLanguages as $lang)
                                <div class="mb-2">
                                    <label class="form-label small mb-0">{{ $lang->name }} Name ({{ strtoupper($lang->code) }})</label>
                                    <input type="text" name="name_{{ $lang->code }}" class="form-control form-control-sm"
                                           placeholder="Enter menu name in {{ $lang->name }}" {{ $lang->code == 'en' ? 'required' : '' }}>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Menu Type</label>
                            <select name="menu_type" class="form-control" id="menu_type_select" required>
                                <option value="">-- Select Type --</option>
                                <option value="page">Page</option>
                                <option value="language">Language</option>
                            </select>
                        </div>

                        <div class="mb-2" id="dynamic_dropdown_container" style="display:none;">
                            <label class="form-label" id="dynamic_label"></label>
                            <select name="dynamic_id" id="dynamic_select" class="form-control">
                                <option value="">-- Select --</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Position</label>
                                <select name="position" class="form-control" required>
                                    <option value="header">Header</option>
                                    <option value="footer">Footer</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Order</label>
                                <input type="number" name="order" class="form-control" value="0">
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Save Menu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= EDIT MENU MODAL ================= --}}
    <div class="modal fade" id="editMenuModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" id="editMenuForm">
                @csrf
                {{-- update method post হিসেবে কাজ করছে কন্ট্রোলারে, তাই method PUT দেয়ার প্রয়োজন নেই যদি কন্ট্রোলার route এ post থাকে --}}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        {{-- MultiLang অনুযায়ী ডাইনামিক নাম এডিট ইনপুট --}}
                        <div class="p-2 bg-light mb-3 rounded">
                            <h6>Menu Names (Multi-language)</h6>
                            @foreach($multiLanguages as $lang)
                                <div class="mb-2">
                                    <label class="form-label small mb-0">{{ $lang->name }} Name ({{ strtoupper($lang->code) }})</label>
                                    <input type="text" name="name_{{ $lang->code }}" id="edit-name-{{ $lang->code }}"
                                           class="form-control form-control-sm">
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Menu Type</label>
                            <select name="menu_type" id="edit-menu-type" class="form-control" required>
                                <option value="page">Page</option>
                                <option value="language">Language</option>
                            </select>
                        </div>

                        <div class="mb-2" id="edit_dynamic_container" style="display:none;">
                            <label class="form-label" id="edit_dynamic_label"></label>
                            <select name="dynamic_id" id="edit_dynamic_select" class="form-control">
                                <option value="">-- Select --</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Position</label>
                                <select name="position" id="edit-position" class="form-control" required>
                                    <option value="header">Header</option>
                                    <option value="footer">Footer</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Order</label>
                                <input type="number" name="order" id="edit-order" class="form-control">
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Status</label>
                            <select name="status" id="edit-status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Update Menu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // কন্ট্রোলার থেকে আসা পুরাতন লজিকের ডাটা
        const pages = @json($pages);
        const oldLanguages = @json($languages); // old logic Language model data
        const multiLangs = @json($multiLanguages); // new multi-language translation data

        // ================= ADD MENU DYNAMIC SELECT =================
        document.getElementById('menu_type_select').addEventListener('change', function() {
            updateDynamicDropdown(this.value, 'dynamic_dropdown_container', 'dynamic_label', 'dynamic_select');
        });

        // ================= EDIT MENU DYNAMIC SELECT =================
        document.getElementById('edit-menu-type').addEventListener('change', function() {
            updateDynamicDropdown(this.value, 'edit_dynamic_container', 'edit_dynamic_label', 'edit_dynamic_select');
        });

        // ================= REUSABLE DROPDOWN FUNCTION =================
        function updateDynamicDropdown(type, containerId, labelId, selectId, selectedId = null) {
            const container = document.getElementById(containerId);
            const label = document.getElementById(labelId);
            const select = document.getElementById(selectId);
            select.innerHTML = '<option value="">-- Select --</option>';

            if (type === 'page') {
                label.innerText = 'Select Page';
                pages.forEach(p => {
                    const opt = document.createElement('option');
                    opt.value = p.id;
                    opt.text = p.page_title;
                    if(selectedId && selectedId == p.id) opt.selected = true;
                    select.add(opt);
                });
                container.style.display = 'block';
            } else if (type === 'language') {
                label.innerText = 'Select Language (Old Logic)';
                oldLanguages.forEach(l => {
                    const opt = document.createElement('option');
                    opt.value = l.id;
                    opt.text = l.name;
                    if(selectedId && selectedId == l.id) opt.selected = true;
                    select.add(opt);
                });
                container.style.display = 'block';
            } else {
                container.style.display = 'none';
            }
        }

        // ================= EDIT MENU AJAX =================
        function editMenu(id) {
            const url = "{{ route('admin.menu.edit', ':id') }}".replace(':id', id);

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    // ১. মাল্টি-ল্যাঙ্গুয়েজ নাম ফিল্ডগুলো ক্লিয়ার করা
                    multiLangs.forEach(lang => {
                        document.getElementById('edit-name-' + lang.code).value = '';
                    });

                    // ২. ট্রান্সলেশন ডাটা ফিল্ডে বসানো
                    if(data.translations) {
                        data.translations.forEach(t => {
                            if(t.key === 'name') {
                                let input = document.getElementById('edit-name-' + t.locale);
                                if(input) input.value = t.value;
                            }
                        });
                    }

                    // ৩. স্ট্যাটিক ফিল্ডগুলো বসানো
                    document.getElementById('edit-menu-type').value = data.menu_type;
                    document.getElementById('edit-position').value = data.position;
                    document.getElementById('edit-order').value = data.order;
                    document.getElementById('edit-status').value = data.status;

                    // ৪. ডাইনামিক ড্রপডাউন আপডেট (Page/Language)
                    updateDynamicDropdown(data.menu_type, 'edit_dynamic_container', 'edit_dynamic_label', 'edit_dynamic_select', (data.page_id || data.lang_id));

                    // ৫. ফর্ম অ্যাকশন আপডেট
                    document.getElementById('editMenuForm').action = "{{ route('admin.menu.update', ':id') }}".replace(':id', id);

                    new bootstrap.Modal(document.getElementById('editMenuModal')).show();
                });
        }

        // ================= DELETE CONFIRM =================
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "This menu will be deleted along with its translations!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                confirmButtonText: "Yes, delete it"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
