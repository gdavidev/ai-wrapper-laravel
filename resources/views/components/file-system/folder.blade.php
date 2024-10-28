@foreach ($tree as $key => $value)
    @if (is_array($value))
        <div class="folder">
            <a onclick="$(this.parentNode).toggleClass('folder-closed')" class="folder-header">
                <i class="fas fa-angle-left"></i>
                <i class="fas fa-folder"></i>
                {{ $key }}
            </a>
            <div class="folder-container" style="margin-left: {{ $level * 10 }}px; border-left: solid black 1px">
                @include('components.file-system.folder', ['tree' => $value, 'level' => $level + 1])
            </div>
        </div>
    @else
        @include('components.file-system.file', ['value' => $value, 'level' => $level + 1])
    @endif
@endforeach
