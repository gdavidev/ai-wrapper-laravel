import { appendToEditor, overrideEditor, saveFile } from "./code-editor";

export function InitilizeChat() {
    const parent = document.getElementsByClassName('direct-chat-messages')[0]; // target element
    const observer = new MutationObserver((mutationsList) => {
        mutationsList.map((item) => {
            const node = $(item.target);
            const appendButton = $('.ai-msg-actions .ai-msg-append-action', node);
            const overrideButton = $('.ai-msg-actions .ai-msg-override-action', node);
            const text = $('.ai-direct-chat-text', node).text().trim()

            appendButton.on('click', () => { appendToEditor(text); saveFile() })
            overrideButton.on('click', () => { overrideEditor(text); saveFile() })
        });
    });

    observer.observe(parent, {
        childList: true, // observe child nodes
        subtree: false, // only observe direct children
    });

    const messageContainers = $('.ai-direct-chat-msg');
    messageContainers.each((node) => {
        const appendButton = $('.ai-msg-actions .ai-msg-append-action', node);
        const overrideButton = $('.ai-msg-actions .ai-msg-override-action', node);
        const text = $('.ai-direct-chat-text', node).text().trim()

        appendButton.on('click', () => { appendToEditor(text); saveFile() })
        overrideButton.on('click', () => { overrideEditor(text); saveFile() })
    });
}
