import { basicSetup } from "codemirror";
import { EditorView, keymap, highlightActiveLine } from "@codemirror/view";
import { EditorState } from '@codemirror/state';
import { indentWithTab } from "@codemirror/commands";
import { html } from "@codemirror/lang-html";
import { syntaxHighlighting, HighlightStyle } from '@codemirror/language';
import { tags } from '@lezer/highlight';

// Dracula-inspired theme colors
const draculaTheme = EditorView.theme({
    "&": {
        color: "#f8f8f2",
        backgroundColor: "#282a36",
        maxHeight: 'calc(100vh - 110px)',
        minHeight: 'calc(100vh - 110px)',
    },
    ".cm-content": {
        caretColor: "#f8f8f2",
        whiteSpace: 'normal'
    },
    ".cm-scroller": {
        fontFamily: "monospace",
    },
    "&.cm-focused .cm-cursor": {
        borderLeftColor: "#f8f8f2",
    },
    "&.cm-focused .cm-selectionBackground, ::selection": {
        backgroundColor: "#aaaaaa",
    },
    ".cm-gutters": {
        backgroundColor: "#282a36",
        color: "#6272a4",
        border: "none",
    },
    ".cm-activeLine": {
        backgroundColor: "#44475a",
    },
    ".cm-activeLineGutter": {
        backgroundColor: "#44475a",
    },
    ".cm-lineNumbers .cm-gutterElement": {
        color: "#6272a4",
    },
}, { dark: true });

const myHighlightStyle = HighlightStyle.define([
    { tag: tags.keyword, color: "#ff79c6" },
    { tag: [tags.name, tags.variableName], color: "#00FF00" },
    { tag: [tags.string, tags.special(tags.brace)], color: "#f1fa8c" },
    { tag: tags.number, color: "#bd93f9" },
    { tag: tags.bool, color: "#ff79c6" },
    { tag: tags.null, color: "#ff79c6" },
    { tag: tags.className, color: "#8be9fd" },
    { tag: tags.function(tags.variableName), color: "#50fa7b" },
    { tag: tags.typeName, color: "#8be9fd" },
    { tag: tags.comment, color: "#6272a4", fontStyle: "italic" },
    { tag: tags.meta, color: "#f8f8f2" },
]);

var editorView = undefined;
export function loadEditor(file) {
    editorView = new EditorView({
        state: EditorState.create({
            doc: file,
            extensions: [
                basicSetup,
                highlightActiveLine(),
                keymap.of([indentWithTab]),
                html(),
                syntaxHighlighting(myHighlightStyle),
                draculaTheme,
            ]
        }),
        parent: document.getElementById('code-editor')
    });
}

async function getFile(filePath) {
    try {
        const response = await fetch('/get-file', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({ path: filePath }),
        });
        const result = await response.text();
        console.log(result);

        return result;
    } catch (error) {
        console.error('Error getting file from server:', error);
    }
}

export async function saveFile() {
    const content = editorView.state.doc.toString();
    try {
        const response = await fetch('/save-file', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({ content: content }),
        });
        await response.json();
        $('iframe')[0].contentWindow.location.reload()
    } catch (error) {
        console.error('Error saving to server:', error);
    }
}

export function appendToEditor(text) {
    editorView.dispatch({
        changes: {
            from: editorView.state.doc.length,
            insert: text
        }
    });
}

export function overrideEditor(text) {
    editorView.dispatch({
        changes: {
            from: 0,
            to: editorView.state.doc.length,
            insert: text
        }
    });
}

export async function InitilizeEditor(startingFile) {
    $('#btn-download').click(async () => {
        await saveFile();
        const content = editorView.state.doc.toString();
        const blob = new Blob([content], { type: 'text/plain' });

        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'code.txt';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
    $('#btn-save').click(() => {
        saveFile();
    });

    const file = await getFile(startingFile)
    loadEditor(file);
}
