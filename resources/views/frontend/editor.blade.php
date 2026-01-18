<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->site_name ?? 'SVD Delta' }} - {{ $language->display_name }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset($settings->favicon ?? '') }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            transition: background 0.3s, color 0.3s;
        }

        body {
            display: flex;
            flex-direction: column;
            padding-top: 80px;
        }

        /* Navbar */
        .navbar {
            z-index: 10;
        }

        /* Sidebar */
        .sidebar {
            width: 90px;
            min-height: 100vh;
            height: 100%;
            background: #1a1a1a;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 10px;
        }

        /* Sidebar link */
        .sidebar a {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            padding: 12px 0;
            color: #cfd8dc;
            font-size: 20px;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 6px;
            transition: all 0.2s ease;
        }

        /* Hover */
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        /* Active */
        .sidebar a.active {
            background: #3a485c;
            color: #fff;
        }

        /* Editor & Output */
        .card,
        #editor,
        #userInput,
        #output {
            border-radius: 6px;
            transition: background 0.3s, color 0.3s;
        }

        #editor {
            width: 100%;
            flex-grow: 1;
        }

        #userInput,
        #output {
            border: 1px solid #ced4da;
            padding: 10px;
            border-radius: 6px;
        }

        #output {
            flex-grow: 1;
            overflow-y: auto;
        }

        /* Dark Mode */
        body.dark-mode {
            background: #121212;
            color: #fff;
        }

        body.dark-mode .sidebar {
            background: #1a1a1a;
        }

        body.dark-mode .card,
        body.dark-mode #editor,
        body.dark-mode #userInput,
        body.dark-mode #output {
            background: #1e1e1e;
            color: #fff;
            border-color: #444;
        }

        body.dark-mode .btn-theme {
            background-color: #ffc107;
            color: #212529;
            border: 1px solid #ffc107;
        }

        body.dark-mode .btn-theme:hover {
            background-color: #e0a800;
            color: #212529;
        }

        /* Fullscreen mode */
        body.fullscreen-mode .sidebar {
            display: none !important;
        }

        body.fullscreen-mode .container-fluid {
            width: 100% !important;
            margin-left: 0 !important;
            padding-left: 20px;
            padding-right: 20px;
        }

        body.dark-mode textarea::placeholder,
        body.dark-mode pre {
            color: #a09e9e !important;
        }

        body.dark-mode .language-description,
        body.dark-mode .language-description * {
            color: #fff !important;
        }

        body:not(.dark-mode) .language-description,
        body:not(.dark-mode) .language-description * {
            color: #000 !important;
        }

        .footer {
            background-color: #007bff;
            padding: 2rem 0;
            text-align: center;
        }

        .footer .container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .footer p {
            margin-bottom: 0;
        }

        .footer a {
            color: white;
            text-decoration: none;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
        }
    </style>
</head>

