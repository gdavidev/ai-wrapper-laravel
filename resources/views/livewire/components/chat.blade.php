<div class="card card-green direct-chat direct-chat-green" style="margin: 0;">
    <div class="card-header">
        <h3 class="card-title">AI Chat</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
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
                    <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-right">You</span>
                        </div>
                        <div class="direct-chat-text" style="margin-right: 0;">
                            {{ $message['content'] }}
                        </div>
                    </div>
                @else
                    <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-left">Assistant</span>
                        </div>
                        <div class="direct-chat-text" style="margin-right: 0;">
                            {{ $message['content'] }}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="card-footer">
        <form action="#" method="post">
            <div class="input-group">
                <input wire:model="inputValue" id="sendMessageInput" type="text" name="message" placeholder="Type Message ..."
                    class="form-control">
                <span class="input-group-append">
                    <button wire:click="sendMessage" onclick="$('#sendMessageInput').val('')" type="button" class="btn btn-primary">Send</button>
                </span>
            </div>
        </form>
    </div>
</div>
