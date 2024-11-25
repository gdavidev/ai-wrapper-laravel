<div class="card card-green direct-chat direct-chat-green" style="margin: 0; position: absolute; bottom: 0; right: 0; min-width: 500px; max-width: 800px; z-index: 20">
    <div class="card-header" data-card-widget="collapse">
        <h3 class="card-title">AI Chat</h3>
    </div>
    <div class="card-body" style="background-color: #0E0E0E">
        @if ($errorMessage !== '')
            <div class="bg-danger p-2 w-100 d-flex justify-content-between align-items-center">
                {{ $errorMessage }}
                <button type="button" class="p-2 cursor-pointer bg-transparent border-0 text-white"
                    onclick="this.parentNode.remove()">
                    X
                </button>
            </div>
        @endif
        <div class="direct-chat-messages">
            @foreach ($messages as $message)
                @if ($message['role'] === 'user')
                    <div class="direct-chat-msg right" style="color: white">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-right">You</span>
                        </div>
                        <div class="direct-chat-text" style="margin-right: 0;">
                            {{ $message['content'] }}
                        </div>
                    </div>
                @else
                    <div class="ai-direct-chat-msg">
                        <div class="direct-chat-infos d-flex aling-items-center clearfix" style="color: white; column-gap: 3px">
                            <span class="direct-chat-name float-left">Assistant</span>
                            <div class='d-flex aling-items-center ai-msg-actions' style="column-gap: 3px">
                                <a href="#" class="btn btn-sm btn-info ai-msg-append-action" style="margin-right: 0;">
                                    <i class="fas fa-plus"></i>
                                    Append
                                </a>
                                <a href="#" class="btn btn-sm btn-info ai-msg-override-action" style="margin-right: 0;">
                                    <i class="fas fa-edit"></i>
                                    Override
                                </a>
                                <a href="#" class="btn btn-sm btn-info ai-msg-override-selection-action" style="margin-right: 0;">
                                    <i class="fas fa-edit"></i>
                                    Override Selection
                                </a>
                                <a href="#"
                                    class="btn btn-sm btn-info ai-msg-copy-action"
                                    style="margin-right: 0;">
                                    <i class="fas fa-copy"></i>
                                    Copy
                                </a>
                            </div>
                        </div>
                        <span class="direct-chat-text ai-direct-chat-text" style="margin-right: 0; margin-left: 0px">
                            {{ $message['content'] }}
                        </span>
                    </div>
                @endif
            @endforeach
        </div>
        <div id='attachment' class="w-100 p-2 text-white align-items-center" style='column-gap: 3px; display: none'>
            <i class="fas fa-paperclip"></i>
            Attachment:
            <span id='attachment-text'
                class="d-inline-block text-truncate"
                style="max-width: 300px">
                {{ substr($inputAttachment, 0, 30) }}
            </span>
            <input id='attachment-content'
                type="hidden"
                name='attachment'
                wire:model="inputAttachment"/>
        </div>
    </div>
    <div class="card-footer" style="background-color: #0E0E0E">
        <div class="input-group">
            <input wire:model="inputValue"
                id="sendMessageInput"
                type="text"
                name="message"
                placeholder="Type Message ..."
                class="form-control text-white"
                style="background-color: #2E2E2E">
            <span class="input-group-append">
                <button id='send-message-btn'
                    wire:click="sendMessage"
                    onclick="$('#sendMessageInput').val('')"
                    type="button"
                    class="btn btn-primary">
                    Send
                </button>
            </span>
        </div>
    </div>
</div>