<body class="dark-mode">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top"
        style="background-color: {{ $landing->header_color ?? '#007bff' }}">
        <div class="p-2" style="margin-left: 75px">
            <a class="navbar-brand fw-bold text-white" href="{{ url('/') }}"><img
                    src="{{ asset($settings->logo) }}" style="filter: brightness(0) invert(1);"></a>
        </div>
    </nav>

    <div class="d-flex flex-grow-1">
        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column align-items-center shadow">
            <a href="{{ url('/') }}" class="{{ request()->routeIs('frontend.home') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
            </a>

            @foreach ($languages as $lang)
                @if (is_object($lang))
                    <a href="{{ route('frontend.editor', $lang->slug) }}"
                        class="{{ request()->route('slug') == $lang->slug ? 'active' : '' }}"
                        title="{{ $lang->display_name }}">


                        <img src="{{ $lang->icon_show }}" style="height: 30px; width: 30px">
                    </a>
                @endif
            @endforeach
        </div>

        <!-- Main Content -->
        <div class="container-fluid p-3 pb-0 d-flex flex-column">
            <div class="row flex-grow-1 h-100">

                <!-- Editor -->
                <div class="col-md-7 d-flex flex-column h-100">
                    <div class="card shadow-sm flex-grow-1 editor-card d-flex flex-column">
                        <div class="card-body d-flex flex-column editor-body flex-grow-1 p-3">
                            <div class="d-flex justify-content-between mb-2">
                                <h5 class="fw-bold">
                                    <i class="fa-solid fa-code me-2"></i>{{ $language->display_name }} Editor
                                </h5>
                                <div class="d-flex gap-2">
                                    <button id="fullscreenBtn" class="btn btn-secondary btn-sm"><i
                                            class="fa-solid fa-expand"></i></button>
                                    <button id="themeToggle" class="btn btn-theme btn-sm"><i
                                            class="fa-solid fa-sun"></i></button>
                                    <button id="shareBtn" class="btn btn-success btn-sm">
                                        <i class="fa-solid fa-share-nodes me-1"></i> Share
                                    </button>
                                    <button id="runBtn" class="btn btn-primary btn-sm"><i
                                            class="fas fa-play me-1"></i>Run</button>
                                </div>
                            </div>
                            <div id="editor"></div>
                        </div>
                    </div>
                </div>

                <!-- Output -->
                <div class="col-md-5 d-flex flex-column h-100">
                    <div class="card shadow-sm flex-grow-1 output-card d-flex flex-column">
                        <div class="card-body d-flex flex-column output-body flex-grow-1 p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="fw-bold mb-0">
                                    <i class="fas fa-terminal me-2"></i>User Input (stdin)
                                </h5>

                                <button id="clearBtn" class="btn btn-danger btn-sm">
                                    Clear
                                </button>
                            </div>
                            <textarea id="userInput" class="form-control mb-3" rows="3" placeholder="Input for your program"></textarea>
                            <label class="fw-semibold mb-2"><i class="fa-solid fa-tv me-2"></i>Output</label>
                            <pre id="output" class="flex-grow-1 p-3 rounded">Output will appear here...</pre>
                            <iframe id="htmlOutput"
                                style="display:none; width:100%; height:100%; border:1px solid #444; border-radius:6px; background:#fff;">
                            </iframe>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Dark Share Modal -->
        <div class="modal fade" id="shareModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content shadow-lg rounded-4 bg-dark text-light">

                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold text-white">
                            Share your code
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body pt-2">
                        <p class="text-secondary small">
                            Anyone with this link can view & edit the code.
                        </p>

                        <!-- Share link -->
                        <div class="input-group mb-3">
                            <input type="text" id="shareLinkInput"
                                class="form-control form-control-lg bg-black text-light border-secondary" readonly>

                            <button class="btn btn-primary px-4" id="copyShareLink">
                                Copy
                            </button>
                        </div>

                        <!-- Social buttons -->
                        <div class="text-center mt-4">
                            <p class="fw-semibold text-light mb-3">Share On</p>

                            <div class="d-flex justify-content-center gap-3">
                                <a href="#" id="shareFacebook"
                                    class="btn btn-outline-primary rounded-circle hw-social">
                                    <i class="fab fa-facebook-f"></i>
                                </a>

                                <a href="#" id="shareTwitter"
                                    class="btn btn-outline-light rounded-circle hw-social">
                                    <i class="fab fa-x-twitter"></i>
                                </a>

                                <a href="#" id="shareWhatsApp"
                                    class="btn btn-outline-success rounded-circle hw-social">
                                    <i class="fab fa-whatsapp"></i>
                                </a>

                                <a href="#" id="shareLinkedIn"
                                    class="btn btn-outline-info rounded-circle hw-social">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0 justify-content-center pt-0">
                        <small class="text-secondary">
                            No login required • Permanent link
                        </small>
                    </div>

                </div>
            </div>
        </div>


    </div>

    <section class="container mb-5">
        <div class="language-description">{!! $language->description !!}</div>
    </section>

    <!-- Footer -->
    <footer class="footer" style="background-color: {{ $landing->footer_color ?? '#007bff' }}">
        <div class="container">
            <p> {{ $settings->footer_text }}</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.15.2/ace.js"></script>

    <script>
        // Ace Editor
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/twilight");
        editor.session.setMode("ace/mode/javascript");
        editor.setShowPrintMargin(false);
        editor.setFontSize(16);
        editor.setOptions({
            enableBasicAutocompletion: true,
            enableSnippets: true,
            enableLiveAutocompletion: true
        });

        let lang = "{{ strtolower($language->runtime) }}";
        if (lang.includes('python')) editor.session.setMode("ace/mode/python");
        else if (lang.includes('java')) editor.session.setMode("ace/mode/java");
        else if (lang.includes('c++')) editor.session.setMode("ace/mode/c_cpp");
        else if (lang.includes('php')) editor.session.setMode("ace/mode/php");
        else if (lang.includes('html')) editor.session.setMode("ace/mode/html");

        // Theme toggle
        var darkMode = true; // default dark
        const themeToggleBtn = document.getElementById('themeToggle');
        themeToggleBtn.addEventListener('click', function() {
            darkMode = !darkMode;
            document.body.classList.toggle('dark-mode', darkMode);

            if (darkMode) {
                this.innerHTML = '<i class="fa-solid fa-sun"></i>';
                editor.setTheme("ace/theme/monokai");
            } else {
                this.innerHTML = '<i class="fa-solid fa-moon"></i>';
                editor.setTheme("ace/theme/github");
            }
        });

        // Fullscreen toggle
        const fullscreenBtn = document.getElementById('fullscreenBtn');
        fullscreenBtn.addEventListener('click', function() {
            document.body.classList.toggle('fullscreen-mode');

            if (document.body.classList.contains('fullscreen-mode')) {
                fullscreenBtn.innerHTML = '<i class="fa-solid fa-compress"></i>';
            } else {
                fullscreenBtn.innerHTML = '<i class="fa-solid fa-expand"></i>';
            }
        });

        // Run Code
        const runBtn = document.getElementById('runBtn');

        runBtn.addEventListener('click', function() {

            const code = editor.getValue();
            const stdin = document.getElementById('userInput').value;
            const output = document.getElementById('output');
            const iframe = document.getElementById('htmlOutput');
            const lang = "{{ strtolower($language->runtime) }}";

            //  HTML RUN (NO API)
            if (lang.includes('html')) {

                output.style.display = 'none';
                iframe.style.display = 'block';

                const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                iframeDoc.open();
                iframeDoc.write(code);
                iframeDoc.close();

                return;
            }

            //  OTHER LANGUAGES (API)
            iframe.style.display = 'none';
            output.style.display = 'block';

            runBtn.disabled = true;
            runBtn.innerText = 'Running...';

            fetch("{{ route('frontend.run') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        language_id: "{{ $language->id }}",
                        code: code,
                        stdin: stdin
                    })
                })
                .then(res => res.json())
                .then(data => {
                    output.innerText =
                        data.run?.stdout ||
                        data.run?.stderr ||
                        'No output';
                })
                .catch(() => {
                    output.innerText = 'Error running code!';
                })
                .finally(() => {
                    runBtn.disabled = false;
                    runBtn.innerText = '▶ Run';
                });
        });

        // Make editor 100% height
        function resizeEditor() {
            const editorContainer = document.getElementById('editor');
            const editorCard = document.querySelector('.editor-card');
            const editorBody = document.querySelector('.editor-body');
            const rowHeight = document.querySelector('.row.flex-grow-1').offsetHeight;

            editorCard.style.height = rowHeight + 'px';
            editorBody.style.height = '100%';
            editor.resize();
        }

        window.addEventListener('resize', resizeEditor);
        window.addEventListener('load', resizeEditor);
    </script>


    @if (isset($sharedCode))
        <script>
            editor.setValue(@json($sharedCode->code));
            document.getElementById('userInput').value = @json($sharedCode->stdin);
        </script>
    @endif

    <script>
        const shareBtn = document.getElementById('shareBtn');
        if (shareBtn) {
            let language = "{{ strtolower($language->runtime) }}";

            shareBtn.addEventListener('click', function() {
                fetch("{{ route('frontend.shareCode') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            language: language,
                            code: editor.getValue(),
                            stdin: document.getElementById('userInput').value
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        const link = data.url;
                        document.getElementById('shareLinkInput').value = link;

                        document.getElementById('shareFacebook').href =
                            `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(link)}`;
                        document.getElementById('shareTwitter').href =
                            `https://twitter.com/intent/tweet?url=${encodeURIComponent(link)}`;
                        document.getElementById('shareWhatsApp').href =
                            `https://wa.me/?text=${encodeURIComponent(link)}`;
                        document.getElementById('shareLinkedIn').href =
                            `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(link)}`;

                        new bootstrap.Modal(document.getElementById('shareModal')).show();
                    });
            });
        }

        document.getElementById('copyShareLink').addEventListener('click', function() {
            const input = document.getElementById('shareLinkInput');
            navigator.clipboard.writeText(input.value);

            this.innerHTML = "Copied ✔";
            this.classList.remove('btn-primary');
            this.classList.add('btn-success');

            setTimeout(() => {
                this.innerHTML = "Copy";
                this.classList.remove('btn-success');
                this.classList.add('btn-primary');
            }, 1500);
        });
    </script>


    <script>
        const clearBtn = document.getElementById('clearBtn');
        if (clearBtn) {
            clearBtn.addEventListener('click', function() {
                const outputBox = document.getElementById('output');
                if (outputBox) {
                    outputBox.innerHTML = '';
                }
                const inputBox = document.getElementById('userInput');
                if (inputBox) {
                    inputBox.value = '';
                }
            });
        }
    </script>

    <script>
        function resizeEditor() {
            const editorCard = document.querySelector('.editor-card');
            const editorBody = document.querySelector('.editor-body');
            const row = document.querySelector('.row.flex-grow-1');

            if (!editorCard || !editorBody || !row) return;

            const rowHeight = row.offsetHeight;

            editorCard.style.height = rowHeight + 'px';
            editorBody.style.height = '100%';

            editor.resize();
        }

        window.addEventListener('resize', resizeEditor);
        window.addEventListener('load', resizeEditor);

        const fullscreenBtn = document.getElementById('fullscreenBtn');

        fullscreenBtn.addEventListener('click', function() {
            document.body.classList.toggle('fullscreen-mode');

            if (document.body.classList.contains('fullscreen-mode')) {
                fullscreenBtn.innerHTML = '<i class="fa-solid fa-compress"></i>';
            } else {
                fullscreenBtn.innerHTML = '<i class="fa-solid fa-expand"></i>';
            }

        });
    </script>


</body>

</html>
