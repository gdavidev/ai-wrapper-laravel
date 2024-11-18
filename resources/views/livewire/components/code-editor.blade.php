<div>
    @vite('resources/css/code-editor.css')

    <div class="code-editor-wrapper">
        <div class="code-editor-buttons p-1 position-absolute d-flex justify-content-end" style="z-index: 10; column-gap: 10px; right: 50%;">
            <a id="btn-download" class="p-2 rounded-sm text-white">
                <i class="fas fa-download"></i>
            </a>
            <a id="btn-save"class="p-2 rounded-sm text-white">
                <i class="fas fa-save"></i>
            </a>
        </div>
        <div id='code-editor'></div>
    </div>

    @vite('resources/js/code-editor.js')
</div>
