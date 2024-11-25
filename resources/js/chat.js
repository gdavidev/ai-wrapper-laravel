import { appendToEditor, overrideEditor, overrideSelection, saveFile } from "./code-editor";

const parent = document.getElementsByClassName('direct-chat-messages')[0]; // target element
export function InitilizeChat() {
    const observer = new MutationObserver((mutationsList) => {
        mutationsList.forEach((mutation) => {
            if (mutation.type !== 'childList') return;

            mutation.addedNodes.forEach((node) => {
                if (node.nodeType !== Node.ELEMENT_NODE) return

                const element = $(node);
                if (element.hasClass('ai-direct-chat-msg')) {
                    setupMessageActionButtons(element)
                }
            });
        });
    });

    observer.observe(parent, {
        childList: true, // observe child nodes
        subtree: false, // only observe direct children
    });

    const messageContainers = $('.ai-direct-chat-msg');
    messageContainers.each((node) => {
        setupMessageActionButtons(node)
    });

    $('#sendMessageInput').on('keyup', (e) => {
        if (e.key === 'Enter')
            $('#send-message-btn').trigger('click')
    });
}

function setupMessageActionButtons(messageElement) {
    const appendButton = $('.ai-msg-actions .ai-msg-append-action', messageElement);
    const overrideButton = $('.ai-msg-actions .ai-msg-override-action', messageElement);
    const overrideSelectionButton = $('.ai-msg-actions .ai-msg-override-selection-action', messageElement);
    const copyButton = $('.ai-msg-actions .ai-msg-copy-action', messageElement);

    const text = $('.ai-direct-chat-text', messageElement).text().trim()

    appendButton.on('click', () => { appendToEditor(text); saveFile() })
    overrideButton.on('click', () => { overrideEditor(text); saveFile() })
    overrideSelectionButton.on('click', () => { overrideSelection(text); saveFile() })
    copyButton.on('click', () => navigator.clipboard.writeText(text))
}

export function attachCodeToMessage(text) {
    forceOpen()
    $('#attachment').css('display', 'flex');
    $('#attachment-text').text(text.substring(0, 30) + '...');
    $('#attachment-content').val(text);
    $('#attachment-content')[0].dispatchEvent(new Event('input'));
}

function forceOpen() {
    const chatHandle = $('.direct-chat');
    if (chatHandle.hasClass('collapsed-card'))
        $('.card-header', chatHandle).trigger('click');
}
