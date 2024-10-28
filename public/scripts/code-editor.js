new EditorView({
    doc: "console.log('hello')\n",
    extensions: [basicSetup, javascript()],
    parent: document.getElementById('code-editor')
  })
