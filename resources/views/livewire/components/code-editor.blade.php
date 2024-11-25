<div class="code-editor-wrapper">
    <div class="code-editor-overlay p-1 pb-4 position-absolute d-flex flex-column justify-content-between"
        style="z-index: 10; column-gap: 10px; right: 52%;">
        {{-- TOP --}}
        <div class='code-editor-buttons d-flex justify-content-end'>
            <a id="btn-download" class="p-2 rounded-sm text-white">
                <i class="fas fa-download"></i>
            </a>
            <a id="btn-save" class="p-2 rounded-sm text-white">
                <i class="fas fa-save"></i>
            </a>
        </div>
        {{-- BOTTOM --}}
        <div class='code-editor-buttons'>
            <a id="btn-refactor"
                class="p-2 rounded-sm text-black bg-white"
                style='display: none'>
                <i class="fas fa-edit"></i>
                Refactor Selection
            </a>
        </div>
    </div>

    {{-- THE EDITOR --}}
    <div id='code-editor'></div>
</div>
