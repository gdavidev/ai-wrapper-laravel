<div class="d-flex w-100 h-100">
    <div class="w-50 d-flex flex-column" style="min-height: 100%; justify-content: space-between">
        <livewire:components.code-editor />
        <livewire:components.chat />
    </div>
    <div class="w-50" style="height: 100%;">
        <iframe src="{{ $previewFilePath }}" class="w-100 h-100" frameborder="0"></iframe>
    </div>
</div>


